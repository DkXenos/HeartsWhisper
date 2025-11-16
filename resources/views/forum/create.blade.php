@extends('layouts.app')

@section('title', 'Create Post - Hearts Whisper')

@section('styles')
    @vite(['resources/css/create.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('asset/forums/background-forum.svg') }}" alt="Homepage Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <img src="{{ asset('asset/homepage/pillar-left.svg') }}" alt="" class="pillar-left">
    <img src="{{ asset('asset/homepage/pillar-right.svg') }}" alt="" class="pillar-right">

    <div class="create-post-container">
        <div class="create-post-header">
            <h2>Share Your Story</h2>
            <p class="create-post-muted">Whisper us your recent story!</p>
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

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form class="create-post-form" method="POST" action="{{ route('forums.store') }}">
            @csrf

            <div class="create-form-group">
                <label for="content" class="create-form-label">What's on your mind?</label>
                <textarea id="content" name="content" class="create-form-textarea" rows="8"
                    placeholder="Share your thoughts, feelings, or experiences..." required>{{ old('content') }}</textarea>
                @error('content')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <div class="create-character-count">
                    <span class="create-current-count">0</span> / <span class="create-max-count">5000</span> characters
                </div>
            </div>

            <div class="create-form-group">
                <label class="create-form-label">Categories (Optional)</label>
                <div class="create-categories-grid">
                    @foreach ($categories as $category)
                        <label class="create-category-checkbox">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                            <span class="create-category-label">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="create-form-actions">
                <a href="{{ route('forums.index') }}" class="create-btn-cancel">Cancel</a>
                <button type="submit" class="create-btn-submit">Share Post</button>
            </div>
        </form>
    </div>
@endsection
