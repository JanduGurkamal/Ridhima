@extends('layouts.main')

@section('title', 'Exhibitions')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">Exhibitions</h1>
    
    <!-- Filters -->
    <div class="mb-8">
        <div class="flex gap-4">
            <a href="{{ route('exhibitions.index', ['filter' => 'upcoming']) }}" 
               class="px-4 py-2 rounded-lg {{ request('filter') == 'upcoming' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                Upcoming
            </a>
            <a href="{{ route('exhibitions.index', ['filter' => 'current']) }}" 
               class="px-4 py-2 rounded-lg {{ request('filter') == 'current' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                Current
            </a>
            <a href="{{ route('exhibitions.index', ['filter' => 'past']) }}" 
               class="px-4 py-2 rounded-lg {{ request('filter') == 'past' ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                Past
            </a>
            <a href="{{ route('exhibitions.index') }}" 
               class="px-4 py-2 rounded-lg {{ !request('filter') ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-700' }}">
                All
            </a>
        </div>
    </div>
    
    <!-- Exhibitions List -->
    @if($exhibitions->count() > 0)
    <div class="space-y-8">
        @foreach($exhibitions as $exhibition)
        <a href="{{ route('exhibitions.show', $exhibition->slug) }}" class="block group">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-white rounded-lg shadow-sm hover:shadow-md transition p-6">
                @if($exhibition->featured_image)
                <div class="aspect-video overflow-hidden rounded-lg">
                    <img src="{{ asset('storage/' . $exhibition->featured_image) }}" 
                         alt="{{ $exhibition->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                @endif
                <div class="md:col-span-2">
                    <h2 class="text-2xl font-serif font-bold mb-2 group-hover:text-gray-600 transition">{{ $exhibition->title }}</h2>
                    @if($exhibition->venue)
                    <p class="text-gray-600 mb-2">{{ $exhibition->venue }}</p>
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
                    @if($exhibition->description)
                    <p class="text-gray-600 mt-4 line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($exhibition->description), 150) }}</p>
                    @endif
                </div>
            </div>
        </a>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-12">
        {{ $exhibitions->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-600">No exhibitions found.</p>
    </div>
    @endif
</div>
@endsection

