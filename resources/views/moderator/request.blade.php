@extends('layouts.app')

@section('title', 'Moderator Request - Hearts Whisper')

@section('styles')
    @vite(['resources/css/create.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Forum Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <img src="{{ asset('asset/homepage/pillar-left.svg') }}" alt="" class="pillar-left">
    <img src="{{ asset('asset/homepage/pillar-right.svg') }}" alt="" class="pillar-right">

    <div class="create-post-container">
        <div class="create-post-header">
            <h2>Apply to Become a Moderator</h2>
            <p class="create-post-muted">Help maintain a positive and respectful community by becoming a moderator.</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('moderator.store') }}" method="POST" class="create-post-form">
            @csrf

            <div class="create-form-group">
                <label for="reason" class="create-form-label">Why do you want to become a moderator?</label>
                <textarea name="reason" id="reason" class="create-form-textarea" rows="8" 
                    placeholder="Tell us why you'd be a great moderator (minimum 50 characters)..." 
                    required minlength="50" maxlength="500">{{ old('reason') }}</textarea>
                @error('reason')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <div class="create-character-count">
                    <span class="create-current-count" id="char-current">0</span> / <span class="create-max-count">500</span> characters (minimum 50)
                </div>
            </div>

            <div class="create-form-actions">
                <a href="{{ route('dashboard') }}" class="create-btn-cancel">Cancel</a>
                <button type="submit" class="create-btn-submit">Submit Request</button>
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
