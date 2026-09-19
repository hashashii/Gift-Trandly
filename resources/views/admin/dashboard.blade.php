@extends('layouts.admin')

@section('title', 'Dashboard')
@section('heading', 'Dashboard')

@section('actions')
    <a href="{{ route('admin.posts.create') }}" class="btn-pink">New post</a>
@endsection

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Published posts', $stats['published']],
            ['Drafts', $stats['drafts']],
            ['Gift cards', $stats['gifts']],
            ['Subscribers', $stats['subscribers']],
        ] as [$label, $value])
            <div class="rounded-2xl border border-blush-100 bg-white p-5">
                <p class="text-sm text-gray-500">{{ $label }}</p>
                <p class="mt-1 text-3xl font-semibold">{{ number_format($value) }}</p>
            </div>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-3">
        <section class="rounded-2xl border border-blush-100 bg-white p-5 lg:col-span-2">
            <h2 class="font-semibold">Recently edited</h2>
            <table class="mt-4 w-full text-sm">
                <tbody class="divide-y divide-blush-50">
                @forelse ($recent as $post)
                    <tr>
                        <td class="py-2.5">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="font-medium hover:text-blush-600">
                                {{ $post->title }}
                            </a>
                            <span class="block text-xs text-gray-400">{{ $post->category?->name ?? 'Uncategorised' }}</span>
                        </td>
                        <td class="py-2.5 text-right">
                            <span class="pill">{{ ucfirst($post->status) }}</span>
                        </td>
                        <td class="py-2.5 text-right text-xs text-gray-400">{{ $post->updated_at->diffForHumans() }}</td>
                    </tr>
                @empty
                    <tr><td class="py-6 text-center text-gray-500">No posts yet. Create your first one.</td></tr>
                @endforelse
                </tbody>
            </table>
        </section>

        <section class="rounded-2xl border border-blush-100 bg-white p-5">
            <h2 class="font-semibold">Most viewed</h2>
            <ul class="mt-4 space-y-3 text-sm">
                @forelse ($topPosts as $post)
                    <li class="flex items-baseline justify-between gap-3">
                        <span class="truncate">{{ $post->title }}</span>
                        <span class="shrink-0 text-xs text-gray-400">{{ number_format($post->views) }}</span>
                    </li>
                @empty
                    <li class="text-gray-500">No views recorded yet.</li>
                @endforelse
            </ul>
        </section>
    </div>
@endsection
