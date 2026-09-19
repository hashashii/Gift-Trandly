<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        Subscriber::firstOrCreate(
            ['email' => $data['email']],
            ['source' => $request->input('source', 'sidebar')]
        );

        return back()->with('subscribed', "You're on the list. Look out for our next gift roundup.");
    }
}
