@if($location && $location->is_active)
    <section id="location" class="location-section">
        <div class="location-container">
            <div class="location-content">
                <p class="location-label">{{ $location->label }}</p>
                <h2 class="location-title">{{ $location->title }}</h2>
                <p class="location-text">{{ $location->description }}</p>
                <div class="location-distances">
                    @for($i = 1; $i <= 4; $i++)
                        @if($location->{'distance_' . $i . '_label'})
                            <div class="location-distance-item">
                                <i data-lucide="{{ $location->{'distance_' . $i . '_icon'} }}"></i>
                                <div>
                                    <p class="location-distance-label">{{ $location->{'distance_' . $i . '_label'} }}</p>
                                    <p class="location-distance-value">{{ $location->{'distance_' . $i . '_value'} }}</p>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="location-map">
                <iframe src="{{ $location->map_embed_url }}" width="100%" height="450"
                    style="border:0; border-radius: 2rem;" allowfullscreen="" loading="lazy"
                    title="Location map for {{ $location->title }}">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Trigger AOS Refresh for dynamic elements -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                if (typeof AOS !== 'undefined') {
                    AOS.refresh();
                }
            }, 100);
        });
    </script>
@endif