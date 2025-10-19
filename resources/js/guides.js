import { getAllGuides } from './lib/guidesData.js';

/**
 * Guide Slideshow functionality
 */
class GuideSlideshow {
    constructor() {
        this.guides = getAllGuides();
        this.currentIndex = 0;
        this.slideshow = null;
        this.slideImage = null;
        this.slideTitle = null;
        this.slideDescription = null;
        this.slideCategory = null;
        this.videoButton = null;
        this.prevButton = null;
        this.nextButton = null;
        this.dotsContainer = null;
    }

    init() {
        // Get DOM elements
        this.slideshow = document.getElementById('guide-slideshow');
        if (!this.slideshow) return;

        this.slideImage = document.getElementById('slide-image');
        this.slideTitle = document.getElementById('slide-title');
        this.slideDescription = document.getElementById('slide-description');
        this.slideCategory = document.getElementById('slide-category');
        this.videoButton = document.getElementById('video-button');
        this.prevButton = document.getElementById('prev-slide');
        this.nextButton = document.getElementById('next-slide');
        this.dotsContainer = document.getElementById('slide-dots');

        // Initialize slideshow
        this.createDots();
        this.showSlide(0);
        this.attachEventListeners();
        
        // Auto-advance slideshow every 5 seconds
        this.startAutoPlay();
    }

    createDots() {
        if (!this.dotsContainer) return;
        
        this.dotsContainer.innerHTML = '';
        this.guides.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.classList.add('slide-dot');
            dot.setAttribute('data-slide', index);
            dot.addEventListener('click', () => this.goToSlide(index));
            this.dotsContainer.appendChild(dot);
        });
    }

    showSlide(index) {
        // Wrap around if out of bounds
        if (index >= this.guides.length) {
            this.currentIndex = 0;
        } else if (index < 0) {
            this.currentIndex = this.guides.length - 1;
        } else {
            this.currentIndex = index;
        }

        const guide = this.guides[this.currentIndex];

        // Update content instantly without animation
        if (this.slideImage) this.slideImage.src = guide.image;
        if (this.slideTitle) this.slideTitle.textContent = guide.title;
        if (this.slideDescription) this.slideDescription.textContent = guide.description;
        if (this.slideCategory) this.slideCategory.textContent = guide.category;
        if (this.videoButton) this.videoButton.href = guide.videoUrl;

        // Update dots
        const dots = this.dotsContainer.querySelectorAll('.slide-dot');
        dots.forEach((dot, idx) => {
            if (idx === this.currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    nextSlide() {
        this.showSlide(this.currentIndex + 1);
        this.resetAutoPlay();
    }

    prevSlide() {
        this.showSlide(this.currentIndex - 1);
        this.resetAutoPlay();
    }

    goToSlide(index) {
        this.showSlide(index);
        this.resetAutoPlay();
    }

    attachEventListeners() {
        if (this.prevButton) {
            this.prevButton.addEventListener('click', () => this.prevSlide());
        }
        if (this.nextButton) {
            this.nextButton.addEventListener('click', () => this.nextSlide());
        }

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prevSlide();
            if (e.key === 'ArrowRight') this.nextSlide();
        });
    }

    startAutoPlay() {
        this.autoPlayInterval = setInterval(() => {
            this.nextSlide();
        }, 5000);
    }

    resetAutoPlay() {
        clearInterval(this.autoPlayInterval);
        this.startAutoPlay();
    }

    destroy() {
        clearInterval(this.autoPlayInterval);
    }
}

// Initialize slideshow when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const slideshow = new GuideSlideshow();
    slideshow.init();
});

export default GuideSlideshow;
