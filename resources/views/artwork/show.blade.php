@extends('layouts.main')

@section('title', $artwork->title)
@php
    $meta_title = $artwork->meta_title ?? $artwork->title;
    $meta_description = $artwork->meta_description ?? $artwork->description;
    $featured_image = $artwork->featured_image;
@endphp

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <!-- Image -->
        <div>
            @if($artwork->featured_image)
            <img src="{{ asset('storage/' . $artwork->featured_image) }}" 
                 alt="{{ $artwork->title }}"
                 class="w-full rounded-lg shadow-lg">
            @endif
            
            @if($artwork->images->count() > 0)
            <div class="grid grid-cols-4 gap-4 mt-4">
                @foreach($artwork->images as $image)
                <img src="{{ asset('storage/' . $image->image_path) }}" 
                     alt="{{ $artwork->title }}"
                     class="w-full rounded-lg cursor-pointer hover:opacity-75 transition">
                @endforeach
            </div>
            @endif
        </div>
        
        <!-- Details -->
        <div>
            <h1 class="text-4xl font-serif font-bold mb-4">{{ $artwork->title }}</h1>
            
            @if($artwork->description)
            <div class="prose max-w-none mb-6">
                {!! nl2br(e($artwork->description)) !!}
            </div>
            @endif
            
            <dl class="space-y-4 mb-8">
                @if($artwork->category)
                <div>
                    <dt class="font-semibold">Category</dt>
                    <dd>{{ $artwork->category->name }}</dd>
                </div>
                @endif
                
                @if($artwork->medium)
                <div>
                    <dt class="font-semibold">Medium</dt>
                    <dd>{{ $artwork->medium }}</dd>
                </div>
                @endif
                
                @if($artwork->dimensions)
                <div>
                    <dt class="font-semibold">Dimensions</dt>
                    <dd>{{ $artwork->dimensions }}</dd>
                </div>
                @endif
                
                @if($artwork->year)
                <div>
                    <dt class="font-semibold">Year</dt>
                    <dd>{{ $artwork->year }}</dd>
                </div>
                @endif
            </dl>
            
            @if($artwork->tags->count() > 0)
            <div class="mb-8">
                <h3 class="font-semibold mb-2">Tags</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($artwork->tags as $tag)
                    <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm">{{ $tag->name }}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Related Artworks -->
    @if($relatedArtworks->count() > 0)
    <div class="mt-20">
        <h2 class="text-3xl font-serif font-bold mb-8">Related Artworks</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($relatedArtworks as $related)
            <a href="{{ route('artwork.show', $related->slug) }}" class="group">
                <div class="relative overflow-hidden rounded-lg aspect-square bg-gray-100">
                    @if($related->featured_image)
                    <img src="{{ asset('storage/' . $related->featured_image) }}" 
                         alt="{{ $related->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

