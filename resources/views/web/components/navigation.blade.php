<!-- Navigation -->
<nav id="main-nav" class="nav-container">
    @php
        $siteLogo = \App\Models\Setting::get('site_logo');
        $siteName = \App\Models\Setting::get('site_name', 'Villa Lanka');
        $showLogo = \App\Models\Setting::get('show_logo', '1');
    @endphp

    <a href="{{ url('/') }}" class="nav-logo flex items-center">
        @if($siteLogo && $showLogo === '1')
            <img src="{{ $siteLogo }}" alt="Moon Stone" class="h-10 object-contain max-w-[150px]">
        @endif
        <span>{{ $siteName }}</span>
    </a>
    <div class="nav-capsule" id="nav-capsule">
        <a href="#" class="nav-link active">Home</a>
        <a href="#rooms" class="nav-link">Rooms</a>
        <a href="#gallery" class="nav-link">Gallery</a>
        <a href="#location" class="nav-link">Location</a>
        <a href="#contact" class="nav-link">Contact</a>
    </div>
    <div class="nav-mobile">
        <button class="nav-mobile-btn" aria-label="Open menu">
            <i data-lucide="menu"></i>
        </button>
    </div>
</nav>