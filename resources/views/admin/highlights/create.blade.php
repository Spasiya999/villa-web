<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-bold text-gray-900">Create New Highlight</h1>
    </x-slot>

    <div class="max-w-2xl">
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

        <form action="{{ route('admin.highlights.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Icon -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Icon</h2>
                <div>
                    <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                        Lucide Icon Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="icon" id="icon" value="{{ old('icon') }}"
                        placeholder="e.g., bed-double, waves, wifi, chef-hat" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="mt-2 text-sm text-gray-500">
                        Browse icons at <a href="https://lucide.dev/icons/" target="_blank"
                            class="text-blue-600 hover:underline">lucide.dev/icons</a>
                    </p>
                </div>
            </div>

            <!-- Content -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Content</h2>
                <div class="space-y-4">
                    <!-- Label -->
                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700 mb-2">
                            Label <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="label" id="label" value="{{ old('label') }}"
                            placeholder="e.g., 4 Bedrooms" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <!-- Sublabel -->
                    <div>
                        <label for="sublabel" class="block text-sm font-medium text-gray-700 mb-2">
                            Sublabel <span class="text-gray-400">(optional)</span>
                        </label>
                        <input type="text" name="sublabel" id="sublabel" value="{{ old('sublabel') }}"
                            placeholder="e.g., Sleeps 8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Order & Status -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Settings</h2>
                <div class="space-y-4">
                    <!-- Order -->
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                            Display Order <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="order" id="order" value="{{ old('order', 0) }}" min="0"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-2 text-sm text-gray-500">Lower numbers appear first</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Active Status</h3>
                            <p class="text-sm text-gray-500 mt-1">Show this highlight on the website</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.highlights.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Create Highlight
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
