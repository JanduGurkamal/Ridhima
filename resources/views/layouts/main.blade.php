<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', config('app.name', 'Artist Portfolio'))</title>
    
    @if(isset($meta_title))
    <meta property="og:title" content="{{ $meta_title }}">
    <meta name="twitter:title" content="{{ $meta_title }}">
    @endif
    
    @if(isset($meta_description))
    <meta name="description" content="{{ $meta_description }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta name="twitter:description" content="{{ $meta_description }}">
    @endif
    
    @if(isset($featured_image))
    <meta property="og:image" content="{{ asset('storage/' . $featured_image) }}">
    <meta name="twitter:image" content="{{ asset('storage/' . $featured_image) }}">
    @endif
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=playfair-display:400,500,600,700&family=inter:400,500,600&display=swap" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-gray-900">
                        {{ config('app.name', 'Portfolio') }}
                    </a>
                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition">Home</a>
                        <a href="{{ route('gallery.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition">Gallery</a>
                        <a href="{{ route('exhibitions.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition">Exhibitions</a>
                        <a href="{{ route('blog.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition">Blog</a>
                        <a href="{{ route('about.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition">About</a>
                        <a href="{{ route('contact.index') }}" class="text-gray-700 hover:text-gray-900 px-3 py-2 text-sm font-medium transition">Contact</a>
                    </div>
                </div>
                <div class="md:hidden">
                    <button type="button" class="mobile-menu-button inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-gray-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900">Home</a>
                <a href="{{ route('gallery.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900">Gallery</a>
                <a href="{{ route('exhibitions.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900">Exhibitions</a>
                <a href="{{ route('blog.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900">Blog</a>
                <a href="{{ route('about.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900">About</a>
                <a href="{{ route('contact.index') }}" class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-gray-900">Contact</a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-serif font-bold mb-4">{{ config('app.name', 'Portfolio') }}</h3>
                    <p class="text-gray-400">Showcasing artistic excellence through digital presence.</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('gallery.index') }}" class="text-gray-400 hover:text-white transition">Gallery</a></li>
                        <li><a href="{{ route('exhibitions.index') }}" class="text-gray-400 hover:text-white transition">Exhibitions</a></li>
                        <li><a href="{{ route('blog.index') }}" class="text-gray-400 hover:text-white transition">Blog</a></li>
                        <li><a href="{{ route('about.index') }}" class="text-gray-400 hover:text-white transition">About</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Connect</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('contact.index') }}" class="text-gray-400 hover:text-white transition">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-800 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} {{ config('app.name', 'Portfolio') }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script>
        // Mobile menu toggle
        document.querySelector('.mobile-menu-button')?.addEventListener('click', function() {
            document.querySelector('.mobile-menu')?.classList.toggle('hidden');
        });
    </script>
</body>
</html>

