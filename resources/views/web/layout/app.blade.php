<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Villa Lanka | Your Private Paradise in Sri Lanka</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">

    <script src="https://unpkg.com/lucide@latest"></script>
    {{-- <script type="module" async
        src="https://static.rocket.new/rocket-web.js?_cfg=https%3A%2F%2Fvillalank2485back.builtwithrocket.new&_be=https%3A%2F%2Fappanalytics.rocket.new&_v=0.1.14">
        </script>
    <script type="module" defer src="https://static.rocket.new/rocket-shot.js?v=0.0.2"></script> --}}
</head>

<body>
    @include('web.components.navigation')

    @include('web.components.whatssapp')

    @include('web.components.booking')

    <main>
        @yield('content')
    </main>

    @include('web.components.footer')

    <script>
        lucide.createIcons();

        // Sticky Navigation
        const nav = document.getElementById('main-nav');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('nav-scrolled');
            } else {
                nav.classList.remove('nav-scrolled');
            }
        });

        // Smooth Scroll for Anchor Links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Mobile Booking Button Show/Hide
        const mobileBookingSticky = document.querySelector('.mobile-booking-sticky');
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;

            if (currentScrollY > 800) {
                mobileBookingSticky.classList.add('visible');
            } else {
                mobileBookingSticky.classList.remove('visible');
            }

            lastScrollY = currentScrollY;
        });

        // Re-initialize Lucide icons after dynamic content
        setTimeout(() => {
            lucide.createIcons();
        }, 100);

        // Mobile Navigation Functionality
        document.addEventListener('DOMContentLoaded', function () {
            const mobileBtn = document.querySelector('.nav-mobile-btn');
            const navCapsule = document.getElementById('nav-capsule');
            const navContainer = document.getElementById('main-nav');

            // Create mobile menu overlay
            const mobileMenu = document.createElement('div');
            mobileMenu.className = 'mobile-menu';
            mobileMenu.innerHTML = `
        <div class="mobile-menu-content">
            <button class="mobile-menu-close" aria-label="Close menu">
                <i data-lucide="x"></i>
            </button>
            <div class="mobile-menu-links">
                <a href="#" class="mobile-menu-link active">Home</a>
                <a href="#rooms" class="mobile-menu-link">Rooms</a>
                <a href="#location" class="mobile-menu-link">Location</a>
                <a href="#gallery" class="mobile-menu-link">Gallery</a>
                <a href="#contact" class="mobile-menu-link">Contact</a>
            </div>
        </div>
    `;
            document.body.appendChild(mobileMenu);

            // Open mobile menu
            mobileBtn.addEventListener('click', function () {
                mobileMenu.classList.add('active');
                document.body.style.overflow = 'hidden';

                // Refresh Lucide icons for the close button
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons();
                }
            });

            // Close mobile menu
            const closeBtn = mobileMenu.querySelector('.mobile-menu-close');
            closeBtn.addEventListener('click', function () {
                mobileMenu.classList.remove('active');
                document.body.style.overflow = '';
            });

            // Close menu when clicking on a link
            const mobileLinks = mobileMenu.querySelectorAll('.mobile-menu-link');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function () {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';

                    // Update active state
                    mobileLinks.forEach(l => l.classList.remove('active'));
                    this.classList.add('active');
                });
            });

            // Close menu when clicking outside
            mobileMenu.addEventListener('click', function (e) {
                if (e.target === mobileMenu) {
                    mobileMenu.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
    </script>

    <script src="{{ asset('js/navbar-scroll-enhanced.js') }}"></script>

    <!-- Animation Libraries JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    </script>

    <!-- Your custom animations -->
    <script src="{{ asset('js/animations.js') }}"></script>
</body>

</html>