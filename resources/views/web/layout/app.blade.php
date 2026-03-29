<!DOCTYPE html>
<html lang="en">

@php
    $siteName = \App\Models\Setting::get('site_name', 'Villa Lanka');
    $metaTitle = \App\Models\Setting::get('meta_title');
    $metaDescription = \App\Models\Setting::get('meta_description', \App\Models\Setting::get('site_description'));
    $metaKeywords = \App\Models\Setting::get('meta_keywords');
    $ogImage = \App\Models\Setting::get('og_image', asset('images/seo-preview.jpg'));
    $favicon = \App\Models\Setting::get('favicon', asset('favicon.png'));
    $robotsMeta = \App\Models\Setting::get('robots_meta', 'index, follow');
    $gaId = \App\Models\Setting::get('google_analytics_id');
    $gtmId = \App\Models\Setting::get('google_tag_manager_id');
    $verificationId = \App\Models\Setting::get('google_site_verification_id');
    $headerScripts = \App\Models\Setting::get('custom_header_scripts');
    $bodyScripts = \App\Models\Setting::get('custom_body_scripts');
@endphp

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if($gtmId)
        <!-- Google Tag Manager -->
        <script>(function (w, d, s, l, i) {
                w[l] = w[l] || []; w[l].push({
                    'gtm.start':
                        new Date().getTime(), event: 'gtm.js'
                }); var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl; f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $gtmId }}');</script>
        <!-- End Google Tag Manager -->
    @endif

    @if($gaId)
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag.js?id={{ $gaId }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() { dataLayer.push(arguments); }
            gtag('js', new Date());
            gtag('config', '{{ $gaId }}');
        </script>
    @endif

    <title>{{ $metaTitle ?: ($siteName . ' | Your Private Paradise in Sri Lanka') }}</title>

    @if($metaDescription)
        <meta name="description" content="{{ $metaDescription }}">
    @endif

    @if($metaKeywords)
        <meta name="keywords" content="{{ $metaKeywords }}">
    @endif

    @if($verificationId)
        <meta name="google-site-verification" content="{{ $verificationId }}">
    @endif

    <link rel="canonical" href="{{ url()->current() }}">

    <meta property="og:title" content="{{ $metaTitle ?: $siteName }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle ?: $siteName }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" type="image/png" href="{{ $favicon }}">

    <meta name="robots" content="{{ $robotsMeta }}">

    @if($headerScripts)
        {!! $headerScripts !!}
    @endif

    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fonts/fonts.css') }}">

    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/animate-css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">

    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/owl-carousel/owl.theme.default.min.css') }}">

    <!-- GLightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

    <script src="{{ asset('vendor/lucide/lucide.min.js') }}"></script>

    <!-- jQuery and Owl Carousel JS -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/owl-carousel/owl.carousel.min.js') }}"></script>
</head>

<body>
    @if($gtmId)
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ $gtmId }}" height="0" width="0"
                style="display:none;visibility:hidden" title="Google Tag Manager"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

    @if($bodyScripts)
        {!! $bodyScripts !!}
    @endif

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
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/gsap/gsap.min.js') }}"></script>
    <script src="{{ asset('vendor/gsap/ScrollTrigger.min.js') }}"></script>

    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    </script>

    <!-- GLightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        const lightbox = GLightbox({
            selector: '.glightbox',
            touchNavigation: true,
            loop: true,
            autoplayVideos: true
        });
    </script>

    <!-- Your custom animations -->
    <script src="{{ asset('js/animations.js') }}"></script>
</body>

</html>