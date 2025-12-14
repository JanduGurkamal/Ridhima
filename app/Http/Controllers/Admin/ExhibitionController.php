<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Exhibition;
use App\Models\Artwork;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    protected ImageService $imageService;
    protected SeoService $seoService;

    public function __construct(ImageService $imageService, SeoService $seoService)
    {
        $this->imageService = $imageService;
        $this->seoService = $seoService;
    }

    public function index()
    {
        $exhibitions = Exhibition::orderBy('start_date', 'desc')->paginate(20);
        return view('admin.exhibitions.index', compact('exhibitions'));
    }

    public function create()
    {
        $artworks = Artwork::published()->get();
        return view('admin.exhibitions.create', compact('artworks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'featured_image' => 'nullable|image|max:10240',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'artworks' => 'nullable|array',
            'artworks.*' => 'exists:artworks,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'exhibitions');
            $validated['featured_image'] = $paths['original'];
        }

        $validated['slug'] = $this->seoService->generateSlug($validated['title']);
        $validated['meta_title'] = $this->seoService->generateMetaTitle($validated['meta_title'] ?? null, $validated['title']);
        $validated['meta_description'] = $this->seoService->generateMetaDescription($validated['meta_description'] ?? null, $validated['description'] ?? '');

        $exhibition = Exhibition::create($validated);

        if ($request->has('artworks')) {
            $exhibition->artworks()->sync($request->artworks);
        }

        return redirect()->route('admin.exhibitions.index')->with('success', 'Exhibition created successfully.');
    }

    public function show(Exhibition $exhibition)
    {
        $exhibition->load(['artworks.images', 'artworks.category']);
        return view('admin.exhibitions.show', compact('exhibition'));
    }

    public function edit(Exhibition $exhibition)
    {
        $exhibition->load('artworks');
        $artworks = Artwork::published()->get();
        return view('admin.exhibitions.edit', compact('exhibition', 'artworks'));
    }

    public function update(Request $request, Exhibition $exhibition)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'venue' => 'nullable|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'featured_image' => 'nullable|image|max:10240',
            'is_published' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'artworks' => 'nullable|array',
            'artworks.*' => 'exists:artworks,id',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($exhibition->featured_image) {
                $this->imageService->delete($exhibition->featured_image);
            }
            $paths = $this->imageService->upload($request->file('featured_image'), 'exhibitions');
            $validated['featured_image'] = $paths['original'];
        }

        if ($exhibition->title !== $validated['title']) {
            $validated['slug'] = $this->seoService->generateSlug($validated['title']);
        }

        $validated['meta_title'] = $this->seoService->generateMetaTitle($validated['meta_title'] ?? null, $validated['title']);
        $validated['meta_description'] = $this->seoService->generateMetaDescription($validated['meta_description'] ?? null, $validated['description'] ?? '');

        $exhibition->update($validated);

        if ($request->has('artworks')) {
            $exhibition->artworks()->sync($request->artworks);
        } else {
            $exhibition->artworks()->detach();
        }

        return redirect()->route('admin.exhibitions.index')->with('success', 'Exhibition updated successfully.');
    }

    public function destroy(Exhibition $exhibition)
    {
        if ($exhibition->featured_image) {
            $this->imageService->delete($exhibition->featured_image);
        }

        $exhibition->delete();

        return redirect()->route('admin.exhibitions.index')->with('success', 'Exhibition deleted successfully.');
    }
}
