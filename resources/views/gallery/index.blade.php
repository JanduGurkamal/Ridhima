@extends('layouts.main')

@section('title', 'Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-4xl font-serif font-bold mb-8">Gallery</h1>
    
    <!-- Filters -->
    <div class="mb-8 space-y-4">
        <form method="GET" action="{{ route('gallery.index') }}" class="flex flex-wrap gap-4">
            @if($categories->count() > 0)
            <select name="category" class="border border-gray-300 rounded-lg px-4 py-2">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }} ({{ $category->published_artworks_count }})
                </option>
                @endforeach
            </select>
            @endif
            
            @if($years->count() > 0)
            <select name="year" class="border border-gray-300 rounded-lg px-4 py-2">
                <option value="">All Years</option>
                @foreach($years as $year)
                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                @endforeach
            </select>
            @endif
            
            <input type="text" name="search" placeholder="Search..." value="{{ request('search') }}" 
                   class="border border-gray-300 rounded-lg px-4 py-2 flex-1 min-w-[200px]">
            
            <button type="submit" class="bg-gray-900 text-white px-6 py-2 rounded-lg hover:bg-gray-800">
                Filter
            </button>
            
            @if(request()->anyFilled(['category', 'year', 'search']))
            <a href="{{ route('gallery.index') }}" class="text-gray-600 hover:text-gray-900 px-4 py-2">
                Clear
            </a>
            @endif
        </form>
    </div>
    
    <!-- Artworks Grid -->
    @if($artworks->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($artworks as $artwork)
        <a href="{{ route('artwork.show', $artwork->slug) }}" class="group">
            <div class="relative overflow-hidden rounded-lg aspect-square bg-gray-100 mb-4">
                @if($artwork->featured_image)
                <img src="{{ asset('storage/' . $artwork->featured_image) }}" 
                     alt="{{ $artwork->title }}"
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                @else
                <div class="w-full h-full flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                @endif
            </div>
            <h3 class="font-semibold text-gray-900 group-hover:text-gray-600 transition">{{ $artwork->title }}</h3>
            @if($artwork->year)
            <p class="text-sm text-gray-600">{{ $artwork->year }}</p>
            @endif
        </a>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-12">
        {{ $artworks->links() }}
    </div>
    @else
    <div class="text-center py-12">
        <p class="text-gray-600">No artworks found.</p>
    </div>
    @endif
</div>
@endsection

