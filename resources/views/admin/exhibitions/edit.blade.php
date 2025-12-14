@extends('layouts.admin')

@section('title', 'Edit Exhibition')
@section('page-title', 'Edit Exhibition')

@section('content')
<form method="POST" action="{{ route('admin.exhibitions.update', $exhibition) }}" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
    @csrf
    @method('PUT')
    
    <div class="space-y-6">
        <div>
            <label for="title" class="block text-sm font-medium text-gray-700">Title *</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $exhibition->title) }}"
                   class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
        </div>
        
        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4"
                      class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('description', $exhibition->description) }}</textarea>
        </div>
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date *</label>
                <input type="date" name="start_date" id="start_date" required value="{{ old('start_date', $exhibition->start_date->format('Y-m-d')) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
            
            <div>
                <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $exhibition->end_date?->format('Y-m-d')) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
            </div>
        </div>
        
        <div>
            <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
            @if($exhibition->featured_image)
            <img src="{{ asset('storage/' . $exhibition->featured_image) }}" alt="Current image" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="featured_image" id="featured_image" accept="image/*"
                   class="mt-1 block w-full">
        </div>
        
        <div class="flex items-center">
            <label class="flex items-center">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $exhibition->is_published) ? 'checked' : '' }}
                       class="rounded border-gray-300">
                <span class="ml-2 text-sm text-gray-700">Published</span>
            </label>
        </div>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.exhibitions.index') }}" class="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                Update
            </button>
        </div>
    </div>
</form>
@endsection

