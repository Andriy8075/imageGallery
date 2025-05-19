<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureImageOwner;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;

Route::get('/', [ImageController::class, 'index']);

Route::get('/dashboard', [ImageController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/images', [ImageController::class, 'index'])->name('images');
Route::get('/images/load-more', [ImageController::class, 'loadMoreAny'])->name('images.load-more');
Route::get('/images/search', [ImageController::class, 'search'])->name('images.search');
Route::get('/images/load-more-search', [ImageController::class, 'loadMoreSearch'])->name('images.load-more-search');
Route::middleware('auth')->group(function () {
    Route::get('/images/uploaded', [ImageController::class, 'uploaded'])->name('images.uploaded');
    Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');
    Route::post('/images/create', [ImageController::class, 'store'])->name('images.store');
    Route::get('/images/liked', [ImageController::class, 'liked'])->name('images.liked');
    Route::post('/images/{image}/like', [ImageController::class, 'like'])->name('images.like');
    Route::get('/images/load-more-uploaded', [ImageController::class, 'loadMoreUploaded'])->name('images.load-more-uploaded');
    Route::get('/images/load-more-liked', [ImageController::class, 'loadMoreLiked'])->name('images.load-more');
});
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');
Route::middleware(['auth', EnsureImageOwner::class])->group(function () {
    Route::get('/images/{image}/edit', [ImageController::class, 'edit'])->name('images.edit');
    Route::patch('/images/{image}/update', [ImageController::class, 'update'])->name('images.update');
    Route::delete('/images/{image}/destroy', [ImageController::class, 'destroy'])->name('images.destroy');
});

Route::post('/comments/{imageId}', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::get('/comments/load-more', [CommentController::class, 'loadMore'])->name('comments.load-more');
Route::middleware(['auth', EnsureImageOwner::class])->group(function () {
    Route::post('/comments/{comment}/update', [CommentController::class, 'update'])->name('comments.update');
    Route::post('/comments/{comment}/destroy', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/alpine-test', function () {
    return view('alpine-test');
});

require __DIR__.'/auth.php';
