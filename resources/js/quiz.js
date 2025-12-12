// Quiz Data - Specific questions for each quiz type
const quizData = {
    'love-language': {
        title: 'Love Language Quiz',
        questions: [
            { text: 'I feel most loved when my partner spends quality time with me', category: 'quality-time' },
            { text: 'Words of praise and affirmation from my partner mean a lot to me', category: 'words' },
            { text: 'Physical touch like hugs or holding hands makes me feel connected', category: 'physical' },
            { text: 'Gifts from my partner, even small ones, make me feel special', category: 'gifts' },
            { text: 'I feel loved when my partner helps me with work or tasks', category: 'service' },
            { text: 'Time together without distractions is more important than anything else', category: 'quality-time' },
            { text: 'I love hearing "I love you" and other sweet words', category: 'words' },
            { text: 'Physical closeness makes me feel safe in a relationship', category: 'physical' },
            { text: 'I deeply appreciate thoughtful and meaningful gifts', category: 'gifts' },
            { text: 'Small acts like making me coffee show love', category: 'service' }
        ],
        results: {
            'quality-time': {
                title: 'Quality Time',
                icon: '⏰',
                description: 'Your primary love language is Quality Time. You feel most loved when someone gives you their full attention and spends quality time with you.'
            },
            'words': {
                title: 'Words of Affirmation',
                icon: '💬',
                description: 'Your primary love language is Words of Affirmation. Words of praise, encouragement, and affirmation mean a lot and make you feel loved.'
            },
            'physical': {
                title: 'Physical Touch',
                icon: '🤗',
                description: 'Your primary love language is Physical Touch. Physical touch like hugs, holding hands, and closeness make you feel connected and loved.'
            },
            'gifts': {
                title: 'Receiving Gifts',
                icon: '🎁',
                description: 'Your primary love language is Receiving Gifts. Thoughtful and meaningful gifts make you feel cared for and loved.'
            },
            'service': {
                title: 'Acts of Service',
                icon: '🤝',
                description: 'Your primary love language is Acts of Service. Helpful actions and doing things for you show real love and affection.'
            }
        }
    },
    'communication': {
        title: 'Communication Style',
        questions: [
            { text: 'When there is a problem, I say it directly and frankly', category: 'assertive' },
            { text: 'I often avoid conflict and prefer to stay silent', category: 'passive' },
            { text: 'When angry, I tend to be sarcastic or speak in a sarcastic tone', category: 'passive-aggressive' },
            { text: 'I often force my opinion without listening to others', category: 'aggressive' },
            { text: 'I can express my feelings clearly without attacking others', category: 'assertive' },
            { text: 'I often give in even though I actually disagree', category: 'passive' },
            { text: 'I have difficulty expressing annoyance directly', category: 'passive-aggressive' },
            { text: 'I tend to criticize and blame others when there is a problem', category: 'aggressive' },
            { text: 'I can listen to other people\'s perspectives with empathy', category: 'assertive' },
            { text: 'I prefer to avoid uncomfortable conversations', category: 'passive' }
        ],
        results: {
            'assertive': {
                title: 'Assertive Communicator',
                icon: '✨',
                description: 'You are an assertive communicator! You can express your feelings and needs clearly while still respecting others. This is the healthiest communication style.'
            },
            'passive': {
                title: 'Passive Communicator',
                icon: '🤐',
                description: 'You tend to be passive in communication. You often avoid conflict and hide your feelings. Try to be braver in expressing your needs and opinions.'
            },
            'passive-aggressive': {
                title: 'Passive-Aggressive Communicator',
                icon: '😤',
                description: 'You show a passive-aggressive communication style. You have difficulty expressing annoyance directly. Train yourself to be more open and honest about your feelings.'
            },
            'aggressive': {
                title: 'Aggressive Communicator',
                icon: '⚡',
                description: 'You tend to be aggressive in communication. You are firm but sometimes too dominant. Try to listen more and consider other people\'s feelings.'
            }
        }
    },
    'attachment': {
        title: 'Attachment Style',
        questions: [
            { text: 'I feel comfortable with emotional intimacy in relationships', category: 'secure' },
            { text: 'I often worry that my partner doesn\'t really love me', category: 'anxious' },
            { text: 'I feel uncomfortable when others get too close emotionally', category: 'avoidant' },
            { text: 'I easily trust others in relationships', category: 'secure' },
            { text: 'I need a lot of reassurance from my partner that I am loved', category: 'anxious' },
            { text: 'I prefer to keep an emotional distance to protect myself', category: 'avoidant' },
            { text: 'I am not afraid to be vulnerable with people I trust', category: 'secure' },
            { text: 'I often feel anxious when my partner doesn\'t reply to messages immediately', category: 'anxious' },
            { text: 'I feel burdened when others depend on me', category: 'avoidant' },
            { text: 'I can give and receive love in a balanced way', category: 'secure' },
            { text: 'I am afraid of being abandoned or ignored by people I care about', category: 'anxious' },
            { text: 'I am more comfortable solving problems alone than asking for help', category: 'avoidant' }
        ],
        results: {
            'secure': {
                title: 'Secure Attachment',
                icon: '💚',
                description: 'You have a secure attachment style! You are comfortable with intimacy, trust others, and can give and receive love in a healthy way. Maintain this pattern!'
            },
            'anxious': {
                title: 'Anxious Attachment',
                icon: '💭',
                description: 'You show an anxious attachment style. You care deeply about relationships but often feel anxious and need reassurance. Focus on building self-worth and trust.'
            },
            'avoidant': {
                title: 'Avoidant Attachment',
                icon: '🛡️',
                description: 'You tend to have an avoidant attachment style. You value independence but sometimes struggle with emotional intimacy. Try to be more open and vulnerable.'
            }
        }
    },
    'conflict': {
        title: 'Conflict Resolution',
        questions: [
            { text: 'When there is a conflict, I try to understand both sides\' perspectives', category: 'collaborative' },
            { text: 'I tend to give in to avoid arguments', category: 'accommodating' },
            { text: 'I prefer to avoid conflict and pretend there is no problem', category: 'avoiding' },
            { text: 'When arguing, I focus on "winning" the discussion', category: 'competing' },
            { text: 'I look for win-win solutions that satisfy all parties', category: 'collaborative' },
            { text: 'I often sacrifice my needs for the happiness of others', category: 'accommodating' },
            { text: 'I need time to cool down before discussing problems', category: 'avoiding' },
            { text: 'I believe my opinion is the most correct in a conflict', category: 'competing' },
            { text: 'I am open to compromise and finding middle ground', category: 'collaborative' },
            { text: 'Harmony in relationships is more important than fighting for my desires', category: 'accommodating' }
        ],
        results: {
            'collaborative': {
                title: 'Collaborative Problem Solver',
                icon: '🤝',
                description: 'You are a collaborative problem solver! You seek win-win solutions and consider the needs of all parties. This is the healthiest way to handle conflict.'
            },
            'accommodating': {
                title: 'Accommodating Peacemaker',
                icon: '🕊️',
                description: 'You tend to be accommodating in conflicts. You value harmony but often sacrifice your own needs. Remember that your needs are also important and valid.'
            },
            'avoiding': {
                title: 'Conflict Avoider',
                icon: '🙈',
                description: 'You tend to avoid conflict. This may feel safe in the short term, but unresolved issues can pile up. Try to be more proactive in addressing issues.'
            },
            'competing': {
                title: 'Competitive Debater',
                icon: '⚔️',
                description: 'You are competitive in conflicts and focus on winning. You are assertive but need to remember that relationships are not about who is right. Also listen to other people\'s perspectives.'
            }
        }
    }
};

