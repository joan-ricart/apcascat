<?php

use App\Http\Controllers\AssociateController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', HomeController::class)->name('home');

Route::prefix('noticies')->group(function () {
    Route::get('', [PostController::class, 'index'])->name('posts.index');
    Route::get('{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('categoria/{postCategory}', [PostController::class, 'category'])->name('posts.categories.show');
});

Route::prefix('perits')->group(function () {
    Route::get('', [AssociateController::class, 'index'])->name('associates.index');
    Route::get('{associate}', [AssociateController::class, 'show'])->name('associates.show');
});
