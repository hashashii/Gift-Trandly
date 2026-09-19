@extends('layouts.site')

@section('title', 'Search | Gift Trandly')

@section('content')
    <div class="mx-auto max-w-7xl gap-10 px-4 py-12 sm:px-6 lg:grid lg:grid-cols-[minmax(0,1fr)_320px] lg:px-8">
        <div>
            <h1 class="font-script text-5xl text-blush-500">Search</h1>
            <p class="mt-2 text-sm text-gray-600">
                {{ $posts->total() }} {{ Str::plural('result', $posts->total()) }}
                @if ($term) for &ldquo;{{ $term }}&rdquo; @endif
            </p>

            @if ($posts->isEmpty())
                <p class="mt-8 rounded-xl border border-dashed border-blush-200 p-8 text-center text-sm text-gray-500">
                    Nothing matched that. Try a broader word like &ldquo;jewellery&rdquo; or &ldquo;self-care&rdquo;.
                </p>
            @else
                <div class="mt-8 space-y-6">
                    @foreach ($posts as $item)
                        <article class="flex gap-4">
                            <a href="{{ route('post.show', $item) }}" class="shrink-0">
                                <img src="{{ $item->cover_url }}" alt=""
                                     class="h-24 w-32 rounded-xl object-cover" loading="lazy">
                            </a>
                            <div>
                                <h2 class="text-[15px] font-semibold">
                                    <a href="{{ route('post.show', $item) }}" class="hover:text-blush-600">{{ $item->title }}</a>
                                </h2>
                                <p class="mt-1 line-clamp-2 text-sm text-gray-600">{{ $item->excerpt }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-10">{{ $posts->links() }}</div>
            @endif
        </div>

        <div class="mt-12 lg:mt-0">@include('partials.sidebar')</div>
    </div>
@endsection
