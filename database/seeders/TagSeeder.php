<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            'Abstract',
            'Realism',
            'Portrait',
            'Landscape',
            'Still Life',
            'Contemporary',
            'Modern',
            'Classical',
            'Expressionism',
            'Impressionism',
            'Minimalist',
            'Colorful',
            'Monochrome',
            'Nature',
            'Urban',
            'Emotional',
            'Bold',
            'Delicate',
            'Large Scale',
            'Small Scale',
            'Award Winning',
            'Featured',
            'New',
            'Popular',
        ];

        foreach ($tags as $tagName) {
            Tag::create([
                'name' => $tagName,
                'slug' => \Illuminate\Support\Str::slug($tagName),
            ]);
        }
    }
}

