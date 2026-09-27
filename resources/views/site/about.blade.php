@extends('layouts.site')

@section('title', 'About Gift Trandly | Gift Ideas & Fashion Finds')

@section('meta_description', 'Learn more about Gift Trandly, a curated destination for thoughtful gift ideas, fashion finds, seasonal inspiration and useful shopping guides.')

@section('content')

    {{-- Hero --}}
    <section class="bg-linen">
        <div class="mx-auto max-w-5xl px-4 py-16 text-center sm:px-6 sm:py-20">

            <span class="inline-flex rounded-full bg-blush-50 px-4 py-1.5 text-xs font-semibold uppercase tracking-wider text-blush-600">
                About Us
            </span>

            <h1 class="mt-5 font-serif text-4xl font-semibold leading-tight text-ink sm:text-5xl">
                Finding the right gift should feel
                <span class="text-blush-500">inspiring, not overwhelming.</span>
            </h1>

            <p class="mx-auto mt-6 max-w-2xl text-base leading-7 text-gray-600">
                Gift Trandly is a gift and lifestyle inspiration site created to help
                you discover thoughtful gift ideas, fashion finds and seasonal picks
                for the people and moments that matter.
            </p>

        </div>
    </section>


    {{-- Our Story --}}
    <section class="mx-auto max-w-5xl px-4 py-14 sm:px-6">

        <div class="grid gap-10 md:grid-cols-2 md:items-center">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blush-500">
                    Our Story
                </p>

                <h2 class="mt-3 font-serif text-3xl font-semibold text-ink">
                    Less searching. More great finds.
                </h2>
            </div>

            <div class="space-y-4 text-[15px] leading-7 text-gray-600">

                <p>
                    Finding a gift can quickly turn into hours of searching through
                    products, trends and recommendations. Gift Trandly was created to
                    make that process simpler.
                </p>

                <p>
                    We publish curated gift guides, fashion inspiration and seasonal
                    roundups designed to give you ideas for birthdays, holidays,
                    celebrations and everyday surprises.
                </p>

            </div>

        </div>

    </section>


    {{-- What We Share --}}
    <section class="border-y border-blush-100 bg-blush-50/30">

        <div class="mx-auto max-w-5xl px-4 py-14 sm:px-6">

            <div class="text-center">

                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blush-500">
                    What You'll Find Here
                </p>

                <h2 class="mt-3 font-serif text-3xl font-semibold text-ink">
                    Ideas for every kind of moment
                </h2>

            </div>


            <div class="mt-10 grid gap-8 sm:grid-cols-3">

                {{-- Gift Ideas --}}
                <div class="text-center">

                    <span class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-white text-lg shadow-sm">
                        🎁
                    </span>

                    <h3 class="mt-4 text-sm font-semibold text-ink">
                        Thoughtful Gift Ideas
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-600">
                        Gift inspiration for birthdays, holidays, special occasions
                        and those just-because moments.
                    </p>

                </div>


                {{-- Fashion --}}
                <div class="text-center">

                    <span class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-white text-lg shadow-sm">
                        ✨
                    </span>

                    <h3 class="mt-4 text-sm font-semibold text-ink">
                        Fashion Finds
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-600">
                        Fun, stylish and seasonal fashion finds worth adding to your
                        inspiration list.
                    </p>

                </div>


                {{-- Seasonal --}}
                <div class="text-center">

                    <span class="mx-auto grid h-11 w-11 place-items-center rounded-full bg-white text-lg shadow-sm">
                        🍂
                    </span>

                    <h3 class="mt-4 text-sm font-semibold text-ink">
                        Seasonal Inspiration
                    </h3>

                    <p class="mt-2 text-sm leading-6 text-gray-600">
                        Fresh ideas for Halloween, Christmas, Valentine's Day and
                        other moments throughout the year.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- How We Choose --}}
    <section class="mx-auto max-w-5xl px-4 py-14 sm:px-6">

        <div class="grid gap-8 md:grid-cols-[220px_1fr]">

            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blush-500">
                    Our Approach
                </p>

                <h2 class="mt-3 font-serif text-2xl font-semibold text-ink">
                    How we choose what to feature
                </h2>
            </div>


            <div class="grid gap-6 sm:grid-cols-3">

                <div class="flex gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blush-50 text-sm font-semibold text-blush-600">
                        1
                    </span>

                    <div>
                        <h3 class="text-sm font-semibold text-ink">
                            Useful
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            We look for ideas that fit real occasions and everyday needs.
                        </p>
                    </div>
                </div>


                <div class="flex gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blush-50 text-sm font-semibold text-blush-600">
                        2
                    </span>

                    <div>
                        <h3 class="text-sm font-semibold text-ink">
                            Relevant
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            We focus on styles, themes and ideas relevant to each guide.
                        </p>
                    </div>
                </div>


                <div class="flex gap-3">
                    <span class="grid h-9 w-9 shrink-0 place-items-center rounded-full bg-blush-50 text-sm font-semibold text-blush-600">
                        3
                    </span>

                    <div>
                        <h3 class="text-sm font-semibold text-ink">
                            Easy to Explore
                        </h3>

                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            Our roundups are designed to help you compare ideas quickly.
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </section>


    {{-- Affiliate Disclosure --}}
    <section class="mx-auto max-w-5xl px-4 pb-16 sm:px-6">

        <div class="rounded-2xl border border-blush-100 bg-linen p-6 sm:p-8">

            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-blush-500">
                Transparency
            </p>

            <h2 class="mt-2 font-serif text-2xl font-semibold text-ink">
                A note about affiliate links
            </h2>

            <p class="mt-4 max-w-3xl text-sm leading-7 text-gray-600">
                Some links on Gift Trandly may be affiliate links. If you make a
                purchase through one of these links, we may earn a commission at no
                additional cost to you. Affiliate partnerships help support the site
                and allow us to continue creating new guides and inspiration.
            </p>

        </div>

    </section>

@endsection