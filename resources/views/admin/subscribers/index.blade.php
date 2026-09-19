@extends('layouts.admin')

@section('title', 'Subscribers')
@section('heading', 'Subscribers')

@section('actions')
    <a href="{{ route('admin.subscribers.export') }}" class="btn-pink">Export CSV</a>
@endsection

@section('content')
    <form method="GET" class="mb-5 flex gap-3">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search by email"
               class="field w-64" aria-label="Search subscribers">
        <button class="btn-pink">Search</button>
    </form>

    <div class="overflow-x-auto rounded-2xl border border-blush-100 bg-white">
        <table class="w-full text-sm">
            <thead class="bg-blush-50/60 text-left text-xs text-gray-500">
                <tr>
                    <th class="px-4 py-3 font-medium">Email</th>
                    <th class="px-4 py-3 font-medium">Source</th>
                    <th class="px-4 py-3 font-medium">Signed up</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-blush-50">
            @forelse ($subscribers as $subscriber)
                <tr>
                    <td class="px-4 py-3">{{ $subscriber->email }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $subscriber->source ?? '—' }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $subscriber->created_at->format('M j, Y') }}</td>
                    <td class="px-4 py-3 text-right">
                        <form method="POST" action="{{ route('admin.subscribers.destroy', $subscriber) }}"
                              onsubmit="return confirm('Remove this subscriber?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-600 hover:underline">Remove</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-10 text-center text-gray-500">
                    No subscribers yet. The sign-up form lives in the site sidebar.
                </td></tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-5">{{ $subscribers->links() }}</div>
@endsection
