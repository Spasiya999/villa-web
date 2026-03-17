<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-2">
            <a href="{{ route('admin.social-links.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="text-2xl font-bold text-gray-900">Add New Social Link</h1>
        </div>
    </x-slot>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <form action="{{ route('admin.social-links.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Platform Name -->
                    <div>
                        <label for="platform" class="block text-sm font-medium text-gray-700 mb-2">Platform Name</label>
                        <input type="text" name="platform" id="platform" value="{{ old('platform') }}"
                            placeholder="e.g. Facebook" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('platform') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Icon Selector -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                        <select name="icon" id="icon" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Select an icon</option>
                            <option value="facebook" {{ old('icon') == 'facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="instagram" {{ old('icon') == 'instagram' ? 'selected' : '' }}>Instagram
                            </option>
                            <option value="twitter" {{ old('icon') == 'twitter' ? 'selected' : '' }}>Twitter / X</option>
                            <option value="youtube" {{ old('icon') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                            <option value="linkedin" {{ old('icon') == 'linkedin' ? 'selected' : '' }}>LinkedIn</option>
                            <option value="github" {{ old('icon') == 'github' ? 'selected' : '' }}>GitHub</option>
                            <option value="message-circle" {{ old('icon') == 'message-circle' ? 'selected' : '' }}>
                                WhatsApp / Message</option>
                            <option value="mail" {{ old('icon') == 'mail' ? 'selected' : '' }}>Email</option>
                            <option value="phone" {{ old('icon') == 'phone' ? 'selected' : '' }}>Phone</option>
                            <option value="globe" {{ old('icon') == 'globe' ? 'selected' : '' }}>Website</option>
                        </select>
                        @error('icon') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- URL -->
                <div>
                    <label for="url" class="block text-sm font-medium text-gray-700 mb-2">Link URL</label>
                    <input type="url" name="url" id="url" value="{{ old('url') }}" placeholder="https://..." required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('url') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Sort Order -->
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        @error('sort_order') <p class="mt-1 text-sm text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Active Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Display Status</label>
                        <div class="flex items-center mt-3">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                                </div>
                                <span class="ml-3 text-sm font-medium text-gray-700">Show on Website</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-3 pt-4">
                    <a href="{{ route('admin.social-links.index') }}"
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Cancel</a>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors shadow-sm">
                        Create Social Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>