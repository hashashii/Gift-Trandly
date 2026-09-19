@extends('layouts.admin')

@section('title', 'Posts')
@section('heading', 'Posts')

@section('actions')
    <a href="{{ route('admin.posts.create') }}" class="btn-pink">New post</a>
@endsection

@section('content')
    <form method="GET" class="mb-5 flex flex-wrap gap-3">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search titles"
               class="field w-56" aria-label="Search posts">

        <select name="status" class="field w-40" aria-label="Filter by status">
            <option value="">All statuses</option>
            @foreach (['published', 'draft'] as $status)
                <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
            @endforeach
        </select>

        <select name="category" class="field w-48" aria-label="Filter by category">
            <option value="">All categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(request('category') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>

        <button class="btn-pink">Apply filters</button>
    </form>

    <div class="overflow-x-auto rounded-2xl border border-blush-100 bg-white">
        <table class="w-full text-sm">
            <thead class="bg-blush-50/60 text-left text-xs text-gray-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Title</th>
                    <th class="px-4 py-3 font-medium">Category</th>
                    <th class="px-4 py-3 font-medium">Gifts</th>
                    <th class="px-4 py-3 font-medium">Status</th>
                    <th class="px-4 py-3 font-medium">Published</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blush-50">
            @forelse ($posts as $post)
                <tr>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="font-medium hover:text-blush-600">
                            {{ $post->title }}
                        </a>
                        <span class="block text-xs text-gray-400">/{{ $post->slug }}</span>
                    </td>
                    <td class="px-4 py-3 text-gray-600">{{ $post->category?->name ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-600">{{ $post->gifts_count }}</td>
                    <td class="px-4 py-3"><span class="pill">{{ ucfirst($post->status) }}</span></td>
                    <td class="px-4 py-3 text-gray-500">{{ optional($post->published_at)->format('M j, Y') ?? '—' }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-3 text-xs">
                            <a href="{{ route('admin.posts.gifts.index', $post) }}" class="text-blush-600 hover:underline">Gifts</a>
                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-gray-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                  onsubmit="return confirm('Delete this post and all its gift cards?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="px-4 py-10 text-center text-gray-500">
                    No posts match these filters. Create a post to get started.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $posts->links() }}</div>
@endsection
