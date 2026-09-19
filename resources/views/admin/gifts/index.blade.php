@extends('layouts.admin')

@section('title', 'Gift cards')
@section('heading', 'Gift cards — ' . $post->title)

@section('actions')
    <a href="{{ route('admin.posts.gifts.create', $post) }}" class="btn-pink">Add gift card</a>
@endsection

@section('content')
    <p class="mb-5 text-sm text-gray-600">
        Drag a row to change the order shoppers see. The number on each card and the table of contents follow this order.
    </p>

    @if ($post->gifts->isEmpty())
        <div class="rounded-2xl border border-dashed border-blush-200 p-12 text-center">
            <p class="text-sm text-gray-600">This post has no gift cards yet.</p>
            <a href="{{ route('admin.posts.gifts.create', $post) }}" class="btn-pink mt-4">Add the first one</a>
        </div>
    @else
        <ul id="gift-list" data-reorder-url="{{ route('admin.posts.gifts.reorder', $post) }}"
            class="space-y-3">
            @foreach ($post->gifts as $index => $gift)
                <li data-id="{{ $gift->id }}" draggable="true"
                    class="flex cursor-grab items-center gap-4 rounded-2xl border border-blush-100 bg-white p-3">
                    <span class="grid h-7 w-7 shrink-0 place-items-center rounded-full bg-blush-500 text-xs font-semibold text-white">
                        {{ $index + 1 }}
                    </span>
                    <img src="{{ $gift->image_url }}" alt="" class="h-14 w-16 shrink-0 rounded-lg object-cover">
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium">{{ $gift->title }}</p>
                        <p class="truncate text-xs text-gray-500">{{ $gift->description }}</p>
                        @if ($gift->tags)
                            <p class="mt-1 flex flex-wrap gap-1">
                                @foreach ($gift->tags as $tag)<span class="pill">{{ $tag }}</span>@endforeach
                            </p>
                        @endif
                    </div>
                    <div class="flex shrink-0 gap-3 text-xs">
                        <a href="{{ route('admin.posts.gifts.edit', [$post, $gift]) }}" class="text-gray-600 hover:underline">Edit</a>
                        <form method="POST" action="{{ route('admin.posts.gifts.destroy', [$post, $gift]) }}"
                              onsubmit="return confirm('Delete this gift card?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <div class="mt-6 flex gap-4 text-sm">
        <a href="{{ route('admin.posts.edit', $post) }}" class="text-gray-600 hover:underline">Back to post</a>
        <a href="{{ route('post.show', $post) }}" target="_blank" class="text-blush-600 hover:underline">Preview on site</a>
    </div>
@endsection
