@extends('layouts.site')

@section('title', 'Contact | Gift Trandly')

@section('content')
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6">
        <h1 class="font-script text-5xl text-blush-500">Say hello</h1>
        <p class="mt-3 text-sm text-gray-600">
            Brand collaborations, product suggestions or a correction — send it over and we'll reply within a few days.
        </p>

        <form method="POST" action="#" class="mt-8 space-y-4">
            @csrf
            <div>
                <label class="label" for="c-name">Your name</label>
                <input id="c-name" name="name" class="field" required>
            </div>
            <div>
                <label class="label" for="c-email">Email</label>
                <input id="c-email" name="email" type="email" class="field" required>
            </div>
            <div>
                <label class="label" for="c-message">Message</label>
                <textarea id="c-message" name="message" rows="5" class="field" required></textarea>
            </div>
            <button type="submit" class="btn-pink">Send message</button>
        </form>
    </div>
@endsection
