<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mr-3">
            <h1 class="text-2xl font-bold text-gray-900">Guest Reviews</h1>
            <a href="{{ route('admin.reviews.create') }}"
                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Review
            </a>
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
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Reviewer</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Rating</th>
                            <th class="px-6 py-4 hidden md:table-cell text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Review</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($reviews as $review)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($review->image)
                                            <img src="{{ Storage::url($review->image) }}" class="w-10 h-10 rounded-full object-cover mr-3 border border-gray-200" alt="{{ $review->name }}">
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center mr-3 border border-gray-300">
                                                <span class="text-gray-600 font-medium">{{ substr($review->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="font-semibold text-gray-900">{{ $review->name }}</div>
                                            @if($review->location)
                                                <div class="text-sm text-gray-500">{{ $review->location }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < $review->rating; $i++)
                                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                        @endfor
                                    </div>
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    <p class="truncate max-w-xs xl:max-w-md text-gray-500" title="{{ $review->review }}">
                                        {{ Str::limit($review->review, 60) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button onclick="toggleReviewStatus({{ $review->id }})" 
                                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 status-toggle-{{ $review->id }} {{ $review->is_active ? 'bg-blue-600' : 'bg-gray-200' }}">
                                        <span class="sr-only">Toggle status</span>
                                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $review->is_active ? 'translate-x-6' : 'translate-x-1' }} shadow ring-0"></span>
                                    </button>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="{{ route('admin.reviews.edit', $review) }}" 
                                           class="text-gray-400 hover:text-indigo-600 transition-colors"
                                           title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this review?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-gray-400 hover:text-red-600 transition-colors"
                                                    title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                    <h3 class="text-sm font-medium text-gray-900">No reviews found</h3>
                                    <p class="mt-1 text-sm text-gray-500">Get started by creating a new review.</p>
                                    <div class="mt-6">
                                        <a href="{{ route('admin.reviews.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                            <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                            </svg>
                                            Add Review
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($reviews, 'hasPages') && $reviews->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
    function toggleReviewStatus(reviewId) {
        const toggleBtn = document.querySelector(`.status-toggle-${reviewId}`);
        const toggleKnob = toggleBtn.querySelector('span:nth-child(2)');
        
        // Optimistic UI update
        const isCurrentlyActive = toggleBtn.classList.contains('bg-blue-600');
        
        if (isCurrentlyActive) {
            toggleBtn.classList.replace('bg-blue-600', 'bg-gray-200');
            toggleKnob.classList.replace('translate-x-6', 'translate-x-1');
        } else {
            toggleBtn.classList.replace('bg-gray-200', 'bg-blue-600');
            toggleKnob.classList.replace('translate-x-1', 'translate-x-6');
        }

        fetch(`/admin/reviews/${reviewId}/toggle-status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .catch(error => {
            console.error('Error:', error);
            // Revert UI on failure
            if (isCurrentlyActive) {
                toggleBtn.classList.replace('bg-gray-200', 'bg-blue-600');
                toggleKnob.classList.replace('translate-x-1', 'translate-x-6');
            } else {
                toggleBtn.classList.replace('bg-blue-600', 'bg-gray-200');
                toggleKnob.classList.replace('translate-x-6', 'translate-x-1');
            }
        });
    }
    </script>
</x-app-layout>