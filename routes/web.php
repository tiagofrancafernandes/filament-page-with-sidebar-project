<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Posts;
use App\Http\Controllers\ThemeSetController;
use Illuminate\Support\Facades\Redirect;

// Route::get('/', fn () => Redirect::to(route('filament.pages.dashboard')))->name('home');
Route::get('/', fn () => Redirect::to(route('posts.index')))->name('home');

if ($loginPage = config('filament.auth.pages.login')) {
    Route::get('/login', $loginPage)->name('login');
}

Route::get('set-theme/{themeName}', ThemeSetController::class)->name('theme.set');

Route::prefix('/posts')->as('posts.')->group(function () {
    Route::get('/', Posts\IndexController::class)->name('index');
    Route::get('/{post:slug}', Posts\ShowController::class)->name('show');
});
