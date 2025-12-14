<?php

namespace App\Services;

class SeoService
{
    public function generateMetaTitle(?string $title, string $default = ''): string
    {
        if ($title) {
            return $title;
        }
        return $default ?: config('app.name');
    }

    public function generateMetaDescription(?string $description, string $content = '', int $length = 160): string
    {
        if ($description) {
            return $description;
        }
        
        if ($content) {
            $cleaned = strip_tags($content);
            return mb_substr($cleaned, 0, $length);
        }
        
        return '';
    }

    public function generateSlug(string $title): string
    {
        return \Illuminate\Support\Str::slug($title);
    }

    public function generateStructuredData($artwork): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'VisualArtwork',
            'name' => $artwork->title,
            'description' => $artwork->description,
            'image' => $artwork->featured_image ? asset('storage/' . $artwork->featured_image) : null,
            'creator' => [
                '@type' => 'Person',
                'name' => config('app.name'),
            ],
            'dateCreated' => $artwork->year,
            'artMedium' => $artwork->medium,
            'artworkSurface' => $artwork->dimensions,
        ];
    }
}

