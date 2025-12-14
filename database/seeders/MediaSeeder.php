<?php

namespace Database\Seeders;

use App\Models\Media;
use App\Models\User;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Artist',
                'email' => 'artist@example.com',
            ]);
        }

        $mediaItems = [
            [
                'name' => 'Studio Setup Photo',
                'file_name' => 'studio-setup.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/studio-setup.jpg',
                'thumbnail_path' => 'media/thumbnails/studio-setup-thumb.jpg',
                'size' => 2450000,
                'width' => 1920,
                'height' => 1080,
            ],
            [
                'name' => 'Work in Progress',
                'file_name' => 'work-in-progress.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/work-in-progress.jpg',
                'thumbnail_path' => 'media/thumbnails/work-in-progress-thumb.jpg',
                'size' => 1890000,
                'width' => 1600,
                'height' => 1200,
            ],
            [
                'name' => 'Exhibition Opening',
                'file_name' => 'exhibition-opening.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/exhibition-opening.jpg',
                'thumbnail_path' => 'media/thumbnails/exhibition-opening-thumb.jpg',
                'size' => 3200000,
                'width' => 2048,
                'height' => 1536,
            ],
            [
                'name' => 'Artist Portrait',
                'file_name' => 'artist-portrait.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/artist-portrait.jpg',
                'thumbnail_path' => 'media/thumbnails/artist-portrait-thumb.jpg',
                'size' => 1560000,
                'width' => 1200,
                'height' => 1600,
            ],
            [
                'name' => 'Color Palette',
                'file_name' => 'color-palette.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/color-palette.jpg',
                'thumbnail_path' => 'media/thumbnails/color-palette-thumb.jpg',
                'size' => 980000,
                'width' => 1500,
                'height' => 1000,
            ],
            [
                'name' => 'Gallery View',
                'file_name' => 'gallery-view.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/gallery-view.jpg',
                'thumbnail_path' => 'media/thumbnails/gallery-view-thumb.jpg',
                'size' => 2750000,
                'width' => 1920,
                'height' => 1080,
            ],
            [
                'name' => 'Brushes and Tools',
                'file_name' => 'brushes-tools.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/brushes-tools.jpg',
                'thumbnail_path' => 'media/thumbnails/brushes-tools-thumb.jpg',
                'size' => 1120000,
                'width' => 1400,
                'height' => 1050,
            ],
            [
                'name' => 'Artwork Detail',
                'file_name' => 'artwork-detail.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'media/artwork-detail.jpg',
                'thumbnail_path' => 'media/thumbnails/artwork-detail-thumb.jpg',
                'size' => 1980000,
                'width' => 1800,
                'height' => 1200,
            ],
        ];

        foreach ($mediaItems as $media) {
            $media['user_id'] = $user->id;
            Media::create($media);
        }
    }
}

