@php
    $galleries = \App\Models\Gallery::active()->ordered()->get();
@endphp

@if ($galleries->count() > 0)
    <section id="gallery" class="vl-gallery">

        {{-- Decorative background --}}
        <div class="vl-gallery__bg-deco" aria-hidden="true"></div>

        {{-- Header --}}
        <div class="vl-gallery__header" data-aos="fade-up" data-aos-duration="900" data-aos-once="true">
            <span class="vl-gallery__eyebrow">Gallery</span>
            <h2 class="vl-gallery__title">A Visual Journey</h2>
            <p class="vl-gallery__subtitle">Experience Villa Lanka through these captured moments</p>
            <div class="vl-gallery__title-line" data-aos="width-in" data-aos-delay="400" data-aos-once="true"></div>
        </div>

        {{-- Masonry Grid --}}
        <div class="vl-gallery__grid">
            @foreach ($galleries as $index => $gallery)
                @php
                    $col = $index % 5;
                    $delay = ($index % 5) * 120;
                @endphp
                <figure class="vl-gallery__item vl-gallery__item--col{{ $col }}" data-aos="fade-up"
                    data-aos-delay="{{ $delay }}" data-aos-duration="800" data-aos-once="true">
                    <a href="{{ $gallery->image_url }}" class="glightbox" data-gallery="main-gallery">
                        <div class="vl-gallery__img-wrap">
                            <img src="{{ $gallery->image_url }}" alt="{{ $gallery->image_alt }}" loading="lazy">
                            <div class="vl-gallery__overlay" aria-hidden="true">
                                <div class="vl-gallery__overlay-inner">
                                    <span class="vl-gallery__overlay-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </figure>
            @endforeach
        </div>

    </section>

    <style>
        /* ── Variables ─────────────────────────────────── */
        .vl-gallery {
            --gold: #c9a84c;
            --gold-lt: #e8d5a0;
            --ink: #1a1610;
            --cream: #faf8f4;
            --warm-mid: #7a6e5f;
            --radius: 4px;
            --gap: 14px;

            position: relative;
            background: var(--cream);
            padding: 100px 0 120px;
            overflow: hidden;
            font-family: var(--font-serif);
        }

        /* ── Decorative background ─────────────────────── */
        .vl-gallery__bg-deco {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 40% at 5% 10%, rgba(201, 168, 76, .07) 0%, transparent 70%),
                radial-gradient(ellipse 50% 60% at 95% 85%, rgba(201, 168, 76, .06) 0%, transparent 70%);
            pointer-events: none;
        }

        /* ── Header ────────────────────────────────────── */
        .vl-gallery__header {
            text-align: center;
            max-width: 600px;
            margin: 0 auto 64px;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }

        .vl-gallery__eyebrow {
            display: inline-block;
            font-family: var(--font-sans);
            font-size: 0.7rem;
            letter-spacing: 0.35em;
            text-transform: uppercase;
            color: var(--gold);
            margin-bottom: 16px;
        }

        .vl-gallery__title {
            font-size: clamp(2rem, 4vw, 3.2rem);
            font-weight: 400;
            color: var(--ink);
            letter-spacing: -0.02em;
            line-height: 1.15;
            margin: 0 0 16px;
        }

        .vl-gallery__subtitle {
            font-size: 1rem;
            color: var(--warm-mid);
            line-height: 1.7;
            margin: 0 0 28px;
            font-style: italic;
        }

        .vl-gallery__title-line {
            width: 48px;
            height: 2px;
            background: var(--gold);
            margin: 0 auto;
            transition: width 0.8s ease;
        }

        /* ── Grid ──────────────────────────────────────── */
        .vl-gallery__grid {
            columns: 2;
            column-gap: var(--gap);
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 24px;
            position: relative;
            z-index: 1;
        }

        @media (min-width: 640px) {
            .vl-gallery__grid {
                columns: 3;
            }
        }

        @media (min-width: 1024px) {
            .vl-gallery__grid {
                columns: 4;
            }
        }

        /* ── Items ─────────────────────────────────────── */
        .vl-gallery__item {
            break-inside: avoid;
            margin: 0 0 var(--gap);
            position: relative;
            cursor: pointer;
        }

        /* Varying heights via nth-child pattern */
        .vl-gallery__item--col0 .vl-gallery__img-wrap {
            padding-bottom: 133%;
        }

        /* tall portrait */
        .vl-gallery__item--col1 .vl-gallery__img-wrap {
            padding-bottom: 75%;
        }

        /* landscape      */
        .vl-gallery__item--col2 .vl-gallery__img-wrap {
            padding-bottom: 100%;
        }

        /* square         */
        .vl-gallery__item--col3 .vl-gallery__img-wrap {
            padding-bottom: 120%;
        }

        /* portrait       */
        .vl-gallery__item--col4 .vl-gallery__img-wrap {
            padding-bottom: 80%;
        }

        /* wide portrait  */

        .vl-gallery__img-wrap {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: var(--radius);
            background: #e8e2d8;
        }

        .vl-gallery__img-wrap img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.75s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        /* ── Overlay ───────────────────────────────────── */
        .vl-gallery__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(160deg,
                    rgba(26, 22, 16, 0) 40%,
                    rgba(26, 22, 16, 0.65) 100%);
            opacity: 0;
            transition: opacity 0.45s ease;
            border-radius: var(--radius);
            display: flex;
            align-items: flex-end;
            padding: 20px;
        }

        .vl-gallery__overlay-inner {
            transform: translateY(10px);
            transition: transform 0.45s ease;
        }

        .vl-gallery__overlay-num {
            font-family: var(--font-sans);
            font-size: 0.65rem;
            letter-spacing: 0.3em;
            color: var(--gold-lt);
            opacity: 0.8;
        }

        /* ── Hover states ──────────────────────────────── */
        .vl-gallery__item:hover .vl-gallery__img-wrap img {
            transform: scale(1.07);
        }

        .vl-gallery__item:hover .vl-gallery__overlay {
            opacity: 1;
        }

        .vl-gallery__item:hover .vl-gallery__overlay-inner {
            transform: translateY(0);
        }

        /* ── AOS custom keyframe for title line ────────── */
        [data-aos="width-in"] {
            width: 0 !important;
            transition-property: width !important;
        }

        [data-aos="width-in"].aos-animate {
            width: 48px !important;
        }

        /* ── Responsive tweaks ─────────────────────────── */
        @media (max-width: 639px) {

            .vl-gallery__item--col0 .vl-gallery__img-wrap,
            .vl-gallery__item--col3 .vl-gallery__img-wrap {
                padding-bottom: 110%;
            }

            .vl-gallery__item--col1 .vl-gallery__img-wrap,
            .vl-gallery__item--col4 .vl-gallery__img-wrap {
                padding-bottom: 85%;
            }
        }
    </style>
@endif