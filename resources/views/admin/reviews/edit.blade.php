<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Edit Review</h1>
                <p class="text-sm text-gray-500 mt-1">Update guest review details.</p>
            </div>
            <a href="{{ route('admin.reviews.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                <svg class="w-5 h-5 mr-2 -ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Reviews
            </a>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.reviews.update', $review) }}" method="POST" enctype="multipart/form-data" class="p-6 sm:p-8 space-y-6">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Guest Name <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $review->name) }}" required
                           class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition-colors">
                    @error('name')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Location -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Guest Location</label>
                    <input type="text" name="location" id="location" value="{{ old('location', $review->location) }}" placeholder="e.g. United Kingdom"
                           class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition-colors">
                    @error('location')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700 mb-2">Rating <span class="text-red-500">*</span></label>
                    <select name="rating" id="rating" required
                            class="w-full sm:w-1/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition-colors">
                        <option value="5" {{ old('rating', $review->rating) == 5 ? 'selected' : '' }}>5 Stars</option>
                        <option value="4" {{ old('rating', $review->rating) == 4 ? 'selected' : '' }}>4 Stars</option>
                        <option value="3" {{ old('rating', $review->rating) == 3 ? 'selected' : '' }}>3 Stars</option>
                        <option value="2" {{ old('rating', $review->rating) == 2 ? 'selected' : '' }}>2 Stars</option>
                        <option value="1" {{ old('rating', $review->rating) == 1 ? 'selected' : '' }}>1 Star</option>
                    </select>
                    @error('rating')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Review Text -->
                <div>
                    <label for="review" class="block text-sm font-medium text-gray-700 mb-2">Review Content <span class="text-red-500">*</span></label>
                    <textarea name="review" id="review" rows="4" required
                              class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 transition-colors">{{ old('review', $review->review) }}</textarea>
                    @error('review')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reviewer Avatar / Image</label>
                    <div class="flex items-start space-x-6">
                        <div class="flex-1">
                            <div class="flex items-center justify-center w-full">
                                <label for="image" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-200">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-600"><span class="font-semibold text-blue-600">Click to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500">SVG, PNG, JPG or WEBP (Max: 2MB)</p>
                                    </div>
                                    <input type="file" name="image" id="image" class="hidden" accept="image/*" onchange="previewImage(this)" />
                                </label>
                            </div>
                            @error('image')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Image Preview -->
                        <div id="imagePreviewContainer" class="{{ $review->image ? '' : 'hidden' }} shrink-0">
                            <p class="text-sm font-medium text-gray-600 mb-2">Preview</p>
                            <div class="relative w-32 h-32 rounded-full overflow-hidden border border-gray-200 bg-gray-50 shadow-sm">
                                <img id="imagePreview" src="{{ $review->image ? Storage::url($review->image) : '' }}" alt="Preview" class="w-full h-full object-cover">
                                <button type="button" onclick="removeImage()" 
                                        class="absolute inset-0 bg-black/50 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Active Status -->
                <div class="flex items-center pt-4">
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" class="sr-only peer" {{ old('is_active', $review->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-500 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                        <span class="ml-3 text-sm font-medium text-gray-700">Set as Active (Visible to public)</span>
                    </label>
                </div>

                <!-- Submit Buttons -->
                <div class="pt-6 border-t border-gray-100 flex items-center justify-end space-x-4">
                    <a href="{{ route('admin.reviews.index') }}" 
                       class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:ring-4 focus:ring-gray-100 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-colors">
                        Update Review
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    function previewImage(input) {
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        const fileInput = document.getElementById('image');
        const previewContainer = document.getElementById('imagePreviewContainer');
        const previewImage = document.getElementById('imagePreview');
        
        fileInput.value = '';
        previewImage.src = '';
        previewContainer.classList.add('hidden');
    }
    </script>
</x-app-layout>