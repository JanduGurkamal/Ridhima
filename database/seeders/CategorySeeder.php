<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Paintings',
                'slug' => 'paintings',
                'description' => 'Original oil and acrylic paintings showcasing various techniques and styles.',
                'color' => '#FF6B6B',
                'icon' => '🎨',
                'order' => 1,
            ],
            [
                'name' => 'Drawings',
                'slug' => 'drawings',
                'description' => 'Pencil, charcoal, and ink drawings capturing fine details and expressions.',
                'color' => '#4ECDC4',
                'icon' => '✏️',
                'order' => 2,
            ],
            [
                'name' => 'Sculptures',
                'slug' => 'sculptures',
                'description' => 'Three-dimensional artworks in various materials including clay, metal, and stone.',
                'color' => '#95E1D3',
                'icon' => '🗿',
                'order' => 3,
            ],
            [
                'name' => 'Digital Art',
                'slug' => 'digital-art',
                'description' => 'Contemporary digital artworks and illustrations created using modern technology.',
                'color' => '#F38181',
                'icon' => '💻',
                'order' => 4,
            ],
            [
                'name' => 'Mixed Media',
                'slug' => 'mixed-media',
                'description' => 'Artworks combining multiple materials and techniques for unique expressions.',
                'color' => '#AA96DA',
                'icon' => '🎭',
                'order' => 5,
            ],
            [
                'name' => 'Photography',
                'slug' => 'photography',
                'description' => 'Fine art photography capturing moments, emotions, and landscapes.',
                'color' => '#FCBAD3',
                'icon' => '📷',
                'order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create some subcategories
        $paintings = Category::where('slug', 'paintings')->first();
        if ($paintings) {
            Category::create([
                'name' => 'Oil Paintings',
                'slug' => 'oil-paintings',
                'description' => 'Traditional oil paintings with rich textures and vibrant colors.',
                'color' => '#FF6B6B',
                'icon' => '🖼️',
                'parent_id' => $paintings->id,
                'order' => 1,
            ]);

            Category::create([
                'name' => 'Acrylic Paintings',
                'slug' => 'acrylic-paintings',
                'description' => 'Modern acrylic paintings with bold colors and contemporary styles.',
                'color' => '#FF6B6B',
                'icon' => '🎨',
                'parent_id' => $paintings->id,
                'order' => 2,
            ]);
        }
    }
}

