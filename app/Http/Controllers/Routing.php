<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Routing extends Controller
{
	/**
	 * Show the homepage skeleton.
	 */
	public function homepage()
	{
		return view('homepage');
	}

	/**
	 * About page
	 */
	public function about()
	{
		return view('about');
	}

	/**
	 * Forum index
	 */
	public function forum()
	{
		return view('forum');
	}

	/**
	 * User dashboard
	 */
	public function dashboard()
	{
		return view('dashboard');
	}

	/**
	 * Profile
	 */
	public function profile()
	{
		return view('profile');
	}
}
