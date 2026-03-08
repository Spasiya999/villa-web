@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-3xl">
        <div class="mb-6">
            <h1 class="text-3xl font-bold">{{ isset($room) ? 'Edit Room' : 'Add New Room' }}</h1>
            <a href="{{ route('admin.rooms.index') }}" class="text-blue-600 hover:underline">&larr; Back to Rooms</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($room) ? route('admin.rooms.update', $room) : route('admin.rooms.store') }}" method="POST"
            class="bg-white shadow-md rounded-lg p-6">
            @csrf
            @if (isset($room))
                @method('PUT')
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="name">
                    Room Name *
                </label>
                <input type="text" name="name" id="name" value="{{ old('name', $room->name ?? '') }}"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="bed_type">
                        Bed Type *
                    </label>
                    <input type="text" name="bed_type" id="bed_type"
                        value="{{ old('bed_type', $room->bed_type ?? '') }}" placeholder="e.g., King Bed, Queen Bed"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="bed_count">
                        Number of Beds *
                    </label>
                    <input type="number" name="bed_count" id="bed_count"
                        value="{{ old('bed_count', $room->bed_count ?? 1) }}" min="1"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="sleeps">
                        Sleeps (Guests) *
                    </label>
                    <input type="number" name="sleeps" id="sleeps" value="{{ old('sleeps', $room->sleeps ?? 2) }}"
                        min="1"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label class="block text-gray-700 font-bold mb-2" for="rate_per_night">
                        Rate Per Night ($)
                    </label>
                    <input type="number" name="rate_per_night" id="rate_per_night"
                        value="{{ old('rate_per_night', $room->rate_per_night ?? '') }}" step="0.01" min="0"
                        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="description">
                    Description *
                </label>
                <textarea name="description" id="description" rows="3"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('description', $room->description ?? '') }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="image_url">
                    Image URL *
                </label>
                <input type="url" name="image_url" id="image_url"
                    value="{{ old('image_url', $room->image_url ?? '') }}"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="image_alt">
                    Image Alt Text *
                </label>
                <input type="text" name="image_alt" id="image_alt"
                    value="{{ old('image_alt', $room->image_alt ?? '') }}"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2" for="sort_order">
                    Sort Order
                </label>
                <input type="number" name="sort_order" id="sort_order"
                    value="{{ old('sort_order', $room->sort_order ?? 0) }}"
                    class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-sm text-gray-600 mt-1">Lower numbers appear first</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">
                    Amenities
                </label>
                <div id="amenities-container">
                    @php
                        $amenities = old('amenities', $room->amenities ?? []);
                    @endphp
                    @forelse($amenities as $index => $amenity)
                        <div class="flex gap-2 mb-2 amenity-row">
                            <input type="text" name="amenities[]" value="{{ $amenity }}"
                                class="flex-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., Ocean View, Private Balcony">
                            <button type="button" onclick="this.parentElement.remove()"
                                class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
                        </div>
                    @empty
                        <div class="flex gap-2 mb-2 amenity-row">
                            <input type="text" name="amenities[]"
                                class="flex-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="e.g., Ocean View, Private Balcony">
                            <button type="button" onclick="this.parentElement.remove()"
                                class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
                        </div>
                    @endforelse
                </div>
                <button type="button" onclick="addAmenity()"
                    class="mt-2 px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    + Add Amenity
                </button>
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="is_available" value="1"
                        {{ old('is_available', $room->is_available ?? true) ? 'checked' : '' }} class="mr-2">
                    <span class="text-gray-700 font-bold">Room is Available</span>
                </label>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                    {{ isset($room) ? 'Update Room' : 'Create Room' }}
                </button>
                <a href="{{ route('admin.rooms.index') }}"
                    class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        function addAmenity() {
            const container = document.getElementById('amenities-container');
            const div = document.createElement('div');
            div.className = 'flex gap-2 mb-2 amenity-row';
            div.innerHTML = `
        <input type="text"
               name="amenities[]"
               class="flex-1 px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
               placeholder="e.g., Ocean View, Private Balcony">
        <button type="button" onclick="this.parentElement.remove()" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Remove</button>
    `;
            container.appendChild(div);
        }
    </script>
@endsection
