<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('homepage');
});
Route::get('/forums', [Routing::class, 'showForums']);
Route::get('/guides', [Routing::class, 'showGuides']);
Route::get('/forums/create', [Routing::class, 'showCreatePost'])->name('forums.create');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
