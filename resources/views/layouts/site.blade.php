<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Gift Trandly — Trending Gifts & Fashion Finds')</title>
    <meta name="description" content="@yield('meta_description', 'Trending gift ideas, fashion finds and thoughtful picks for every occasion.')">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<header x-data="{ open: false }" class="sticky top-0 z-40 border-b border-blush-100 bg-white/95 backdrop-blur">
    <div class="mx-auto flex max-w-7xl items-center gap-6 px-4 py-4 sm:px-6 lg:px-8">

        <a href="{{ route('home') }}" class="flex items-baseline gap-1.5">
            <svg class="h-5 w-5 shrink-0 text-blush-500" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M12 21s-7.5-4.7-9.6-9A5.3 5.3 0 0 1 12 6.3 5.3 5.3 0 0 1 21.6 12c-2.1 4.3-9.6 9-9.6 9Z"/>
            </svg>
            <span class="text-2xl font-bold tracking-tight">
                <span class="text-ink">Gift</span><span class="text-blush-500">Trandly</span>
                <span class="mt-0.5 block text-[10px] font-light tracking-[0.18em] text-gray-500">
                    Trending Gifts &amp; Fashion Finds
                </span>
            </span>
        </a>

        <nav class="ml-auto hidden items-center gap-7 text-sm font-medium text-gray-700 lg:flex">
            <a href="{{ route('home') }}" class="hover:text-blush-600">Home</a>

            @foreach ($navCategories as $navCategory)
                <a href="{{ route('category', $navCategory) }}" class="hover:text-blush-600">
                    {{ $navCategory->name }}
                </a>
            @endforeach

            <a href="{{ route('trending') }}" class="hover:text-blush-600">Trending</a>
            <a href="{{ route('about') }}" class="hover:text-blush-600">About</a>
            <a href="{{ route('contact') }}" class="hover:text-blush-600">Contact</a>
        </nav>

        <div class="ml-auto flex items-center gap-4 lg:ml-0">
            <form action="{{ route('search') }}" method="GET" class="hidden sm:block">
                <label class="sr-only" for="header-search">Search</label>
                <input id="header-search" type="search" name="q" placeholder="Search"
                       class="field w-40 rounded-full py-1.5 pl-4">
            </form>

            <button @click="open = !open" class="rounded p-1.5 text-gray-700 lg:hidden" aria-label="Open menu">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
        </div>
    </div>

    <div x-show="open" x-cloak class="border-t border-blush-100 bg-white lg:hidden">
        <nav class="space-y-1 px-4 py-4 text-sm font-medium text-gray-700">
            <a href="{{ route('home') }}" class="block py-2">Home</a>
            @foreach ($navCategories as $navCategory)
                <a href="{{ route('category', $navCategory) }}" class="block py-2">{{ $navCategory->name }}</a>
            @endforeach
            <a href="{{ route('trending') }}" class="block py-2">Trending</a>
            <a href="{{ route('about') }}" class="block py-2">About</a>
            <a href="{{ route('contact') }}" class="block py-2">Contact</a>
        </nav>
    </div>
</header>

@if (session('subscribed'))
    <p class="bg-blush-50 px-4 py-3 text-center text-sm text-blush-700">{{ session('subscribed') }}</p>
@endif

<main>
    @yield('content')
</main>

<footer class="mt-20 bg-forest text-white">
    <div class="mx-auto grid max-w-7xl gap-10 px-4 py-14 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <p class="text-xl font-bold">Gift<span class="text-blush-300">Trandly</span></p>
            <p class="mt-3 max-w-xs text-sm leading-relaxed text-white/70">
                Hand-picked gift ideas and fashion finds, refreshed every week.
            </p>
        </div>

        <div class="text-sm">
            <p class="font-semibold">Browse</p>
            <ul class="mt-3 space-y-2 text-white/70">
                @foreach ($navCategories as $navCategory)
                    <li><a href="{{ route('category', $navCategory) }}" class="hover:text-white">{{ $navCategory->name }}</a></li>
                @endforeach
                <li><a href="{{ route('trending') }}" class="hover:text-white">Trending</a></li>
            </ul>
        </div>

        <div class="text-sm">
            <p class="font-semibold">Follow us</p>
            <div class="mt-4 flex gap-3">
                <a href="#" title="Pinterest" class="grid h-9 w-9 place-items-center rounded-full bg-blush-50 text-blush-600 hover:bg-blush-500 hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.171-2.911 1.023 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.995-.285 1.201.594 2.181 1.777 2.181 2.132 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.415 0-5.418 2.561-5.418 5.207 0 1.031.397 2.137.893 2.739.098.119.112.223.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.632-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.367 18.607 0 12.017 0z"/></svg>
                </a>
                <a href="#" title="Instagram" class="grid h-9 w-9 place-items-center rounded-full bg-blush-50 text-blush-600 hover:bg-blush-500 hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                </a>
                <a href="#" title="Facebook" class="grid h-9 w-9 place-items-center rounded-full bg-blush-50 text-blush-600 hover:bg-blush-500 hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/></svg>
                </a>
                <a href="#" title="TikTok" class="grid h-9 w-9 place-items-center rounded-full bg-blush-50 text-blush-600 hover:bg-blush-500 hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>
                </a>
                <a href="#" title="YouTube" class="grid h-9 w-9 place-items-center rounded-full bg-blush-50 text-blush-600 hover:bg-blush-500 hover:text-white">
                    <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                </a>
            </div>
            <p class="mt-6 text-white/50">
                Some links are affiliate links. We may earn a small commission at no extra cost to you.
            </p>
        </div>
    </div>

    <div class="border-t border-white/10 py-5 text-center text-xs text-white/50">
        &copy; {{ date('Y') }} Gift Trandly. All rights reserved.
    </div>
</footer>

</body>
</html>
