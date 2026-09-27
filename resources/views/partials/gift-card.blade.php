@props(['gift', 'number'])

@php
    /*
    |--------------------------------------------------------------------------
    | Gift Image Optimization
    |--------------------------------------------------------------------------
    | Cloudinary images:
    | - f_auto = WebP / AVIF when supported
    | - q_auto = automatic quality optimization
    | - responsive widths = 400 / 600 / 800
    |
    | Non-Cloudinary images remain unchanged.
    */

    $imageUrl = $gift->image_url;

    $isCloudinary = $imageUrl
        && str_contains($imageUrl, 'res.cloudinary.com')
        && str_contains($imageUrl, '/image/upload/');

    if ($isCloudinary) {

        // Remove our existing standard transformation if already present.
        $originalUrl = str_replace(
            '/image/upload/f_auto,q_auto,w_1200/',
            '/image/upload/',
            $imageUrl
        );

        $gift400 = str_replace(
            '/image/upload/',
            '/image/upload/f_auto,q_auto,w_400/',
            $originalUrl
        );

        $gift600 = str_replace(
            '/image/upload/',
            '/image/upload/f_auto,q_auto,w_600/',
            $originalUrl
        );

        $gift800 = str_replace(
            '/image/upload/',
            '/image/upload/f_auto,q_auto,w_800/',
            $originalUrl
        );

    } else {

        $gift400 = $imageUrl;
        $gift600 = $imageUrl;
        $gift800 = $imageUrl;

    }
@endphp


<article
    id="gift-{{ $gift->id }}"
    class="scroll-mt-28"
>

    {{-- =====================================================
        PRODUCT IMAGE
    ====================================================== --}}
    <div class="relative overflow-hidden rounded-2xl">

        @if ($isCloudinary)

            <img
                src="{{ $gift600 }}"

                srcset="
                    {{ $gift400 }} 400w,
                    {{ $gift600 }} 600w,
                    {{ $gift800 }} 800w
                "

                sizes="
                    (min-width: 1024px) 33vw,
                    (min-width: 640px) 50vw,
                    100vw
                "

                alt="{{ $gift->title }}"

                width="800"
                height="600"

                loading="lazy"
                decoding="async"

                class="aspect-[4/3] w-full object-cover"
            >

        @else

            <img
                src="{{ $imageUrl }}"
                alt="{{ $gift->title }}"
                width="800"
                height="600"
                loading="lazy"
                decoding="async"
                class="aspect-[4/3] w-full object-cover"
            >

        @endif


        {{-- Gift Number --}}
        <span
            class="absolute bottom-3 left-3 grid h-7 w-7 place-items-center rounded-full bg-blush-500 text-xs font-semibold text-white"
        >
            {{ $number }}
        </span>

    </div>


    {{-- =====================================================
        PRODUCT TITLE
    ====================================================== --}}
    <h3 class="mt-3 text-[15px] font-semibold">
        {{ $gift->title }}
    </h3>


    {{-- =====================================================
        DESCRIPTION
    ====================================================== --}}
    @if ($gift->description)

        <p class="mt-1 text-sm leading-relaxed text-gray-600">
            {{ $gift->description }}
        </p>

    @endif


    {{-- =====================================================
        TAGS
    ====================================================== --}}
    @if ($gift->tags)

        <ul class="mt-2.5 flex flex-wrap gap-1.5">

            @foreach ($gift->tags as $tag)

                <li class="pill">
                    {{ $tag }}
                </li>

            @endforeach

        </ul>

    @endif


    {{-- =====================================================
        AFFILIATE BUTTON
    ====================================================== --}}
    <a
        href="{{ $gift->affiliate_url ?: '#' }}"

        @if ($gift->affiliate_url)
            target="_blank"
            rel="nofollow sponsored noopener"
        @endif

        class="btn-pink mt-3"
    >

        {{ $gift->button_label }}

        @if ($gift->price)

            <span class="opacity-80">
                ${{ number_format((float) $gift->price, 2) }}
            </span>

        @endif


        <svg
            class="h-3.5 w-3.5"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M5 12h13m-5-5 5 5-5 5"
            />
        </svg>

    </a>

</article>