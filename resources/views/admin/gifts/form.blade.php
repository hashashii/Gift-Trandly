@extends('layouts.admin')

@section('title', $gift->exists ? 'Edit gift card' : 'Add gift card')
@section('heading', $gift->exists ? 'Edit gift card' : 'Add gift card')

@section('content')
<form method="POST"
      action="{{ $gift->exists ? route('admin.posts.gifts.update', [$post, $gift]) : route('admin.posts.gifts.store', $post) }}"
      enctype="multipart/form-data"
      class="grid max-w-4xl gap-6 lg:grid-cols-[minmax(0,1fr)_280px]">
    @csrf
    @if ($gift->exists) @method('PUT') @endif

    <div class="space-y-5 rounded-2xl border border-blush-100 bg-white p-6">
        <div>
            <label class="label" for="title">Gift name</label>
            <input id="title" name="title" class="field" required
                   value="{{ old('title', $gift->title) }}" placeholder="Minimalist Jewelry">
        </div>

        <div>
            <label class="label" for="description">Short description</label>
            <textarea id="description" name="description" rows="3" class="field"
                      placeholder="A timeless piece she can wear every day.">{{ old('description', $gift->description) }}</textarea>
        </div>

        <div>
            <label class="label" for="tags">Tags</label>
            <input id="tags" name="tags" class="field" placeholder="Birthday, Anniversary, Valentine's Day"
                   value="{{ old('tags', is_array($gift->tags) ? implode(', ', $gift->tags) : '') }}">
            <p class="mt-1 text-xs text-gray-500">Separate with commas. These become the pink pills on the card.</p>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="label" for="affiliate_url">Affiliate link</label>
                <input id="affiliate_url" name="affiliate_url" type="url" class="field"
                       value="{{ old('affiliate_url', $gift->affiliate_url) }}" placeholder="https://...">
            </div>
            <div>
                <label class="label" for="button_label">Button text</label>
                <input id="button_label" name="button_label" class="field" required
                       value="{{ old('button_label', $gift->button_label ?: 'Check Price') }}">
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <label class="label" for="price">Price (optional)</label>
                <input id="price" name="price" type="number" step="0.01" min="0" class="field"
                       value="{{ old('price', $gift->price) }}">
            </div>
            <div>
                <label class="label" for="position">Order</label>
                <input id="position" name="position" type="number" min="0" class="field" required
                       value="{{ old('position', $gift->position) }}">
            </div>
        </div>
    </div>

    <div class="space-y-5">
        <div class="space-y-3 rounded-2xl border border-blush-100 bg-white p-5">
            <p class="text-sm font-semibold">Product image</p>

            @if ($gift->image)
                <img src="{{ $gift->image_url }}" alt="" class="aspect-[4/3] w-full rounded-lg object-cover">
            @endif

            <div>
                <label class="label" for="image_file">Upload a file</label>
                <input id="image_file" name="image_file" type="file" accept="image/*" class="w-full text-sm">
            </div>

            <div>
                <label class="label" for="image_url">Or paste an image URL</label>
                <input id="image_url" name="image_url" type="url" class="field" placeholder="https://...">
            </div>
        </div>

        <div class="flex gap-3">
            <button class="btn-pink">{{ $gift->exists ? 'Save changes' : 'Add gift card' }}</button>
            <a href="{{ route('admin.posts.gifts.index', $post) }}" class="px-3 py-2.5 text-sm text-gray-600 hover:underline">Cancel</a>
        </div>
    </div>
</form>
@endsection
