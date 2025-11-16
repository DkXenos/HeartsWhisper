@extends('layouts.app')

@section('title', 'Login - Hearts Whisper')

@section('styles')
    @vite(['resources/css/auth.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('Asset/login/loginbg.svg') }}" alt="Login Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="auth-container">
        <div class="auth-form-wrapper">
            <img src="{{ asset('Asset/login/loginformbg2.svg') }}" alt="Form Background" class="form-background">
            
            <div class="auth-form-content">
                <h2 class="auth-title">Welcome Back</h2>
                
                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="auth-form">
                    @csrf

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               required autofocus autocomplete="username" class="form-input">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" 
                               required autocomplete="current-password" class="form-input">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-group-checkbox">
                        <label for="remember_me" class="checkbox-label">
                            <input id="remember_me" type="checkbox" name="remember" class="form-checkbox">
                            <span>Remember me</span>
                        </label>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            Log in
                        </button>
                        
                        <div class="auth-links">
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="auth-link">
                                    Forgot your password?
                                </a>
                            @endif
                            <a href="{{ route('register') }}" class="auth-link">
                                Don't have an account? Register
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

