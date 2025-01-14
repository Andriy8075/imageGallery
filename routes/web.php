<?php

use App\Http\Controllers\ProfileController;
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
Route::get('/images/load-more', [ImageController::class, 'loadMore'])->name('images.load-more');
Route::get('/images/create', [ImageController::class, 'create'])->middleware('auth')->name('images.create');
Route::post('/images/create', [ImageController::class, 'store'])->middleware('auth')->name('images.store');
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');
Route::middleware('auth')->group(function () {
    Route::get('/images/{image}/edit', [ImageController::class, 'edit'])->name('images.edit');
    Route::patch('/images/{image}/update', [ImageController::class, 'update'])->name('images.update');
});


Route::get('/my-images', [ImageController::class, 'myImages'])->middleware('auth')
    ->name('my-images');
Route::get('/load-more-mine', [ImageController::class, 'loadMoreMine'])->middleware('auth')
    ->name('load-more-mine');

Route::get('/alpine-test', function () {
    return view('alpine-test');
});

require __DIR__.'/auth.php';
