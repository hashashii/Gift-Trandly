<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featured = Post::published()->with(['gifts', 'category'])
            ->where('is_featured', true)
            ->latest('published_at')
            ->first()
            ?? Post::published()->with(['gifts', 'category'])->latest('published_at')->first();

        $latest = Post::published()
            ->when($featured, fn ($q) => $q->whereKeyNot($featured->id))
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('site.home', compact('featured', 'latest'));
    }

    public function show(Post $post)
    {
        abort_unless($post->status === 'published', 404);

        $post->increment('views');
        $post->load(['gifts', 'category', 'author']);

        $related = Post::published()
            ->where('category_id', $post->category_id)
            ->whereKeyNot($post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('site.post', compact('post', 'related'));
    }

    public function category(Category $category)
    {
        $posts = Post::published()
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(9);

        return view('site.category', compact('category', 'posts'));
    }

    public function trending()
    {
        $posts = Post::published()->orderByDesc('views')->paginate(9);

        return view('site.category', [
            'category' => new Category(['name' => 'Trending', 'slug' => 'trending']),
            'posts'    => $posts,
        ]);
    }

    public function search(Request $request)
    {
        $term = trim((string) $request->input('q'));

        $posts = Post::published()
            ->when($term !== '', function ($q) use ($term) {
                $q->where(function ($q) use ($term) {
                    $q->where('title', 'like', "%{$term}%")
                      ->orWhere('excerpt', 'like', "%{$term}%")
                      ->orWhere('body', 'like', "%{$term}%");
                });
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('site.search', compact('posts', 'term'));
    }

    public function about()
    {
        return view('site.about');
    }

    public function contact()
    {
        return view('site.contact');
    }
}
