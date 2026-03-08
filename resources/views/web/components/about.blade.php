@php
    $about = \App\Models\AboutVilla::getActive();
@endphp

@if ($about && $about->is_active)
    <section class="about-section">
        <div class="about-container">
            <div class="about-content">
                @if ($about->subtitle)
                    <p class="about-label">{{ $about->subtitle }}</p>
                @endif

                @if ($about->title)
                    <h2 class="about-title">{{ $about->title }}</h2>
                @endif

                @if ($about->description)
                    <div class="about-text">
                        {!! nl2br(e($about->description)) !!}
                    </div>
                @endif
            </div>

            <div class="about-image">
                @if ($about->main_image)
                    <img src="{{ Storage::url($about->main_image) }}" alt="{{ $about->title }}" loading="lazy"
                        class="no-parallax">
                @else
                    <img src="https://img.rocket.new/generatedImages/rocket_gen_img_1cf330127-1768082737700.png"
                        alt="Luxury villa living room with floor-to-ceiling windows opening to tropical garden and ocean view 1"
                        loading="lazy" class="no-parallax">
                @endif
            </div>
        </div>
    </section>
@endif