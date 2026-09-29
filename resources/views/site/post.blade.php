@extends('layouts.site')


{{-- =========================================================
    SEO TITLE + DESCRIPTION
========================================================= --}}

@section('title', $post->meta_title ?: $post->title . ' | Gift Trandly')

@section('meta_description', $post->meta_description ?: $post->excerpt)


{{-- =========================================================
    SEO / SOCIAL / STRUCTURED DATA
========================================================= --}}

@push('head')

    {{-- Canonical --}}
    <link rel="canonical" href="{{ route('post.show', $post) }}">


    {{-- =====================================================
        OPEN GRAPH / FACEBOOK
    ====================================================== --}}

    <meta property="og:type" content="article">

    <meta property="og:site_name" content="Gift Trandly">

    <meta
        property="og:title"
        content="{{ $post->meta_title ?: $post->title }}"
    >

    <meta
        property="og:description"
        content="{{ $post->meta_description ?: $post->excerpt }}"
    >

    <meta
        property="og:url"
        content="{{ route('post.show', $post) }}"
    >

    @if ($post->cover_url)

        <meta
            property="og:image"
            content="{{ $post->cover_url }}"
        >

        <meta
            property="og:image:alt"
            content="{{ $post->title }}"
        >

    @endif


    {{-- Article dates for social crawlers --}}

    @if ($post->published_at)

        <meta
            property="article:published_time"
            content="{{ $post->published_at->toIso8601String() }}"
        >

    @endif

    @if ($post->updated_at)

        <meta
            property="article:modified_time"
            content="{{ $post->updated_at->toIso8601String() }}"
        >

    @endif


    {{-- =====================================================
        TWITTER / X
    ====================================================== --}}

    <meta
        name="twitter:card"
        content="summary_large_image"
    >

    <meta
        name="twitter:title"
        content="{{ $post->meta_title ?: $post->title }}"
    >

    <meta
        name="twitter:description"
        content="{{ $post->meta_description ?: $post->excerpt }}"
    >

    @if ($post->cover_url)

        <meta
            name="twitter:image"
            content="{{ $post->cover_url }}"
        >

        <meta
            name="twitter:image:alt"
            content="{{ $post->title }}"
        >

    @endif


    {{-- =====================================================
        ARTICLE SCHEMA
    ====================================================== --}}

    @php
        $articleSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',

            'headline' => $post->title,

            'description' => $post->meta_description ?: $post->excerpt,

            'url' => route('post.show', $post),

            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('post.show', $post),
            ],

            'author' => [
                '@type' => 'Organization',
                'name' => 'Gift Trandly',
                'url' => url('/'),
            ],

            'publisher' => [
                '@type' => 'Organization',
                'name' => 'Gift Trandly',
                'url' => url('/'),
            ],
        ];

        if ($post->cover_url) {
            $articleSchema['image'] = [
                $post->cover_url
            ];
        }

        if ($post->published_at) {
            $articleSchema['datePublished'] =
                $post->published_at->toIso8601String();
        }

        if ($post->updated_at) {
            $articleSchema['dateModified'] =
                $post->updated_at->toIso8601String();
        }
    @endphp


    <script type="application/ld+json">
        {!! json_encode(
            $articleSchema,
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE |
            JSON_HEX_TAG |
            JSON_HEX_AMP |
            JSON_HEX_APOS |
            JSON_HEX_QUOT
        ) !!}
    </script>


    {{-- =====================================================
        BREADCRUMB SCHEMA
    ====================================================== --}}

    @php
        $breadcrumbSchema = [
            '@context' => 'https://schema.org',

            '@type' => 'BreadcrumbList',

            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => url('/'),
                ],

                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => $post->title,
                    'item' => route('post.show', $post),
                ],
            ],
        ];
    @endphp


    <script type="application/ld+json">
        {!! json_encode(
            $breadcrumbSchema,
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE |
            JSON_HEX_TAG |
            JSON_HEX_AMP |
            JSON_HEX_APOS |
            JSON_HEX_QUOT
        ) !!}
    </script>

@endpush


