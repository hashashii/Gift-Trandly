@extends('layouts.site')

@section('title', 'Contact | Gift Trandly')

@section('meta_description', 'Contact Gift Trandly for questions, product suggestions, corrections, feedback or collaboration enquiries.')

@section('content')

    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6">

        {{-- Heading --}}
        <h1 class="font-script text-5xl text-blush-500">
            Say hello
        </h1>

        <p class="mt-3 text-sm leading-6 text-gray-600">
            Brand collaborations, product suggestions or a correction — send it over
            and we'll reply within a few days.
        </p>


        {{-- Success Message --}}
        @if (session('contact_success'))

            <div class="mt-6 rounded-xl border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">

                {{ session('contact_success') }}

            </div>

        @endif


        {{-- Validation Errors --}}
        @if ($errors->any())

            <div class="mt-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

                <p class="font-semibold">
                    Please check the following:
                </p>

                <ul class="mt-2 list-disc space-y-1 pl-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Contact Form --}}
        <form
            method="POST"
            action="{{ route('contact.store') }}"
            class="mt-8 space-y-5"
        >

            @csrf


            {{-- Name --}}
            <div>

                <label class="label" for="c-name">
                    Your name
                </label>

                <input
                    id="c-name"
                    name="name"
                    type="text"
                    class="field"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    maxlength="100"
                    required
                >

            </div>


            {{-- Email --}}
            <div>

                <label class="label" for="c-email">
                    Email
                </label>

                <input
                    id="c-email"
                    name="email"
                    type="email"
                    class="field"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    maxlength="255"
                    required
                >

            </div>


            {{-- Message --}}
            <div>

                <label class="label" for="c-message">
                    Message
                </label>

                <textarea
                    id="c-message"
                    name="message"
                    rows="6"
                    class="field"
                    maxlength="5000"
                    required
                >{{ old('message') }}</textarea>

            </div>


            {{-- Submit --}}
            <button
                type="submit"
                class="btn-pink"
            >
                Send message
            </button>

        </form>

    </div>

@endsection