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

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');


