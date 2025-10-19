@extends('layouts.app')

@section('title', 'Register - Hearts Whisper')

@section('content')
    <img src="{{ asset('asset/login/loginbg.svg') }}" alt="Register Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <img src="{{ asset('asset/homepage/pillar-left.svg') }}" alt="" class="pillar-left">
    <img src="{{ asset('asset/homepage/pillar-right.svg') }}" alt="" class="pillar-right">

    <div class="auth-container">
        <img src="asset/login/registerbg.svg" alt="register bg" class="registerbg">
        

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
                <label class="auth-form-label">Choose Your Gender</label>
                <div class="gender-selection">
                    <input type="radio" id="gender-girl" name="gender" value="girl" {{ old('gender') == 'girl' ? 'checked' : '' }} required hidden>
                    <label for="gender-girl" class="gender-option" data-gender="girl">
                        <img src="{{ asset('asset/forums/girl.svg') }}" alt="Girl" class="gender-avatar">
                        <span class="gender-label">Girl</span>
                    </label>
                    
                    <input type="radio" id="gender-boi" name="gender" value="boi" {{ old('gender') == 'boi' ? 'checked' : '' }} required hidden>
                    <label for="gender-boi" class="gender-option" data-gender="boi">
                        <img src="{{ asset('asset/forums/boi.svg') }}" alt="Boy" class="gender-avatar">
                        <span class="gender-label">Boy</span>
                    </label>
                </div>
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
