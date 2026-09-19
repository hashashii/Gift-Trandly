<?php

use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GiftItemController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public site
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::redirect('/dashboard', '/admin')->name('dashboard');
Route::get('/trending', [HomeController::class, 'trending'])->name('trending');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');

/*
|--------------------------------------------------------------------------
| Admin panel
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('posts', AdminPostController::class)->except('show');

        Route::prefix('posts/{post}')->name('posts.')->group(function () {
            Route::get('gifts', [GiftItemController::class, 'index'])->name('gifts.index');
            Route::get('gifts/create', [GiftItemController::class, 'create'])->name('gifts.create');
            Route::post('gifts', [GiftItemController::class, 'store'])->name('gifts.store');
            Route::get('gifts/{gift}/edit', [GiftItemController::class, 'edit'])->name('gifts.edit');
            Route::put('gifts/{gift}', [GiftItemController::class, 'update'])->name('gifts.update');
            Route::delete('gifts/{gift}', [GiftItemController::class, 'destroy'])->name('gifts.destroy');
            Route::post('gifts/reorder', [GiftItemController::class, 'reorder'])->name('gifts.reorder');
        });

        Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index');
        Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');
        Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
        Route::put('categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
        Route::get('subscribers/export', [AdminSubscriberController::class, 'export'])->name('subscribers.export');
        Route::delete('subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');
    });

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Catch-all article route — must stay LAST so it never shadows
| /login, /register, /admin, /dashboard, or any other named route above it.
|--------------------------------------------------------------------------
*/
Route::get('/{post}', [HomeController::class, 'show'])->name('post.show');
Route::get('/health', function () {
    return response('OK', 200);
});