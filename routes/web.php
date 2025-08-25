<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/', HomeController::class)->name('home');

Route::prefix(__('routes.noticias'))->group(function () {
    Route::get('', [PostController::class, 'index'])->name('posts.index');
    Route::get('{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('categoria/{postCategory}', [PostController::class, 'category'])->name('posts.categories.show');
});
