<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    public function index(Request $request)
    {
        $query = Exhibition::published()->with(['artworks']);

        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'upcoming':
                    $query->upcoming();
                    break;
                case 'current':
                    $query->current();
                    break;
                case 'past':
                    $query->past();
                    break;
            }
        }

        $exhibitions = $query->orderBy('start_date', 'desc')->paginate(12);

        return view('exhibitions.index', compact('exhibitions'));
    }

    public function show($slug)
    {
        $exhibition = Exhibition::published()
            ->where('slug', $slug)
            ->with(['artworks.images', 'artworks.category'])
            ->firstOrFail();

        return view('exhibitions.show', compact('exhibition'));
    }
}
