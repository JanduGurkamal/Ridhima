<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\ArtworkImage;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ArtworkSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $tags = Tag::all();

        $artworks = [
            [
                'title' => 'Sunset Over Mountains',
                'description' => 'A breathtaking landscape capturing the golden hour over majestic mountain ranges. The interplay of light and shadow creates a serene and contemplative atmosphere.',
                'medium' => 'Oil on Canvas',
                'dimensions' => '120cm x 80cm',
                'year' => 2024,
                'price' => 2500.00,
                'is_featured' => true,
                'is_published' => true,
                'order' => 1,
                'meta_title' => 'Sunset Over Mountains - Original Oil Painting',
                'meta_description' => 'Beautiful landscape oil painting featuring a stunning sunset over mountains.',
            ],
            [
                'title' => 'Urban Reflections',
                'description' => 'A contemporary piece exploring the relationship between urban architecture and natural light. The reflections in glass and water create a dynamic composition.',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '100cm x 100cm',
                'year' => 2024,
                'price' => 1800.00,
                'is_featured' => true,
                'is_published' => true,
                'order' => 2,
                'meta_title' => 'Urban Reflections - Modern Acrylic Artwork',
                'meta_description' => 'Contemporary urban scene with reflections and modern architectural elements.',
            ],
            [
                'title' => 'Portrait of Silence',
                'description' => 'An intimate portrait that captures the quiet strength and inner world of the subject. The subtle use of color and light emphasizes emotional depth.',
                'medium' => 'Charcoal and Pastel',
                'dimensions' => '60cm x 80cm',
                'year' => 2023,
                'price' => 1200.00,
                'is_featured' => false,
                'is_published' => true,
                'order' => 3,
                'meta_title' => 'Portrait of Silence - Charcoal Drawing',
                'meta_description' => 'Emotional portrait created with charcoal and pastel techniques.',
            ],
            [
                'title' => 'Abstract Harmony',
                'description' => 'Bold colors and dynamic forms come together in this abstract composition. The piece explores the balance between chaos and order, movement and stillness.',
                'medium' => 'Mixed Media',
                'dimensions' => '90cm x 90cm',
                'year' => 2024,
                'price' => 2200.00,
                'is_featured' => true,
                'is_published' => true,
                'order' => 4,
                'meta_title' => 'Abstract Harmony - Mixed Media Artwork',
                'meta_description' => 'Vibrant abstract composition using mixed media techniques.',
            ],
            [
                'title' => 'Floral Symphony',
                'description' => 'A delicate still life featuring an arrangement of seasonal flowers. The soft color palette and careful attention to detail create a sense of tranquility.',
                'medium' => 'Watercolor on Paper',
                'dimensions' => '50cm x 70cm',
                'year' => 2023,
                'price' => 850.00,
                'is_featured' => false,
                'is_published' => true,
                'order' => 5,
                'meta_title' => 'Floral Symphony - Watercolor Painting',
                'meta_description' => 'Beautiful floral still life painted with watercolors.',
            ],
            [
                'title' => 'City Lights at Night',
                'description' => 'A vibrant depiction of urban nightlife with neon lights and bustling streets. The energy of the city is captured through bold brushstrokes and rich colors.',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '150cm x 100cm',
                'year' => 2024,
                'price' => 3200.00,
                'is_featured' => true,
                'is_published' => true,
                'order' => 6,
                'meta_title' => 'City Lights at Night - Urban Artwork',
                'meta_description' => 'Dynamic cityscape painting featuring vibrant night scenes.',
            ],
            [
                'title' => 'Ocean Waves',
                'description' => 'The power and beauty of the ocean captured in this seascape. The movement of waves and the play of light on water create a mesmerizing effect.',
                'medium' => 'Oil on Canvas',
                'dimensions' => '100cm x 70cm',
                'year' => 2023,
                'price' => 1900.00,
                'is_featured' => false,
                'is_published' => true,
                'order' => 7,
                'meta_title' => 'Ocean Waves - Seascape Oil Painting',
                'meta_description' => 'Dramatic seascape showing the power and beauty of ocean waves.',
            ],
            [
                'title' => 'Minimalist Forms',
                'description' => 'A study in simplicity and form. This minimalist piece uses geometric shapes and a limited color palette to create visual harmony.',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '80cm x 80cm',
                'year' => 2024,
                'price' => 1500.00,
                'is_featured' => false,
                'is_published' => true,
                'order' => 8,
                'meta_title' => 'Minimalist Forms - Geometric Artwork',
                'meta_description' => 'Clean, minimalist composition featuring geometric forms.',
            ],
            [
                'title' => 'Dancing Shadows',
                'description' => 'An exploration of light and shadow in an interior setting. The interplay creates a sense of mystery and depth.',
                'medium' => 'Charcoal on Paper',
                'dimensions' => '70cm x 50cm',
                'year' => 2023,
                'price' => 950.00,
                'is_featured' => false,
                'is_published' => true,
                'order' => 9,
                'meta_title' => 'Dancing Shadows - Charcoal Drawing',
                'meta_description' => 'Dramatic study of light and shadow using charcoal.',
            ],
            [
                'title' => 'Spring Awakening',
                'description' => 'A celebration of spring with vibrant colors and fresh energy. The piece captures the renewal and growth of the season.',
                'medium' => 'Oil on Canvas',
                'dimensions' => '110cm x 90cm',
                'year' => 2024,
                'price' => 2400.00,
                'is_featured' => true,
                'is_published' => true,
                'order' => 10,
                'meta_title' => 'Spring Awakening - Landscape Oil Painting',
                'meta_description' => 'Vibrant spring landscape painted with oils.',
            ],
            [
                'title' => 'The Thinker',
                'description' => 'A contemplative portrait that invites viewers to reflect. The subtle expression and thoughtful composition create an intimate connection.',
                'medium' => 'Graphite on Paper',
                'dimensions' => '50cm x 60cm',
                'year' => 2023,
                'price' => 750.00,
                'is_featured' => false,
                'is_published' => true,
                'order' => 11,
                'meta_title' => 'The Thinker - Portrait Drawing',
                'meta_description' => 'Thoughtful portrait drawn with graphite pencil.',
            ],
            [
                'title' => 'Cosmic Dreams',
                'description' => 'An abstract representation of the cosmos, blending reality with imagination. The piece uses deep blues and purples to evoke the mystery of space.',
                'medium' => 'Acrylic on Canvas',
                'dimensions' => '120cm x 120cm',
                'year' => 2024,
                'price' => 2800.00,
                'is_featured' => true,
                'is_published' => true,
                'order' => 12,
                'meta_title' => 'Cosmic Dreams - Abstract Space Art',
                'meta_description' => 'Abstract artwork inspired by the cosmos and space.',
            ],
        ];

        $categoryNames = ['Paintings', 'Drawings', 'Sculptures', 'Digital Art', 'Mixed Media', 'Photography'];
        $tagNames = ['Abstract', 'Realism', 'Portrait', 'Landscape', 'Still Life', 'Contemporary', 'Modern', 'Colorful', 'Nature', 'Urban', 'Featured'];

        foreach ($artworks as $index => $artworkData) {
            // Assign random category
            $category = $categories->whereIn('name', $categoryNames)->random();
            $artworkData['category_id'] = $category->id;

            $artwork = Artwork::create($artworkData);

            // Add 1-3 images per artwork
            $imageCount = rand(1, 3);
            for ($i = 0; $i < $imageCount; $i++) {
                ArtworkImage::create([
                    'artwork_id' => $artwork->id,
                    'image_path' => 'artworks/artwork-' . $artwork->id . '-image-' . ($i + 1) . '.jpg',
                    'thumbnail_path' => 'artworks/thumbnails/artwork-' . $artwork->id . '-thumb-' . ($i + 1) . '.jpg',
                    'alt_text' => $artwork->title . ' - Image ' . ($i + 1),
                    'order' => $i + 1,
                ]);
            }

            // Attach random tags (2-5 tags per artwork)
            $availableTags = $tags->whereIn('name', $tagNames);
            if ($availableTags->count() > 0) {
                $tagCount = min(rand(2, 5), $availableTags->count());
                $artworkTags = $availableTags->random($tagCount);
                $artwork->tags()->attach($artworkTags->pluck('id'));
            }
        }
    }
}

