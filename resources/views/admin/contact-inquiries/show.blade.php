<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between mr-3">
            <h1 class="text-2xl font-bold text-gray-900">Inquiry Details</h1>
            <a href="{{ route('admin.contact-inquiries.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 text-sm font-medium rounded-lg transition-colors">
                Back to List
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto">
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
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <div class="mb-6">
                        <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-2">Message</h2>
                        <div
                            class="bg-gray-50 rounded-lg p-6 text-gray-800 whitespace-pre-wrap text-lg leading-relaxed border border-gray-100">
                            {{ $contactInquiry->message }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-6">Contact Information
                    </h2>

                    <div class="space-y-4">
                        <div>
                            <label class="text-xs text-gray-400 font-medium uppercase tracking-wider">Full Name</label>
                            <div class="text-gray-900 font-semibold">{{ $contactInquiry->name }}</div>
                        </div>

                        <div>
                            <label class="text-xs text-gray-400 font-medium uppercase tracking-wider">Email
                                Address</label>
                            <div
                                class="text-gray-900 font-semibold underline decoration-blue-200 decoration-2 underline-offset-2">
                                <a href="mailto:{{ $contactInquiry->email }}">{{ $contactInquiry->email }}</a>
                            </div>
                        </div>

                        <div>
                            <label class="text-xs text-gray-400 font-medium uppercase tracking-wider">Phone
                                Number</label>
                            <div class="text-gray-900 font-semibold">{{ $contactInquiry->phone ?? 'Not provided' }}
                            </div>
                        </div>

                        <div>
                            <label class="text-xs text-gray-400 font-medium uppercase tracking-wider">Date
                                Received</label>
                            <div class="text-gray-900 font-semibold">
                                {{ $contactInquiry->created_at->format('M d, Y H:i:s') }}</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-6">Management</h2>

                    <form action="{{ route('admin.contact-inquiries.update', $contactInquiry) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="status"
                                class="block text-xs text-gray-400 font-medium uppercase tracking-wider mb-2">Status</label>
                            <select name="status" id="status"
                                class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="pending" {{ $contactInquiry->status === 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="read" {{ $contactInquiry->status === 'read' ? 'selected' : '' }}>Read
                                </option>
                                <option value="archived" {{ $contactInquiry->status === 'archived' ? 'selected' : '' }}>
                                    Archived</option>
                            </select>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded-lg transition-colors">
                            Update Status
                        </button>
                    </form>

                    <form action="{{ route('admin.contact-inquiries.destroy', $contactInquiry) }}" method="POST"
                        class="mt-4" onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2 rounded-lg transition-colors border border-red-100">
                            Delete Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>