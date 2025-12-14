@extends('layouts.main')

@section('title', 'Home')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center bg-gradient-to-br from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-5xl md:text-7xl font-serif font-bold text-gray-900 mb-6">
            Welcome to My Art
        </h1>
        <p class="text-xl md:text-2xl text-gray-600 mb-8 max-w-2xl mx-auto">
            A collection of artistic expressions and creative journeys
        </p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('gallery.index') }}" class="bg-gray-900 text-white px-8 py-3 rounded-lg font-medium hover:bg-gray-800 transition">
                View Gallery
            </a>
            <a href="{{ route('about.index') }}" class="bg-white text-gray-900 border-2 border-gray-900 px-8 py-3 rounded-lg font-medium hover:bg-gray-50 transition">
                Learn More
            </a>
        </div>
    </div>
</section>

<!-- Featured Artworks -->
@if($featuredArtworks->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-4xl font-serif font-bold text-center mb-12">Featured Artworks</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredArtworks as $artwork)
            <a href="{{ route('artwork.show', $artwork->slug) }}" class="group">
                <div class="relative overflow-hidden rounded-lg aspect-square bg-gray-100">
                    @if($artwork->featured_image)
                    <img src="{{ asset('storage/' . $artwork->featured_image) }}" 
                         alt="{{ $artwork->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-gray-400">
                        <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition"></div>
                </div>
                <h3 class="mt-4 text-xl font-semibold text-gray-900">{{ $artwork->title }}</h3>
                @if($artwork->year)
                <p class="text-gray-600">{{ $artwork->year }}</p>
                @endif
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Stats Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <div class="text-5xl font-bold text-gray-900 mb-2">{{ $stats['artworks'] }}</div>
                <div class="text-gray-600">Artworks</div>
            </div>
            <div>
                <div class="text-5xl font-bold text-gray-900 mb-2">{{ $stats['exhibitions'] }}</div>
                <div class="text-gray-600">Exhibitions</div>
            </div>
            <div>
                <div class="text-5xl font-bold text-gray-900 mb-2">{{ $stats['posts'] }}</div>
                <div class="text-gray-600">Blog Posts</div>
            </div>
        </div>
    </div>
</section>

<!-- Recent Artworks -->
@if($recentArtworks->count() > 0)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-4xl font-serif font-bold">Recent Works</h2>
            <a href="{{ route('gallery.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                View All →
            </a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($recentArtworks->take(6) as $artwork)
            <a href="{{ route('artwork.show', $artwork->slug) }}" class="group">
                <div class="relative overflow-hidden rounded-lg aspect-square bg-gray-100">
                    @if($artwork->featured_image)
                    <img src="{{ asset('storage/' . $artwork->featured_image) }}" 
                         alt="{{ $artwork->title }}"
                         class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    @endif
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection

