<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class Routing extends Controller
{
	public function showGuides(){
		return view('guides');
	}
public function showForums(){
    $posts = Post::with(['user', 'categories'])->latest()->paginate(15);
    return view('forum.index', ['posts' => $posts]);
}}
