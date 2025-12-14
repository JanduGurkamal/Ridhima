@extends('layouts.admin')

@section('title', 'Media Library')
@section('page-title', 'Media Library')

@section('content')
<div class="mb-6">
    <form method="POST" action="{{ route('admin.media.store') }}" enctype="multipart/form-data" class="inline">
        @csrf
        <input type="file" name="files[]" multiple accept="image/*" required
               class="border border-gray-300 rounded-md px-3 py-2">
        <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg hover:bg-gray-800 ml-2">
            Upload
        </button>
    </form>
</div>

<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @forelse($media as $item)
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($item->isImage())
        <img src="{{ asset('storage/' . $item->path) }}" alt="{{ $item->name }}" class="w-full aspect-square object-cover">
        @else
        <div class="w-full aspect-square bg-gray-200 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
            </svg>
        </div>
        @endif
        <div class="p-2">
            <p class="text-xs text-gray-600 truncate">{{ $item->name }}</p>
            <form action="{{ route('admin.media.destroy', $item) }}" method="POST" class="mt-2" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-xs text-red-600 hover:text-red-900">Delete</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-500">
        No media files found
    </div>
    @endforelse
</div>

<div class="mt-6">
    {{ $media->links() }}
</div>
@endsection

