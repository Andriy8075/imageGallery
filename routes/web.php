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
Route::get('/images/load-more', [ImageController::class, 'loadMore']);
Route::get('/images/{id}', [ImageController::class, 'show'])->name('images.show');
Route::get('/images/create', [ImageController::class, 'create'])->name('images.create');

require __DIR__.'/auth.php';
