// Navbar Scroll Animation and Section Highlighting
(function () {
    'use strict';

    // Cache DOM elements
    const nav = document.getElementById('main-nav');
    const navLinks = document.querySelectorAll('.nav-link');
    const mobileMenuBtn = document.querySelector('.nav-mobile-btn');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const mobileMenuLinks = document.querySelectorAll('.mobile-menu-link');

    // Sections to track
    const sections = [
        { id: 'home', element: document.querySelector('.hero-section'), name: 'Home' },
        { id: 'rooms', element: document.querySelector('.rooms-section'), name: 'Rooms' },
        { id: 'gallery', element: document.querySelector('.gallery-section'), name: 'Gallery' },
        { id: 'location', element: document.querySelector('.location-section'), name: 'Location' },
        { id: 'booking', element: document.querySelector('.booking-section'), name: 'Contact' }
    ];

    // State
    let isScrolling = false;
    let currentSection = 'home';

    /**
     * Handle navbar background on scroll
     */
    function handleNavbarScroll() {
        if (window.scrollY > 100) {
            nav.classList.add('nav-scrolled');
        } else {
            nav.classList.remove('nav-scrolled');
        }
    }

    /**
     * Get current section based on scroll position
     */
    function getCurrentSection() {
        const scrollPosition = window.scrollY + window.innerHeight / 3;

        for (let i = sections.length - 1; i >= 0; i--) {
            const section = sections[i];
            if (section.element) {
                const sectionTop = section.element.offsetTop;
                if (scrollPosition >= sectionTop) {
                    return section.id;
                }
            }
        }

        return 'home';
    }

    /**
     * Update active nav link
     */
    function updateActiveNavLink(sectionId) {
        if (currentSection === sectionId) return;

        currentSection = sectionId;

        // Update desktop nav links
        navLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');

            // Check if link matches current section
            if (sectionId === 'home' && href === '#') {
                link.classList.add('active');
            } else if (href === `#${sectionId}`) {
                link.classList.add('active');
            } else if (sectionId === 'booking' && href === '#contact') {
                link.classList.add('active');
            }
        });

        // Update mobile menu links
        mobileMenuLinks.forEach(link => {
            link.classList.remove('active');
            const href = link.getAttribute('href');

            if (sectionId === 'home' && href === '#') {
                link.classList.add('active');
            } else if (href === `#${sectionId}`) {
                link.classList.add('active');
            } else if (sectionId === 'booking' && href === '#contact') {
                link.classList.add('active');
            }
        });
    }

    /**
     * Handle scroll events
     */
    function handleScroll() {
        if (isScrolling) return;

        isScrolling = true;

        requestAnimationFrame(() => {
            handleNavbarScroll();
            const section = getCurrentSection();
            updateActiveNavLink(section);
            isScrolling = false;
        });
    }

    /**
     * Smooth scroll to section
     */
    function smoothScrollTo(target) {
        const element = target === '#' || target === '#home'
            ? document.querySelector('.hero-section')
            : document.querySelector(target);

        if (element) {
            const offsetTop = element.offsetTop;
            const navHeight = nav.offsetHeight;

            window.scrollTo({
                top: target === '#' || target === '#home' ? 0 : offsetTop - navHeight,
                behavior: 'smooth'
            });
        }
    }

    /**
     * Handle nav link clicks
     */
    function handleNavLinkClick(e) {
        e.preventDefault();
        const target = this.getAttribute('href');

        // Close mobile menu if open
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            closeMobileMenu();
        }

        smoothScrollTo(target);

        // Update active state immediately
        const sectionId = target === '#' ? 'home' : target.replace('#', '');
        updateActiveNavLink(sectionId);
    }

    /**
     * Open mobile menu
     */
    function openMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    /**
     * Close mobile menu
     */
    function closeMobileMenu() {
        if (mobileMenu) {
            mobileMenu.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    /**
     * Initialize event listeners
     */
    function initEventListeners() {
        // Scroll event
        window.addEventListener('scroll', handleScroll, { passive: true });

        // Nav link clicks (desktop)
        navLinks.forEach(link => {
            link.addEventListener('click', handleNavLinkClick);
        });

        // Mobile menu links
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', handleNavLinkClick);
        });

        // Mobile menu toggle
        if (mobileMenuBtn) {
            mobileMenuBtn.addEventListener('click', openMobileMenu);
        }

        if (mobileMenuClose) {
            mobileMenuClose.addEventListener('click', closeMobileMenu);
        }

        // Close mobile menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu && mobileMenu.classList.contains('active')) {
                closeMobileMenu();
            }
        });

        // Close mobile menu on backdrop click
        if (mobileMenu) {
            mobileMenu.addEventListener('click', (e) => {
                if (e.target === mobileMenu) {
                    closeMobileMenu();
                }
            });
        }
    }

    /**
     * Initialize on DOM ready
     */
    function init() {
        // Set initial state
        handleNavbarScroll();
        updateActiveNavLink('home');

        // Initialize event listeners
        initEventListeners();

        // Handle initial hash in URL
        if (window.location.hash) {
            setTimeout(() => {
                smoothScrollTo(window.location.hash);
            }, 100);
        }
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
