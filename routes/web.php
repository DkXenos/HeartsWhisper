<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('homepage');
});
Route::get('/forums', [Routing::class, 'showForums'])->name('forums.index');
Route::get('/forums/create', [Routing::class, 'showCreatePost'])->name('forums.create');
Route::get('/forums/{post}', [Routing::class, 'showPost'])->name('forums.show');
Route::get('/guides', [Routing::class, 'showGuides']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
