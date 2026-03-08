<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-900">General Settings</h1>
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

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Branding Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Site Branding</h2>

                <div class="space-y-6">
                    <!-- Site Logo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Global Site Logo
                        </label>

                        @if(isset($settings['site_logo']) && $settings['site_logo'])
                            <div class="mb-4 bg-gray-50 p-4 rounded-lg inline-block border border-gray-200">
                                <img src="{{ $settings['site_logo'] }}" alt="Current Logo" class="h-12 object-contain mb-3">
                                
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="remove_logo" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-red-600">Remove current logo entirely</span>
                                </label>
                            </div>
                        @else
                            <div class="mb-4 text-sm text-gray-500 italic">No custom logo uploaded yet. Defaults to text.
                            </div>
                        @endif

                        <input type="file" name="site_logo" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        <p class="mt-2 text-xs text-gray-500">Recommended dimension: Transparent PNG/SVG, max height
                            60px. Max size: 5MB.</p>
                        @error('site_logo') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <!-- App / Site Name and Visibility -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Site Name / Brand
                            </label>
                            <input type="text" name="site_name" id="site_name"
                                value="{{ old('site_name', $settings['site_name'] ?? 'Villa Lanka') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('site_name') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Display Logo in Navbars?</label>
                            <div class="flex items-center mt-3">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="show_logo" value="1"
                                        {{ old('show_logo', $settings['show_logo'] ?? '1') == '1' ? 'checked' : '' }} class="sr-only peer">
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                    </div>
                                    <span class="ml-3 text-sm font-medium text-gray-700">Visible</span>
                                </label>
                            </div>
                            <p class="mt-2 text-xs text-gray-500">Enable to show the image logo. If disabled or no logo is uploaded, text is shown.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- General Info Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Business Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">
                            Contact Email
                        </label>
                        <input type="email" name="contact_email" id="contact_email"
                            value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                            placeholder="info@villalanka.com"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('contact_email') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">
                            Contact Phone
                        </label>
                        <input type="text" name="contact_phone" id="contact_phone"
                            value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                            placeholder="+94 77 123 4567"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('contact_phone') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Short Description / SEO Meta
                        </label>
                        <textarea name="site_description" id="site_description" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                        @error('site_description') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
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
                    Save All Settings
                </button>
            </div>
        </form>
    </div>
</x-app-layout>