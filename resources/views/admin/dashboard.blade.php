@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium mb-2">Total Artworks</h3>
        <p class="text-3xl font-bold">{{ $stats['artworks']['total'] }}</p>
        <p class="text-sm text-gray-500 mt-2">{{ $stats['artworks']['published'] }} published</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium mb-2">Exhibitions</h3>
        <p class="text-3xl font-bold">{{ $stats['exhibitions']['total'] }}</p>
        <p class="text-sm text-gray-500 mt-2">{{ $stats['exhibitions']['upcoming'] }} upcoming</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium mb-2">Blog Posts</h3>
        <p class="text-3xl font-bold">{{ $stats['posts']['total'] }}</p>
        <p class="text-sm text-gray-500 mt-2">{{ $stats['posts']['published'] }} published</p>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-600 text-sm font-medium mb-2">Contact Messages</h3>
        <p class="text-3xl font-bold">{{ $stats['contacts']['total'] }}</p>
        <p class="text-sm text-gray-500 mt-2">{{ $stats['contacts']['new'] }} new</p>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Submissions</h2>
        @if($recentSubmissions->count() > 0)
        <div class="space-y-4">
            @foreach($recentSubmissions as $submission)
            <div class="border-b pb-4">
                <p class="font-semibold">{{ $submission->name }}</p>
                <p class="text-sm text-gray-600">{{ $submission->email }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $submission->created_at->diffForHumans() }}</p>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500">No recent submissions</p>
        @endif
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold mb-4">Recent Artworks</h2>
        @if($recentArtworks->count() > 0)
        <div class="space-y-4">
            @foreach($recentArtworks as $artwork)
            <div class="border-b pb-4">
                <p class="font-semibold">{{ $artwork->title }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $artwork->created_at->diffForHumans() }}</p>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500">No recent artworks</p>
        @endif
    </div>
</div>
@endsection

