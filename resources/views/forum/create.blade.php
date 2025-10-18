@extends('layouts.app')

@section('title', 'Create Post - Hearts Whisper')

@section('content')
    <div class="create-post-container">
        <div class="create-post-header">
            <h2>Share Your Story</h2>
            <p class="create-post-muted">Express yourself and connect with the community</p>
        </div>

        <form class="create-post-form">
            @csrf

            <div class="create-form-group">
                <label for="content" class="create-form-label">What's on your mind?</label>
                <textarea id="content" name="content" class="create-form-textarea" rows="8"
                    placeholder="Share your thoughts, feelings, or experiences..." required></textarea>
                <div class="create-character-count">
                    <span class="create-current-count">0</span> / <span class="create-max-count">5000</span> characters
                </div>
            </div>

            <div class="create-form-group">
                <label class="create-form-label">Categories</label>
                <div class="create-categories-grid">
                    @foreach ($categories as $category)
                        <label class="create-category-checkbox">
                            <input type="checkbox" name="categories[]" value="{{ $category->id }}">
                            <span class="create-category-label">{{ $category->name }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="create-form-group">
                <label class="create-form-label create-anonymous-label">
                    <input type="checkbox" name="anonymous" value="1" class="create-anonymous-checkbox">
                    Post anonymously
                </label>
            </div>

            <div class="create-form-actions">
                <a href="{{ url('/forums') }}" class="create-btn-cancel">Cancel</a>
                <button type="submit" class="create-btn-submit">Share Post</button>
            </div>
        </form>
    </div>
@endsection
