@extends('layouts.app')

@section('title', 'Register - Hearts Whisper')

@section('content')
    <img src="{{ asset('asset/login/loginbg.svg') }}" alt="Register Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <img src="{{ asset('asset/homepage/pillar-left.svg') }}" alt="" class="pillar-left">
    <img src="{{ asset('asset/homepage/pillar-right.svg') }}" alt="" class="pillar-right">

    <div class="auth-container">
        <a href="{{ route('login') }}" class="auth-back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="width: 20px; height: 20px;">
                <path fill-rule="evenodd" d="M11.03 3.97a.75.75 0 0 1 0 1.06l-6.22 6.22H21a.75.75 0 0 1 0 1.5H4.81l6.22 6.22a.75.75 0 1 1-1.06 1.06l-7.5-7.5a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
            </svg>
            Back to Login
        </a>

        <div class="auth-header">
            <h2>Create Account</h2>
            <p>Join our community and share your stories</p>
        </div>

        <form class="auth-form" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="auth-form-group">
                <label for="name" class="auth-form-label">Username</label>
                <input 
                    id="name" 
                    type="text" 
                    class="auth-form-input @error('name') is-invalid @enderror" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="Choose a username"
                    required 
                    autocomplete="name" 
                    autofocus
                >
                @error('name')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

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
                >
                @error('email')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="gender" class="auth-form-label">Gender</label>
                <select 
                    id="gender" 
                    class="auth-form-select @error('gender') is-invalid @enderror" 
                    name="gender" 
                    required
                >
                    <option value="">Select your gender</option>
                    <option value="girl" {{ old('gender') == 'girl' ? 'selected' : '' }}>Girl</option>
                    <option value="boi" {{ old('gender') == 'boi' ? 'selected' : '' }}>Boy</option>
                </select>
                @error('gender')
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
                    placeholder="Create a password"
                    required 
                    autocomplete="new-password"
                >
                @error('password')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-form-group">
                <label for="password-confirm" class="auth-form-label">Confirm Password</label>
                <input 
                    id="password-confirm" 
                    type="password" 
                    class="auth-form-input" 
                    name="password_confirmation" 
                    placeholder="Confirm your password"
                    required 
                    autocomplete="new-password"
                >
            </div>

            <div class="auth-form-actions">
                <button type="submit" class="auth-btn-submit">Create Account</button>
            </div>

            <div class="auth-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
            </div>
        </form>
    </div>
@endsection
