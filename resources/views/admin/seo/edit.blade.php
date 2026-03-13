<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-900">SEO Settings</h1>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        <!-- Success/Error Messages -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center justify-between">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ session('success') }}
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Please check the form below for errors.
            </div>
        @endif

        <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Global Meta Tags</h2>

                <div class="space-y-6">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Title
                        </label>
                        <input type="text" name="meta_title" id="meta_title"
                            value="{{ old('meta_title', $settings['meta_title'] ?? '') }}"
                            placeholder="Villa Lanka | Luxury Boutique Villa in Bentota"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters. Appears as the clickable
                            headline in search results.</p>
                        @error('meta_title') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Description
                        </label>
                        <textarea name="meta_description" id="meta_description" rows="4"
                            placeholder="Experience luxury and tranquility at Villa Lanka. A private boutique villa in Bentota, Sri Lanka offering personalized service and stunning views."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters. A brief summary of the
                            page content for search engines.</p>
                        @error('meta_description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Keywords
                        </label>
                        <input type="text" name="meta_keywords" id="meta_keywords"
                            value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}"
                            placeholder="villa bentota, luxury villa sri lanka, boutique villa bentota, private villa"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">Comma-separated list of keywords representing the core
                            topics of your site.</p>
                        @error('meta_keywords') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Favicon / Brand Logo -->
                    <div class="border-t border-gray-100 pt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Website Favicon
                        </label>

                        @if(isset($settings['favicon']) && $settings['favicon'])
                            <div class="mb-4 bg-gray-50 p-4 rounded-lg inline-block border border-gray-200">
                                <img src="{{ $settings['favicon'] }}" alt="Current Favicon"
                                    class="w-16 h-16 object-contain rounded shadow-sm mb-2">
                                <p class="text-xs text-gray-500">Current favicon used in browser tabs.</p>
                            </div>
                        @else
                            <div
                                class="mb-4 text-sm text-gray-500 italic p-4 border border-dashed border-gray-200 rounded-lg">
                                No custom favicon uploaded. Defaults to asset image.
                            </div>
                        @endif

                        <input type="file" name="favicon" id="favicon" accept="image/x-icon,image/png,image/jpeg"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <p class="mt-2 text-xs text-gray-500">Recommended: 32x32px or 64x64px PNG/ICO. This icon appears
                            next to your page title in browser tabs.</p>
                        @error('favicon') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- Robots Meta Tag -->
                    <div class="border-t border-gray-100 pt-6">
                        <label for="robots_meta" class="block text-sm font-medium text-gray-700 mb-2">
                            Search Engine Visibility (Robots Meta)
                        </label>
                        <select name="robots_meta" id="robots_meta"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="index, follow" {{ old('robots_meta', $settings['robots_meta'] ?? 'index, follow') == 'index, follow' ? 'selected' : '' }}>Index, Follow (Recommended)</option>
                            <option value="noindex, follow" {{ old('robots_meta', $settings['robots_meta'] ?? '') == 'noindex, follow' ? 'selected' : '' }}>NoIndex, Follow (Hide from search results)
                            </option>
                            <option value="index, nofollow" {{ old('robots_meta', $settings['robots_meta'] ?? '') == 'index, nofollow' ? 'selected' : '' }}>Index, NoFollow (Don't follow links)
                            </option>
                            <option value="noindex, nofollow" {{ old('robots_meta', $settings['robots_meta'] ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>NoIndex, NoFollow (Complete block)
                            </option>
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Controls how search engines (Google, Bing) crawl and index
                            your site.</p>
                        @error('robots_meta') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- OG Image / SEO Preview -->
                    <div class="border-t border-gray-100 pt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            SEO Preview Image (OG Image)
                        </label>

                        @if(isset($settings['og_image']) && $settings['og_image'])
                            <div class="mb-4 bg-gray-50 p-4 rounded-lg inline-block border border-gray-200">
                                <img src="{{ $settings['og_image'] }}" alt="Current OG Image"
                                    class="max-w-xs h-auto rounded-lg shadow-sm mb-2">
                                <p class="text-xs text-gray-500">Current preview image used for social sharing.</p>
                            </div>
                        @else
                            <div
                                class="mb-4 text-sm text-gray-500 italic p-4 border border-dashed border-gray-200 rounded-lg">
                                No custom preview image uploaded. Defaults to asset image.
                            </div>
                        @endif

                        <input type="file" name="og_image" id="og_image" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <p class="mt-2 text-xs text-gray-500">Recommended: 1200x630px JPG/PNG. This image is shown when
                            you share your website link on social media (Facebook, WhatsApp, Twitter, etc.).</p>
                        @error('og_image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Verification & Analytics Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Verification & Analytics
                </h2>

                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="google_analytics_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Google Analytics Measurement ID
                            </label>
                            <input type="text" name="google_analytics_id" id="google_analytics_id"
                                value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}"
                                placeholder="G-XXXXXXXXXX"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('google_analytics_id') <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="google_tag_manager_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Google Tag Manager ID
                            </label>
                            <input type="text" name="google_tag_manager_id" id="google_tag_manager_id"
                                value="{{ old('google_tag_manager_id', $settings['google_tag_manager_id'] ?? '') }}"
                                placeholder="GTM-XXXXXXX"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('google_tag_manager_id') <span class="text-sm text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="google_site_verification_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Google Search Console Verification ID
                        </label>
                        <input type="text" name="google_site_verification_id" id="google_site_verification_id"
                            value="{{ old('google_site_verification_id', $settings['google_site_verification_id'] ?? '') }}"
                            placeholder="xyz123abc..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">The verification code from the <code>content</code>
                            attribute of your verification meta tag.</p>
                        @error('google_site_verification_id') <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Advanced Scripts Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Advanced Scripts</h2>

                <div class="space-y-6">
                    <div>
                        <label for="custom_header_scripts" class="block text-sm font-medium text-gray-700 mb-2">
                            Custom Header Scripts
                        </label>
                        <textarea name="custom_header_scripts" id="custom_header_scripts" rows="4"
                            placeholder="<!-- Google Analytics, Facebook Pixel, etc. -->"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('custom_header_scripts', $settings['custom_header_scripts'] ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Injected before the <code>&lt;/head&gt;</code> tag.</p>
                        @error('custom_header_scripts') <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="custom_body_scripts" class="block text-sm font-medium text-gray-700 mb-2">
                            Custom Body Scripts
                        </label>
                        <textarea name="custom_body_scripts" id="custom_body_scripts" rows="4"
                            placeholder="<!-- Scripts to run after page load -->"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg font-mono text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('custom_body_scripts', $settings['custom_body_scripts'] ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Injected right after the <code>&lt;body&gt;</code> tag.
                        </p>
                        @error('custom_body_scripts') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end pt-4">
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save SEO Settings
                </button>
            </div>
        </form>
    </div>
</x-app-layout>