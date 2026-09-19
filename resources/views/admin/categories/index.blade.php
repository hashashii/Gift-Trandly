@extends('layouts.admin')

@section('title', 'Categories')
@section('heading', 'Categories')

@section('content')
<div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">

    <div class="overflow-x-auto rounded-2xl border border-blush-100 bg-white">
        <table class="w-full text-sm">
            <thead class="bg-blush-50/60 text-left text-xs text-gray-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Name</th>
                    <th class="px-4 py-3 font-medium">Slug</th>
                    <th class="px-4 py-3 font-medium">Posts</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blush-50">
            @forelse ($categories as $row)
                <tr>
                    <td class="flex items-center gap-2 px-4 py-3">
                        <span class="h-3 w-3 rounded-full" style="background: {{ $row->color }}"></span>
                        {{ $row->name }}
                    </td>
                    <td class="px-4 py-3 text-gray-500">{{ $row->slug }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $row->posts_count }}</td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex justify-end gap-3 text-xs">
                            <a href="{{ route('admin.categories.edit', $row) }}" class="text-gray-600 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.categories.destroy', $row) }}"
                                  onsubmit="return confirm('Delete this category? Its posts stay, but become uncategorised.')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-10 text-center text-gray-500">
                    No categories yet. Add one on the right.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <form method="POST"
          action="{{ $category->exists ? route('admin.categories.update', $category) : route('admin.categories.store') }}"
          class="space-y-4 rounded-2xl border border-blush-100 bg-white p-5">
        @csrf
        @if ($category->exists) @method('PUT') @endif

        <p class="font-semibold">{{ $category->exists ? 'Edit category' : 'Add category' }}</p>

        <div>
            <label class="label" for="name">Name</label>
            <input id="name" name="name" class="field" required value="{{ old('name', $category->name) }}">
        </div>

        <div>
            <label class="label" for="slug">Slug</label>
            <input id="slug" name="slug" class="field" value="{{ old('slug', $category->slug) }}"
                   placeholder="Leave blank to generate">
        </div>

        <div>
            <label class="label" for="color">Accent colour</label>
            <input id="color" name="color" type="color" class="h-10 w-full rounded-lg border-blush-200"
                   value="{{ old('color', $category->color ?: '#E8547C') }}">
        </div>

        <div>
            <label class="label" for="description">Description</label>
            <textarea id="description" name="description" rows="3" class="field">{{ old('description', $category->description) }}</textarea>
        </div>

        <div class="flex gap-3">
            <button class="btn-pink">{{ $category->exists ? 'Save changes' : 'Add category' }}</button>
            @if ($category->exists)
                <a href="{{ route('admin.categories.index') }}" class="px-3 py-2.5 text-sm text-gray-600 hover:underline">Cancel</a>
            @endif
        </div>
    </form>
</div>
@endsection
