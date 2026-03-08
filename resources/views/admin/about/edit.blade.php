<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mr-3">
            <h1 class="text-2xl font-bold text-gray-900">Edit About Villa Section</h1>
            <a href="{{ url('/') }}" target="_blank"
                class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg transition-colors">
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
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

        <form action="{{ route('admin.about.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Main Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Main Content</h2>

                <div class="space-y-4">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Section Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="title" id="title" value="{{ old('title', $about->title) }}"
                            placeholder="e.g., About Our Villa" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Subtitle -->
                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                            Subtitle <span class="text-gray-400">(optional tagline)</span>
                        </label>
                        <input type="text" name="subtitle" id="subtitle"
                            value="{{ old('subtitle', $about->subtitle) }}"
                            placeholder="e.g., Your Beachfront Sanctuary"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="6" required
                            placeholder="Write a compelling description about your villa..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $about->description) }}</textarea>
                        <p class="mt-2 text-sm text-gray-500">Maximum 2000 characters</p>
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Images</h2>

                <div class="space-y-6">
                    <!-- Main Image -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Main Image</h3>
                        @if ($about->main_image)
                            <div class="relative mb-4">
                                <img src="{{ Storage::url($about->main_image) }}" alt="Main Image"
                                    class="w-full h-64 object-cover rounded-lg">
                                <button type="button"
                                    onclick="if(confirm('Are you sure you want to remove this image?')) { document.getElementById('remove-main-image-form').submit(); }"
                                    class="absolute top-4 right-4 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                    Remove Image
                                </button>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $about->main_image ? 'Change Main Image' : 'Upload Main Image' }}
                            </label>
                            <input type="file" name="main_image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-sm text-gray-500">Recommended size: 1200x800px. Max: 5MB</p>
                        </div>
                    </div>

                    <!-- Secondary Image -->
                    <div class="pt-6 border-t border-gray-200 hidden">
                        <h3 class="text-sm font-semibold text-gray-700 mb-3">Secondary Image <span
                                class="text-gray-400">(optional)</span></h3>
                        @if ($about->secondary_image)
                            <div class="relative mb-4">
                                <img src="{{ Storage::url($about->secondary_image) }}" alt="Secondary Image"
                                    class="w-full h-64 object-cover rounded-lg">
                                <button type="button"
                                    onclick="if(confirm('Are you sure you want to remove this image?')) { document.getElementById('remove-secondary-image-form').submit(); }"
                                    class="absolute top-4 right-4 bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                    Remove Image
                                </button>
                            </div>
                        @endif

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ $about->secondary_image ? 'Change Secondary Image' : 'Upload Secondary Image' }}
                            </label>
                            <input type="file" name="secondary_image" accept="image/*"
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="mt-2 text-sm text-gray-500">Recommended size: 1200x800px. Max: 5MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hidden">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Key Features</h2>
                <p class="text-sm text-gray-600 mb-6">Highlight the main features of your villa (all optional)</p>

                <div class="space-y-6">
                    <!-- Feature 1 -->
                    <div class="pb-6 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Feature 1</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="feature_1_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Title
                                </label>
                                <input type="text" name="feature_1_title" id="feature_1_title"
                                    value="{{ old('feature_1_title', $about->feature_1_title) }}"
                                    placeholder="e.g., Beachfront Paradise"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="feature_1_description"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <input type="text" name="feature_1_description" id="feature_1_description"
                                    value="{{ old('feature_1_description', $about->feature_1_description) }}"
                                    placeholder="Brief description..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="pb-6 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Feature 2</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="feature_2_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Title
                                </label>
                                <input type="text" name="feature_2_title" id="feature_2_title"
                                    value="{{ old('feature_2_title', $about->feature_2_title) }}"
                                    placeholder="e.g., Luxury Amenities"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="feature_2_description"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <input type="text" name="feature_2_description" id="feature_2_description"
                                    value="{{ old('feature_2_description', $about->feature_2_description) }}"
                                    placeholder="Brief description..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="pb-6 border-b border-gray-200">
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Feature 3</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="feature_3_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Title
                                </label>
                                <input type="text" name="feature_3_title" id="feature_3_title"
                                    value="{{ old('feature_3_title', $about->feature_3_title) }}"
                                    placeholder="e.g., Perfect Location"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="feature_3_description"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <input type="text" name="feature_3_description" id="feature_3_description"
                                    value="{{ old('feature_3_description', $about->feature_3_description) }}"
                                    placeholder="Brief description..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>

                    <!-- Feature 4 -->
                    <div>
                        <h3 class="text-sm font-semibold text-gray-700 mb-4">Feature 4</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="feature_4_title" class="block text-sm font-medium text-gray-700 mb-2">
                                    Title
                                </label>
                                <input type="text" name="feature_4_title" id="feature_4_title"
                                    value="{{ old('feature_4_title', $about->feature_4_title) }}"
                                    placeholder="e.g., Personalized Service"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="feature_4_description"
                                    class="block text-sm font-medium text-gray-700 mb-2">
                                    Description
                                </label>
                                <input type="text" name="feature_4_description" id="feature_4_description"
                                    value="{{ old('feature_4_description', $about->feature_4_description) }}"
                                    placeholder="Brief description..."
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
                        <p class="text-sm text-gray-500 mt-1">Show this section on the website</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $about->is_active) ? 'checked' : '' }} class="sr-only peer">
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

        <!-- Hidden forms for image removal -->
        <form id="remove-main-image-form" action="{{ route('admin.about.removeMainImage') }}" method="POST"
            class="hidden">
            @csrf
            @method('DELETE')
        </form>

        <form id="remove-secondary-image-form" action="{{ route('admin.about.removeSecondaryImage') }}"
            method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</x-app-layout>
