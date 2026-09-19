@extends('layouts.site')

@section('title', $category->name . ' | Gift Trandly')

@section('content')
    <div class="mx-auto max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid lg:grid-cols-[minmax(0,1fr)_320px] lg:px-8">
        <div>
            <h1 class="font-script text-5xl text-blush-500">{{ $category->name }}</h1>
            @if ($category->description)
                <p class="mt-2 max-w-xl text-sm leading-relaxed text-gray-600">{{ $category->description }}</p>
            @endif

            @if ($posts->isEmpty())
                <p class="mt-8 rounded-xl border border-dashed border-blush-200 p-8 text-center text-sm text-gray-500">
                    Nothing here yet. Check back soon.
                </p>
            @else
                <div class="mt-8 grid gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($posts as $item)
                        <article>
                            <a href="{{ route('post.show', $item) }}">
                                <img src="{{ $item->cover_url }}" alt="{{ $item->title }}"
                                     class="aspect-[4/3] w-full rounded-2xl object-cover" loading="lazy">
                            </a>
                            <h3 class="mt-3 text-[15px] font-semibold leading-snug">
                                <a href="{{ route('post.show', $item) }}" class="hover:text-blush-600">{{ $item->title }}</a>
                            </h3>
                            <p class="mt-1 line-clamp-2 text-sm leading-relaxed text-gray-600">{{ $item->excerpt }}</p>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10">{{ $posts->links() }}</div>
            @endif
        </div>

        <div class="mt-12 lg:mt-0">@include('partials.sidebar')</div>
    </div>
@endsection
