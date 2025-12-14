<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Artwork::published()->with(['category', 'images', 'tags']);

        // Filter by category
        if ($request->has('category') && $request->category) {
            $query->inCategory($request->category);
        }

        // Filter by tag
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        // Filter by year
        if ($request->has('year') && $request->year) {
            $query->where('year', $request->year);
        }

        // Filter by medium
        if ($request->has('medium') && $request->medium) {
            $query->where('medium', 'like', '%' . $request->medium . '%');
        }

        // Search
        if ($request->has('search') && $request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $artworks = $query->orderBy('order')->orderBy('created_at', 'desc')->paginate(24);
        
        $categories = Category::withCount('publishedArtworks')->get();
        $tags = Tag::withCount('artworks')->get();
        $years = Artwork::published()->distinct()->pluck('year')->filter()->sort()->reverse()->values();
        $mediums = Artwork::published()->distinct()->pluck('medium')->filter()->unique()->sort()->values();

        return view('gallery.index', compact('artworks', 'categories', 'tags', 'years', 'mediums'));
    }
}
