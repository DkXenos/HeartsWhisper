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

        <form class="create-post-form" method="POST" action="{{ route('forums.store') }}" enctype="multipart/form-data">
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
                <label for="image" class="create-form-label">Add Image (Optional) Max 500Kb</label>
                <div class="image-upload-container">
                    <input type="file" id="image" name="image" accept="image/*" class="image-input">
                    <div class="image-preview" id="imagePreview" style="display: none;">
                        <img id="previewImg" src="" alt="Preview">
                        <button type="button" class="remove-image-btn" onclick="removeImage()">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 20px; height: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                @error('image')
                    <span class="error-message">{{ $message }}</span>
                @enderror
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

    <style>
        .image-upload-container {
            margin-top: 0.5rem;
        }

        .image-input {
            display: block;
            width: 100%;
            padding: 0.75rem;
            border: 2px dashed #ffc4d6;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .image-input:hover {
            border-color: #ff69b4;
            background: #fff5f7;
        }

        .image-preview {
            margin-top: 1rem;
            position: relative;
            max-width: 500px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.2);
        }

        .image-preview img {
            width: 100%;
            height: auto;
            display: block;
        }

        .remove-image-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(255, 107, 107, 0.9);
            color: white;
            border: none;
            border-radius: 50%;
            width: 35px;
            height: 35px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .remove-image-btn:hover {
            background: #ff1744;
            transform: scale(1.1);
        }
    </style>

    <script>
        // Character counter
        const textarea = document.getElementById('content');
        const currentCount = document.querySelector('.create-current-count');
        
        textarea.addEventListener('input', function() {
            currentCount.textContent = this.value.length;
        });

        // Image preview
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');

        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        function removeImage() {
            imageInput.value = '';
            imagePreview.style.display = 'none';
            previewImg.src = '';
        }
    </script>
@endsection
