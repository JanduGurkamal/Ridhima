@extends('layouts.main')

@section('title', 'Contact')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <h1 class="text-4xl font-serif font-bold text-center mb-12">Get in Touch</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
        <!-- Contact Form -->
        <div>
            <h2 class="text-2xl font-semibold mb-6">Send a Message</h2>
            
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
            @endif
            
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form method="POST" action="{{ route('contact.store') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                    <input type="text" name="name" id="name" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                           value="{{ old('name') }}">
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                           value="{{ old('email') }}">
                </div>
                
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" name="subject" id="subject"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent"
                           value="{{ old('subject') }}">
                </div>
                
                <div>
                    <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea name="message" id="message" rows="6" required
                              class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-gray-900 focus:border-transparent">{{ old('message') }}</textarea>
                </div>
                
                <button type="submit" 
                        class="w-full bg-gray-900 text-white px-6 py-3 rounded-lg font-medium hover:bg-gray-800 transition">
                    Send Message
                </button>
            </form>
        </div>
        
        <!-- Contact Info -->
        <div>
            <h2 class="text-2xl font-semibold mb-6">Contact Information</h2>
            <div class="space-y-6">
                <p class="text-gray-600">
                    Feel free to reach out for inquiries about my artwork, exhibitions, 
                    collaborations, or any other questions you may have.
                </p>
                
                <div class="space-y-4">
                    <div>
                        <h3 class="font-semibold mb-2">Email</h3>
                        <p class="text-gray-600">contact@example.com</p>
                    </div>
                    
                    <div>
                        <h3 class="font-semibold mb-2">Response Time</h3>
                        <p class="text-gray-600">I typically respond within 24-48 hours.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

