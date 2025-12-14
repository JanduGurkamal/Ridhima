@extends('layouts.main')

@section('title', $exhibition->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="mb-8">
        <h1 class="text-4xl font-serif font-bold mb-4">{{ $exhibition->title }}</h1>
        @if($exhibition->venue)
        <p class="text-xl text-gray-600 mb-2">{{ $exhibition->venue }}</p>
        @endif
        @if($exhibition->location)
        <p class="text-gray-600 mb-2">{{ $exhibition->location }}</p>
        @endif
        <p class="text-gray-600">
            {{ $exhibition->start_date->format('F j, Y') }}
            @if($exhibition->end_date)
            - {{ $exhibition->end_date->format('F j, Y') }}
            @endif
        </p>
    </div>
    
    @if($exhibition->featured_image)
    <div class="mb-12">
        <img src="{{ asset('storage/' . $exhibition->featured_image) }}" 
             alt="{{ $exhibition->title }}"
             class="w-full rounded-lg shadow-lg">
    </div>
    @endif
    
    @if($exhibition->description)
    <div class="prose max-w-none mb-12">
        {!! nl2br(e($exhibition->description)) !!}
    </div>
    @endif
    
    @if($exhibition->artworks->count() > 0)
    <div>
        <h2 class="text-3xl font-serif font-bold mb-8">Featured Artworks</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach($exhibition->artworks as $artwork)
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
    @endif
</div>
@endsection

