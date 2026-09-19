<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') &middot; Gift Trandly</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-blush-50/40">

<div x-data="{ nav: false }" class="min-h-screen lg:flex">

    {{-- Sidebar --}}
    <aside class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-blush-100 bg-white transition lg:static lg:translate-x-0"
           :class="nav && '!translate-x-0'">
        <div class="flex h-16 items-center border-b border-blush-100 px-5">
            <a href="{{ route('admin.dashboard') }}" class="text-lg font-bold">
                Gift<span class="text-blush-500">Trandly</span>
            </a>
        </div>

        @php
            $links = [
                ['admin.dashboard',        'Dashboard',   'admin.dashboard'],
                ['admin.posts.index',      'Posts',       'admin.posts.*'],
                ['admin.categories.index', 'Categories',  'admin.categories.*'],
                ['admin.subscribers.index','Subscribers', 'admin.subscribers.*'],
            ];
        @endphp

        <nav class="space-y-1 p-3 text-sm">
            @foreach ($links as [$route, $label, $pattern])
                <a href="{{ route($route) }}"
                   class="block rounded-lg px-3 py-2 font-medium {{ request()->routeIs($pattern) ? 'bg-blush-500 text-white' : 'text-gray-600 hover:bg-blush-50' }}">
                    {{ $label }}
                </a>
            @endforeach

            <a href="{{ route('home') }}" target="_blank"
               class="block rounded-lg px-3 py-2 font-medium text-gray-600 hover:bg-blush-50">
                View site
            </a>
        </nav>

        <div class="absolute inset-x-0 bottom-0 border-t border-blush-100 p-4 text-sm">
            <p class="font-medium">{{ auth()->user()?->name }}</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="mt-1 text-xs text-blush-600 hover:underline">Log out</button>
            </form>
        </div>
    </aside>

    {{-- Content --}}
    <div class="flex-1">
        <header class="flex h-16 items-center gap-4 border-b border-blush-100 bg-white px-4 sm:px-6">
            <button @click="nav = !nav" class="rounded p-1.5 lg:hidden" aria-label="Toggle navigation">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
            </button>
            <h1 class="text-base font-semibold">@yield('heading', 'Dashboard')</h1>
            <div class="ml-auto">@yield('actions')</div>
        </header>

        @if (session('status'))
            <p class="mx-4 mt-4 rounded-lg bg-blush-100 px-4 py-3 text-sm text-blush-800 sm:mx-6">
                {{ session('status') }}
            </p>
        @endif

        @if ($errors->any())
            <ul class="mx-4 mt-4 list-inside list-disc rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700 sm:mx-6">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <main class="p-4 sm:p-6">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
