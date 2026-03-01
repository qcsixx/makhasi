# Image Optimization Setup Guide

## Overview

This guide provides instructions for setting up image optimization using Intervention Image library.

## Installation

### Step 1: Install Intervention Image

```bash
composer require intervention/image
```

### Step 2: Publish Configuration (Optional)

```bash
php artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
```

## Implementation

### Update AdminController

```php
use Intervention\Image\Facades\Image;

public function add(StoreMakananRequest $request)
{
    $validated = $request->validated();

    // Process and optimize image
    $image = Image::make($request->file('image'));
    
    // Resize to max 800px width, maintain aspect ratio
    $image->resize(800, null, function ($constraint) {
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    
    // Optimize quality (80% for good balance)
    $image->encode('jpg', 80);
    
    // Generate unique filename
    $filename = \Illuminate\Support\Str::uuid() . '.jpg';
    
    // Save to public/images
    $image->save(public_path('images/' . $filename));
    
    // Save to database
    $makanan = Makanan::create([
        ...$validated,
        'image' => $filename
    ]);

    return redirect()->route('feed')->with('success', 'New feed berhasil disimpan!');
}
```

### Update Method for Updates

```php
public function update($id, UpdateMakananRequest $request)
{
    $makanan = Makanan::findOrFail($id);
    $validated = $request->validated();

    if ($request->hasFile('image')) {
        // Delete old image
        File::delete(public_path('images/' . $makanan->image));

        // Process new image
        $image = Image::make($request->file('image'));
        $image->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->encode('jpg', 80);
        
        $filename = \Illuminate\Support\Str::uuid() . '.jpg';
        $image->save(public_path('images/' . $filename));
        
        $makanan->image = $filename;
    }

    $makanan->update($validated);
    return redirect()->route('feed')->with('success', 'Update berhasil!');
}
```

## Advanced Features

### Generate Thumbnails

```php
// Create thumbnail
$thumbnail = Image::make($request->file('image'))
    ->fit(300, 300)
    ->encode('jpg', 70);
    
$thumbFilename = 'thumb_' . $filename;
$thumbnail->save(public_path('images/thumbnails/' . $thumbFilename));
```

### Watermark

```php
$image->insert(public_path('images/watermark.png'), 'bottom-right', 10, 10);
```

### Multiple Sizes

```php
$sizes = [
    'large' => [1200, 80],
    'medium' => [800, 80],
    'small' => [400, 75],
    'thumb' => [150, 70],
];

foreach ($sizes as $size => $params) {
    $img = Image::make($request->file('image'))
        ->resize($params[0], null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })
        ->encode('jpg', $params[1]);
        
    $img->save(public_path("images/{$size}_{$filename}"));
}
```

## Benefits

- ✅ **Reduced file size**: 50-80% smaller files
- ✅ **Faster page loads**: Images load much quicker
- ✅ **Bandwidth savings**: Lower hosting costs
- ✅ **Better UX**: Faster perceived performance
- ✅ **SEO improvement**: Page speed is a ranking factor

## Testing

```php
// Test image processing
$originalSize = $request->file('image')->getSize();
// After processing
$newSize = filesize(public_path('images/' . $filename));
$reduction = round((($originalSize - $newSize) / $originalSize) * 100, 2);
Log::info("Image optimized: {$reduction}% reduction");
```

## Troubleshooting

### GD Library Not Found

```bash
# Ubuntu/Debian
sudo apt-get install php-gd

# After installation
sudo service apache2 restart
# or
sudo service php-fpm restart
```

### Memory Limit Issues

Update `php.ini`:
```ini
memory_limit = 256M
```

Or in code:
```php
ini_set('memory_limit', '256M');
```

## Production Considerations

1. **Use queues** for image processing to avoid timeout
2. **Store images** in cloud storage (S3, etc.)
3. **Use CDN** for serving images
4. **Implement** progressive JPEGs for better UX
5. **Consider** WebP format for modern browsers

## Optional: Queue Processing

```php
// Create job
php artisan make:job ProcessMakananImage

// In job
public function handle()
{
    $image = Image::make(storage_path('temp/' . $this->filename));
    // Process...
}

// Dispatch
ProcessMakananImage::dispatch($filename);
```

This setup is **optional** but **highly recommended** for production environments.
