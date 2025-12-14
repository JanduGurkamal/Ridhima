@extends('layouts.admin')

@section('title', 'Edit Artwork')
@section('page-title', 'Edit Artwork')

@section('content')
<form method="POST" action="{{ route('admin.artworks.update', $artwork) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
    @csrf
    @method('PUT')
    
    <div class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $artwork->title) }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
        </div>
        
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('description', $artwork->description) }}</textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">None</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $artwork->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" id="year" value="{{ old('year', $artwork->year) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
        </div>
        
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
            @if($artwork->featured_image)
            <img src="{{ asset('storage/' . $artwork->featured_image) }}" alt="Current image" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                   class="mt-1 block w-full">
        </div>
        
        <div class="flex items-center space-x-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $artwork->is_featured) ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Featured</span>
            </label>
            
            <label class="flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $artwork->is_published) ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.artworks.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                Update
            </button>
        </div>
    </div>
</form>
@endsection

