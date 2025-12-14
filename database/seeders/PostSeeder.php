<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
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

        $tags = Tag::all();

        $posts = [
            [
                'title' => 'The Journey of an Artist: Finding My Voice',
                'excerpt' => 'After years of exploring different styles and techniques, I finally discovered what truly resonates with me as an artist. This journey has been both challenging and rewarding.',
                'content' => '<p>After years of exploring different styles and techniques, I finally discovered what truly resonates with me as an artist. This journey has been both challenging and rewarding.</p>

<p>When I first started painting, I tried to emulate the masters. I studied their techniques, their color palettes, their compositions. But something was missing. I was creating beautiful paintings, but they weren\'t truly mine.</p>

<p>It wasn\'t until I started painting from my own experiences and emotions that I found my voice. The colors became more vibrant, the brushstrokes more confident, and the compositions more meaningful.</p>

<p>Now, every piece I create tells a story. Whether it\'s a landscape that reminds me of a childhood memory or a portrait that captures a fleeting emotion, each artwork is a piece of my journey.</p>

<p>To all the emerging artists out there: don\'t be afraid to experiment. Your unique voice is waiting to be discovered, and it\'s worth the journey.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(5),
                'meta_title' => 'The Journey of an Artist: Finding My Voice',
                'meta_description' => 'A personal reflection on discovering artistic voice and style through years of exploration and experimentation.',
            ],
            [
                'title' => 'Behind the Scenes: Creating "Sunset Over Mountains"',
                'excerpt' => 'Join me as I take you through the creative process behind one of my most recent paintings. From initial inspiration to final brushstroke, discover the story behind the artwork.',
                'content' => '<p>Join me as I take you through the creative process behind one of my most recent paintings. From initial inspiration to final brushstroke, discover the story behind the artwork.</p>

<p>The idea for "Sunset Over Mountains" came to me during a hiking trip last summer. As I watched the sun dip below the horizon, painting the sky in shades of orange, pink, and purple, I knew I had to capture this moment.</p>

<p>Back in my studio, I started with a series of sketches. I experimented with different compositions, trying to find the perfect balance between the sky and the mountains. The challenge was capturing the fleeting quality of light while maintaining the solidity of the landscape.</p>

<p>I chose oil paints for this piece because of their rich colors and ability to blend smoothly. The process took about three weeks, with many layers of paint building up the depth and atmosphere.</p>

<p>The final painting captures not just what I saw, but how I felt in that moment - a sense of peace, wonder, and connection to nature.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(12),
                'meta_title' => 'Behind the Scenes: Creating "Sunset Over Mountains"',
                'meta_description' => 'An inside look at the creative process behind the painting "Sunset Over Mountains".',
            ],
            [
                'title' => 'Exploring Color Theory in Contemporary Art',
                'excerpt' => 'Color is one of the most powerful tools in an artist\'s arsenal. In this post, I explore how contemporary artists are using color theory to create emotional impact and visual harmony.',
                'content' => '<p>Color is one of the most powerful tools in an artist\'s arsenal. In this post, I explore how contemporary artists are using color theory to create emotional impact and visual harmony.</p>

<h2>The Psychology of Color</h2>
<p>Colors have the ability to evoke emotions and create atmosphere. Warm colors like red, orange, and yellow can create energy and excitement, while cool colors like blue, green, and purple can evoke calmness and tranquility.</p>

<h2>Color Harmony</h2>
<p>Understanding color relationships is crucial for creating visually pleasing compositions. Complementary colors, when used together, create vibrant contrast. Analogous colors, on the other hand, create harmony and unity.</p>

<h2>Modern Applications</h2>
<p>Contemporary artists are pushing the boundaries of color theory, using unexpected combinations and bold palettes to challenge traditional notions of beauty and harmony.</p>

<p>In my own work, I often use color to guide the viewer\'s eye and create emotional resonance. Whether it\'s a monochromatic study or a vibrant explosion of color, every choice is intentional.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(20),
                'meta_title' => 'Exploring Color Theory in Contemporary Art',
                'meta_description' => 'A deep dive into how color theory is used in contemporary art to create emotional impact.',
            ],
            [
                'title' => 'Upcoming Exhibition: "Moments in Time"',
                'excerpt' => 'I\'m thrilled to announce my upcoming solo exhibition at the Metropolitan Gallery. "Moments in Time" will feature 25 of my recent works, exploring themes of memory, emotion, and the passage of time.',
                'content' => '<p>I\'m thrilled to announce my upcoming solo exhibition at the Metropolitan Gallery. "Moments in Time" will feature 25 of my recent works, exploring themes of memory, emotion, and the passage of time.</p>

<p>The exhibition will open on March 15th and run through April 30th. I\'ll be hosting an opening reception on March 15th from 6-9 PM, and I\'d love to see you there!</p>

<h2>Featured Works</h2>
<p>The exhibition will include several pieces that have never been shown before, including "Spring Awakening" and "Cosmic Dreams". I\'ve also curated a selection of earlier works to show the evolution of my artistic journey.</p>

<h2>Special Events</h2>
<p>In addition to the opening reception, I\'ll be hosting an artist talk on March 22nd where I\'ll discuss my creative process and answer questions from visitors.</p>

<p>I hope to see you there!</p>',
                'is_published' => true,
                'published_at' => now()->subDays(2),
                'meta_title' => 'Upcoming Exhibition: "Moments in Time"',
                'meta_description' => 'Announcement of upcoming solo exhibition featuring recent artworks.',
            ],
            [
                'title' => 'The Importance of Sketching: Building a Strong Foundation',
                'excerpt' => 'Many artists skip the sketching phase, but I believe it\'s one of the most important steps in creating a successful artwork. Here\'s why sketching matters and how it improves your final piece.',
                'content' => '<p>Many artists skip the sketching phase, but I believe it\'s one of the most important steps in creating a successful artwork. Here\'s why sketching matters and how it improves your final piece.</p>

<h2>Planning Your Composition</h2>
<p>Sketching allows you to experiment with different compositions before committing to paint. You can try multiple arrangements, adjust proportions, and work out potential problems before they become costly mistakes.</p>

<h2>Understanding Form and Structure</h2>
<p>Through sketching, you develop a deeper understanding of the forms you\'re working with. This knowledge translates directly to your finished work, making it more accurate and expressive.</p>

<h2>Building Confidence</h2>
<p>When you\'ve worked out the details in a sketch, you can approach your final piece with confidence. You know where you\'re going, which allows you to focus on technique and expression rather than problem-solving.</p>

<p>I always start with at least three to five sketches before beginning a painting. This process has saved me countless hours and has significantly improved the quality of my work.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(30),
                'meta_title' => 'The Importance of Sketching: Building a Strong Foundation',
                'meta_description' => 'Why sketching is crucial for creating successful artworks and improving artistic skills.',
            ],
            [
                'title' => 'Studio Tour: Where the Magic Happens',
                'excerpt' => 'Take a virtual tour of my studio space and learn about the tools, materials, and setup that help me create my artwork. Every artist\'s workspace is unique, and mine reflects my creative process.',
                'content' => '<p>Take a virtual tour of my studio space and learn about the tools, materials, and setup that help me create my artwork. Every artist\'s workspace is unique, and mine reflects my creative process.</p>

<h2>The Space</h2>
<p>My studio is a bright, airy space with large north-facing windows that provide consistent, natural light. This is crucial for accurately seeing colors and values as I work.</p>

<h2>Essential Tools</h2>
<p>I keep a wide variety of brushes, from large flats for covering big areas to tiny detail brushes for fine work. My palette is always organized with my most-used colors, and I have a separate area for mixing.</p>

<h2>Organization</h2>
<p>Organization is key to a productive studio. I have dedicated spaces for different materials - oils, acrylics, watercolors, and drawing supplies each have their own area. This saves time and keeps my workflow smooth.</p>

<h2>Inspiration Corner</h2>
<p>One wall is dedicated to inspiration - sketches, color studies, and reference photos. This visual reference helps me stay connected to my ideas and provides quick inspiration when I need it.</p>

<p>Creating a space that supports your creative process is essential. Your studio should be a place where you feel comfortable, inspired, and ready to create.</p>',
                'is_published' => true,
                'published_at' => now()->subDays(40),
                'meta_title' => 'Studio Tour: Where the Magic Happens',
                'meta_description' => 'A virtual tour of the artist\'s studio space and creative workspace.',
            ],
        ];

        $tagNames = ['Contemporary', 'Modern', 'Art', 'Creative', 'Inspiration', 'Technique', 'Exhibition', 'Process'];

        foreach ($posts as $postData) {
            $postData['user_id'] = $user->id;
            $post = Post::create($postData);

            // Attach random tags (2-4 tags per post)
            $availableTags = $tags->whereIn('name', $tagNames);
            if ($availableTags->count() > 0) {
                $tagCount = min(rand(2, 4), $availableTags->count());
                $postTags = $availableTags->random($tagCount);
                $post->tags()->attach($postTags->pluck('id'));
            }
        }
    }
}

