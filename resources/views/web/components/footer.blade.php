@php
    $siteName = \App\Models\Setting::get('site_name', 'Villa Lanka');
    $siteDescription = \App\Models\Setting::get('site_description', 'Your private paradise in Sri Lanka');
    $contactPhone = \App\Models\Setting::get('contact_phone', '+94 77 123 4567');
    $contactEmail = \App\Models\Setting::get('contact_email', 'stay@villalanka.com');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '94771234567');

    $socialLinks = \App\Models\SocialLink::where('is_active', true)->ordered()->get();
@endphp

<!-- Footer -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-brand">
            <h3 class="footer-logo">{{ $siteName }}</h3>
            <p class="footer-tagline">{{ $siteDescription }}</p>
        </div>
        <div class="footer-contact">
            @if($contactPhone)
                <a href="tel:{{ str_replace(' ', '', $contactPhone) }}" class="footer-link">
                    <i data-lucide="phone"></i>
                    {{ $contactPhone }}
                </a>
            @endif
            @if($whatsappNumber)
                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener" class="footer-link">
                    <i data-lucide="message-circle"></i>
                    WhatsApp
                </a>
            @endif
            @if($contactEmail)
                <a href="mailto:{{ $contactEmail }}" class="footer-link">
                    <i data-lucide="mail"></i>
                    {{ $contactEmail }}
                </a>
            @endif
        </div>
        <div class="footer-social">
            @foreach($socialLinks as $link)
                <a href="{{ $link->url }}" target="_blank" rel="noopener" class="footer-social-link"
                    aria-label="{{ $link->platform }}">
                    <i data-lucide="{{ $link->icon }}"></i>
                </a>
            @endforeach
        </div>
    </div>
    <div class="footer-bottom">
        <p class="footer-copyright">© {{ date('Y') }} {{ $siteName }}. All rights reserved.</p>
        <div class="footer-legal">
            <a href="#" class="footer-legal-link">Privacy Policy</a>
            <a href="#" class="footer-legal-link">Terms of Service</a>
        </div>
    </div>
</footer>