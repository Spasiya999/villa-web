@php
    $galleries = \App\Models\Gallery::active()->ordered()->get();
@endphp

@if ($galleries->count() > 0)
    <!-- Featured Gallery Section -->
    <section id="gallery" class="gallery-section">
        <div class="gallery-header" data-aos="fade-up">
            <h2 class="gallery-title">A Visual Journey</h2>
            <p class="gallery-subtitle">Experience Villa Lanka through these moments</p>
        </div>
        <div class="gallery-grid">
            @foreach ($galleries as $gallery)
                @php
                    $itemClass = 'gallery-item';
                    $mod = $loop->iteration % 6;

                    if ($mod == 1) {
                        $itemClass .= ' gallery-item-tall';
                    } elseif ($mod == 4) {
                        $itemClass .= ' gallery-item-wide';
                    }
                @endphp
                <div class="{{ $itemClass }}" data-aos="fade-up" data-aos-delay="{{ min($loop->iteration * 100, 500) }}">
                    <img src="{{ $gallery->image_url }}" alt="{{ $gallery->image_alt }}">
                </div>
            @endforeach
        </div>
        <div class="gallery-cta-container" data-aos="fade-up">
            <a href="#contact" class="gallery-cta">View Full Gallery</a>
        </div>
    </section>
@endif