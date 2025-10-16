<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Routing;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('homepage');
});
Route::get('/forums', [Routing::class, 'showForums']);
Route::get('/forums', [Routing::class, 'showGuides']);



