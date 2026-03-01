<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    protected array $sizes = [
        'thumbnail' => [150, 150],
        'medium' => [400, 400],
        'large' => [800, 800],
    ];

    /**
     * Upload and optimize an image with multiple sizes.
     *
     * @param UploadedFile $image
     * @param string $directory
     * @return array Array of filenames for each size
     */
    public function uploadAndOptimize(UploadedFile $image, string $directory = 'images'): array
    {
        $filename = uniqid() . '.jpg'; // Always convert to JPG for consistency
        $filenames = [];

        foreach ($this->sizes as $size => $dimensions) {
            // Read image
            $img = $this->manager->read($image);

            // Resize maintaining aspect ratio (cover is equivalent to fit)
            $img->cover($dimensions[0], $dimensions[1]);

            // Optimize quality
            $encoded = $img->toJpeg(85);

            // Save to storage
            $path = "{$directory}/{$size}_{$filename}";
            Storage::disk('public')->put($path, (string) $encoded);

            $filenames[$size] = "{$size}_{$filename}";
        }

        // Also save original (optimized)
        $original = $this->manager->read($image)->toJpeg(90);
        $originalPath = "{$directory}/{$filename}";
        Storage::disk('public')->put($originalPath, (string) $original);
        $filenames['original'] = $filename;

        return $filenames;
    }

    /**
     * Delete all image sizes.
     *
     * @param string $filename Original filename
     * @param string $directory
     * @return void
     */
    public function deleteAllSizes(string $filename, string $directory = 'images'): void
    {
        // Delete original
        Storage::disk('public')->delete("{$directory}/{$filename}");

        // Delete all sizes
        foreach (array_keys($this->sizes) as $size) {
            Storage::disk('public')->delete("{$directory}/{$size}_{$filename}");
        }
    }

    /**
     * Get URL for a specific image size.
     *
     * @param string $filename
     * @param string $size
     * @param string $directory
     * @return string
     */
    public function getUrl(string $filename, string $size = 'original', string $directory = 'images'): string
    {
        if ($size === 'original') {
            return Storage::url("{$directory}/{$filename}");
        }

        return Storage::url("{$directory}/{$size}_{$filename}");
    }

    /**
     * Check if image exists.
     *
     * @param string $filename
     * @param string $directory
     * @return bool
     */
    public function exists(string $filename, string $directory = 'images'): bool
    {
        return Storage::disk('public')->exists("{$directory}/{$filename}");
    }
}
