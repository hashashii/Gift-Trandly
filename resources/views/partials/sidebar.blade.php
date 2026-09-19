@props(['post' => null])

<aside class="space-y-6">

    {{-- Search --}}
    <form action="{{ route('search') }}" method="GET" class="flex overflow-hidden rounded-xl border border-blush-200">
        <label class="sr-only" for="sidebar-search">Search gifts and fashion</label>
        <input id="sidebar-search" type="search" name="q" value="{{ request('q') }}"
               placeholder="Search gifts, fashion..."
               class="w-full border-0 px-4 py-2.5 text-sm focus:ring-0">
        <button type="submit" class="bg-blush-500 px-4 text-white hover:bg-blush-600" aria-label="Search">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-3.5-3.5"/>
            </svg>
        </button>
    </form>

    {{-- Table of contents, built from this post's gift cards --}}
    @if ($post && $post->gifts->isNotEmpty())
        <nav class="panel">
            <h2 class="text-base font-semibold">Table of Contents</h2>
            <ol class="mt-4 space-y-2 text-sm text-gray-600">
                @foreach ($post->gifts as $index => $gift)
                    <li class="flex gap-2">
                        <span class="w-5 shrink-0 text-right text-gray-400">{{ $index + 1 }}.</span>
                        <a href="#gift-{{ $gift->id }}" class="hover:text-blush-600">{{ $gift->title }}</a>
                    </li>
                @endforeach
            </ol>
        </nav>
    @endif

    {{-- Popular posts --}}
    @if ($popularPosts->isNotEmpty())
        <section class="panel">
            <h2 class="text-base font-semibold">Popular Posts</h2>
            <ul class="mt-4 space-y-4">
                @foreach ($popularPosts as $popular)
                    <li>
                        <a href="{{ route('post.show', $popular) }}" class="group flex gap-3">
                            <img src="{{ $popular->cover_url }}" alt=""
                                 class="h-14 w-16 shrink-0 rounded-lg object-cover" loading="lazy">
                            <span>
                                <span class="block text-sm font-medium leading-snug group-hover:text-blush-600">
                                    {{ $popular->title }}
                                </span>
                                <span class="mt-1 block text-xs text-gray-400">
                                    {{ optional($popular->published_at)->format('M j, Y') }}
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    {{-- Newsletter --}}
    <section class="rounded-2xl bg-blush-100 p-6 text-center">
        <svg class="mx-auto h-6 w-6 text-blush-500" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
            <rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>
        </svg>
        <h2 class="mt-2 font-script text-3xl text-ink">Stay in the Loop</h2>
        <p class="mt-1 text-sm text-gray-600">Get the latest gift ideas, trending finds and exclusive picks.</p>

        <form action="{{ route('subscribe') }}" method="POST" class="mt-4 space-y-3">
            @csrf
            <input type="hidden" name="source" value="sidebar">
            <label class="sr-only" for="newsletter-email">Your email address</label>
            <input id="newsletter-email" type="email" name="email" required placeholder="Your email address"
                   class="field text-center">
            @error('email')<p class="text-xs text-blush-700">{{ $message }}</p>@enderror
            <button type="submit" class="btn-dark w-full">Subscribe</button>
        </form>
    </section>

    {{-- Promo card --}}
    <a href="{{ route('trending') }}"
       class="block overflow-hidden rounded-2xl bg-blush-50 p-6 text-center transition hover:bg-blush-100">
        <span class="font-script text-3xl leading-tight text-ink">Small Gifts<br>Big Smiles</span>
        <span class="mt-2 block text-xs text-gray-500">See this week's trending picks</span>
    </a>

    {{-- Follow --}}
    <section class="panel">
        <h2 class="text-base font-semibold">Follow Us</h2>
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
    </section>
</aside>
