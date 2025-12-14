<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use Illuminate\Http\Request;

class ArtworkController extends Controller
{
    public function show($slug)
    {
        $artwork = Artwork::published()
            ->where('slug', $slug)
            ->with(['category', 'images', 'tags', 'exhibitions'])
            ->firstOrFail();

        $artwork->incrementViews();

        $relatedArtworks = Artwork::published()
            ->where('id', '!=', $artwork->id)
            ->where(function ($query) use ($artwork) {
                if ($artwork->category_id) {
                    $query->where('category_id', $artwork->category_id);
                }
            })
            ->orWhereHas('tags', function ($q) use ($artwork) {
                $q->whereIn('tags.id', $artwork->tags->pluck('id'));
            })
            ->limit(6)
            ->get();

        return view('artwork.show', compact('artwork', 'relatedArtworks'));
    }
}
