<?php

namespace App\Services;

use App\Models\Library;
use App\Models\Makanan;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LibraryService
{
    /**
     * Get all library items for a user.
     *
     * @param int $userId
     * @return Collection
     */
    public function getUserLibrary(int $userId): Collection
    {
        $libraryItems = Library::where('user_id', $userId)
            ->with(['makanan.daerah'])
            ->get();

        return $libraryItems->map(function ($item) {
            return $item->makanan;
        });
    }

    /**
     * Add a food item to user's library.
     *
     * @param int $userId
     * @param int $makananId
     * @return Library|null
     */
    public function addToLibrary(int $userId, int $makananId): ?Library
    {
        // Check if already exists
        $existing = Library::where('user_id', $userId)
            ->where('makanan_id', $makananId)
            ->first();

        if ($existing) {
            return null; // Already in library
        }

        return Library::create([
            'user_id' => $userId,
            'makanan_id' => $makananId,
        ]);
    }

    /**
     * Remove a food item from user's library.
     *
     * @param int $userId
     * @param int $makananId
     * @return bool
     */
    public function removeFromLibrary(int $userId, int $makananId): bool
    {
        return Library::where('user_id', $userId)
            ->where('makanan_id', $makananId)
            ->delete() > 0;
    }

    /**
     * Check if a food item is in user's library.
     *
     * @param int $userId
     * @param int $makananId
     * @return bool
     */
    public function isInLibrary(int $userId, int $makananId): bool
    {
        return Library::where('user_id', $userId)
            ->where('makanan_id', $makananId)
            ->exists();
    }

    /**
     * Get library count for a user.
     *
     * @param int $userId
     * @return int
     */
    public function getLibraryCount(int $userId): int
    {
        return Library::where('user_id', $userId)->count();
    }

    /**
     * Get most favorited foods.
     *
     * @param int $limit
     * @return Collection
     */
    public function getMostFavorited(int $limit = 10): Collection
    {
        return Makanan::withCount('libraries')
            ->orderBy('libraries_count', 'desc')
            ->limit($limit)
            ->get();
    }
}
