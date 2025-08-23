document.addEventListener('DOMContentLoaded', function() {
    // =============================================
    // Hero Slider
    // =============================================
    function initHeroSlider() {
        const heroSlider = document.querySelector('.hero-slider');
        if (!heroSlider) return;

        const slides = heroSlider.querySelectorAll('.slide');
        const dotsContainer = document.querySelector('.slider-dots');
        const prevBtn = document.querySelector('.slider-prev');
        const nextBtn = document.querySelector('.slider-next');
        let currentIndex = 0;
        let slideInterval;

        // Create dots
        slides.forEach((_, index) => {
            const dot = document.createElement('div');
            dot.classList.add('dot');
            if (index === 0) dot.classList.add('active');
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });

        function goToSlide(index) {
            slides[currentIndex].classList.remove('active');
            dotsContainer.children[currentIndex].classList.remove('active');
            
            currentIndex = (index + slides.length) % slides.length;
            
            slides[currentIndex].classList.add('active');
            dotsContainer.children[currentIndex].classList.add('active');
            resetInterval();
        }

        function nextSlide() {
            goToSlide(currentIndex + 1);
        }

        function prevSlide() {
            goToSlide(currentIndex - 1);
        }

        function startInterval() {
            slideInterval = setInterval(nextSlide, 5000);
        }

        function resetInterval() {
            clearInterval(slideInterval);
            startInterval();
        }

        // Event listeners
        if (nextBtn) nextBtn.addEventListener('click', nextSlide);
        if (prevBtn) prevBtn.addEventListener('click', prevSlide);
        
        const hero = document.querySelector('.wine-hero');
        if (hero) {
            hero.addEventListener('mouseenter', () => clearInterval(slideInterval));
            hero.addEventListener('mouseleave', startInterval);
        }

        startInterval();
    }

    // =============================================
    // Luxury Products Slider (Best Sellers) - IMPROVED
    // =============================================
    function initLuxurySlider() {
        const slider = document.querySelector('.luxury-slider');
        if (!slider) return;

        const slides = slider.querySelectorAll('.product-card');
        const prevBtn = document.querySelector('.prev-btn');
        const nextBtn = document.querySelector('.next-btn');
        const progressBar = document.querySelector('.progress-bar');
        
        if (!slides.length) return;

        let currentIndex = 0;
        let autoSlideInterval;
        let isHovering = false;
        let isAnimating = false;
        const autoSlideSpeed = 5000;
        const isMobile = window.innerWidth <= 768;

        // Calculate slide width dynamically
        function getSlideWidth() {
            const slideStyle = window.getComputedStyle(slides[0]);
            const slideMargin = parseFloat(slideStyle.marginRight) || 32; // Gap between slides
            return slides[0].offsetWidth + slideMargin;
        }

        function updateSlider(smooth = true) {
            const slideWidth = getSlideWidth();
            const maxIndex = Math.max(0, slides.length - (isMobile ? 1 : 3));
            currentIndex = Math.min(Math.max(0, currentIndex), maxIndex);
            
            if (isMobile) {
                // Mobile: use scroll behavior
                const scrollPosition = currentIndex * slideWidth;
                slider.scrollTo({
                    left: scrollPosition,
                    behavior: smooth ? 'smooth' : 'instant'
                });
            } else {
                // Desktop: use transform
                const translateX = -currentIndex * slideWidth;
                slider.style.transform = `translateX(${translateX}px)`;
            }
            
            updateProgressBar();
        }

        function navigate(direction) {
            if (isAnimating) return;
            isAnimating = true;
            
            const maxIndex = Math.max(0, slides.length - (isMobile ? 1 : 3));
            
            if (direction > 0) {
                // Next
                if (currentIndex >= maxIndex) {
                    currentIndex = 0; // Loop back to start
                } else {
                    currentIndex++;
                }
            } else {
                // Previous
                if (currentIndex <= 0) {
                    currentIndex = maxIndex; // Loop to end
                } else {
                    currentIndex--;
                }
            }
            
            updateSlider();
            resetAutoSlide();
            
            // Reset animation flag
            setTimeout(() => {
                isAnimating = false;
            }, 800);
        }

        function startAutoSlide() {
            if (isMobile) return; // Disable auto-slide on mobile
            
            autoSlideInterval = setInterval(() => {
                if (!isHovering && !isAnimating) {
                    navigate(1);
                }
            }, autoSlideSpeed);
            
            updateProgressBar();
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        function updateProgressBar() {
            if (!progressBar || isMobile) return;
            
            progressBar.style.animation = 'none';
            void progressBar.offsetWidth; // Force reflow
            progressBar.style.animation = `slideProgress ${autoSlideSpeed/1000}s linear forwards`;
        }

        // Initialize slider
        function initSlider() {
            if (isMobile) {
                // Mobile configuration
                slider.style.transform = 'none';
                slider.style.overflowX = 'auto';
                slider.style.scrollSnapType = 'x mandatory';
                slider.style.webkitOverflowScrolling = 'touch';
                
                // Hide scrollbar
                slider.style.scrollbarWidth = 'none';
                slider.style.msOverflowStyle = 'none';
                
                slides.forEach(slide => {
                    slide.style.scrollSnapAlign = 'center';
                });
            } else {
                // Desktop configuration
                slider.style.overflowX = 'hidden';
                slider.style.scrollSnapType = 'none';
                slider.style.transition = 'transform 0.8s cubic-bezier(0.16, 1, 0.3, 1)';
                
                slides.forEach(slide => {
                    slide.style.scrollSnapAlign = 'none';
                });
            }
            
            currentIndex = 0;
            updateSlider(false);
        }

        // Event listeners
        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                navigate(-1);
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                navigate(1);
            });
        }

        // Hover events for auto-slide
        slider.addEventListener('mouseenter', () => {
            isHovering = true;
            clearInterval(autoSlideInterval);
        });
        
        slider.addEventListener('mouseleave', () => {
            isHovering = false;
            if (!isMobile) {
                startAutoSlide();
            }
        });

        // Touch/drag support for mobile
        let isDragging = false;
        let startX = 0;
        let scrollLeft = 0;

        slider.addEventListener('touchstart', (e) => {
            isDragging = true;
            startX = e.touches[0].pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        }, { passive: true });

        slider.addEventListener('touchend', () => {
            isDragging = false;
            if (isMobile) {
                // Snap to nearest card
                const slideWidth = getSlideWidth();
                const newIndex = Math.round(slider.scrollLeft / slideWidth);
                currentIndex = Math.min(Math.max(0, newIndex), slides.length - 1);
                updateSlider();
            }
        }, { passive: true });

        slider.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            const x = e.touches[0].pageX - slider.offsetLeft;
            const walk = (x - startX) * 1;
            slider.scrollLeft = scrollLeft - walk;
        }, { passive: true });

        // Initialize
        initSlider();
        if (!isMobile) {
            startAutoSlide();
        }

        // Reinitialize on window resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const wasMobile = isMobile;
                const isNowMobile = window.innerWidth <= 768;
                
                if (wasMobile !== isNowMobile) {
                    location.reload(); // Reload on mobile/desktop switch for clean initialization
                } else {
                    initSlider();
                }
            }, 250);
        });
    }

    // =============================================
    // View Product Button Functionality
    // =============================================
    function initProductButtons() {
        const viewProductBtns = document.querySelectorAll('.view-product-btn');
        
        viewProductBtns.forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const productCard = this.closest('.product-card');
                const productTitle = productCard?.querySelector('.product-title')?.textContent;
                
                // Add loading state
                const originalText = this.textContent;
                this.textContent = 'Chargement...';
                this.disabled = true;
                
                // Simulate navigation (replace with actual navigation)
                setTimeout(() => {
                    // Reset button state
                    this.textContent = originalText;
                    this.disabled = false;
                    
                    // You can replace this with actual navigation logic
                    console.log('Viewing product:', productTitle);
                    // window.location.href = `/product/${productId}`;
                }, 1000);
            });
        });
    }

    // =============================================
    // Testimonials Slider
    // =============================================
    function initTestimonialsSlider() {
        const slider = document.getElementById('testimonialsSlider');
        if (!slider) return;

        const prevBtn = document.getElementById('prevTestimonial');
        const nextBtn = document.getElementById('nextTestimonial');
        const cards = slider.querySelectorAll('.testimonial-card');
        
        if (!cards.length) return;

        let currentIndex = 0;
        let isAnimating = false;
        let autoSlideInterval;
        const isMobile = window.innerWidth < 768;
        const visibleCards = isMobile ? 1 : 3;

        function getCardWidth() {
            const cardStyle = window.getComputedStyle(cards[0]);
            const cardMargin = parseFloat(cardStyle.marginRight) || 32;
            return cards[0].offsetWidth + cardMargin;
        }

        function updateSlider() {
            if (isAnimating) return;
            isAnimating = true;
            
            const maxIndex = Math.max(0, cards.length - visibleCards);
            currentIndex = Math.min(Math.max(0, currentIndex), maxIndex);
            
            const scrollAmount = currentIndex * getCardWidth();
            
            slider.scrollTo({
                left: scrollAmount,
                behavior: 'smooth'
            });

            setTimeout(() => {
                isAnimating = false;
            }, 700);
        }

        function startAutoSlide() {
            if (isMobile) return;
            
            autoSlideInterval = setInterval(() => {
                if (isAnimating) return;
                
                const maxIndex = Math.max(0, cards.length - visibleCards);
                if (currentIndex >= maxIndex) {
                    currentIndex = 0;
                } else {
                    currentIndex++;
                }
                updateSlider();
            }, 5000);
        }

        function resetAutoSlide() {
            clearInterval(autoSlideInterval);
            startAutoSlide();
        }

        // Navigation
        if (prevBtn) {
            prevBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (isAnimating) return;
                
                const maxIndex = Math.max(0, cards.length - visibleCards);
                if (currentIndex > 0) {
                    currentIndex--;
                } else {
                    currentIndex = maxIndex;
                }
                updateSlider();
                resetAutoSlide();
            });
        }

        if (nextBtn) {
            nextBtn.addEventListener('click', (e) => {
                e.preventDefault();
                if (isAnimating) return;
                
                const maxIndex = Math.max(0, cards.length - visibleCards);
                if (currentIndex < maxIndex) {
                    currentIndex++;
                } else {
                    currentIndex = 0;
                }
                updateSlider();
                resetAutoSlide();
            });
        }

        // Initialize based on screen size
        function initSlider() {
            clearInterval(autoSlideInterval);
            
            if (isMobile) {
                slider.style.scrollSnapType = 'x mandatory';
                cards.forEach(card => {
                    card.style.scrollSnapAlign = 'start';
                    card.style.flex = '0 0 100%';
                });
                
                if (prevBtn) prevBtn.style.display = 'none';
                if (nextBtn) nextBtn.style.display = 'none';
            } else {
                slider.style.scrollSnapType = 'none';
                cards.forEach(card => {
                    card.style.scrollSnapAlign = 'none';
                    card.style.flex = `0 0 calc(${100/visibleCards}% - 32px)`;
                });
                
                if (prevBtn) prevBtn.style.display = 'flex';
                if (nextBtn) nextBtn.style.display = 'flex';
                
                startAutoSlide();
            }
            
            currentIndex = 0;
            slider.scrollTo({ left: 0, behavior: 'instant' });
        }

        initSlider();
        
        // Pause on hover
        slider.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });
        
        slider.addEventListener('mouseleave', () => {
            if (!isMobile) {
                startAutoSlide();
            }
        });
    }

    // =============================================
    // Countdown Timer
    // =============================================
    function initCountdown() {
        const daysEl = document.getElementById('days');
        const hoursEl = document.getElementById('hours');
        const minutesEl = document.getElementById('minutes');
        const secondsEl = document.getElementById('seconds');

        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) return;

        const endDate = new Date();
        endDate.setDate(endDate.getDate() + 7); // 7 days from now

        function updateCountdown() {
            const now = new Date();
            const distance = endDate - now;
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            daysEl.textContent = days.toString().padStart(2, '0');
            hoursEl.textContent = hours.toString().padStart(2, '0');
            minutesEl.textContent = minutes.toString().padStart(2, '0');
            secondsEl.textContent = seconds.toString().padStart(2, '0');
            
            if (distance < 0) {
                clearInterval(countdownTimer);
                const container = document.querySelector(".countdown-container");
                if (container) {
                    container.innerHTML = `<div class="countdown-expired">Offre expirée</div>`;
                }
            }
        }

        updateCountdown();
        const countdownTimer = setInterval(updateCountdown, 1000);
    }

    // =============================================
    // Scroll Animations
    // =============================================
    function initScrollAnimations() {
        const animateElements = document.querySelectorAll('.animate');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(element => {
            observer.observe(element);
        });
    }

    // =============================================
    // Smooth Scroll for Anchor Links
    // =============================================
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    }

    // =============================================
    // Initialize All Components
    // =============================================
    initHeroSlider();
    initLuxurySlider();
    initProductButtons();
    initTestimonialsSlider();
    initCountdown();
    initScrollAnimations();
    initSmoothScroll();

    // =============================================
    // Global Responsive Adjustments
    // =============================================
    window.addEventListener('resize', function() {
        // Debounce resize events
        clearTimeout(window.resizeTimeout);
        window.resizeTimeout = setTimeout(function() {
            // Reinitialize components that need resize handling
            initTestimonialsSlider();
        }, 250);
    });

    // =============================================
    // Performance Optimization
    // =============================================
    
    // Add smooth scrolling CSS if not present
    if (!document.querySelector('style[data-smooth-scroll]')) {
        const style = document.createElement('style');
        style.setAttribute('data-smooth-scroll', 'true');
        style.textContent = `
            .luxury-slider::-webkit-scrollbar {
                display: none;
            }
            
            .luxury-slider {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
            
            @media (max-width: 768px) {
                .luxury-slider {
                    scroll-behavior: smooth;
                }
            }
        `;
        document.head.appendChild(style);
    }
});