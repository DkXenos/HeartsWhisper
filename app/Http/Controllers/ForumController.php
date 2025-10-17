<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Menampilkan halaman utama forum.
     */
    public function index()
    {
        // 1. Mengambil data dari database
        $posts = Post::with(['user', 'categories'])->latest()->paginate(15);

        // 2. Mengirim data '$posts' ke dalam view 'forums.index'
        return view('forum.index', [
            'posts' => $posts
        ]);
    }
}