// Current quiz state
let currentQuizType = null;
let currentQuestionIndex = 0;
let answers = [];
let currentQuestions = [];

// Start Quiz - Load specific questions for the quiz type
function startQuiz(quizType) {
    currentQuizType = quizType;
    currentQuestionIndex = 0;
    answers = [];
    
    // Get questions for this quiz type
    currentQuestions = quizData[quizType].questions;
    
    // Hide selection, show quiz
    document.getElementById('quiz-selection').style.display = 'none';
    document.getElementById('quiz-taking').style.display = 'block';
    
    // Load first question
    loadQuestion();
}

// Load Question
function loadQuestion() {
    const totalQuestions = currentQuestions.length;
    
    // Update progress bar
    const progress = ((currentQuestionIndex + 1) / totalQuestions) * 100;
    document.getElementById('progress-fill').style.width = progress + '%';
    
    // Update question number
    document.getElementById('question-number').textContent = 
        `Question ${currentQuestionIndex + 1} of ${totalQuestions}`;
    
    // Update question text
    document.getElementById('question-text').textContent = currentQuestions[currentQuestionIndex].text;
    
    // Clear previous selection
    document.querySelectorAll('.scale-btn').forEach(btn => {
        btn.classList.remove('selected');
    });
    
    // If question already answered, show previous answer
    if (answers[currentQuestionIndex] !== undefined) {
        const prevAnswer = answers[currentQuestionIndex];
        document.querySelector(`.scale-btn[data-value="${prevAnswer}"]`).classList.add('selected');
        document.getElementById('next-btn').disabled = false;
    } else {
        document.getElementById('next-btn').disabled = true;
    }
    
    // Update navigation buttons
    document.getElementById('prev-btn').disabled = currentQuestionIndex === 0;
    
    // Update next button text
    if (currentQuestionIndex === totalQuestions - 1) {
        document.getElementById('next-btn').textContent = 'View Results →';
    } else {
        document.getElementById('next-btn').textContent = 'Next →';
    }
}

