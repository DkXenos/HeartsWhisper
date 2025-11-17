@extends('layouts.app')

@section('title', 'Moderator Request - Hearts Whisper')

@section('styles')
    @vite(['resources/css/create.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Forum Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <div class="create-container">
        <h2>Apply to Become a Moderator</h2>
        <p class="muted">Help maintain a positive and respectful community by becoming a moderator.</p>

        <form action="{{ route('moderator.store') }}" method="POST" class="create-form">
            @csrf

            <div class="form-group">
                <label for="reason">Why do you want to become a moderator?</label>
                <textarea name="reason" id="reason" rows="8" 
                    placeholder="Tell us why you'd be a great moderator (minimum 50 characters)..." 
                    required minlength="50" maxlength="500">{{ old('reason') }}</textarea>
                @error('reason')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <p class="char-count">
                    <span id="char-current">0</span> / 500 characters (minimum 50)
                </p>
            </div>

            <div class="form-actions">
                <a href="{{ route('dashboard') }}" class="btn-secondary">Cancel</a>
                <button type="submit" class="btn-primary">Submit Request</button>
            </div>
        </form>
    </div>

    <script>
        const textarea = document.getElementById('reason');
        const charCurrent = document.getElementById('char-current');

        textarea.addEventListener('input', function() {
            charCurrent.textContent = this.value.length;
        });

        // Initialize count if there's old input
        if (textarea.value) {
            charCurrent.textContent = textarea.value.length;
        }
    </script>
@endsection
