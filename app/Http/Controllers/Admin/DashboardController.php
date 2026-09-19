<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\GiftItem;
use App\Models\Post;
use App\Models\Subscriber;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts'       => Post::count(),
            'published'   => Post::where('status', 'published')->count(),
            'drafts'      => Post::where('status', 'draft')->count(),
            'gifts'       => GiftItem::count(),
            'categories'  => Category::count(),
            'subscribers' => Subscriber::where('is_active', true)->count(),
            'views'       => Post::sum('views'),
        ];

        $recent = Post::with('category')->latest()->take(6)->get();
        $topPosts = Post::orderByDesc('views')->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recent', 'topPosts'));
    }
}
