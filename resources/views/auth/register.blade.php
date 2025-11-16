@extends('layouts.app')

@section('title', 'Register - Hearts Whisper')

@section('styles')
    @vite(['resources/css/auth.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('Asset/login/registerbg.svg') }}" alt="Register Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="auth-container">
        <div class="auth-form-wrapper">
            <img src="{{ asset('Asset/login/loginformbg2.svg') }}" alt="Form Background" class="form-background">
            
            <div class="auth-form-content">
                <h2 class="auth-title">Create Account</h2>

                <form method="POST" action="{{ route('register') }}" class="auth-form">
                    @csrf

                    <!-- Username -->
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" 
                               required autofocus autocomplete="username" class="form-input">
                        @error('username')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" 
                               required autocomplete="email" class="form-input">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Gender -->
                    <div class="form-group">
                        <label for="gender" class="form-label">Gender</label>
                        <select id="gender" name="gender" class="form-input">
                            <option value="">Select Gender (Optional)</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" type="password" name="password" 
                               required autocomplete="new-password" class="form-input">
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                               required autocomplete="new-password" class="form-input">
                        @error('password_confirmation')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            Register
                        </button>
                        
                        <div class="auth-links">
                            <a href="{{ route('login') }}" class="auth-link">
                                Already have an account? Login
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

