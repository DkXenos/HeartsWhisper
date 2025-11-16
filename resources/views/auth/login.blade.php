@extends('layouts.app')

@section('title', 'Login - Hearts Whisper')

@section('styles')
    @vite(['resources/css/auth.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/login/loginbg.svg') }}" alt="Login Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <img src="{{ asset('asset/homepage/pillar-left.svg') }}" alt="" class="pillar-left">
    <img src="{{ asset('asset/homepage/pillar-right.svg') }}" alt="" class="pillar-right">

    <div class="auth-container">
        <img src="asset/login/loginformbg2.svg" alt="login form bg" class="loginformbg">
        <div class="auth-header">
            <h2>Welcome Back</h2>
            <p>Login to continue sharing your stories</p>
        </div>

        <form class="auth-form" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-form-group">
                <label for="email" class="auth-form-label">Email Address</label>
                <input 
                    id="email" 
                    type="email" 
                    class="auth-form-input @error('email') is-invalid @enderror" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="Enter your email"
                    required 
                    autocomplete="email" 
                    autofocus
                >
                @error('email')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password" class="auth-form-label">Password</label>
                <input 
                    id="password" 
                    type="password" 
                    class="auth-form-input @error('password') is-invalid @enderror" 
                    name="password" 
                    placeholder="Enter your password"
                    required 
                    autocomplete="current-password"
                >
                @error('password')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-actions">
                <button type="submit" class="auth-btn-submit">Login</button>
            </div>

            <div class="auth-footer">
                <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
            </div>
        </form>
    </div>
@endsection

