@extends('layouts.admin')

@section('title', $post->exists ? 'Edit post' : 'New post')
@section('heading', $post->exists ? 'Edit post' : 'New post')

@section('content')
<form method="POST"
      action="{{ $post->exists ? route('admin.posts.update', $post) : route('admin.posts.store') }}"
      enctype="multipart/form-data"
      class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_300px]">
    @csrf
    @if ($post->exists) @method('PUT') @endif

    <div class="space-y-5 rounded-2xl border border-blush-100 bg-white p-6">
        <div>
            <label class="label" for="title">Title</label>
            <input id="title" name="title" class="field" required
                   value="{{ old('title', $post->title) }}"
                   placeholder="15 Trending Gift Ideas for Her in 2026">
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="label" for="slug">URL slug</label>
                <input id="slug" name="slug" class="field" value="{{ old('slug', $post->slug) }}"
                       placeholder="Leave blank to generate from the title">
            </div>
            <div>
                <label class="label" for="eyebrow">Hero pill</label>
                <input id="eyebrow" name="eyebrow" class="field" value="{{ old('eyebrow', $post->eyebrow) }}"
                       placeholder="GIFT IDEAS">
            </div>
        </div>

        <div>
            <label class="label" for="subtitle">Subtitle</label>
            <input id="subtitle" name="subtitle" class="field" value="{{ old('subtitle', $post->subtitle) }}"
                   placeholder="Stylish. Thoughtful. Unforgettable.">
        </div>

        <div>
            <label class="label" for="excerpt">Hero paragraph</label>
            <textarea id="excerpt" name="excerpt" rows="3" class="field">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div>
            <label class="label" for="body">Intro copy</label>
            <textarea id="body" name="body" rows="6" class="field">{{ old('body', $post->body) }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Shown under the script heading, above the gift grid.</p>
        </div>

        <div>
            <label class="label" for="pull_quote">Pull quote</label>
            <input id="pull_quote" name="pull_quote" class="field" value="{{ old('pull_quote', $post->pull_quote) }}"
                   placeholder="The best gifts aren't always the most expensive.">
        </div>

        <fieldset class="border-t border-blush-50 pt-5">
            <legend class="text-sm font-semibold">Search listing</legend>
            <div class="mt-3 space-y-4">
                <div>
                    <label class="label" for="meta_title">Meta title</label>
                    <input id="meta_title" name="meta_title" class="field" value="{{ old('meta_title', $post->meta_title) }}">
                </div>
                <div>
                    <label class="label" for="meta_description">Meta description</label>
                    <textarea id="meta_description" name="meta_description" rows="2" class="field">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>
            </div>
        </fieldset>
    </div>

    <div class="space-y-5">
        <div class="space-y-4 rounded-2xl border border-blush-100 bg-white p-5">
            <div>
                <label class="label" for="status">Status</label>
                <select id="status" name="status" class="field">
                    @foreach (['draft' => 'Draft', 'published' => 'Published'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $post->status) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label" for="published_at">Publish date</label>
                <input id="published_at" name="published_at" type="datetime-local" class="field"
                       value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}">
            </div>

            <div>
                <label class="label" for="category_id">Category</label>
                <select id="category_id" name="category_id" class="field">
                    <option value="">Uncategorised</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="label" for="read_minutes">Read time (minutes)</label>
                <input id="read_minutes" name="read_minutes" type="number" min="1" class="field"
                       value="{{ old('read_minutes', $post->read_minutes ?? 5) }}">
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_featured" value="1" class="rounded border-blush-300 text-blush-500"
                       @checked(old('is_featured', $post->is_featured))>
                Show in the homepage hero
            </label>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="is_popular" value="1" class="rounded border-blush-300 text-blush-500"
                       @checked(old('is_popular', $post->is_popular))>
                Show in Popular Posts
            </label>
        </div>

        <div class="space-y-3 rounded-2xl border border-blush-100 bg-white p-5">
            <p class="text-sm font-semibold">Cover image</p>

            @if ($post->cover_image)
                <img src="{{ $post->cover_url }}" alt="" class="h-32 w-full rounded-lg object-cover">
            @endif

            <div>
                <label class="label" for="cover_file">Upload a file</label>
                <input id="cover_file" name="cover_file" type="file" accept="image/*" class="w-full text-sm">
            </div>

            <div>
                <label class="label" for="cover_url">Or paste an image URL</label>
                <input id="cover_url" name="cover_url" type="url" class="field" placeholder="https://...">
            </div>
        </div>

        <div class="flex gap-3">
            <button class="btn-pink">{{ $post->exists ? 'Save changes' : 'Create post' }}</button>
            <a href="{{ route('admin.posts.index') }}" class="px-3 py-2.5 text-sm text-gray-600 hover:underline">Cancel</a>
        </div>

        @if ($post->exists)
            <a href="{{ route('admin.posts.gifts.index', $post) }}"
               class="block rounded-2xl border border-dashed border-blush-200 p-4 text-center text-sm text-blush-600 hover:bg-blush-50">
                Manage gift cards
            </a>
        @endif
    </div>
</form>
@endsection
