@php
    $highlights = \App\Models\Highlight::getActive();
@endphp

@if ($highlights->count() > 0)
    <section class="highlights-section">
        <div class="highlights-container">
            @foreach ($highlights as $highlight)
                <div class="highlight-item">
                    <div class="highlight-icon">
                        <i data-lucide="{{ $highlight->icon }}"></i>
                    </div>
                    <p class="highlight-label">{{ $highlight->label }}</p>
                    @if ($highlight->sublabel)
                        <p class="highlight-sublabel">{{ $highlight->sublabel }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
@endif
