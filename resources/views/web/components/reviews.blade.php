<style>
    .reviews-section .owl-theme .owl-dots .owl-dot span {
        background: #e2e8f0;
        transition: all 0.3s ease;
    }

    .reviews-section .owl-theme .owl-dots .owl-dot.active span,
    .reviews-section .owl-theme .owl-dots .owl-dot:hover span {
        background: #d4af37;
        transform: scale(1.2);
    }

    .reviews-section .owl-stage-outer {
        padding: 1rem 0 2rem 0;
    }
</style>
<section class="reviews-section">
    <div class="reviews-header" data-aos="fade-up" data-aos-duration="800" data-aos-once="true">
        <h2 class="reviews-title">What our guests are saying</h2>
        <p class="reviews-subtitle" data-aos="fade-up" data-aos-delay="150" data-aos-duration="800" data-aos-once="true">
            Real experiences from travelers who've made Villa Lanka their home
        </p>
    </div>

    @if($reviews->count() > 0)
        <div class="reviews-grid owl-carousel owl-theme"
             data-aos="fade-up"
             data-aos-delay="300"
             data-aos-duration="900"
             data-aos-once="true">
            @foreach($reviews as $review)
                <div class="review-card">
                    <div class="review-stars">
                        @for($i = 0; $i < $review->rating; $i++)
                            <i data-lucide="star" class="star-filled"></i>
                        @endfor
                        @for($i = $review->rating; $i < 5; $i++)
                            <i data-lucide="star" class="text-gray-300"></i>
                        @endfor
                    </div>
                    <p class="review-text">"{{ $review->review }}"</p>
                    <div class="review-author">
                        <div class="review-author-image">
                            @if($review->image)
                                <img src="{{ Storage::url($review->image) }}"
                                    alt="{{ $review->name }} from {{ $review->location ?? 'Guest' }}">
                            @else
                                <div style="width: 50px; height: 50px; border-radius: 50%; background-color: #d4af37; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem;">
                                    {{ substr($review->name, 0, 1) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="review-author-name">{{ $review->name }}</p>
                            @if($review->location)
                                <p class="review-author-location">{{ $review->location }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center w-full col-span-full py-8 text-gray-500 italic"
             data-aos="fade-up" data-aos-duration="600" data-aos-once="true">
            No reviews available yet. Check back soon!
        </div>
    @endif
</section>

<script>
    $(document).ready(function () {
        $(".reviews-grid").on('initialized.owl.carousel changed.owl.carousel', function () {
            if (typeof lucide !== 'undefined') {
                setTimeout(() => lucide.createIcons(), 50);
            }
        }).owlCarousel({
            loop: true,
            margin: 24,
            nav: false,
            dots: true,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                    margin: 16
                },
                768: {
                    items: 2,
                    margin: 20
                },
                1024: {
                    items: 3,
                    margin: 24
                }
            }
        });
    });
</script>