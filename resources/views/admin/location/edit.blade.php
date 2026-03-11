<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Location Section</h1>
                <p class="text-sm text-gray-500 mt-1">Manage the content of the home page location area.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto py-6">
        @if(session('success'))
            <div class="mb-6 p-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.location.update') }}" method="POST" class="p-6 sm:p-8 space-y-8">
                @csrf
                @method('PUT')

                <!-- Headers Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Header Section</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="label" class="block text-sm font-medium text-gray-700 mb-2">Eyebrow Label <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="label" id="label" value="{{ old('label', $location->label) }}"
                                required
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('label')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Main Title <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="title" id="title" value="{{ old('title', $location->title) }}"
                                required
                                class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                            @error('title')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description Text
                            <span class="text-red-500">*</span></label>
                        <textarea name="description" id="description" rows="3" required
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">{{ old('description', $location->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Google Maps Embed -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Map Embed</h3>
                    <div>
                        <label for="map_embed_url" class="block text-sm font-medium text-gray-700 mb-2">Google Maps
                            Embed iframe source URL (the `src` attribute) <span class="text-red-500">*</span></label>
                        <input type="url" name="map_embed_url" id="map_embed_url"
                            value="{{ old('map_embed_url', $location->map_embed_url) }}" required
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5">
                        <p class="mt-1 text-xs text-gray-500">Go to Google Maps -> Share -> Embed a map -> Copy just the
                            `src="..."` URL from the iframe code.</p>
                        @error('map_embed_url')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Distances Section -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 border-b pb-2">Distance Points</h3>
                    <div class="space-y-6">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <h4 class="font-medium text-sm text-gray-700 mb-3">Item {{ $i }}</h4>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="distance_{{ $i }}_icon"
                                            class="block text-sm font-medium text-gray-700 mb-1">Lucide Icon Name</label>
                                        <input type="text" name="distance_{{ $i }}_icon" id="distance_{{ $i }}_icon"
                                            value="{{ old('distance_' . $i . '_icon', $location->{'distance_' . $i . '_icon'}) }}"
                                            placeholder="e.g. palmtree" class="w-full border-gray-300 rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label for="distance_{{ $i }}_label"
                                            class="block text-sm font-medium text-gray-700 mb-1">Location Name</label>
                                        <input type="text" name="distance_{{ $i }}_label" id="distance_{{ $i }}_label"
                                            value="{{ old('distance_' . $i . '_label', $location->{'distance_' . $i . '_label'}) }}"
                                            placeholder="e.g. Beach" class="w-full border-gray-300 rounded-lg text-sm">
                                    </div>
                                    <div>
                                        <label for="distance_{{ $i }}_value"
                                            class="block text-sm font-medium text-gray-700 mb-1">Distance Value</label>
                                        <input type="text" name="distance_{{ $i }}_value" id="distance_{{ $i }}_value"
                                            value="{{ old('distance_' . $i . '_value', $location->{'distance_' . $i . '_value'}) }}"
                                            placeholder="e.g. 100m walk" class="w-full border-gray-300 rounded-lg text-sm">
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-100 flex items-center justify-end">
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-colors">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>