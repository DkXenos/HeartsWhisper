@extends('layouts.app')

@section('title', 'Guides - Hearts Whisper')

@section('styles')
    @vite(['resources/css/guides.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('Asset/Guide/guidebg.svg') }}" alt="Guide Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">

    <img src="{{ asset('Asset/Homepage/pillar-left.svg') }}" alt="" class="pillar-left">
    <img src="{{ asset('Asset/Homepage/pillar-right.svg') }}" alt="" class="pillar-right">

    <div class="guides-container">
        <div class="guides-header">
            <h2>Love & Life Guides</h2>
            <p>Expert advice to help you navigate relationships and personal growth</p>
        </div>

        <div id="guide-slideshow" class="guide-slideshow">
            <div class="slide-content">
                <div class="slide-image-container">
                    <img id="slide-image" class="slide-image" src="" alt="Guide Image">
                </div>
                
                <div class="slide-info">
                    <span id="slide-category" class="slide-category">Category</span>
                    <h3 id="slide-title" class="slide-title">Guide Title</h3>
                    <p id="slide-description" class="slide-description">Guide description goes here.</p>
                    
                    <a id="video-button" href="#" target="_blank" rel="noopener noreferrer" class="video-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.5 5.653c0-1.427 1.529-2.33 2.779-1.643l11.54 6.347c1.295.712 1.295 2.573 0 3.286L7.28 19.99c-1.25.687-2.779-.217-2.779-1.643V5.653Z" clip-rule="evenodd" />
                        </svg>
                        Watch Video Guide
                    </a>
                </div>
            </div>

            <div class="slide-controls">
                <div class="slide-nav-buttons">
                    <button id="prev-slide" class="slide-nav-btn" aria-label="Previous slide">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.72 12.53a.75.75 0 0 1 0-1.06l7.5-7.5a.75.75 0 1 1 1.06 1.06L9.31 12l6.97 6.97a.75.75 0 1 1-1.06 1.06l-7.5-7.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button id="next-slide" class="slide-nav-btn" aria-label="Next slide">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd" d="M16.28 11.47a.75.75 0 0 1 0 1.06l-7.5 7.5a.75.75 0 0 1-1.06-1.06L14.69 12 7.72 5.03a.75.75 0 0 1 1.06-1.06l7.5 7.5Z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                
                <div id="slide-dots" class="slide-dots"></div>
            </div>
        </div>
    </div>
@endsection
