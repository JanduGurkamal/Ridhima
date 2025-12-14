@extends('layouts.admin')

@section('title', 'Create Artwork')
@section('page-title', 'Create Artwork')

@section('content')
<form method="POST" action="{{ route('admin.artworks.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
    @csrf
    
    <div class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            @error('title')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('description') }}</textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" id="category_id" class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                    <option value="">None</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                <input type="number" name="year" id="year" value="{{ old('year') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="medium" class="block text-sm font-medium text-gray-700">Medium</label>
                <input type="text" name="medium" id="medium" value="{{ old('medium') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            
            <div>
                <label for="dimensions" class="block text-sm font-medium text-gray-700">Dimensions</label>
                <input type="text" name="dimensions" id="dimensions" value="{{ old('dimensions') }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
        </div>
        
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                   class="mt-1 block w-full">
        </div>
        
        <div class="flex items-center space-x-6">
            <label class="flex items-center">
                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Featured</span>
            </label>
            
            <label class="flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.artworks.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                Create
            </button>
        </div>
    </div>
</form>
@endsection

