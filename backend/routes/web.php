<?php

use App\Http\Controllers\Admin\AiController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('spa');
});

Route::get('/artikel', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/kategori/{slug}', [ArticleController::class, 'category'])->name('categories.show');
Route::get('/tag/{slug}', [ArticleController::class, 'tag'])->name('tags.show');
Route::get('/sitemap.xml', [ArticleController::class, 'sitemap'])->name('sitemap');

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('tags', TagController::class);
    Route::get('media', [MediaController::class, 'index'])->name('media.index');
    Route::post('media', [MediaController::class, 'store'])->name('media.store');
    Route::post('media/ckeditor', [MediaController::class, 'ckeditor'])->name('media.ckeditor');
    Route::get('media/json', [MediaController::class, 'json'])->name('media.json');
    Route::delete('media/{mediaItem}', [MediaController::class, 'destroy'])->name('media.destroy');

    Route::post('ai/generate', [AiController::class, 'generate'])->middleware('throttle:20,1')->name('ai.generate');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::view('/{any}', 'spa')->where('any', '^(?!admin|artikel|kategori|tag|login|logout|forgot-password|reset-password|verify-email|profile).*$');
