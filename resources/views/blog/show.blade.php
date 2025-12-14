@extends('layouts.main')

@section('title', $post->title)
@php
    $meta_title = $post->meta_title ?? $post->title;
    $meta_description = $post->meta_description ?? $post->excerpt;
    $featured_image = $post->featured_image;
@endphp

@section('content')
<article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <header class="mb-8">
        <h1 class="text-4xl md:text-5xl font-serif font-bold mb-4">{{ $post->title }}</h1>
        <div class="flex items-center text-gray-600 mb-6">
            <span>{{ $post->published_at->format('F j, Y') }}</span>
            @if($post->reading_time)
            <span class="mx-2">•</span>
            <span>{{ $post->reading_time }} min read</span>
            @endif
        </div>
        @if($post->featured_image)
        <img src="{{ asset('storage/' . $post->featured_image) }}" 
             alt="{{ $post->title }}"
             class="w-full rounded-lg shadow-lg mb-8">
        @endif
    </header>
    
    <div class="prose prose-lg max-w-none">
        {!! $post->content !!}
    </div>
    
    @if($post->tags->count() > 0)
    <div class="mt-8 pt-8 border-t">
        <h3 class="font-semibold mb-2">Tags</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($post->tags as $tag)
            <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">{{ $tag->name }}</span>
            @endforeach
        </div>
    </div>
    @endif
    
    @if($relatedPosts->count() > 0)
    <div class="mt-12 pt-12 border-t">
        <h2 class="text-2xl font-serif font-bold mb-6">Related Posts</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($relatedPosts as $related)
            <a href="{{ route('blog.show', $related->slug) }}" class="group">
                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    @if($related->featured_image)
                    <div class="aspect-video overflow-hidden">
                        <img src="{{ asset('storage/' . $related->featured_image) }}" 
                             alt="{{ $related->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    @endif
                    <div class="p-4">
                        <h3 class="font-semibold group-hover:text-gray-600 transition">{{ $related->title }}</h3>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</article>
@endsection

