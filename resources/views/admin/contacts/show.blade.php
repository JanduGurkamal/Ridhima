@extends('layouts.admin')

@section('title', 'View Submission')
@section('page-title', 'View Submission')

@section('content')
<div class="bg-white rounded-lg shadow p-6">
    <div class="space-y-6">
        <div>
            <h3 class="text-sm font-medium text-gray-500">Name</h3>
            <p class="mt-1 text-lg">{{ $contact->name }}</p>
        </div>
        
        <div>
            <h3 class="text-sm font-medium text-gray-500">Email</h3>
            <p class="mt-1">{{ $contact->email }}</p>
        </div>
        
        @if($contact->subject)
        <div>
            <h3 class="text-sm font-medium text-gray-500">Subject</h3>
            <p class="mt-1">{{ $contact->subject }}</p>
        </div>
        @endif
        
        <div>
            <h3 class="text-sm font-medium text-gray-500">Message</h3>
            <p class="mt-1 whitespace-pre-wrap">{{ $contact->message }}</p>
        </div>
        
        <div>
            <h3 class="text-sm font-medium text-gray-500">Received</h3>
            <p class="mt-1">{{ $contact->created_at->format('F j, Y g:i A') }}</p>
        </div>
        
        <div class="flex space-x-4 pt-6 border-t">
            <form action="{{ route('admin.contacts.read', $contact) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    Mark as Read
                </button>
            </form>
            
            <form action="{{ route('admin.contacts.replied', $contact) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    Mark as Replied
                </button>
            </form>
            
            <form action="{{ route('admin.contacts.archive', $contact) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-md hover:bg-yellow-700">
                    Archive
                </button>
            </form>
            
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

