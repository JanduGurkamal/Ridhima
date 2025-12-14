@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
<form method="POST" action="{{ route('admin.settings.update') }}" class="bg-white rounded-lg shadow p-6">
    @csrf
    
    <div class="space-y-6">
        <div>
            <h2 class="text-xl font-bold mb-4">Site Information</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                    <input type="text" name="site_name" id="site_name" value="{{ old('site_name', config('app.name')) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                </div>
                
                <div>
                    <label for="site_description" class="block text-sm font-medium text-gray-700">Site Description</label>
                    <textarea name="site_description" id="site_description" rows="3"
                              class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">{{ old('site_description') }}</textarea>
                </div>
            </div>
        </div>
        
        <div>
            <h2 class="text-xl font-bold mb-4">Contact Information</h2>
            
            <div class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                </div>
                
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md px-3 py-2">
                </div>
            </div>
        </div>
        
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-gray-900 text-white rounded-md hover:bg-gray-800">
                Save Settings
            </button>
        </div>
    </div>
</form>
@endsection

