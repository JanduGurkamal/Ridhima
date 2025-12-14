<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Exhibition;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredArtworks = Artwork::published()
            ->featured()
            ->orderBy('order')
            ->limit(6)
            ->get();

        $recentArtworks = Artwork::published()
            ->orderBy('created_at', 'desc')
            ->limit(12)
            ->get();

        $upcomingExhibitions = Exhibition::published()
            ->upcoming()
            ->orderBy('start_date')
            ->limit(3)
            ->get();

        $recentPosts = Post::published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        $stats = [
            'artworks' => Artwork::published()->count(),
            'exhibitions' => Exhibition::published()->count(),
            'posts' => Post::published()->count(),
        ];

        return view('home', compact('featuredArtworks', 'recentArtworks', 'upcomingExhibitions', 'recentPosts', 'stats'));
    }
}
