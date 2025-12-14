<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use App\Models\Tag;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArtworkController extends Controller
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
        $artworks = Artwork::with(['category', 'images'])->orderBy('order')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.artworks.index', compact('artworks'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.artworks.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medium' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:10240',
            'images.*' => 'nullable|image|max:10240',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'artworks');
            $validated['featured_image'] = $paths['original'];
        }

        $validated['slug'] = $this->seoService->generateSlug($validated['title']);
        $validated['meta_title'] = $this->seoService->generateMetaTitle($validated['meta_title'] ?? null, $validated['title']);
        $validated['meta_description'] = $this->seoService->generateMetaDescription($validated['meta_description'] ?? null, $validated['description'] ?? '');

        $artwork = Artwork::create($validated);

        // Handle tags
        if ($request->has('tags')) {
            $artwork->tags()->sync($request->tags);
        }

        // Handle additional images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $paths = $this->imageService->upload($image, 'artworks');
                $artwork->images()->create([
                    'image_path' => $paths['original'],
                    'thumbnail_path' => $paths['thumb'] ?? null,
                    'order' => $index,
                ]);
            }
        }

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork created successfully.');
    }

    public function show(Artwork $artwork)
    {
        $artwork->load(['category', 'images', 'tags', 'exhibitions']);
        return view('admin.artworks.show', compact('artwork'));
    }

    public function edit(Artwork $artwork)
    {
        $artwork->load(['images', 'tags']);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.artworks.edit', compact('artwork', 'categories', 'tags'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'medium' => 'nullable|string|max:255',
            'dimensions' => 'nullable|string|max:255',
            'year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'is_featured' => 'boolean',
            'is_published' => 'boolean',
            'order' => 'nullable|integer',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:10240',
            'images.*' => 'nullable|image|max:10240',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($artwork->featured_image) {
                $this->imageService->delete($artwork->featured_image);
            }
            $paths = $this->imageService->upload($request->file('featured_image'), 'artworks');
            $validated['featured_image'] = $paths['original'];
        }

        if ($artwork->title !== $validated['title']) {
            $validated['slug'] = $this->seoService->generateSlug($validated['title']);
        }

        $validated['meta_title'] = $this->seoService->generateMetaTitle($validated['meta_title'] ?? null, $validated['title']);
        $validated['meta_description'] = $this->seoService->generateMetaDescription($validated['meta_description'] ?? null, $validated['description'] ?? '');

        $artwork->update($validated);

        // Handle tags
        if ($request->has('tags')) {
            $artwork->tags()->sync($request->tags);
        } else {
            $artwork->tags()->detach();
        }

        // Handle additional images
        if ($request->hasFile('images')) {
            $maxOrder = $artwork->images()->max('order') ?? -1;
            foreach ($request->file('images') as $index => $image) {
                $paths = $this->imageService->upload($image, 'artworks');
                $artwork->images()->create([
                    'image_path' => $paths['original'],
                    'thumbnail_path' => $paths['thumb'] ?? null,
                    'order' => $maxOrder + $index + 1,
                ]);
            }
        }

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork updated successfully.');
    }

    public function destroy(Artwork $artwork)
    {
        // Delete images
        if ($artwork->featured_image) {
            $this->imageService->delete($artwork->featured_image);
        }
        foreach ($artwork->images as $image) {
            $this->imageService->delete($image->image_path);
            if ($image->thumbnail_path) {
                $this->imageService->delete($image->thumbnail_path);
            }
        }

        $artwork->delete();

        return redirect()->route('admin.artworks.index')->with('success', 'Artwork deleted successfully.');
    }
}