@section('content')


    {{-- =========================================================
        HERO
    ========================================================== --}}

    @php

        $heroUrl = $post->cover_url;

        $hero640 = str_replace(
            'f_auto,q_auto,w_1200',
            'f_auto,q_auto,w_640',
            $heroUrl
        );

        $hero960 = str_replace(
            'f_auto,q_auto,w_1200',
            'f_auto,q_auto,w_960',
            $heroUrl
        );

        $hero1200 = $heroUrl;

    @endphp


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

                    <p class="mt-4 text-lg font-medium text-gray-800">

                        {{ $post->subtitle }}

                    </p>

                @endif


                @if ($post->excerpt)

                    <p class="mt-3 max-w-xl text-[15px] leading-relaxed text-gray-600">

                        {{ $post->excerpt }}

                    </p>

                @endif


                <div class="mt-6 flex flex-wrap items-center gap-6 text-xs text-gray-500">


                    {{-- Publish Date --}}

                    <span class="flex items-center gap-1.5">

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >

                            <rect x="3" y="5" width="18" height="16" rx="2"/>

                            <path d="M8 3v4M16 3v4M3 10h18"/>

                        </svg>


                        {{ optional($post->published_at)->format('F j, Y') }}

                    </span>


                    {{-- Read Time --}}

                    <span class="flex items-center gap-1.5">

                        <svg
                            class="h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.6"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >

                            <circle cx="12" cy="12" r="9"/>

                            <path stroke-linecap="round" d="M12 7v5l3 2"/>

                        </svg>


                        {{ $post->read_minutes }} min read

                    </span>

                </div>

            </div>


            {{-- =================================================
                RESPONSIVE HERO IMAGE
            ================================================== --}}

            <img
                src="{{ $hero960 }}"

                srcset="
                    {{ $hero640 }} 640w,
                    {{ $hero960 }} 960w,
                    {{ $hero1200 }} 1200w
                "

                sizes="(min-width: 1024px) 50vw, 100vw"

                alt="{{ $post->title }}"

                width="1200"
                height="840"

                fetchpriority="high"
                decoding="async"

                class="h-64 w-full rounded-2xl object-cover lg:h-[420px] lg:rounded-none"
            >

        </div>

    </section>


    {{-- =========================================================
        ARTICLE BODY
    ========================================================== --}}

    <div class="mx-auto max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid lg:grid-cols-[minmax(0,1fr)_320px] lg:px-8">


        {{-- LEFT CONTENT --}}

        <div>


            {{-- Category Heading --}}

            <h2 class="font-script text-4xl text-blush-500">

                {{ $post->category?->name ?? 'Gift Ideas for Her' }}

            </h2>


            {{-- Intro Copy --}}

            @if ($post->body)

                <div class="prose prose-sm mt-3 max-w-2xl text-gray-600 prose-headings:font-serif prose-a:text-blush-600">

                    {!! nl2br(e($post->body)) !!}

                </div>

            @endif


            {{-- =================================================
                GIFT GRID
            ================================================== --}}

            @if ($post->gifts->isNotEmpty())

                <div class="mt-8 grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($post->gifts as $index => $gift)

                        @include('partials.gift-card', [
                            'gift' => $gift,
                            'number' => $index + 1
                        ])

                    @endforeach

                </div>

            @endif


            {{-- =================================================
                PULL QUOTE
            ================================================== --}}

            @if ($post->pull_quote)

                <figure class="brush-quote mx-auto mt-14 max-w-xl px-10 py-8 text-center">

                    <blockquote class="font-script text-2xl leading-snug text-blush-700">

                        {{ $post->pull_quote }}

                    </blockquote>

                </figure>

            @endif


            {{-- =================================================
                DYNAMIC ARTICLE SECTIONS
            ================================================== --}}

            @if ($post->sections->isNotEmpty())

                <div class="mt-14 space-y-12">

                    @foreach ($post->sections as $index => $section)

                        <section class="relative overflow-hidden rounded-2xl border border-blush-100 bg-gradient-to-br from-blush-50/70 via-white to-white p-6 sm:p-8">


                            {{-- Number Badge --}}

                            <div class="mb-5 flex items-start gap-4">

                                <span class="grid h-10 w-10 shrink-0 place-items-center rounded-full bg-blush-500 text-sm font-semibold text-white">

                                    {{ $index + 1 }}

                                </span>


                                <div>

                                    <p class="mb-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-blush-500">

                                        Style Guide

                                    </p>


                                    <h2 class="font-serif text-2xl font-semibold leading-tight text-ink sm:text-3xl">

                                        {{ $section->heading }}

                                    </h2>

                                </div>

                            </div>


                            {{-- Section Content --}}

                            <div class="border-l-2 border-blush-200 pl-5 sm:ml-5 sm:pl-7">

                                <div class="text-[15px] leading-7 text-gray-600">

                                    {!! nl2br(e($section->content)) !!}

                                </div>

                            </div>

                        </section>

                    @endforeach

                </div>

            @endif


            {{-- =================================================
                RELATED POSTS
            ================================================== --}}

            @if ($related->isNotEmpty())

                <section class="mt-16">

                    <h2 class="text-xl font-semibold">

                        You might also like

                    </h2>


                    <div class="mt-5 grid gap-6 sm:grid-cols-3">

                        @foreach ($related as $item)

                            @php

                                $relatedUrl = $item->cover_url;


                                $related400 = str_replace(
                                    'f_auto,q_auto,w_1200',
                                    'f_auto,q_auto,w_400',
                                    $relatedUrl
                                );


                                $related600 = str_replace(
                                    'f_auto,q_auto,w_1200',
                                    'f_auto,q_auto,w_600',
                                    $relatedUrl
                                );


                                $related800 = str_replace(
                                    'f_auto,q_auto,w_1200',
                                    'f_auto,q_auto,w_800',
                                    $relatedUrl
                                );

                            @endphp


                            <a
                                href="{{ route('post.show', $item) }}"
                                class="group"
                            >

                                <img
                                    src="{{ $related600 }}"

                                    srcset="
                                        {{ $related400 }} 400w,
                                        {{ $related600 }} 600w,
                                        {{ $related800 }} 800w
                                    "

                                    sizes="
                                        (min-width: 640px) 33vw,
                                        100vw
                                    "

                                    alt="{{ $item->title }}"

                                    width="800"
                                    height="600"

                                    loading="lazy"
                                    decoding="async"

                                    class="aspect-[4/3] w-full rounded-xl object-cover"
                                >


                                <h3 class="mt-2 text-sm font-medium leading-snug group-hover:text-blush-600">

                                    {{ $item->title }}

                                </h3>

                            </a>

                        @endforeach

                    </div>

                </section>

            @endif

        </div>


        {{-- =================================================
            SIDEBAR
        ================================================== --}}

        <div class="mt-12 lg:mt-0">

            @include('partials.sidebar', [
                'post' => $post
            ])

        </div>

    </div>

@endsection