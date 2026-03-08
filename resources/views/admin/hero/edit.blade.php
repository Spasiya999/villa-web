<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mr-3">
            <h1 class="text-2xl font-bold text-gray-900">Edit Hero Section</h1>
            <a href="{{ url('/') }}" target="_blank"
                class="hidden inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Preview on Website
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl">
        <!-- Success Message -->
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

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <p class="font-semibold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.hero.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Hero Media Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Hero Media</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Image -->
                    <div class="space-y-4">
                        @if ($hero->hero_image)
                            <div class="relative">
                                <img src="{{ Storage::url($hero->hero_image) }}" alt="Hero Image"
                                    class="w-full h-64 object-cover rounded-lg">
                                <button type="button"
                                    onclick="if(confirm('Are you sure you want to remove this image?')) { document.getElementById('remove-image-form').submit(); }"
                                    class="absolute top-4 right-4 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                    Remove Image
                                </button>
                            </div>
                        @else
                            <div
                                class="w-full h-64 bg-gray-50 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-200">
                                <span class="text-gray-400">No image uploaded</span>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $hero->hero_image ? 'Change Hero Image' : 'Upload Hero Image' }}
                            </label>
                            <input type="file" name="hero_image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-sm text-gray-500">Recommended size: 1920x1080px. Max file size:
                                5MB.<br>Formats: JPG, PNG, WebP</p>
                        </div>
                    </div>

                    <!-- Video -->
                    <div class="space-y-4 border-t md:border-t-0 md:border-l border-gray-100 pt-6 md:pt-0 md:pl-6">
                        @if ($hero->hero_video)
                            <div class="relative bg-black rounded-lg">
                                <video src="{{ Storage::url($hero->hero_video) }}" controls
                                    class="w-full h-64 object-cover rounded-lg"></video>
                                <button type="button"
                                    onclick="if(confirm('Are you sure you want to remove this video?')) { document.getElementById('remove-video-form').submit(); }"
                                    class="absolute top-4 right-4 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                    Remove Video
                                </button>
                            </div>
                        @else
                            <div
                                class="w-full h-64 bg-gray-50 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-200">
                                <span class="text-gray-400">No video uploaded</span>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $hero->hero_video ? 'Change Hero Video' : 'Upload Hero Video' }}
                            </label>
                            <input type="file" name="hero_video" accept="video/mp4,video/webm,video/ogg"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-sm text-gray-500">Recommended size: 1920x1080px. Max file size:
                                50MB.<br>Formats: MP4, WebM, OGG</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tagline -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Tagline</h2>
                <div>
                    <label for="tagline" class="block text-sm font-medium text-gray-700 mb-2">
                        Tagline <span class="text-gray-400">(appears above the title)</span>
                    </label>
                    <input type="text" name="tagline" id="tagline" value="{{ old('tagline', $hero->tagline) }}"
                        placeholder="e.g., Beachfront · Private · Serene"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>
            </div>

            <!-- Main Title -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Main Title</h2>
                <div class="space-y-4">
                    <div>
                        <label for="title_line_1" class="block text-sm font-medium text-gray-700 mb-2">
                            Title Line 1
                        </label>
                        <input type="text" name="title_line_1" id="title_line_1"
                            value="{{ old('title_line_1', $hero->title_line_1) }}" placeholder="e.g., Your Private"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="title_line_2" class="block text-sm font-medium text-gray-700 mb-2">
                            Title Line 2
                        </label>
                        <input type="text" name="title_line_2" id="title_line_2"
                            value="{{ old('title_line_2', $hero->title_line_2) }}" placeholder="e.g., Paradise Awaits"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="title_accent" class="block text-sm font-medium text-gray-700 mb-2">
                            Title Accent <span class="text-gray-400">(highlighted text)</span>
                        </label>
                        <input type="text" name="title_accent" id="title_accent"
                            value="{{ old('title_accent', $hero->title_accent) }}" placeholder="e.g., in Sri Lanka"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Subtitle -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Subtitle</h2>
                <div>
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                        Subtitle Description
                    </label>
                    <textarea name="subtitle" id="subtitle" rows="3"
                        placeholder="A brief description that appears below the main title"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('subtitle', $hero->subtitle) }}</textarea>
                </div>
            </div>

            <!-- Call to Action Buttons -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Call to Action Buttons</h2>

                <div class="space-y-6">
                    <!-- Primary CTA -->
                    <div class="border-b border-gray-200 pb-6">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Primary Button</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="primary_cta_text" class="block text-sm font-medium text-gray-700 mb-2">
                                    Button Text
                                </label>
                                <input type="text" name="primary_cta_text" id="primary_cta_text"
                                    value="{{ old('primary_cta_text', $hero->primary_cta_text) }}"
                                    placeholder="e.g., Book Your Stay"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="primary_cta_link" class="block text-sm font-medium text-gray-700 mb-2">
                                    Button Link
                                </label>
                                <input type="text" name="primary_cta_link" id="primary_cta_link"
                                    value="{{ old('primary_cta_link', $hero->primary_cta_link) }}"
                                    placeholder="e.g., #booking or https://..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Secondary CTA -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Secondary Button (Optional)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="secondary_cta_text" class="block text-sm font-medium text-gray-700 mb-2">
                                    Button Text
                                </label>
                                <input type="text" name="secondary_cta_text" id="secondary_cta_text"
                                    value="{{ old('secondary_cta_text', $hero->secondary_cta_text) }}"
                                    placeholder="e.g., WhatsApp Us"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="secondary_cta_link" class="block text-sm font-medium text-gray-700 mb-2">
                                    Button Link
                                </label>
                                <input type="text" name="secondary_cta_link" id="secondary_cta_link"
                                    value="{{ old('secondary_cta_link', $hero->secondary_cta_link) }}"
                                    placeholder="e.g., https://wa.me/94771234567"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-900">Active Status</h3>
                        <p class="text-sm text-gray-500 mt-1">Show this hero section on the website</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $hero->is_active) ? 'checked' : '' }} class="sr-only peer">
                        <div
                            class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                        </div>
                    </label>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>

        <form id="remove-image-form" action="{{ route('admin.hero.removeImage') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <form id="remove-video-form" action="{{ route('admin.hero.removeVideo') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-app-layout>