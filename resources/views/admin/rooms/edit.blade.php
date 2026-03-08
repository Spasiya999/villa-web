<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold text-gray-900">Edit Room: {{ $room->name }}</h1>
            <a href="{{ route('admin.rooms.show', $room) }}" class="text-sm font-medium text-blue-600 hover:text-blue-800">
                View Room &rarr;
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto">
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

        <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="roomForm()">
            @csrf
            @method('PUT')

            <!-- Basic Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Room Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}"
                            placeholder="e.g., Ocean View Master Suite" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="rate_per_night" class="block text-sm font-medium text-gray-700 mb-2">
                            Rate Per Night (USD)
                        </label>
                        <input type="number" step="0.01" name="rate_per_night" id="rate_per_night" value="{{ old('rate_per_night', $room->rate_per_night) }}"
                            placeholder="e.g., 250.00"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="4" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $room->description) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Capacity Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Bed & Capacity</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="bed_type" class="block text-sm font-medium text-gray-700 mb-2">
                            Bed Type <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="bed_type" id="bed_type" value="{{ old('bed_type', $room->bed_type) }}"
                            placeholder="e.g., King, Queen" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="bed_count" class="block text-sm font-medium text-gray-700 mb-2">
                            Bed Count <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="bed_count" id="bed_count" value="{{ old('bed_count', $room->bed_count) }}" min="1" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="sleeps" class="block text-sm font-medium text-gray-700 mb-2">
                            Sleeps (Max Guests) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="sleeps" id="sleeps" value="{{ old('sleeps', $room->sleeps) }}" min="1" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Image Info -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Media</h2>
                
                @if($room->image_url)
                <div class="mb-4">
                    <p class="text-sm font-medium text-gray-700 mb-2">Current Image Preview</p>
                    <img src="{{ $room->image_url }}" alt="{{ $room->image_alt }}" class="h-48 w-full object-cover rounded-lg border border-gray-200">
                </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                            Room Image <span class="text-gray-400">(leave empty to keep current)</span>
                        </label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="image_alt" class="block text-sm font-medium text-gray-700 mb-2">
                            Image Alt Text <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="image_alt" id="image_alt" value="{{ old('image_alt', $room->image_alt) }}"
                            placeholder="e.g., Ocean view master suite with king bed" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <!-- Amenities -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-1">Amenities</h2>
                <p class="text-sm text-gray-500 mb-4">Add amenities available in this room.</p>
                
                <div class="space-y-3">
                    <template x-for="(amenity, index) in amenities" :key="index">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="amenity.value" :name="`amenities[${index}]`" 
                                placeholder="e.g., Air Conditioning, Ensuite Bathroom"
                                class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button type="button" @click="removeAmenity(index)" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>
                    </template>
                    
                    <button type="button" @click="addAmenity()" class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-800">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Add Amenity
                    </button>
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Settings</h2>
                <div class="space-y-4">
                    <!-- Order -->
                    <div class="max-w-xs">
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                            Display Order
                        </label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $room->sort_order) }}" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <p class="mt-2 text-sm text-gray-500">Lower numbers appear first</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-900">Available Status</h3>
                            <p class="text-sm text-gray-500 mt-1">Show this room as available for booking.</p>
                        </div>
                        <input type="hidden" name="is_available" value="0">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_available" value="1"
                                {{ old('is_available', $room->is_available) ? 'checked' : '' }} class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.rooms.index') }}"
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
                    Update Room
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('roomForm', () => {
                const rawAmenities = {!! json_encode(old('amenities', $room->amenities ?? [])) !!};
                const initAmenities = Array.isArray(rawAmenities) && rawAmenities.length ? rawAmenities : [''];
                const mappedAmenities = initAmenities.map(val => ({ value: val }));

                return {
                    amenities: mappedAmenities,
                    addAmenity() {
                        this.amenities.push({ value: '' });
                    },
                    removeAmenity(index) {
                        if (this.amenities.length > 1) {
                            this.amenities.splice(index, 1);
                        } else {
                            this.amenities[0].value = '';
                        }
                    }
                };
            });
        });
    </script>
    @endpush
</x-app-layout>
