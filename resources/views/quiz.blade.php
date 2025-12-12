@extends('layouts.app')

@section('title', 'Relationship Quiz - Hearts Whisper')

@section('styles')
    @vite(['resources/css/quiz.css', 'resources/css/navbar.css', 'resources/css/fonts.css'])
@endsection

@section('content')
    <img src="{{ asset('Asset/Homepage/mainbg.svg') }}" alt="Quiz Background"
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">
    
    <img src="{{ asset('Asset/Components/Navbar/ribbonnew.svg') }}" alt="Hearts Whisper Logo" class="ribbon">

    {{-- Quiz Selection Page --}}
    <section id="quiz-selection" class="quiz-selection-section">
        <div class="quiz-main-container">
            <img src="{{ asset('Asset/Homepage/pillar-left.svg') }}" alt="" class="pillar-left">
            <img src="{{ asset('Asset/Homepage/pillar-right.svg') }}" alt="" class="pillar-right">
            
            <div class="quiz-header">
                <h1 class="quiz-title">Discover Your Relationship Style</h1>
                <p class="quiz-subtitle">Choose a quiz to learn more about yourself and your relationships</p>
            </div>

            <div class="quiz-list-container">
                {{-- Quiz 1: Love Language --}}
                <div class="quiz-list-item" onclick="startQuiz('love-language')">
                    <div class="quiz-list-icon">💕</div>
                    <div class="quiz-list-content">
                        <h3 class="quiz-list-title">Your Language of Love</h3>
                        <p class="quiz-list-description">Discover how you give and receive affection in relationships.</p>
                        <div class="quiz-list-meta">
                            <span>⏱️ 5 minutes</span>
                            <span>📋 10 questions</span>
                        </div>
                    </div>
                    <div class="quiz-list-arrow">→</div>
                </div>

                {{-- Quiz 2: Communication Style --}}
                <div class="quiz-list-item" onclick="startQuiz('communication')">
                    <div class="quiz-list-icon">💬</div>
                    <div class="quiz-list-content">
                        <h3 class="quiz-list-title">How You Express Yourself</h3>
                        <p class="quiz-list-description">Recognize your communication style in expressing thoughts and feelings.</p>
                        <div class="quiz-list-meta">
                            <span>⏱️ 5 minutes</span>
                            <span>📋 10 questions</span>
                        </div>
                    </div>
                    <div class="quiz-list-arrow">→</div>
                </div>

                {{-- Quiz 3: Attachment Style --}}
                <div class="quiz-list-item" onclick="startQuiz('attachment')">
                    <div class="quiz-list-icon">🤝</div>
                    <div class="quiz-list-content">
                        <h3 class="quiz-list-title">Your Bonding Pattern</h3>
                        <p class="quiz-list-description">Learn about your emotional attachment patterns in relationships.</p>
                        <div class="quiz-list-meta">
                            <span>⏱️ 6 minutes</span>
                            <span>📋 12 questions</span>
                        </div>
                    </div>
                    <div class="quiz-list-arrow">→</div>
                </div>

                {{-- Quiz 4: Conflict Resolution --}}
                <div class="quiz-list-item" onclick="startQuiz('conflict')">
                    <div class="quiz-list-icon">🕊️</div>
                    <div class="quiz-list-content">
                        <h3 class="quiz-list-title">Your Conflict Navigator</h3>
                        <p class="quiz-list-description">Discover how you handle conflicts and challenges in relationships.</p>
                        <div class="quiz-list-meta">
                            <span>⏱️ 5 minutes</span>
                            <span>📋 10 questions</span>
                        </div>
                    </div>
                    <div class="quiz-list-arrow">→</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Quiz Taking Page --}}
    <section id="quiz-taking" class="quiz-taking-section" style="display: none;">
        <div class="quiz-main-container">
            <img src="{{ asset('Asset/Homepage/pillar-left.svg') }}" alt="" class="pillar-left">
            <img src="{{ asset('Asset/Homepage/pillar-right.svg') }}" alt="" class="pillar-right">
            
            <div class="quiz-progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            
            <div class="quiz-content">
                <div class="quiz-question-header">
                    <span id="question-number">Question 1 of 10</span>
                    <button onclick="exitQuiz()" class="exit-quiz-btn">✕ Exit</button>
                </div>
                
                <h2 class="quiz-question-text" id="question-text">
                    Loading question...
                </h2>
                
                <div class="quiz-options">
                    <div class="option-scale">
                        <span class="scale-label-left">Strongly Disagree</span>
                        <div class="scale-buttons">
                            <button class="scale-btn" data-value="1" onclick="selectAnswer(1)">1</button>
                            <button class="scale-btn" data-value="2" onclick="selectAnswer(2)">2</button>
                            <button class="scale-btn" data-value="3" onclick="selectAnswer(3)">3</button>
                            <button class="scale-btn" data-value="4" onclick="selectAnswer(4)">4</button>
                            <button class="scale-btn" data-value="5" onclick="selectAnswer(5)">5</button>
                        </div>
                        <span class="scale-label-right">Strongly Agree</span>
                    </div>
                </div>
                
                <div class="quiz-navigation">
                    <button id="prev-btn" onclick="previousQuestion()" class="nav-btn" disabled>
                        ← Previous
                    </button>
                    <button id="next-btn" onclick="nextQuestion()" class="nav-btn nav-btn-primary" disabled>
                        Next →
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Quiz Result Page --}}
    <section id="quiz-result" class="quiz-result-section" style="display: none;">
        <div class="quiz-main-container">
            <img src="{{ asset('Asset/Homepage/pillar-left.svg') }}" alt="" class="pillar-left">
            <img src="{{ asset('Asset/Homepage/pillar-right.svg') }}" alt="" class="pillar-right">
            
            <div class="result-content">
                <div class="result-header">
                    <h1>Your Quiz Results</h1>
                    <div class="result-icon" id="result-icon"></div>
                </div>
                
                <div class="result-card">
                    <h2 id="result-title">Your Result Type</h2>
                    <p id="result-description">Description will appear here...</p>
                    
                    <div class="result-details" id="result-details">
                        <!-- Details will be inserted here -->
                    </div>
                </div>
                
                <div class="result-actions">
                    <button onclick="retakeQuiz()" class="result-btn result-btn-secondary">
                        Retake Quiz
                    </button>
                    <button onclick="backToSelection()" class="result-btn result-btn-primary">
                        Back to Quiz List
                    </button>
                </div>
            </div>
        </div>
    </section>

    @vite(['resources/js/quiz.js'])
@endsection
