(function () {
    'use strict';

    // Register GSAP plugins
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
    }

    // ==============================================
    // HERO SECTION ANIMATIONS
    // ==============================================
    function initHeroAnimations() {
        if (typeof gsap === 'undefined') return;

        const hero = document.querySelector('.hero-section');
        if (!hero) return;

        // Hero content animation
        const heroTimeline = gsap.timeline({ defaults: { ease: 'power3.out' } });

        heroTimeline
            .from('.hero-section h1', {
                y: 100,
                opacity: 0,
                duration: 1.2,
                delay: 0.3
            })
            .from('.hero-section p', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.6')
            .from('.hero-cta', {
                y: 30,
                opacity: 0,
                duration: 0.8,
                stagger: 0.2
            }, '-=0.4')
            .from('.hero-scroll-indicator', {
                opacity: 0,
                duration: 0.6
            }, '-=0.3');

        // Parallax effect for hero background
        gsap.to('.hero-section', {
            backgroundPosition: '50% 100%',
            ease: 'none',
            scrollTrigger: {
                trigger: '.hero-section',
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });
    }

    // ==============================================
    // HIGHLIGHTS SECTION ANIMATIONS
    // ==============================================
    function initHighlightsAnimations() {
        if (typeof gsap === 'undefined') return;

        const highlights = document.querySelectorAll('.highlight-item');
        if (!highlights.length) return;

        gsap.from(highlights, {
            y: 50,
            opacity: 0,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: '.highlights-section',
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });

        // Hover animations
        highlights.forEach(item => {
            item.addEventListener('mouseenter', function () {
                gsap.to(this, {
                    scale: 1.05,
                    y: -10,
                    duration: 0.3,
                    ease: 'power2.out'
                });
                gsap.to(this.querySelector('.highlight-icon'), {
                    rotation: 360,
                    duration: 0.5,
                    ease: 'power2.inOut'
                });
            });

            item.addEventListener('mouseleave', function () {
                gsap.to(this, {
                    scale: 1,
                    y: 0,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });
    }

    // ==============================================
    // ABOUT SECTION ANIMATIONS
    // ==============================================
    function initAboutAnimations() {
        if (typeof gsap === 'undefined') return;

        const aboutSection = document.querySelector('.about-section');
        if (!aboutSection) return;

        const timeline = gsap.timeline({
            scrollTrigger: {
                trigger: aboutSection,
                start: 'top 70%',
                toggleActions: 'play none none none'
            }
        });

        timeline
            .from('.about-label', {
                y: 30,
                opacity: 0,
                duration: 0.6
            })
            .from('.about-title', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.3')
            .from('.about-text p', {
                y: 30,
                opacity: 0,
                duration: 0.6,
                stagger: 0.2
            }, '-=0.4')
            .from('.about-cta', {
                y: 20,
                opacity: 0,
                duration: 0.6
            }, '-=0.2')
            .from('.about-image', {
                x: 100,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            }, '-=1');

        // Image parallax
        gsap.to('.about-image img:not(.no-parallax)', {
            y: -50,
            ease: 'none',
            scrollTrigger: {
                trigger: '.about-section',
                start: 'top bottom',
                end: 'bottom top',
                scrub: true
            }
        });
    }

    // ==============================================
    // ROOMS SECTION ANIMATIONS
    // ==============================================
    function initRoomsAnimations() {
        if (typeof gsap === 'undefined') return;

        const roomCards = document.querySelectorAll('.room-card');
        if (!roomCards.length) return;

        roomCards.forEach((card, index) => {
            gsap.from(card, {
                y: 80,
                opacity: 0,
                duration: 0.8,
                delay: index * 0.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: card,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            });

            // Hover effect
            card.addEventListener('mouseenter', function () {
                gsap.to(this, {
                    y: -15,
                    boxShadow: '0 30px 60px rgba(0, 0, 0, 0.2)',
                    duration: 0.4,
                    ease: 'power2.out'
                });
                gsap.to(this.querySelector('img'), {
                    scale: 1.1,
                    duration: 0.6,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function () {
                gsap.to(this, {
                    y: 0,
                    boxShadow: '0 10px 30px rgba(0, 0, 0, 0.1)',
                    duration: 0.4,
                    ease: 'power2.out'
                });
                gsap.to(this.querySelector('img'), {
                    scale: 1,
                    duration: 0.6,
                    ease: 'power2.out'
                });
            });
        });
    }

    // ==============================================
    // GALLERY SECTION ANIMATIONS
    // ==============================================
    function initGalleryAnimations() {
        if (typeof gsap === 'undefined') return;

        const galleryItems = document.querySelectorAll('.gallery-item');
        if (!galleryItems.length) return;

        // Hover effects
        galleryItems.forEach(item => {
            const img = item.querySelector('img');

            item.addEventListener('mouseenter', function () {
                gsap.to(item, {
                    y: -8,
                    duration: 0.4,
                    ease: 'power2.out'
                });
                gsap.to(img, {
                    scale: 1.15,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            });

            item.addEventListener('mouseleave', function () {
                gsap.to(item, {
                    y: 0,
                    duration: 0.4,
                    ease: 'power2.out'
                });
                gsap.to(img, {
                    scale: 1,
                    duration: 0.5,
                    ease: 'power2.out'
                });
            });
        });
    }

    // ==============================================
    // LOCATION SECTION ANIMATIONS
    // ==============================================
    function initLocationAnimations() {
        if (typeof gsap === 'undefined') return;

        const locationSection = document.querySelector('.location-section');
        if (!locationSection) return;

        const timeline = gsap.timeline({
            scrollTrigger: {
                trigger: locationSection,
                start: 'top 70%',
                toggleActions: 'play none none none'
            }
        });

        timeline
            .from('.location-label', {
                y: 30,
                opacity: 0,
                duration: 0.6
            })
            .from('.location-title', {
                y: 50,
                opacity: 0,
                duration: 0.8
            }, '-=0.3')
            .from('.location-text', {
                y: 30,
                opacity: 0,
                duration: 0.6
            }, '-=0.4')
            .from('.location-distance-item', {
                x: -50,
                opacity: 0,
                duration: 0.5,
                stagger: 0.15
            }, '-=0.3')
            .from('.location-map', {
                x: 100,
                opacity: 0,
                duration: 1,
                ease: 'power3.out'
            }, '-=0.8');
    }

    // ==============================================
    // REVIEWS SECTION ANIMATIONS
    // ==============================================
    function initReviewsAnimations() {
        if (typeof gsap === 'undefined') return;

        const reviewCards = document.querySelectorAll('.review-card');
        if (!reviewCards.length) return;

        gsap.from(reviewCards, {
            y: 60,
            opacity: 0,
            duration: 0.8,
            stagger: 0.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.reviews-grid',
                start: 'top 75%',
                toggleActions: 'play none none none'
            }
        });

        // Hover effects
        reviewCards.forEach(card => {
            card.addEventListener('mouseenter', function () {
                gsap.to(this, {
                    y: -10,
                    boxShadow: '0 20px 40px rgba(0, 0, 0, 0.15)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            card.addEventListener('mouseleave', function () {
                gsap.to(this, {
                    y: 0,
                    boxShadow: '0 4px 12px rgba(0, 0, 0, 0.08)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });

        // Animate stars on scroll
        const stars = document.querySelectorAll('.review-stars i');
        stars.forEach((star, index) => {
            gsap.from(star, {
                scale: 0,
                rotation: 180,
                duration: 0.5,
                delay: index * 0.05,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: star.closest('.review-card'),
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                }
            });
        });
    }

    // ==============================================
    // FINAL CTA SECTION ANIMATIONS
    // ==============================================
    function initFinalCTAAnimations() {
        if (typeof gsap === 'undefined') return;

        const ctaSection = document.querySelector('.final-cta-section');
        if (!ctaSection) return;

        const timeline = gsap.timeline({
            scrollTrigger: {
                trigger: ctaSection,
                start: 'top 70%',
                toggleActions: 'play none none none'
            }
        });

        timeline
            .from('.final-cta-title', {
                y: 50,
                opacity: 0,
                duration: 0.8
            })
            .from('.final-cta-text', {
                y: 30,
                opacity: 0,
                duration: 0.6
            }, '-=0.4')
            .from('.final-cta-primary', {
                scale: 0.8,
                opacity: 0,
                duration: 0.6,
                ease: 'back.out(1.7)'
            }, '-=0.2')
            .from('.final-cta-secondary', {
                scale: 0.8,
                opacity: 0,
                duration: 0.6,
                ease: 'back.out(1.7)'
            }, '-=0.4');
    }

    // ==============================================
    // INTERSECTION OBSERVER FOR SIMPLE ANIMATIONS
    // ==============================================
    function initIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        // Observe elements with animation classes
        const animatedElements = document.querySelectorAll(
            '.fade-in-up, .slide-in-left, .slide-in-right, .zoom-in, .rotate-in, .stagger-item'
        );

        animatedElements.forEach(el => observer.observe(el));
    }

    // ==============================================
    // SCROLL PROGRESS INDICATOR
    // ==============================================
    function initScrollProgress() {
        if (typeof gsap === 'undefined') return;

        // Create progress bar if it doesn't exist
        let progressBar = document.querySelector('.scroll-progress');
        if (!progressBar) {
            progressBar = document.createElement('div');
            progressBar.className = 'scroll-progress';
            progressBar.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 3px;
                background: linear-gradient(90deg, #d4af37, #f4e5b5);
                z-index: 9999;
                transition: width 0.1s ease;
            `;
            document.body.appendChild(progressBar);
        }

        // Update progress on scroll
        window.addEventListener('scroll', () => {
            const windowHeight = document.documentElement.scrollHeight - window.innerHeight;
            const scrolled = (window.scrollY / windowHeight) * 100;
            progressBar.style.width = scrolled + '%';
        });
    }

    // ==============================================
    // SMOOTH REVEAL ON SCROLL
    // ==============================================
    function initSmoothReveal() {
        const reveals = document.querySelectorAll('.reveal');

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });

        reveals.forEach(reveal => revealObserver.observe(reveal));
    }

    // ==============================================
    // CURSOR FOLLOW EFFECT (DESKTOP ONLY)
    // ==============================================
    function initCursorEffect() {
        if (window.innerWidth < 1024) return; // Skip on mobile/tablet

        const cursor = document.createElement('div');
        cursor.className = 'custom-cursor';
        cursor.style.cssText = `
            position: fixed;
            width: 20px;
            height: 20px;
            border: 2px solid #d4af37;
            border-radius: 50%;
            pointer-events: none;
            z-index: 9999;
            transition: transform 0.2s ease;
            display: none;
        `;
        document.body.appendChild(cursor);

        let mouseX = 0, mouseY = 0;
        let cursorX = 0, cursorY = 0;

        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            cursor.style.display = 'block';
        });

        function animateCursor() {
            cursorX += (mouseX - cursorX) * 0.1;
            cursorY += (mouseY - cursorY) * 0.1;

            cursor.style.left = cursorX - 10 + 'px';
            cursor.style.top = cursorY - 10 + 'px';

            requestAnimationFrame(animateCursor);
        }
        animateCursor();

        // Scale cursor on hover
        const hoverElements = document.querySelectorAll('a, button, .hover-scale');
        hoverElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
                cursor.style.borderColor = '#f4e5b5';
            });
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursor.style.borderColor = '#d4af37';
            });
        });
    }

    // ==============================================
    // INITIALIZE ALL ANIMATIONS
    // ==============================================
    function initAllAnimations() {
        initHeroAnimations();
        initHighlightsAnimations();
        initAboutAnimations();
        initRoomsAnimations();
        initGalleryAnimations();
        initLocationAnimations();
        initReviewsAnimations();
        initFinalCTAAnimations();
        initIntersectionObserver();
        initScrollProgress();
        initSmoothReveal();
        initCursorEffect();

        // Refresh ScrollTrigger after all animations are set
        if (typeof ScrollTrigger !== 'undefined') {
            ScrollTrigger.refresh();
        }
    }

    // ==============================================
    // INITIALIZATION
    // ==============================================
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initAllAnimations);
    } else {
        initAllAnimations();
    }

    // Refresh on window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            if (typeof ScrollTrigger !== 'undefined') {
                ScrollTrigger.refresh();
            }
        }, 250);
    });

})();
