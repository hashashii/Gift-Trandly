<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Shared by every page on the public site: the nav and the sidebar.
        View::composer(['layouts.site', 'partials.sidebar'], function ($view) {
            $view->with([
                'navCategories' => Category::orderBy('name')->take(4)->get(),
                'popularPosts'  => Post::published()
                    ->where('is_popular', true)
                    ->latest('published_at')
                    ->take(4)
                    ->get(),
            ]);
        });
    }
}
