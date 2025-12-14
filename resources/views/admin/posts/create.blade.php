@extends('layouts.admin')

@section('title', 'Create Post')
@section('page-title', 'Create Post')

@section('content')
<form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
    @csrf
    
    <div class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
            <input type="text" name="title" id="title" required value="{{ old('title') }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
        </div>
        
        <div>
            <label for="excerpt" class="block text-sm font-medium text-gray-700">Excerpt</label>
            <textarea name="excerpt" id="excerpt" rows="2"
                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('excerpt') }}</textarea>
        </div>
        
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Content *</label>
            <textarea name="content" id="content" rows="10" required
                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('content') }}</textarea>
        </div>
        
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                   class="mt-1 block w-full">
        </div>
        
        <div class="flex items-center">
            <label class="flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.posts.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                Create
            </button>
        </div>
    </div>
</form>
@endsection

