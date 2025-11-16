<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/guides', function () {
    return view('guides');
})->name('guides');

// Forum routes
Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');
Route::get('/forums/create', function () {
    $categories = \App\Models\Category::all();
    return view('forum.create', ['categories' => $categories]);
})->middleware('auth')->name('forums.create');
Route::post('/forums', [ForumController::class, 'store'])->middleware('auth')->name('forums.store');
Route::get('/forums/{id}', [ForumController::class, 'show'])->name('forums.show');

Route::get('/dashboard', function () {
    $user = auth()->user();
    $posts = \App\Models\Post::where('user_id', $user->id)
        ->withCount('replies')
        ->with(['user', 'categories'])
        ->latest()
        ->paginate(10);
    
    $repliesCount = \App\Models\Reply::where('user_id', $user->id)->count();
    $totalLikes = \App\Models\Post::where('user_id', $user->id)->sum('likes_count');
    
    return view('dashboard', [
        'posts' => $posts,
        'repliesCount' => $repliesCount,
        'totalLikes' => $totalLikes
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
