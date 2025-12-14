@extends('layouts.main')

@section('title', 'Blog')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">Blog</h1>
    
    <!-- Featured Post -->
    @if($featuredPost)
    <div class="mb-12">
        <a href="{{ route('blog.show', $featuredPost->slug) }}" class="block group">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                @if($featuredPost->featured_image)
                <div class="aspect-video overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" 
                         alt="{{ $featuredPost->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                @endif
                <div>
                    <h2 class="text-3xl font-serif font-bold mb-4 group-hover:text-gray-600 transition">{{ $featuredPost->title }}</h2>
                    @if($featuredPost->excerpt)
                    <p class="text-gray-600 mb-4">{{ $featuredPost->excerpt }}</p>
                    @endif
                    <div class="flex items-center text-sm text-gray-500">
                        <span>{{ $featuredPost->published_at->format('F j, Y') }}</span>
                        @if($featuredPost->reading_time)
                        <span class="mx-2">•</span>
                        <span>{{ $featuredPost->reading_time }} min read</span>
                        @endif
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endif
    
    <!-- Posts Grid -->
    @if($posts->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($posts as $post)
        <a href="{{ route('blog.show', $post->slug) }}" class="block group">
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                @if($post->featured_image)
                <div class="aspect-video overflow-hidden">
                    <img src="{{ asset('storage/' . $post->featured_image) }}" 
                         alt="{{ $post->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-serif font-bold mb-2 group-hover:text-gray-600 transition">{{ $post->title }}</h3>
                    @if($post->excerpt)
                    <p class="text-gray-600 mb-4 line-clamp-2">{{ $post->excerpt }}</p>
                    @endif
                    <div class="flex items-center text-sm text-gray-500">
                        <span>{{ $post->published_at->format('M j, Y') }}</span>
                        @if($post->reading_time)
                        <span class="mx-2">•</span>
                        <span>{{ $post->reading_time }} min</span>
                        @endif
                    </div>
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-12">
        {{ $posts->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-600">No posts found.</p>
    </div>
    @endif
</div>
@endsection

