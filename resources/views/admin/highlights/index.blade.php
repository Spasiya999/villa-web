<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mr-3">
            <h1 class="text-2xl font-bold text-gray-900">Manage Highlights</h1>
            <a href="{{ route('admin.highlights.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Highlight
            </a>
        </div>
    </x-slot>

    <div class="max-w-6xl">
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

        <!-- Highlights List -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-lg font-bold text-gray-900">All Highlights</h2>
                <p class="text-sm text-gray-600 mt-1">Drag to reorder, click to edit</p>
            </div>

            @if ($highlights->count() > 0)
                <div class="p-6">
                    <div class="space-y-3" id="highlights-list">
                        @foreach ($highlights as $highlight)
                            <div class="highlight-item flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors cursor-move"
                                data-id="{{ $highlight->id }}">
                                <div class="flex items-center space-x-4">
                                    <!-- Drag Handle -->
                                    <div class="drag-handle cursor-move">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 8h16M4 16h16" />
                                        </svg>
                                    </div>

                                    <!-- Icon Preview -->
                                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i data-lucide="{{ $highlight->icon }}" class="w-6 h-6 text-blue-600"></i>
                                    </div>

                                    <!-- Content -->
                                    <div>
                                        <p class="font-semibold text-gray-900">{{ $highlight->label }}</p>
                                        @if ($highlight->sublabel)
                                            <p class="text-sm text-gray-600">{{ $highlight->sublabel }}</p>
                                        @endif
                                    </div>
                                </div>

                                <div class="flex items-center space-x-3">
                                    <!-- Status Badge -->
                                    @if ($highlight->is_active)
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                            Active
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-semibold text-gray-700 bg-gray-100 rounded-full">
                                            Inactive
                                        </span>
                                    @endif

                                    <!-- Order -->
                                    <span class="text-sm text-gray-500">Order: {{ $highlight->order }}</span>

                                    <!-- Actions -->
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.highlights.edit', $highlight) }}"
                                            class="text-blue-600 hover:text-blue-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.highlights.destroy', $highlight) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this highlight?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="p-12 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No highlights yet</h3>
                    <p class="text-gray-600 mb-6">Get started by creating your first highlight</p>
                    <a href="{{ route('admin.highlights.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        </svg>
                        Add Your First Highlight
                    </a>
                </div>
            @endif
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('dashboard') }}"
                class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const el = document.getElementById('highlights-list');
                if (el) {
                    const sortable = Sortable.create(el, {
                        animation: 150,
                        handle: '.drag-handle',
                        onEnd: function(evt) {
                            const items = [];
                            document.querySelectorAll('.highlight-item').forEach((item, index) => {
                                items.push({
                                    id: item.dataset.id,
                                    order: index
                                });
                            });

                            fetch('{{ route('admin.highlights.updateOrder') }}', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        highlights: items
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        console.log('Order updated successfully');
                                    }
                                });
                        }
                    });
                }
            });
        </script>
    @endpush
</x-app-layout>
