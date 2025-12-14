<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use App\Services\ImageService;
use App\Services\SeoService;
use Illuminate\Http\Request;

class PostController extends Controller
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
        $posts = Post::with('user')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.posts.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:10240',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('featured_image')) {
            $paths = $this->imageService->upload($request->file('featured_image'), 'posts');
            $validated['featured_image'] = $paths['original'];
        }

        $validated['user_id'] = auth()->id();
        $validated['slug'] = $this->seoService->generateSlug($validated['title']);
        $validated['meta_title'] = $this->seoService->generateMetaTitle($validated['meta_title'] ?? null, $validated['title']);
        $validated['meta_description'] = $this->seoService->generateMetaDescription($validated['meta_description'] ?? null, $validated['content']);

        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'tags']);
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $post->load('tags');
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|max:10240',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                $this->imageService->delete($post->featured_image);
            }
            $paths = $this->imageService->upload($request->file('featured_image'), 'posts');
            $validated['featured_image'] = $paths['original'];
        }

        if ($post->title !== $validated['title']) {
            $validated['slug'] = $this->seoService->generateSlug($validated['title']);
        }

        $validated['meta_title'] = $this->seoService->generateMetaTitle($validated['meta_title'] ?? null, $validated['title']);
        $validated['meta_description'] = $this->seoService->generateMetaDescription($validated['meta_description'] ?? null, $validated['content']);

        $post->update($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            $this->imageService->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post deleted successfully.');
    }
}
