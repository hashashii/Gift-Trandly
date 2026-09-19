@extends('layouts.site')

@section('title', 'Gift Trandly — Trending Gifts & Fashion Finds')

@section('content')

    @if ($featured)
        <section class="bg-linen">
            <div class="mx-auto grid max-w-7xl items-center gap-8 px-4 py-10 sm:px-6 lg:grid-cols-2 lg:gap-12 lg:px-8 lg:py-0">
                <div class="lg:py-16">
                    @if ($featured->eyebrow)
                        <span class="inline-flex rounded-full bg-blush-500 px-3 py-1 text-[11px] font-semibold tracking-wide text-white">
                            {{ $featured->eyebrow }}
                        </span>
                    @endif

                    <h1 class="headline mt-5 font-serif text-4xl leading-tight sm:text-5xl">
                        <a href="{{ route('post.show', $featured) }}">{{ $featured->title }}</a>
                    </h1>

                    @if ($featured->subtitle)
                        <p class="mt-4 text-lg font-medium text-gray-800">{{ $featured->subtitle }}</p>
                    @endif

                    <p class="mt-3 max-w-xl text-[15px] leading-relaxed text-gray-600">{{ $featured->excerpt }}</p>

                    <a href="{{ route('post.show', $featured) }}" class="btn-pink mt-6">Read the guide</a>
                </div>

                <img src="{{ $featured->cover_url }}" alt="{{ $featured->title }}"
                     class="h-64 w-full rounded-2xl object-cover lg:h-[420px] lg:rounded-none">
            </div>
        </section>
    @endif

    <div class="mx-auto max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid lg:grid-cols-[minmax(0,1fr)_320px] lg:px-8">
        <div>
            <h2 class="font-script text-4xl text-blush-500">Fresh Gift Guides</h2>
            <p class="mt-2 max-w-xl text-sm leading-relaxed text-gray-600">
                New roundups every week — from fashion and beauty to self-care and small surprises.
            </p>

            @if ($latest->isEmpty())
                <p class="mt-8 rounded-xl border border-dashed border-blush-200 p-8 text-center text-sm text-gray-500">
                    No guides published yet. Add your first post from the admin panel.
                </p>
            @else
                <div class="mt-8 grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($latest as $item)
                        <article>
                            <a href="{{ route('post.show', $item) }}">
                                <img src="{{ $item->cover_url }}" alt="{{ $item->title }}"
                                     class="aspect-[4/3] w-full rounded-2xl object-cover" loading="lazy">
                            </a>
                            @if ($item->category)
                                <span class="pill mt-3">{{ $item->category->name }}</span>
                            @endif
                            <h3 class="mt-2 text-[15px] font-semibold leading-snug">
                                <a href="{{ route('post.show', $item) }}" class="hover:text-blush-600">{{ $item->title }}</a>
                            </h3>
                            <p class="mt-1 line-clamp-2 text-sm leading-relaxed text-gray-600">{{ $item->excerpt }}</p>
                            <p class="mt-2 text-xs text-gray-400">
                                {{ optional($item->published_at)->format('M j, Y') }} &middot; {{ $item->read_minutes }} min read
                            </p>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-12 lg:mt-0">
            @include('partials.sidebar')
        </div>
    </div>
@endsection
