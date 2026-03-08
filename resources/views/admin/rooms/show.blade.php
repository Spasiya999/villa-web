<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.rooms.index') }}" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Room Details</h1>
            </div>
            <div class="flex items-center space-x-3">
                <a href="{{ route('admin.rooms.edit', $room) }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline"
                    onsubmit="return confirm('Are you sure you want to delete this room?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
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

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Room Header & Image -->
            <div class="relative h-64 sm:h-80 md:h-96 w-full">
                <img src="{{ $room->image_url }}" alt="{{ $room->image_alt }}"
                    class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/40 to-transparent"></div>
                <div class="absolute bottom-0 left-0 right-0 p-6 md:p-8">
                    <div class="flex items-end justify-between">
                        <div>
                            <div class="flex items-center space-x-3 mb-2">
                                <span
                                    class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $room->is_available ? 'bg-green-500/20 text-green-100 border border-green-500/30' : 'bg-red-500/20 text-red-100 border border-red-500/30' }}">
                                    {{ $room->is_available ? 'Available' : 'Unavailable' }}
                                </span>
                                <span class="text-gray-300 text-sm">Sort Order: {{ $room->sort_order }}</span>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-white">{{ $room->name }}</h2>
                            <p class="text-gray-300 mt-2 max-w-2xl">{{ $room->slug }}</p>
                        </div>
                        <div class="hidden sm:block text-right">
                            <span class="block text-sm text-gray-300 font-medium tracking-wide uppercase">Rate per
                                night</span>
                            <span class="block text-3xl font-bold text-white">{{ $room->formatted_rate }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Rate -->
            <div class="sm:hidden px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                <span class="text-sm text-gray-500 font-medium uppercase tracking-wide">Rate per night</span>
                <span class="text-xl font-bold text-gray-900">{{ $room->formatted_rate }}</span>
            </div>

            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 md:gap-12">

                    <!-- Left Column: Details -->
                    <div class="lg:col-span-2 space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-2 mb-4">Description
                            </h3>
                            <div class="prose prose-sm xl:prose-base text-gray-600">
                                {!! nl2br(e($room->description)) !!}
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-2 mb-4">Capacity &
                                Bedding</h3>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6">
                                <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-4">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 uppercase font-semibold">Sleeps</div>
                                        <div class="text-lg font-bold text-gray-900">{{ $room->sleeps }} Guests</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-4">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 uppercase font-semibold">Bed Type</div>
                                        <div class="text-lg font-bold text-gray-900">{{ $room->bed_type }}</div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-4">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="text-xs text-gray-500 uppercase font-semibold">Count</div>
                                        <div class="text-lg font-bold text-gray-900">{{ $room->bed_count }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Amenities & Meta -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-2 mb-4">Amenities
                            </h3>
                            @if($room->amenities && count(array_filter($room->amenities)) > 0)
                                <ul class="space-y-3">
                                    @foreach(array_filter($room->amenities) as $amenity)
                                        <li class="flex items-center text-gray-700">
                                            <svg class="w-5 h-5 text-green-500 mr-3 shrink-0" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            {{ $amenity }}
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-500 italic">No amenities listed.</p>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-2 mb-4">Image
                                Information</h3>
                            <div class="bg-gray-50 rounded-xl p-4">
                                <p class="text-sm font-semibold text-gray-700 mb-1">Alt Text</p>
                                <p class="text-sm text-gray-600 mb-3">{{ $room->image_alt ?: 'Not set' }}</p>

                                <p class="text-sm font-semibold text-gray-700 mb-1">URL</p>
                                <a href="{{ $room->image_url }}" target="_blank"
                                    class="text-sm text-blue-600 hover:text-blue-800 break-all underline decoration-blue-300 underline-offset-2">
                                    {{ $room->image_url }}
                                </a>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-gray-900 border-b border-gray-200 pb-2 mb-4">Metadata</h3>
                            <ul class="text-sm text-gray-600 space-y-2">
                                <li class="flex justify-between">
                                    <span class="font-medium text-gray-900">Created:</span>
                                    <span>{{ $room->created_at->format('M d, Y h:i A') }}</span>
                                </li>
                                <li class="flex justify-between">
                                    <span class="font-medium text-gray-900">Last Updated:</span>
                                    <span>{{ $room->updated_at->format('M d, Y h:i A') }}</span>
                                </li>
                            </ul>
                        </div>

                        <div class="pt-4 border-t border-gray-200">
                            <form action="{{ route('admin.rooms.toggle-availability', $room) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white {{ $room->is_available ? 'bg-orange-600 hover:bg-orange-700 focus:ring-orange-500' : 'bg-green-600 hover:bg-green-700 focus:ring-green-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2">
                                    {{ $room->is_available ? 'Mark as Unavailable' : 'Mark as Available' }}
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>