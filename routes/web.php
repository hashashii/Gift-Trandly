<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GiftItemController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::redirect('/dashboard', '/admin')->name('dashboard');

Route::get('/trending', [HomeController::class, 'trending'])
    ->name('trending');

Route::get('/search', [HomeController::class, 'search'])
    ->name('search');

Route::get('/about', [HomeController::class, 'about'])
    ->name('about');

Route::get('/contact', [HomeController::class, 'contact'])
    ->name('contact');

Route::post('/subscribe', [SubscriberController::class, 'store'])
    ->name('subscribe');

Route::get('/category/{category}', [HomeController::class, 'category'])
    ->name('category');


/*
|--------------------------------------------------------------------------
| XML Sitemap
|--------------------------------------------------------------------------
|
| Automatically includes all published posts.
| This route MUST stay above the catch-all /{post} route.
|
*/

Route::get('/sitemap.xml', function () {

    $posts = Post::published()
        ->orderByDesc('published_at')
        ->get();

    return response()
        ->view('sitemap', compact('posts'))
        ->header('Content-Type', 'application/xml; charset=UTF-8');

})->name('sitemap');


/*
|--------------------------------------------------------------------------
| Health Check
|--------------------------------------------------------------------------
|
| Keep this above the catch-all /{post} route.
|
*/

Route::get('/health', function () {
    return response('OK', 200);
})->name('health');


/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Posts
        |--------------------------------------------------------------------------
        */

        Route::resource('posts', AdminPostController::class)
            ->except('show');


        /*
        |--------------------------------------------------------------------------
        | Gift Items
        |--------------------------------------------------------------------------
        */

        Route::prefix('posts/{post}')
            ->name('posts.')
            ->group(function () {

                Route::get('gifts', [GiftItemController::class, 'index'])
                    ->name('gifts.index');

                Route::get('gifts/create', [GiftItemController::class, 'create'])
                    ->name('gifts.create');

                Route::post('gifts', [GiftItemController::class, 'store'])
                    ->name('gifts.store');

                Route::get('gifts/{gift}/edit', [GiftItemController::class, 'edit'])
                    ->name('gifts.edit');

                Route::put('gifts/{gift}', [GiftItemController::class, 'update'])
                    ->name('gifts.update');

                Route::delete('gifts/{gift}', [GiftItemController::class, 'destroy'])
                    ->name('gifts.destroy');

                Route::post('gifts/reorder', [GiftItemController::class, 'reorder'])
                    ->name('gifts.reorder');
            });


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::get('categories', [AdminCategoryController::class, 'index'])
            ->name('categories.index');

        Route::post('categories', [AdminCategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('categories/{category}', [AdminCategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('categories/{category}', [AdminCategoryController::class, 'destroy'])
            ->name('categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | Subscribers
        |--------------------------------------------------------------------------
        */

        Route::get('subscribers', [AdminSubscriberController::class, 'index'])
            ->name('subscribers.index');

        Route::get('subscribers/export', [AdminSubscriberController::class, 'export'])
            ->name('subscribers.export');

        Route::delete('subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])
            ->name('subscribers.destroy');
    });


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';


/*
|--------------------------------------------------------------------------
| Catch-all Article Route
|--------------------------------------------------------------------------
|
| IMPORTANT:
| This MUST remain the final route in this file.
|
| Example:
| /halloween-nail-ideas
|
| Post model uses the slug as its route key.
|
*/

Route::get('/{post}', [HomeController::class, 'show'])
    ->name('post.show');