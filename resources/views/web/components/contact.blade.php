@php
    $contactAddress = \App\Models\Setting::get('contact_address', '123 Luxury Lane, Bentota, Sri Lanka');
    $contactEmail = \App\Models\Setting::get('contact_email', 'hello@villaspasiya.com');
    $contactPhone = \App\Models\Setting::get('contact_phone', '+94 77 123 4567');
    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '94771234567');

    $socialLinks = \App\Models\SocialLink::where('is_active', true)->ordered()->get();
@endphp
<section id="contact" class="contact-section">
    <div class="contact-container">
        <div class="contact-header">
            <span class="contact-badge">Contact Us</span>
            <h2 class="contact-title">Your Private Escape Awaits</h2>
            <p class="contact-subtitle">Experience luxury redefined in the heart of Sri Lanka. Book your stay or send us
                an inquiry today.</p>
        </div>

        <div class="contact-content">
            <div class="contact-info-card">
                <div class="info-item">
                    <div class="info-icon">
                        <i data-lucide="map-pin"></i>
                    </div>
                    <div class="info-text">
                        <h3>Our Location</h3>
                        <p>{{ $contactAddress }}</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i data-lucide="mail"></i>
                    </div>
                    <div class="info-text">
                        <h3>Email Us</h3>
                        <p>{{ $contactEmail }}</p>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">
                        <i data-lucide="phone"></i>
                    </div>
                    <div class="info-text">
                        <h3>Call Us</h3>
                        <p>{{ $contactPhone }}</p>
                    </div>
                </div>

                <div class="social-links-card">
                    <p>Follow us</p>
                    <div class="social-icons">
                        @foreach($socialLinks as $link)
                            <a href="{{ $link->url }}" target="_blank"
                                class="social-icon-btn social-{{ strtolower($link->platform) }}"
                                aria-label="{{ $link->platform }}">
                                <i data-lucide="{{ $link->icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                </div>

                <div class="whatsapp-card">
                    <p>Prefer instant messaging?</p>
                    <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="whatsapp-btn">
                        <i data-lucide="message-circle"></i>
                        <span>Chat on WhatsApp</span>
                    </a>
                </div>
            </div>

            <div class="contact-form-card">
                @if(session('success'))
                    <div class="success-alert">
                        <i data-lucide="check-circle-2"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST" class="luxury-form">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <div class="input-wrapper">
                                <i data-lucide="user" class="input-icon"></i>
                                <input type="text" id="name" name="name"
                                    class="luxury-input @error('name') input-error @enderror" placeholder="John Doe"
                                    value="{{ old('name') }}" required />
                            </div>
                            @error('name')<span class="error-text">{{ $message }}</span>@enderror
                        </div> 

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-wrapper">
                                <i data-lucide="mail" class="input-icon"></i>
                                <input type="email" id="email" name="email"
                                    class="luxury-input @error('email') input-error @enderror"
                                    placeholder="john@example.com" value="{{ old('email') }}" required />
                            </div>
                            @error('email')<span class="error-text">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number (Optional)</label>
                        <div class="input-wrapper">
                            <i data-lucide="phone" class="input-icon"></i>
                            <input type="tel" id="phone" name="phone"
                                class="luxury-input @error('phone') input-error @enderror" placeholder="+94 77 123 4567"
                                value="{{ old('phone') }}" />
                        </div>
                        @error('phone')<span class="error-text">{{ $message }}</span>@enderror
                    </div>

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <div class="input-wrapper">
                            <textarea id="message" name="message" rows="4"
                                class="luxury-input @error('message') input-error @enderror"
                                placeholder="Tell us about your travel plans..."
                                required>{{ old('message') }}</textarea>
                        </div>
                        @error('message')<span class="error-text">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="submit-btn">
                        <span>Send Message</span>
                        <i data-lucide="send"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    :root {
        --contact-primary: #111827;
        --contact-accent: #0f9999;
        --contact-accent-soft: rgba(15, 153, 153, 0.1);
        --contact-bg: #f8fafc;
        --contact-card-bg: #ffffff;
        --contact-text-muted: #475569;
        --contact-border: #e2e8f0;
    }

    .contact-section {
        padding: 100px 20px;
        background-color: var(--contact-bg);
        position: relative;
        overflow: hidden;
    }

    .contact-container {
        max-width: 1100px;
        margin: 0 auto;
        position: relative;
        z-index: 10;
    }

    .contact-header {
        text-align: center;
        margin-bottom: 60px;
    }

    .contact-badge {
        display: inline-block;
        padding: 6px 16px;
        background: var(--contact-accent-soft);
        color: #074b4b;
        border-radius: 100px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 16px;
    }

    .contact-title {
        font-family: var(--font-serif);
        font-size: 3rem;
        color: var(--contact-primary);
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .contact-subtitle {
        font-size: 1.1rem;
        color: var(--contact-text-muted);
        max-width: 600px;
        margin: 0 auto;
    }

    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 40px;
        align-items: start;
    }

    @media (max-width: 900px) {
        .contact-content {
            grid-template-columns: 1fr;
        }

        .contact-title {
            font-size: 2.5rem;
        }
    }

    /* Info Card */
    .contact-info-card {
        background: var(--contact-card-bg);
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04);
        border: 1px solid var(--contact-border);
    }

    .info-item {
        display: flex;
        gap: 20px;
        margin-bottom: 30px;
    }

    .info-icon {
        width: 48px;
        height: 48px;
        background: var(--contact-accent-soft);
        color: var(--contact-accent);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-icon i {
        width: 20px;
        height: 20px;
    }

    .info-text h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--contact-primary);
        margin-bottom: 4px;
    }

    .info-text p {
        color: var(--contact-text-muted);
        font-size: 0.95rem;
    }

    .social-links-card {
        margin-top: 30px;
        padding-top: 15px;
        border-top: 1px solid var(--contact-border);
    }

    .social-links-card p {
        color: var(--contact-text-muted);
        font-size: 0.9rem;
        margin-bottom: 14px;
    }

    .social-icons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .social-icon-btn {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        color: white;
    }

    .social-icon-btn i {
        width: 20px;
        height: 20px;
    }

    .social-icon-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .social-facebook {
        background: #1877f2;
    }

    .social-facebook:hover {
        background: #0d65d9;
    }

    .social-instagram {
        background: linear-gradient(135deg, #f58529, #dd2a7b, #8134af);
    }

    .social-instagram:hover {
        filter: brightness(1.1);
    }

    .social-twitter {
        background: #000000;
    }

    .social-twitter:hover {
        background: #333333;
    }

    .social-youtube {
        background: #ff0000;
    }

    .social-youtube:hover {
        background: #cc0000;
    }

    .whatsapp-card {
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid var(--contact-border);
    }

    .whatsapp-card p {
        color: var(--contact-text-muted);
        font-size: 0.9rem;
        margin-bottom: 16px;
    }

    .whatsapp-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: #25d366;
        color: #111827;
        padding: 14px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .whatsapp-btn:hover {
        background: #128c7e;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(37, 211, 102, 0.3);
    }

    /* Form Card */
    .contact-form-card {
        background: var(--contact-card-bg);
        padding: 48px;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.06);
        border: 1px solid var(--contact-border);
    }

    @media (max-width: 640px) {
        .contact-form-card {
            padding: 30px 20px;
        }
    }

    .success-alert {
        background: #ecfdf5;
        color: #065f46;
        padding: 16px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
        border: 1px solid #10b981;
    }

    .luxury-form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 640px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--contact-primary);
    }

    .input-wrapper {
        position: relative;
        display: flex;
        align-items: center;
    }

    .input-icon {
        position: absolute;
        left: 16px;
        width: 18px;
        height: 18px;
        color: var(--contact-text-muted);
        pointer-events: none;
        transition: color 0.3s ease;
    }

    .luxury-input {
        width: 100%;
        padding: 14px 16px 14px 48px;
        border: 1.5px solid var(--contact-border);
        border-radius: 12px;
        font-size: 1rem;
        background: #fff;
        color: var(--contact-primary);
        transition: all 0.3s ease;
        font-family: inherit;
    }

    textarea.luxury-input {
        padding-left: 16px;
        resize: vertical;
    }

    .luxury-input:focus {
        outline: none;
        border-color: var(--contact-accent);
        box-shadow: 0 0 0 4px var(--contact-accent-soft);
    }

    .luxury-input:focus+.input-icon {
        color: var(--contact-accent);
    }

    .luxury-input::placeholder {
        color: #cbd5e1;
    }

    .input-error {
        border-color: #ef4444;
    }

    .error-text {
        font-size: 0.8rem;
        color: #ef4444;
        margin-top: 4px;
    }

    .submit-btn {
        background: var(--contact-primary);
        color: white;
        padding: 16px 32px;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .submit-btn:hover {
        background: #000;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .submit-btn i {
        width: 18px;
        height: 18px;
    }
</style>