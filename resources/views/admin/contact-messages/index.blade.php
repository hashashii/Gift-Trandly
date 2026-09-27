@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('heading', 'Contact Messages')

@section('content')

    @if ($messages->isEmpty())

        <div class="rounded-2xl border border-blush-100 bg-white px-6 py-12 text-center">
            <p class="text-sm font-medium text-gray-700">No messages yet.</p>
            <p class="mt-1 text-xs text-gray-500">
                Messages sent through the contact form will appear here.
            </p>
        </div>

    @else

        <div class="overflow-hidden rounded-2xl border border-blush-100 bg-white">

            <div class="border-b border-blush-100 px-5 py-4">
                <p class="text-sm font-semibold text-gray-800">
                    Inbox
                </p>

                <p class="mt-1 text-xs text-gray-500">
                    {{ $messages->total() }}
                    {{ $messages->total() === 1 ? 'message' : 'messages' }}
                </p>
            </div>

            <div class="divide-y divide-blush-50">

                @foreach ($messages as $message)

                    <article class="p-5 sm:p-6">

                        <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">

                            <div>

                                <h2 class="text-sm font-semibold text-gray-900">
                                    {{ $message->name }}
                                </h2>

                                <a
                                    href="mailto:{{ $message->email }}"
                                    class="mt-1 inline-block text-xs text-blush-600 hover:underline"
                                >
                                    {{ $message->email }}
                                </a>

                            </div>

                            <time
                                datetime="{{ $message->created_at->toIso8601String() }}"
                                class="text-xs text-gray-400"
                            >
                                {{ $message->created_at->format('M j, Y · g:i A') }}
                            </time>

                        </div>

                        <div class="mt-4 rounded-xl bg-gray-50 px-4 py-3">

                            <p class="whitespace-pre-line text-sm leading-6 text-gray-600">{{ $message->message }}</p>

                        </div>

                        <div class="mt-4">

                            <a
                                href="mailto:{{ $message->email }}"
                                class="text-xs font-medium text-blush-600 hover:underline"
                            >
                                Reply by email →
                            </a>

                        </div>

                    </article>

                @endforeach

            </div>

        </div>

        <div class="mt-5">
            {{ $messages->links() }}
        </div>

    @endif

@endsection