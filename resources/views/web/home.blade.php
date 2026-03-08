@extends('web.layout.app')

@section('content')
    @include('web.components.hero')

    <!-- Quick Highlights Section -->
    @include('web.components.highlights')
    {{-- <section class="highlights-section">
        <div class="highlights-container">
            <div class="highlight-item">
                <div class="highlight-icon">
                    <i data-lucide="bed-double"></i>
                </div>
                <p class="highlight-label">4 Bedrooms</p>
                <p class="highlight-sublabel">Sleeps 8</p>
            </div>
            <div class="highlight-item">
                <div class="highlight-icon">
                    <i data-lucide="waves"></i>
                </div>
                <p class="highlight-label">Private Pool</p>
                <p class="highlight-sublabel">Infinity Edge</p>
            </div>
            <div class="highlight-item">
                <div class="highlight-icon">
                    <i data-lucide="palmtree"></i>
                </div>
                <p class="highlight-label">Beach Access</p>
                <p class="highlight-sublabel">100m Walk</p>
            </div>
            <div class="highlight-item">
                <div class="highlight-icon">
                    <i data-lucide="wifi"></i>
                </div>
                <p class="highlight-label">Free Wi-Fi</p>
                <p class="highlight-sublabel">High Speed</p>
            </div>
            <div class="highlight-item">
                <div class="highlight-icon">
                    <i data-lucide="chef-hat"></i>
                </div>
                <p class="highlight-label">Private Chef</p>
                <p class="highlight-sublabel">On Request</p>
            </div>
            <div class="highlight-item">
                <div class="highlight-icon">
                    <i data-lucide="plane"></i>
                </div>
                <p class="highlight-label">Airport Transfer</p>
                <p class="highlight-sublabel">Included</p>
            </div>
        </div>
    </section> --}}

    <!-- About the Villa Section -->
    @include('web.components.about')

    {{-- <section class="about-section">
        <div class="about-container">
            <div class="about-content">
                <p class="about-label">Discover Villa Lanka</p>
                <h2 class="about-title">Where privacy meets paradise on Sri Lanka's pristine coast</h2>
                <div class="about-text">
                    <p>Villa Lanka is more than accommodation — it's your private sanctuary. Nestled between lush
                        tropical gardens and the Indian Ocean, our four-bedroom estate offers complete seclusion
                        with five-star service.</p>
                    <p>Every detail has been thoughtfully designed for your comfort. From the infinity pool that
                        merges with the horizon to the open-air living spaces that invite the ocean breeze, this is
                        where modern luxury harmonizes with nature.</p>
                    <p>Your dedicated staff ensures every moment is effortless, from sunrise yoga sessions to
                        candlelit dinners on the terrace. This isn't just a villa — it's your personal retreat.</p>
                </div>
                <a href="#gallery" class="about-cta">Explore the Villa</a>
            </div>
            <div class="about-image">
                <img src="https://img.rocket.new/generatedImages/rocket_gen_img_1cf330127-1768082737700.png"
                    alt="Luxury villa living room with floor-to-ceiling windows opening to tropical garden and ocean view"
                    >
            </div>
        </div>
    </section> --}}

    <!-- Rooms Section -->
    @include('web.components.rooms')

    <!-- Featured Gallery Section -->
    <section id="gallery" class="gallery-section">
        <div class="gallery-header">
            <h2 class="gallery-title">A Visual Journey</h2>
            <p class="gallery-subtitle">Experience Villa Lanka through these moments</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item gallery-item-tall">
                <img src="https://images.unsplash.com/photo-1598924957326-0446ac30341e"
                    alt="Infinity pool overlooking ocean at sunset with loungers and tropical palms">
            </div>
            <div class="gallery-item">
                <img src="https://img.rocket.new/generatedImages/rocket_gen_img_1adc52e66-1767448133159.png"
                    alt="Master bedroom with king bed, white linens, and ocean view through glass doors">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1721222204647-6280987830cc"
                    alt="Open-air dining area with wooden table set for dinner overlooking tropical garden">
            </div>
            <div class="gallery-item gallery-item-wide">
                <img src="https://images.unsplash.com/photo-1714258940168-fcaeb145b4b5"
                    alt="Beachfront view of villa with palm trees and white sand beach at golden hour">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1634580560239-1b0310ac8094"
                    alt="Outdoor lounge area with daybed and cushions under tropical pergola">
            </div>
            <div class="gallery-item">
                <img src="https://images.unsplash.com/photo-1609280069865-62f178e2c237"
                    alt="Modern bathroom with freestanding tub and tropical garden view through window">
            </div>
        </div>
        <div class="gallery-cta-container">
            <a href="#contact" class="gallery-cta">View Full Gallery</a>
        </div>
    </section>

    <!-- Location Section -->
    <section id="location" class="location-section">
        <div class="location-container">
            <div class="location-content">
                <p class="location-label">Where Paradise Meets Convenience</p>
                <h2 class="location-title">Perfectly positioned on Sri Lanka's southern coast</h2>
                <p class="location-text">Villa Lanka sits in the heart of Sri Lanka's most sought-after coastal
                    region. You're steps from pristine beaches, minutes from vibrant local culture, and less than an
                    hour from Colombo International Airport.</p>
                <div class="location-distances">
                    <div class="location-distance-item">
                        <i data-lucide="palmtree"></i>
                        <div>
                            <p class="location-distance-label">Beach</p>
                            <p class="location-distance-value">100m walk</p>
                        </div>
                    </div>
                    <div class="location-distance-item">
                        <i data-lucide="shopping-bag"></i>
                        <div>
                            <p class="location-distance-label">Town Center</p>
                            <p class="location-distance-value">5 min drive</p>
                        </div>
                    </div>
                    <div class="location-distance-item">
                        <i data-lucide="plane"></i>
                        <div>
                            <p class="location-distance-label">Airport</p>
                            <p class="location-distance-value">45 min drive</p>
                        </div>
                    </div>
                    <div class="location-distance-item">
                        <i data-lucide="landmark"></i>
                        <div>
                            <p class="location-distance-label">Galle Fort</p>
                            <p class="location-distance-value">20 min drive</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="location-map">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126745.85768939493!2d79.77380039999999!3d6.927078699999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae253d10f7a7003%3A0x320b2e4d32d3838d!2sColombo%2C%20Sri%20Lanka!5e0!3m2!1sen!2sus"
                    width="100%" height="450" style="border:0; border-radius: 2rem;" allowfullscreen="">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Guest Reviews Section -->
    <section class="reviews-section">
        <div class="reviews-header">
            <h2 class="reviews-title">What our guests are saying</h2>
            <p class="reviews-subtitle">Real experiences from travelers who've made Villa Lanka their home</p>
        </div>
        <div class="reviews-grid">
            <div class="review-card">
                <div class="review-stars">
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                </div>
                <p class="review-text">"Villa Lanka exceeded every expectation. The privacy, the service, the
                    location — absolutely perfect. Our family felt like royalty for a week. The staff anticipated
                    our every need, and the villa itself is even more stunning in person."</p>
                <div class="review-author">
                    <div class="review-author-image">
                        <img src="https://i.pravatar.cc/100?u=sarah" alt="Sarah Mitchell from United Kingdom">
                    </div>
                    <div>
                        <p class="review-author-name">Sarah Mitchell</p>
                        <p class="review-author-location">United Kingdom</p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <div class="review-stars">
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                </div>
                <p class="review-text">"We've stayed at luxury villas around the world, but Villa Lanka stands out.
                    The attention to detail, the seamless blend of modern comfort and tropical beauty, and the
                    incredibly warm hospitality made this our best vacation yet."</p>
                <div class="review-author">
                    <div class="review-author-image">
                        <img src="https://i.pravatar.cc/100?u=michael" alt="Michael Chen from Singapore">
                    </div>
                    <div>
                        <p class="review-author-name">Michael Chen</p>
                        <p class="review-author-location">Singapore</p>
                    </div>
                </div>
            </div>
            <div class="review-card">
                <div class="review-stars">
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                    <i data-lucide="star" class="star-filled"></i>
                </div>
                <p class="review-text">"Pure magic. From the moment we arrived to our tearful goodbye, every second
                    was perfection. The chef prepared incredible meals, the villa was spotless, and waking up to
                    that ocean view never got old. Already planning our return."</p>
                <div class="review-author">
                    <div class="review-author-image">
                        <img src="https://i.pravatar.cc/100?u=emma" alt="Emma Rodriguez from United States">
                    </div>
                    <div>
                        <p class="review-author-name">Emma Rodriguez</p>
                        <p class="review-author-location">United States</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA Section -->
    <section id="booking" class="final-cta-section">
        <div class="final-cta-content">
            <h2 class="final-cta-title">Your private escape in Sri Lanka awaits</h2>
            <p class="final-cta-text">Limited availability. Book your dates today and experience luxury redefined.
            </p>
            <div class="final-cta-buttons">
                <a href="#contact" class="final-cta-primary">Book Your Stay</a>
                <a href="https://wa.me/94771234567" target="_blank" rel="noopener" class="final-cta-secondary">
                    <i data-lucide="message-circle"></i>
                    <span>Chat on WhatsApp</span>
                </a>
            </div>
        </div>
    </section>
@endsection
