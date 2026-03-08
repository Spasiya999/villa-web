@php
    $rooms = \App\Models\Room::getActive();
@endphp

<!-- Rooms Preview Section -->
<section id="rooms" class="rooms-section">
    <div class="rooms-header" data-aos="fade-up">
        <p class="rooms-label">Accommodation</p>
        <h2 class="rooms-title">Designed for comfort, crafted for luxury</h2>
    </div>
    <div class="rooms-grid">
        @forelse($rooms as $room)
            <div class="room-card" data-room-id="{{ $room->id }}">
                <div class="room-image">
                    <img src="{{ $room->image_url }}" alt="{{ $room->image_alt }}" loading="lazy">
                </div>
                <div class="room-content">
                    <h3 class="room-name">{{ $room->name }}</h3>
                    <div class="room-details">
                        <span class="room-detail">
                            <i data-lucide="{{ $room->bed_count > 1 ? 'bed' : 'bed-double' }}"></i>
                            {{ $room->bed_type }}
                        </span>
                        <span class="room-detail">
                            <i data-lucide="users"></i>
                            Sleeps {{ $room->sleeps }}{{ $room->bed_count > 1 ? '' : '' }}
                        </span>
                    </div>
                    <p class="room-description">{{ $room->description }}</p>

                    @if ($room->amenities && count($room->amenities) > 0)
                        <div class="room-amenities">
                            @foreach (array_slice($room->amenities, 0, 3) as $amenity)
                                <span class="amenity-tag">{{ $amenity }}</span>
                            @endforeach
                            @if (count($room->amenities) > 3)
                                <span class="amenity-tag">+{{ count($room->amenities) - 3 }} more</span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="no-rooms-message">
                <p>No rooms are currently available. Please check back later.</p>
            </div>
        @endforelse
    </div>
    <div class="rooms-cta-container">
        <a href="#contact" class="rooms-cta">View Rooms & Rates</a>
    </div>
</section>

<style>
    .room-amenities {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-top: 0.75rem;
    }

    .amenity-tag {
        background: #f0f0f0;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.85rem;
        color: #666;
    }

    .no-rooms-message {
        grid-column: 1 / -1;
        text-align: center;
        padding: 3rem;
        color: #666;
    }
</style>
{{--
    <!-- Rooms Preview Section -->
    <section id="rooms" class="rooms-section">
        <div class="rooms-header">
            <p class="rooms-label">Accommodation</p>
            <h2 class="rooms-title">Designed for comfort, crafted for luxury</h2>
        </div>
        <div class="rooms-grid">
            <div class="room-card">
                <div class="room-image">
                    <img src="https://img.rocket.new/generatedImages/rocket_gen_img_14b7848a4-1767976373764.png"
                        alt="Master suite with king bed, ocean view balcony, and ensuite bathroom with rainfall shower"
                        loading="lazy">
                </div>
                <div class="room-content">
                    <h3 class="room-name">Master Suite</h3>
                    <div class="room-details">
                        <span class="room-detail">
                            <i data-lucide="bed-double"></i>
                            King Bed
                        </span>
                        <span class="room-detail">
                            <i data-lucide="users"></i>
                            Sleeps 2
                        </span>
                    </div>
                    <p class="room-description">Ocean-facing suite with private balcony, walk-in closet, and luxury
                        ensuite</p>
                </div>
            </div>
            <div class="room-card">
                <div class="room-image">
                    <img src="https://images.unsplash.com/photo-1594706667982-5ac495694f27"
                        alt="Garden suite bedroom with queen bed, tropical garden view, and modern ensuite bathroom"
                        loading="lazy">
                </div>
                <div class="room-content">
                    <h3 class="room-name">Garden Suites</h3>
                    <div class="room-details">
                        <span class="room-detail">
                            <i data-lucide="bed-double"></i>
                            Queen Bed
                        </span>
                        <span class="room-detail">
                            <i data-lucide="users"></i>
                            Sleeps 2 each
                        </span>
                    </div>
                    <p class="room-description">Two identical suites overlooking lush tropical gardens with ensuite
                        bathrooms</p>
                </div>
            </div>
            <div class="room-card">
                <div class="room-image">
                    <img src="https://images.unsplash.com/photo-1591529865762-f84b1490ef8a"
                        alt="Family bedroom with two double beds, colorful decor, and shared bathroom access"
                        loading="lazy">
                </div>
                <div class="room-content">
                    <h3 class="room-name">Family Room</h3>
                    <div class="room-details">
                        <span class="room-detail">
                            <i data-lucide="bed"></i>
                            2 Double Beds
                        </span>
                        <span class="room-detail">
                            <i data-lucide="users"></i>
                            Sleeps 4
                        </span>
                    </div>
                    <p class="room-description">Spacious room with twin double beds, perfect for families or friends
                        traveling together</p>
                </div>
            </div>
        </div>
        <div class="rooms-cta-container">
            <a href="#contact" class="rooms-cta">View Rooms & Rates</a>
        </div>
    </section> --}}