// Select Answer
function selectAnswer(value) {
    // Save answer
    answers[currentQuestionIndex] = value;
    
    // Update UI
    document.querySelectorAll('.scale-btn').forEach(btn => {
        btn.classList.remove('selected');
    });
    document.querySelector(`.scale-btn[data-value="${value}"]`).classList.add('selected');
    
    // Enable next button
    document.getElementById('next-btn').disabled = false;
}

// Next Question
function nextQuestion() {
    if (currentQuestionIndex < currentQuestions.length - 1) {
        currentQuestionIndex++;
        loadQuestion();
    } else {
        // Quiz finished, show results
        calculateResults();
    }
}

// Previous Question
function previousQuestion() {
    if (currentQuestionIndex > 0) {
        currentQuestionIndex--;
        loadQuestion();
    }
}

// Calculate Results based on category scores
function calculateResults() {
    // Count scores by category
    const categoryScores = {};
    
    currentQuestions.forEach((question, index) => {
        const category = question.category;
        const score = answers[index];
        
        if (!categoryScores[category]) {
            categoryScores[category] = 0;
        }
        categoryScores[category] += score;
    });
    
    // Find the dominant category (highest score)
    let dominantCategory = null;
    let maxScore = 0;
    
    for (const [category, score] of Object.entries(categoryScores)) {
        if (score > maxScore) {
            maxScore = score;
            dominantCategory = category;
        }
    }
    
    // Get result for dominant category
    const result = quizData[currentQuizType].results[dominantCategory];
    const totalScore = answers.reduce((sum, score) => sum + score, 0);
    
    // Show results
    showResults(result, totalScore, categoryScores);
}

// Show Results
function showResults(result, totalScore, categoryScores) {
    // Hide quiz taking, show results
    document.getElementById('quiz-taking').style.display = 'none';
    document.getElementById('quiz-result').style.display = 'block';
    
    // Update result content
    document.getElementById('result-icon').textContent = result.icon;
    document.getElementById('result-title').textContent = result.title;
    document.getElementById('result-description').textContent = result.description;
    
    // Build score breakdown HTML
    let detailsHTML = `
        <div class="result-score">
            <h3>Total Score: ${totalScore} out of ${currentQuestions.length * 5}</h3>
            <div class="score-bar">
                <div class="score-fill" style="width: ${(totalScore / (currentQuestions.length * 5)) * 100}%"></div>
            </div>
        </div>
        
        <div class="category-breakdown">
            <h3>Score Breakdown by Category:</h3>
            <div class="category-scores">
    `;
    
    // Sort categories by score
    const sortedCategories = Object.entries(categoryScores).sort((a, b) => b[1] - a[1]);
    
    sortedCategories.forEach(([category, score]) => {
        const categoryResult = quizData[currentQuizType].results[category];
        const maxPossible = currentQuestions.filter(q => q.category === category).length * 5;
        const percentage = (score / maxPossible) * 100;
        
        detailsHTML += `
            <div class="category-item">
                <div class="category-header">
                    <span class="category-icon">${categoryResult.icon}</span>
                    <span class="category-name">${categoryResult.title}</span>
                    <span class="category-score">${score}/${maxPossible}</span>
                </div>
                <div class="category-bar">
                    <div class="category-fill" style="width: ${percentage}%"></div>
                </div>
            </div>
        `;
    });
    
    detailsHTML += `
            </div>
        </div>
        
        <div class="result-tips">
            <h3>Recommendations for You:</h3>
            <ul>
                <li>Learn more about ${result.title} and how it affects your relationships</li>
                <li>Share these quiz results with your partner or loved ones for mutual understanding</li>
                <li>Use this insight to build healthier relationships</li>
                <li>Remember that there are no "wrong" results - everyone is unique!</li>
            </ul>
        </div>
    `;
    
    document.getElementById('result-details').innerHTML = detailsHTML;
}

// Exit Quiz
function exitQuiz() {
    if (confirm('Are you sure you want to exit? Your progress will be lost.')) {
        backToSelection();
    }
}

// Retake Quiz
function retakeQuiz() {
    currentQuestionIndex = 0;
    answers = [];
    
    document.getElementById('quiz-result').style.display = 'none';
    document.getElementById('quiz-taking').style.display = 'block';
    
    loadQuestion();
}

// Back to Selection
function backToSelection() {
    currentQuestionIndex = 0;
    answers = [];
    
    document.getElementById('quiz-taking').style.display = 'none';
    document.getElementById('quiz-result').style.display = 'none';
    document.getElementById('quiz-selection').style.display = 'block';
}

// Export functions to window object for onclick handlers
window.startQuiz = startQuiz;
window.selectAnswer = selectAnswer;
window.nextQuestion = nextQuestion;
window.previousQuestion = previousQuestion;
window.exitQuiz = exitQuiz;
window.retakeQuiz = retakeQuiz;
window.backToSelection = backToSelection;
