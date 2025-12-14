<?php

namespace App\Services;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ImageService
{
    protected ImageManager $manager;

    public function __construct()
    {
        $this->manager = new ImageManager(new Driver());
    }

    public function upload(UploadedFile $file, string $directory = 'artworks', array $sizes = []): array
    {
        $paths = [];
        $originalName = $file->getClientOriginalName();
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        
        // Store original
        $originalPath = $file->storeAs($directory, $fileName, 'public');
        $paths['original'] = $originalPath;

        // Generate thumbnails if sizes provided
        if (empty($sizes)) {
            $sizes = [
                'thumb' => [300, 300],
                'medium' => [800, 800],
                'large' => [1200, 1200],
            ];
        }

        $image = $this->manager->read(Storage::disk('public')->path($originalPath));

        foreach ($sizes as $sizeName => $dimensions) {
            [$width, $height] = $dimensions;
            
            $resized = $image->scale($width, $height);
            
            $sizePath = $directory . '/' . $sizeName . '_' . $fileName;
            Storage::disk('public')->put($sizePath, (string) $resized->encode());
            $paths[$sizeName] = $sizePath;
        }

        return $paths;
    }

    public function delete(string $path): bool
    {
        if (Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }
        return false;
    }

    public function deleteMultiple(array $paths): bool
    {
        $deleted = true;
        foreach ($paths as $path) {
            if (!$this->delete($path)) {
                $deleted = false;
            }
        }
        return $deleted;
    }

    public function getImageInfo(string $path): array
    {
        if (!Storage::disk('public')->exists($path)) {
            return [];
        }

        $image = $this->manager->read(Storage::disk('public')->path($path));
        
        return [
            'width' => $image->width(),
            'height' => $image->height(),
            'size' => Storage::disk('public')->size($path),
            'mime_type' => Storage::disk('public')->mimeType($path),
        ];
    }
}

