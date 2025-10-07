<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;

Route::get('/', [Routing::class, 'homepage'])->name('home');

// quick test route
Route::get('/welcome', function () { return view('welcome'); });

// Additional pages
Route::get('/about', [Routing::class, 'about'])->name('about');
Route::get('/forum', [Routing::class, 'forum'])->name('forum');
Route::get('/dashboard', [Routing::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [Routing::class, 'profile'])->name('profile');
