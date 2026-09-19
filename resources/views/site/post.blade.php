@extends('layouts.site')

@section('title', $post->meta_title ?: $post->title . ' | Gift Trandly')
@section('meta_description', $post->meta_description ?: $post->excerpt)

@section('content')

    {{-- Hero --}}
    <section class="bg-linen">
        <div class="mx-auto grid max-w-7xl items-center gap-8 px-4 py-10 sm:px-6 lg:grid-cols-2 lg:gap-12 lg:px-8 lg:py-0">

            <div class="lg:py-14">
                @if ($post->eyebrow)
                    <span class="inline-flex rounded-full bg-blush-500 px-3 py-1 text-[11px] font-semibold tracking-wide text-white">
                        {{ $post->eyebrow }}
                    </span>
                @endif

                <h1 class="headline mt-5 font-serif text-4xl leading-tight text-ink sm:text-5xl">
                    {{ $post->title }}
                </h1>

                @if ($post->subtitle)
                    <p class="mt-4 text-lg font-medium text-gray-800">{{ $post->subtitle }}</p>
                @endif

                @if ($post->excerpt)
                    <p class="mt-3 max-w-xl text-[15px] leading-relaxed text-gray-600">{{ $post->excerpt }}</p>
                @endif

                <div class="mt-6 flex flex-wrap items-center gap-6 text-xs text-gray-500">
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/>
                        </svg>
                        {{ optional($post->published_at)->format('F j, Y') }}
                    </span>
                    <span class="flex items-center gap-1.5">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="9"/><path stroke-linecap="round" d="M12 7v5l3 2"/>
                        </svg>
                        {{ $post->read_minutes }} min read
                    </span>
                </div>
            </div>

            <img src="{{ $post->cover_url }}" alt="{{ $post->title }}"
                 class="h-64 w-full rounded-2xl object-cover lg:h-[420px] lg:rounded-none">
        </div>
    </section>

    {{-- Body --}}
    <div class="mx-auto max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid lg:grid-cols-[minmax(0,1fr)_320px] lg:px-8">

        <div>
            <h2 class="font-script text-4xl text-blush-500">{{ $post->category?->name ?? 'Gift Ideas for Her' }}</h2>

            @if ($post->body)
                <div class="prose prose-sm mt-3 max-w-2xl text-gray-600 prose-headings:font-serif prose-a:text-blush-600">
                    {!! nl2br(e($post->body)) !!}
                </div>
            @endif

            {{-- Gift grid --}}
            @if ($post->gifts->isNotEmpty())
                <div class="mt-8 grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($post->gifts as $index => $gift)
                        @include('partials.gift-card', ['gift' => $gift, 'number' => $index + 1])
                    @endforeach
                </div>
            @endif

            {{-- Pull quote --}}
            @if ($post->pull_quote)
                <figure class="brush-quote mx-auto mt-14 max-w-xl px-10 py-8 text-center">
                    <blockquote class="font-script text-2xl leading-snug text-blush-700">
                        {{ $post->pull_quote }}
                    </blockquote>
                </figure>
            @endif

            {{-- Buying guide --}}
            <section class="mt-14">
                <h2 class="text-xl font-semibold">How to Choose the Right Gift</h2>

                <div class="mt-6 grid gap-8 divide-blush-100 sm:grid-cols-3 sm:divide-x">
                    @foreach ([
                        ['Her Personality', 'Is she into fashion, beauty, tech, books, travel, fitness or home decor?'],
                        ['Her Style', 'Pay attention to the colours, accessories and products she already uses.'],
                        ['Your Budget', "A thoughtful gift doesn't have to be expensive. Choose something useful or meaningful."],
                    ] as $i => [$heading, $copy])
                        <div class="flex gap-3 @if($i) sm:pl-6 @endif">
                            <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blush-50 text-sm font-semibold text-blush-600">
                                {{ $i + 1 }}
                            </span>
                            <div>
                                <h3 class="text-sm font-semibold">{{ $heading }}</h3>
                                <p class="mt-1 text-sm leading-relaxed text-gray-600">{{ $copy }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Related --}}
            @if ($related->isNotEmpty())
                <section class="mt-16">
                    <h2 class="text-xl font-semibold">You might also like</h2>
                    <div class="mt-5 grid gap-6 sm:grid-cols-3">
                        @foreach ($related as $item)
                            <a href="{{ route('post.show', $item) }}" class="group">
                                <img src="{{ $item->cover_url }}" alt=""
                                     class="aspect-[4/3] w-full rounded-xl object-cover" loading="lazy">
                                <h3 class="mt-2 text-sm font-medium leading-snug group-hover:text-blush-600">
                                    {{ $item->title }}
                                </h3>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>

        <div class="mt-12 lg:mt-0">
            @include('partials.sidebar', ['post' => $post])
        </div>
    </div>
@endsection
