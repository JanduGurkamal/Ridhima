<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\ContactSubmission;
use App\Models\Exhibition;
use App\Models\Post;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'artworks' => [
                'total' => Artwork::count(),
                'published' => Artwork::published()->count(),
                'featured' => Artwork::featured()->count(),
            ],
            'exhibitions' => [
                'total' => Exhibition::count(),
                'published' => Exhibition::published()->count(),
                'upcoming' => Exhibition::upcoming()->count(),
            ],
            'posts' => [
                'total' => Post::count(),
                'published' => Post::published()->count(),
            ],
            'contacts' => [
                'total' => ContactSubmission::count(),
                'new' => ContactSubmission::new()->count(),
            ],
        ];

        $recentSubmissions = ContactSubmission::orderBy('created_at', 'desc')->limit(5)->get();
        $recentArtworks = Artwork::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('stats', 'recentSubmissions', 'recentArtworks'));
    }
}
