// Quiz Data - Specific questions for each quiz type
const quizData = {
    'love-language': {
        title: 'Love Language Quiz',
        questions: [
            { text: 'Saya merasa paling dicintai ketika pasangan menghabiskan waktu berkualitas bersama saya', category: 'quality-time' },
            { text: 'Kata-kata pujian dan afirmasi dari pasangan sangat berarti bagi saya', category: 'words' },
            { text: 'Sentuhan fisik seperti pelukan atau pegangan tangan membuat saya merasa terhubung', category: 'physical' },
            { text: 'Hadiah dari pasangan, meskipun kecil, membuat saya merasa istimewa', category: 'gifts' },
            { text: 'Saya merasa dicintai ketika pasangan membantu saya dengan pekerjaan atau tugas', category: 'service' },
            { text: 'Waktu berdua tanpa gangguan lebih penting daripada hal lainnya', category: 'quality-time' },
            { text: 'Saya suka mendengar "Aku mencintaimu" dan kata-kata manis lainnya', category: 'words' },
            { text: 'Kedekatan fisik membuat saya merasa aman dalam hubungan', category: 'physical' },
            { text: 'Saya sangat menghargai hadiah yang thoughtful dan bermakna', category: 'gifts' },
            { text: 'Tindakan kecil seperti membuatkan kopi menunjukkan kasih sayang', category: 'service' }
        ],
        results: {
            'quality-time': {
                title: 'Quality Time',
                icon: 'QT',
                description: 'Love language utama kamu adalah Quality Time. Kamu merasa paling dicintai ketika seseorang memberikan perhatian penuh dan menghabiskan waktu berkualitas bersamamu.'
            },
            'words': {
                title: 'Words of Affirmation',
                icon: 'WA',
                description: 'Love language utama kamu adalah Words of Affirmation. Kata-kata pujian, dorongan, dan afirmasi sangat berarti dan membuat kamu merasa dicintai.'
            },
            'physical': {
                title: 'Physical Touch',
                icon: 'PT',
                description: 'Love language utama kamu adalah Physical Touch. Sentuhan fisik seperti pelukan, pegangan tangan, dan kedekatan membuat kamu merasa terhubung dan dicintai.'
            },
            'gifts': {
                title: 'Receiving Gifts',
                icon: 'RG',
                description: 'Love language utama kamu adalah Receiving Gifts. Hadiah yang thoughtful dan bermakna membuat kamu merasa diperhatikan dan dicintai.'
            },
            'service': {
                title: 'Acts of Service',
                icon: 'AoS',
                description: 'Love language utama kamu adalah Acts of Service. Tindakan membantu dan melakukan sesuatu untukmu menunjukkan kasih sayang yang nyata.'
            }
        }
    },
    'communication': {
        title: 'Communication Style',
        questions: [
            { text: 'Ketika ada masalah, saya langsung mengatakannya dengan terus terang', category: 'assertive' },
            { text: 'Saya sering menghindari konflik dan lebih memilih diam', category: 'passive' },
            { text: 'Ketika marah, saya cenderung menyindir atau berbicara dengan nada sarkastik', category: 'passive-aggressive' },
            { text: 'Saya sering memaksakan pendapat saya tanpa mendengar orang lain', category: 'aggressive' },
            { text: 'Saya bisa mengekspresikan perasaan dengan jelas tanpa menyerang orang lain', category: 'assertive' },
            { text: 'Saya sering mengalah meskipun sebenarnya tidak setuju', category: 'passive' },
            { text: 'Saya sulit mengekspresikan kekesalan secara langsung', category: 'passive-aggressive' },
            { text: 'Saya cenderung mengkritik dan menyalahkan orang lain saat ada masalah', category: 'aggressive' },
            { text: 'Saya bisa mendengarkan perspektif orang lain dengan empati', category: 'assertive' },
            { text: 'Saya lebih suka menghindari pembicaraan yang uncomfortable', category: 'passive' }
        ],
        results: {
            'assertive': {
                title: 'Assertive Communicator',
                icon: 'AC',
                description: 'Kamu adalah komunikator yang asertif! Kamu bisa mengekspresikan perasaan dan kebutuhan dengan jelas, sambil tetap menghormati orang lain. Ini adalah gaya komunikasi yang paling sehat.'
            },
            'passive': {
                title: 'Passive Communicator',
                icon: 'PC',
                description: 'Kamu cenderung pasif dalam komunikasi. Kamu sering menghindari konflik dan menyembunyikan perasaan. Cobalah untuk lebih berani mengekspresikan kebutuhan dan pendapatmu.'
            },
            'passive-aggressive': {
                title: 'Passive-Aggressive Communicator',
                icon: 'PA',
                description: 'Kamu menunjukkan gaya komunikasi pasif-agresif. Kamu kesulitan mengekspresikan kekesalan secara langsung. Latih diri untuk lebih terbuka dan honest tentang perasaanmu.'
            },
            'aggressive': {
                title: 'Aggressive Communicator',
                icon: 'AG',
                description: 'Kamu cenderung agresif dalam komunikasi. Kamu tegas tapi kadang terlalu dominan. Cobalah untuk lebih mendengarkan dan mempertimbangkan perasaan orang lain.'
            }
        }
    },
    'attachment': {
        title: 'Attachment Style',
        questions: [
            { text: 'Saya merasa nyaman dengan keintiman emosional dalam hubungan', category: 'secure' },
            { text: 'Saya sering khawatir pasangan tidak benar-benar mencintai saya', category: 'anxious' },
            { text: 'Saya merasa tidak nyaman ketika orang lain terlalu dekat secara emosional', category: 'avoidant' },
            { text: 'Saya mudah percaya pada orang lain dalam hubungan', category: 'secure' },
            { text: 'Saya butuh banyak reassurance dari pasangan bahwa saya dicintai', category: 'anxious' },
            { text: 'Saya lebih suka menjaga jarak emosional untuk melindungi diri', category: 'avoidant' },
            { text: 'Saya tidak takut untuk vulnerable dengan orang yang saya percaya', category: 'secure' },
            { text: 'Saya sering cemas ketika pasangan tidak segera membalas pesan', category: 'anxious' },
            { text: 'Saya merasa terbebani ketika orang lain bergantung pada saya', category: 'avoidant' },
            { text: 'Saya bisa memberi dan menerima cinta dengan seimbang', category: 'secure' },
            { text: 'Saya takut ditinggalkan atau diabaikan oleh orang yang saya sayangi', category: 'anxious' },
            { text: 'Saya lebih nyaman menyelesaikan masalah sendiri daripada meminta bantuan', category: 'avoidant' }
        ],
        results: {
            'secure': {
                title: 'Secure Attachment',
                icon: 'SA',
                description: 'Kamu memiliki secure attachment style! Kamu nyaman dengan keintiman, percaya pada orang lain, dan bisa memberikan dan menerima cinta dengan sehat. Pertahankan pola ini!'
            },
            'anxious': {
                title: 'Anxious Attachment',
                icon: 'AnA',
                description: 'Kamu menunjukkan anxious attachment style. Kamu sangat peduli dengan hubungan tapi sering merasa cemas dan butuh reassurance. Focus pada membangun self-worth dan trust.'
            },
            'avoidant': {
                title: 'Avoidant Attachment',
                icon: 'AvA',
                description: 'Kamu cenderung memiliki avoidant attachment style. Kamu menghargai kemandirian tapi kadang kesulitan dengan keintiman emosional. Cobalah untuk lebih terbuka dan vulnerable.'
            }
        }
    },
    'conflict': {
        title: 'Conflict Resolution',
        questions: [
            { text: 'Ketika ada konflik, saya mencoba memahami perspektif kedua belah pihak', category: 'collaborative' },
            { text: 'Saya cenderung mengalah untuk menghindari pertengkaran', category: 'accommodating' },
            { text: 'Saya lebih suka menghindari konflik dan pura-pura tidak ada masalah', category: 'avoiding' },
            { text: 'Ketika berargumen, saya fokus untuk "menang" dalam diskusi', category: 'competing' },
            { text: 'Saya mencari solusi win-win yang memuaskan semua pihak', category: 'collaborative' },
            { text: 'Saya sering mengorbankan kebutuhan saya demi kebahagiaan orang lain', category: 'accommodating' },
            { text: 'Saya butuh waktu untuk cool down sebelum membahas masalah', category: 'avoiding' },
            { text: 'Saya percaya pendapat saya yang paling benar dalam konflik', category: 'competing' },
            { text: 'Saya terbuka untuk kompromi dan mencari jalan tengah', category: 'collaborative' },
            { text: 'Harmony dalam hubungan lebih penting daripada memperjuangkan keinginan saya', category: 'accommodating' }
        ],
        results: {
            'collaborative': {
                title: 'Collaborative Problem Solver',
                icon: 'CP',
                description: 'Kamu adalah collaborative problem solver! Kamu mencari solusi win-win dan mempertimbangkan kebutuhan semua pihak. Ini adalah cara paling sehat untuk mengatasi konflik.'
            },
            'accommodating': {
                title: 'Accommodating Peacemaker',
                icon: 'AP',
                description: 'Kamu cenderung accommodating dalam konflik. Kamu menghargai harmony tapi sering mengorbankan kebutuhanmu sendiri. Ingat bahwa kebutuhanmu juga penting dan valid.'
            },
            'avoiding': {
                title: 'Conflict Avoider',
                icon: 'CA',
                description: 'Kamu cenderung menghindari konflik. Ini mungkin terasa aman jangka pendek, tapi masalah yang tidak diselesaikan bisa menumpuk. Cobalah untuk lebih proaktif dalam mengatasi isu.'
            },
            'competing': {
                title: 'Competitive Debater',
                icon: 'CD',
                description: 'Kamu kompetitif dalam konflik dan fokus untuk menang. Kamu tegas tapi perlu ingat bahwa hubungan bukan tentang siapa yang benar. Dengarkan juga sudut pandang orang lain.'
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
        `Pertanyaan ${currentQuestionIndex + 1} dari ${totalQuestions}`;
    
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
        document.getElementById('next-btn').textContent = 'Lihat Hasil →';
    } else {
        document.getElementById('next-btn').textContent = 'Selanjutnya →';
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
            <h3>Skor Total: ${totalScore} dari ${currentQuestions.length * 5}</h3>
            <div class="score-bar">
                <div class="score-fill" style="width: ${(totalScore / (currentQuestions.length * 5)) * 100}%"></div>
            </div>
        </div>
        
        <div class="category-breakdown">
            <h3>Breakdown Skor per Kategori:</h3>
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
            <h3>Rekomendasi untuk Kamu:</h3>
            <ul>
                <li>Pelajari lebih dalam tentang ${result.title} dan bagaimana ini mempengaruhi hubunganmu</li>
                <li>Komunikasikan hasil quiz ini dengan pasangan atau orang terdekat untuk saling memahami</li>
                <li>Gunakan pemahaman ini untuk membangun hubungan yang lebih sehat</li>
                <li>Ingat bahwa tidak ada hasil yang "salah" - setiap orang unik!</li>
            </ul>
        </div>
    `;
    
    document.getElementById('result-details').innerHTML = detailsHTML;
}

// Exit Quiz
function exitQuiz() {
    if (confirm('Apakah kamu yakin ingin keluar? Progress kamu akan hilang.')) {
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
