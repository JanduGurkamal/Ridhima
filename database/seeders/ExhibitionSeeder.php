<?php

namespace Database\Seeders;

use App\Models\Artwork;
use App\Models\Exhibition;
use Illuminate\Database\Seeder;

class ExhibitionSeeder extends Seeder
{
    public function run(): void
    {
        $artworks = Artwork::all();

        $exhibitions = [
            [
                'title' => 'Moments in Time',
                'slug' => 'moments-in-time',
                'description' => '<p>A solo exhibition exploring themes of memory, emotion, and the passage of time through a collection of 25 recent works. This exhibition represents a journey through different moments and emotions, captured in various mediums and styles.</p>

<p>The pieces range from intimate portraits to expansive landscapes, each telling a unique story while contributing to the overall narrative of the exhibition.</p>',
                'location' => 'Metropolitan Gallery',
                'venue' => '123 Art Street, New York, NY 10001',
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(55),
                'is_published' => true,
                'meta_title' => 'Moments in Time - Solo Exhibition',
                'meta_description' => 'Upcoming solo exhibition featuring 25 recent artworks exploring memory and emotion.',
            ],
            [
                'title' => 'Urban Perspectives',
                'slug' => 'urban-perspectives',
                'description' => '<p>A group exhibition featuring contemporary urban art from emerging and established artists. This show explores how artists interpret and represent city life, architecture, and urban environments.</p>

<p>The exhibition includes paintings, photographs, and mixed media works that capture the energy, complexity, and beauty of urban spaces.</p>',
                'location' => 'City Art Center',
                'venue' => '456 Downtown Ave, Los Angeles, CA 90001',
                'start_date' => now()->subDays(30),
                'end_date' => now()->subDays(5),
                'is_published' => true,
                'meta_title' => 'Urban Perspectives - Group Exhibition',
                'meta_description' => 'Group exhibition featuring contemporary urban art and cityscapes.',
            ],
            [
                'title' => 'Nature\'s Symphony',
                'slug' => 'natures-symphony',
                'description' => '<p>An exhibition celebrating the beauty and diversity of the natural world. Featuring landscapes, seascapes, and nature studies, this collection invites viewers to reconnect with the environment.</p>

<p>The artworks showcase various techniques and styles, from realistic depictions to abstract interpretations of natural forms.</p>',
                'location' => 'Green Gallery',
                'venue' => '789 Nature Way, Portland, OR 97201',
                'start_date' => now()->subDays(90),
                'end_date' => now()->subDays(60),
                'is_published' => true,
                'meta_title' => 'Nature\'s Symphony - Landscape Exhibition',
                'meta_description' => 'Exhibition featuring landscapes and nature-inspired artworks.',
            ],
            [
                'title' => 'Abstract Expressions',
                'slug' => 'abstract-expressions',
                'description' => '<p>A vibrant collection of abstract artworks exploring color, form, and emotion. This exhibition features bold compositions that challenge traditional representation and invite personal interpretation.</p>

<p>The pieces range from minimalist geometric works to dynamic, expressive compositions, showcasing the diversity of abstract art.</p>',
                'location' => 'Modern Art Space',
                'venue' => '321 Contemporary Blvd, Chicago, IL 60601',
                'start_date' => now()->addDays(20),
                'end_date' => now()->addDays(80),
                'is_published' => true,
                'meta_title' => 'Abstract Expressions - Abstract Art Exhibition',
                'meta_description' => 'Exhibition featuring contemporary abstract artworks and compositions.',
            ],
            [
                'title' => 'Portrait Stories',
                'slug' => 'portrait-stories',
                'description' => '<p>An intimate exhibition focusing on portraiture and the human experience. This collection features works that capture not just physical likeness, but the inner world and emotions of the subjects.</p>

<p>The exhibition includes drawings, paintings, and mixed media works, each telling a unique story through the art of portraiture.</p>',
                'location' => 'Portrait Gallery',
                'venue' => '654 Portrait Lane, Boston, MA 02101',
                'start_date' => now()->subDays(15),
                'end_date' => now()->addDays(15),
                'is_published' => true,
                'meta_title' => 'Portrait Stories - Portrait Exhibition',
                'meta_description' => 'Current exhibition featuring portrait artworks and human studies.',
            ],
        ];

        foreach ($exhibitions as $exhibitionData) {
            $exhibition = Exhibition::create($exhibitionData);

            // Attach 3-6 random artworks to each exhibition
            $exhibitionArtworks = $artworks->random(rand(3, 6));
            foreach ($exhibitionArtworks as $index => $artwork) {
                $exhibition->artworks()->attach($artwork->id, ['order' => $index + 1]);
            }
        }
    }
}

