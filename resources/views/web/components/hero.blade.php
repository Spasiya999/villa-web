@php
    $hero = \App\Models\HeroSection::getActive();
@endphp

<section id="home" class="hero-section">
    <div class="hero-image-container">
        @if ($hero && $hero->hero_video)
            <video src="{{ Storage::url($hero->hero_video) }}" @if($hero->hero_image)
            poster="{{ Storage::url($hero->hero_image) }}" @endif class="hero-image" autoplay loop muted playsinline>
            </video>
        @elseif ($hero && $hero->hero_image)
            <img src="{{ Storage::url($hero->hero_image) }}" class="hero-image"
                alt="{{ $hero->title_line_1 }} {{ $hero->title_line_2 }}" loading="eager">
        @else
            <img src="https://img.rocket.new/generatedImages/rocket_gen_img_12844d3f9-1766859606048.png" class="hero-image"
                alt="Luxury private villa with infinity pool overlooking tropical ocean in Sri Lanka" loading="eager">
        @endif
        <div class="hero-overlay"></div>
    </div>
    <div class="hero-content">
        <div class="hero-inner">
            @if ($hero && $hero->tagline)
                <p class="hero-tagline animate__animated animate__fadeInDown">{{ $hero->tagline }}</p>
            @endif

            <h1 class="hero-title animate__animated animate__fadeInUp animate__delay-1s">
                @if ($hero && $hero->title_line_1)
                    {{ $hero->title_line_1 }} <br>
                @endif
                @if ($hero && $hero->title_line_2)
                    {{ $hero->title_line_2 }} <br>
                @endif
                @if ($hero && $hero->title_accent)
                    <span class="hero-title-accent">{{ $hero->title_accent }}</span>
                @endif
            </h1>

            @if ($hero && $hero->subtitle)
                <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-2s">{{ $hero->subtitle }}</p>
            @endif

            <div class="hero-cta-group animate__animated animate__fadeInUp animate__delay-3s">
                @if ($hero && $hero->primary_cta_text)
                    <a href="{{ $hero->primary_cta_link }}" class="hero-cta-primary hover-scale">
                        {{ $hero->primary_cta_text }}
                    </a>
                @endif

                @if ($hero && $hero->secondary_cta_text && $hero->secondary_cta_link)
                    <a href="{{ $hero->secondary_cta_link }}" target="_blank" rel="noopener"
                        class="hero-cta-secondary hover-scale">
                        <i data-lucide="message-circle"></i>
                        <span>{{ $hero->secondary_cta_text }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
    /* Ensure hero section is visible */
    .hero-section {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
</style>