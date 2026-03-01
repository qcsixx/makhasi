<?php

namespace App\Services;

use App\Models\Makanan;
use App\Models\Daerah;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class FoodService
{
    /**
     * Get paginated food items with optional filters.
     *
     * @param array $filters
     * @param int $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getPaginatedFoods(array $filters = [], int $perPage = 12)
    {
        $query = Makanan::with('daerah')->where('status', 'published');

        // Search filter
        if (!empty($filters['search'])) {
            $search = strip_tags($filters['search']);
            $search = htmlspecialchars($search, ENT_QUOTES, 'UTF-8');
            $query->where('nama', 'like', '%' . $search . '%');
        }

        // Region filter
        if (!empty($filters['daerah'])) {
            $query->where('daerah_id', $filters['daerah']);
        }

        // Sorting
        $sortBy = $filters['sort_by'] ?? 'created_at';
        $sortOrder = $filters['sort_order'] ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        return $query->paginate($perPage);
    }

    /**
     * Get a single food item by ID.
     *
     * @param int $id
     * @return Makanan
     */
    public function getFoodById(int $id): Makanan
    {
        return Cache::remember("food_item_{$id}", 3600, function () use ($id) {
            return Makanan::with('daerah')->findOrFail($id);
        });
    }

    /**
     * Create a new food item.
     *
     * @param array $data
     * @param UploadedFile|null $image
     * @return Makanan
     */
    public function createFood(array $data, ?UploadedFile $image = null): Makanan
    {
        return DB::transaction(function () use ($data, $image) {
            if ($image) {
                $data['image'] = $this->handleImageUpload($image);
            }

            $food = Makanan::create($data);

            // Clear relevant caches
            $this->clearFoodCaches();

            return $food;
        });
    }

    /**
     * Update an existing food item.
     *
     * @param int $id
     * @param array $data
     * @param UploadedFile|null $image
     * @return Makanan
     */
    public function updateFood(int $id, array $data, ?UploadedFile $image = null): Makanan
    {
        return DB::transaction(function () use ($id, $data, $image) {
            $food = Makanan::findOrFail($id);

            if ($image) {
                // Delete old image if exists
                if ($food->image) {
                    $this->deleteImage($food->image);
                }
                $data['image'] = $this->handleImageUpload($image);
            }

            $food->update($data);

            // Clear relevant caches
            $this->clearFoodCaches($id);

            return $food->fresh();
        });
    }

    /**
     * Delete a food item (soft delete).
     *
     * @param int $id
     * @return bool
     */
    public function deleteFood(int $id): bool
    {
        $food = Makanan::findOrFail($id);
        $result = $food->delete();

        // Clear relevant caches
        $this->clearFoodCaches($id);

        return $result;
    }

    /**
     * Get all regions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAllRegions()
    {
        return Cache::remember('daerah_list', 3600, function () {
            return Daerah::pluck('nama', 'id');
        });
    }

    /**
     * Get dashboard statistics.
     *
     * @return array
     */
    public function getDashboardStats(): array
    {
        return Cache::remember('dashboard_stats', 300, function () {
            return [
                'total_foods' => Makanan::count(),
                'published_foods' => Makanan::where('status', 'published')->count(),
                'draft_foods' => Makanan::where('status', 'draft')->count(),
                'total_regions' => Daerah::count(),
                'foods_by_region' => Makanan::select('daerah_id', DB::raw('count(*) as total'))
                    ->groupBy('daerah_id')
                    ->with('daerah')
                    ->get(),
            ];
        });
    }

    /**
     * Handle image upload.
     *
     * @param UploadedFile $image
     * @return string
     */
    protected function handleImageUpload(UploadedFile $image): string
    {
        $filename = uniqid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs('public/images', $filename);
        return $filename;
    }

    /**
     * Delete an image file.
     *
     * @param string $filename
     * @return void
     */
    protected function deleteImage(string $filename): void
    {
        $path = storage_path('app/public/images/' . $filename);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Clear food-related caches.
     *
     * @param int|null $foodId
     * @return void
     */
    protected function clearFoodCaches(?int $foodId = null): void
    {
        Cache::forget('dashboard_stats');

        if ($foodId) {
            Cache::forget("food_item_{$foodId}");
        }
    }
}
