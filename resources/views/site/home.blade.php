@extends('layouts.site')


{{-- =========================================================
    HOMEPAGE SEO
========================================================= --}}

@section('title', 'Gift Trandly — Trending Gifts, Fashion & Beauty Ideas')

@section(
    'meta_description',
    'Discover trending gift ideas, fashion finds, beauty inspiration and thoughtful picks for birthdays, holidays and every special occasion.'
)


{{-- =========================================================
    HOMEPAGE SEO / SOCIAL / STRUCTURED DATA
========================================================= --}}

@push('head')

    {{-- Canonical --}}
    <link rel="canonical" href="{{ url('/') }}">


    {{-- =====================================================
        OPEN GRAPH / FACEBOOK
    ====================================================== --}}

    <meta property="og:type" content="website">

    <meta property="og:site_name" content="Gift Trandly">

    <meta
        property="og:title"
        content="Gift Trandly — Trending Gifts, Fashion & Beauty Ideas"
    >

    <meta
        property="og:description"
        content="Discover trending gift ideas, fashion finds, beauty inspiration and thoughtful picks for birthdays, holidays and every special occasion."
    >

    <meta
        property="og:url"
        content="{{ url('/') }}"
    >

    @if ($featured && $featured->cover_url)

        <meta
            property="og:image"
            content="{{ $featured->cover_url }}"
        >

        <meta
            property="og:image:alt"
            content="{{ $featured->title }}"
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
        content="Gift Trandly — Trending Gifts, Fashion & Beauty Ideas"
    >

    <meta
        name="twitter:description"
        content="Discover trending gift ideas, fashion finds, beauty inspiration and thoughtful picks for birthdays, holidays and every special occasion."
    >

    @if ($featured && $featured->cover_url)

        <meta
            name="twitter:image"
            content="{{ $featured->cover_url }}"
        >

        <meta
            name="twitter:image:alt"
            content="{{ $featured->title }}"
        >

    @endif


    {{-- =====================================================
        WEBSITE SCHEMA
    ====================================================== --}}

    @php
        $websiteSchema = [
            '@context' => 'https://schema.org',

            '@type' => 'WebSite',

            '@id' => url('/') . '#website',

            'url' => url('/'),

            'name' => 'Gift Trandly',

            'description' =>
                'Discover trending gift ideas, fashion finds, beauty inspiration and thoughtful picks for birthdays, holidays and every special occasion.',

            'publisher' => [
                '@id' => url('/') . '#organization',
            ],
        ];
    @endphp


    <script type="application/ld+json">
        {!! json_encode(
            $websiteSchema,
            JSON_UNESCAPED_SLASHES |
            JSON_UNESCAPED_UNICODE |
            JSON_HEX_TAG |
            JSON_HEX_AMP |
            JSON_HEX_APOS |
            JSON_HEX_QUOT
        ) !!}
    </script>


    {{-- =====================================================
        ORGANIZATION SCHEMA
    ====================================================== --}}

    @php
        $organizationSchema = [
            '@context' => 'https://schema.org',

            '@type' => 'Organization',

            '@id' => url('/') . '#organization',

            'name' => 'Gift Trandly',

            'url' => url('/'),

            'description' =>
                'Gift Trandly shares trending gift ideas, fashion finds, beauty inspiration and thoughtful picks for every occasion.',
        ];
    @endphp


    <script type="application/ld+json">
        {!! json_encode(
            $organizationSchema,
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
        FEATURED / HERO SECTION
    ========================================================== --}}

    @if ($featured)

        @php

            $heroUrl = $featured->cover_url;


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


                {{-- =================================================
                    HERO CONTENT
                ================================================== --}}

                <div class="lg:py-16">


                    @if ($featured->eyebrow)

                        <span class="inline-flex rounded-full bg-blush-500 px-3 py-1 text-[11px] font-semibold tracking-wide text-white">

                            {{ $featured->eyebrow }}

                        </span>

                    @endif


                    <h1 class="headline mt-5 font-serif text-4xl leading-tight sm:text-5xl">

                        <a href="{{ route('post.show', $featured) }}">

                            {{ $featured->title }}

                        </a>

                    </h1>


                    @if ($featured->subtitle)

                        <p class="mt-4 text-lg font-medium text-gray-800">

                            {{ $featured->subtitle }}

                        </p>

                    @endif


                    @if ($featured->excerpt)

                        <p class="mt-3 max-w-xl text-[15px] leading-relaxed text-gray-600">

                            {{ $featured->excerpt }}

                        </p>

                    @endif


                    <a
                        href="{{ route('post.show', $featured) }}"
                        class="btn-pink mt-6"
                    >

                        Read the guide

                    </a>

                </div>


                {{-- =================================================
                    HERO IMAGE
                ================================================== --}}

                <img
                    src="{{ $hero960 }}"

                    srcset="
                        {{ $hero640 }} 640w,
                        {{ $hero960 }} 960w,
                        {{ $hero1200 }} 1200w
                    "

                    sizes="(min-width: 1024px) 50vw, 100vw"

                    alt="{{ $featured->title }}"

                    width="1200"
                    height="840"

                    fetchpriority="high"
                    decoding="async"

                    class="h-64 w-full rounded-2xl object-cover lg:h-[420px] lg:rounded-none"
                >

            </div>

        </section>

    @endif



    {{-- =========================================================
        MAIN CONTENT
    ========================================================== --}}

    <div class="mx-auto max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid lg:grid-cols-[minmax(0,1fr)_320px] lg:px-8">


        {{-- =====================================================
            FRESH GIFT GUIDES
        ====================================================== --}}

        <div>


            <h2 class="font-script text-4xl text-blush-500">

                Fresh Gift Guides

            </h2>


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


                        @php

                            /*
                            |--------------------------------------------------------------------------
                            | Responsive Card Images
                            |--------------------------------------------------------------------------
                            */

                            $cardUrl = $item->cover_url;


                            $card400 = str_replace(
                                'f_auto,q_auto,w_1200',
                                'f_auto,q_auto,w_400',
                                $cardUrl
                            );


                            $card600 = str_replace(
                                'f_auto,q_auto,w_1200',
                                'f_auto,q_auto,w_600',
                                $cardUrl
                            );


                            $card800 = str_replace(
                                'f_auto,q_auto,w_1200',
                                'f_auto,q_auto,w_800',
                                $cardUrl
                            );

                        @endphp


                        <article>


                            {{-- =================================================
                                ARTICLE IMAGE
                            ================================================== --}}

                            <a href="{{ route('post.show', $item) }}">

                                <img
                                    src="{{ $card600 }}"

                                    srcset="
                                        {{ $card400 }} 400w,
                                        {{ $card600 }} 600w,
                                        {{ $card800 }} 800w
                                    "

                                    sizes="
                                        (min-width: 1024px) 33vw,
                                        (min-width: 640px) 50vw,
                                        100vw
                                    "

                                    alt="{{ $item->title }}"

                                    width="800"
                                    height="600"

                                    loading="lazy"
                                    decoding="async"

                                    class="aspect-[4/3] w-full rounded-2xl object-cover"
                                >

                            </a>


                            {{-- =================================================
                                CATEGORY
                            ================================================== --}}

                            @if ($item->category)

                                <span class="pill mt-3">

                                    {{ $item->category->name }}

                                </span>

                            @endif


                            {{-- =================================================
                                ARTICLE TITLE
                            ================================================== --}}

                            <h3 class="mt-2 text-[15px] font-semibold leading-snug">

                                <a
                                    href="{{ route('post.show', $item) }}"
                                    class="hover:text-blush-600"
                                >

                                    {{ $item->title }}

                                </a>

                            </h3>


                            {{-- =================================================
                                EXCERPT
                            ================================================== --}}

                            @if ($item->excerpt)

                                <p class="mt-1 line-clamp-2 text-sm leading-relaxed text-gray-600">

                                    {{ $item->excerpt }}

                                </p>

                            @endif


                            {{-- =================================================
                                DATE / READ TIME
                            ================================================== --}}

                            <p class="mt-2 text-xs text-gray-400">

                                {{ optional($item->published_at)->format('M j, Y') }}

                                &middot;

                                {{ $item->read_minutes }} min read

                            </p>


                        </article>


                    @endforeach


                </div>


            @endif


        </div>



        {{-- =====================================================
            SIDEBAR
        ====================================================== --}}

        <div class="mt-12 lg:mt-0">

            @include('partials.sidebar')

        </div>


    </div>


@endsection