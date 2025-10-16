<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Routing extends Controller
{
	public function showGuides(){
		return view('guides');
	}
	public function showForums(){
		return view('forum');
	}
}
