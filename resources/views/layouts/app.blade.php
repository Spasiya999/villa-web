<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false }" x-cloak>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fonts/figtree.css') }}" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="{{ asset('vendor/alpinejs/alpine.min.js') }}"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        @include('layouts.navigation')

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-40 bg-gray-900/50 lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-h-screen">
            <!-- Top Navigation Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-30">
                <div class="flex items-center justify-between px-4 py-4 sm:px-6 lg:px-8">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = true" class="lg:hidden text-gray-600 hover:text-gray-900">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Breadcrumbs -->
                    @isset($header)
                        <div class="flex-1 lg:ml-0 ml-4">
                            <nav class="flex text-sm" aria-label="Breadcrumb">
                                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                                    <li class="inline-flex items-center">
                                        <a href="{{ route('dashboard') }}" class="text-gray-500 hover:text-gray-700">
                                            Admin
                                        </a>
                                    </li>
                                    @foreach(request()->segments() as $segment)
                                        @if($segment !== 'admin')
                                            <li>
                                                <div class="flex items-center">
                                                    <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span
                                                        class="text-gray-700 font-medium capitalize">{{ str_replace('-', ' ', $segment) }}</span>
                                                </div>
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            </nav>
                            <div class="mt-1">
                                {{ $header }}
                            </div>
                        </div>
                    @endisset

                    <!-- Right Side Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Notifications -->
                        @php
                            $pendingInquiriesCount = \App\Models\ContactInquiry::where('status', 'pending')->count();
                            $recentInquiries = \App\Models\ContactInquiry::where('status', 'pending')->latest()->take(5)->get();
                        @endphp
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="relative text-gray-600 hover:text-gray-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                                @if($pendingInquiriesCount > 0)
                                    <span
                                        class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white ring-2 ring-white">
                                        {{ $pendingInquiriesCount }}
                                    </span>
                                @endif
                            </button>

                            <!-- Notification Dropdown -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg py-2 z-50 ring-1 ring-black ring-opacity-5">
                                <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                                    <h3 class="text-sm font-semibold text-gray-900">New Inquiries</h3>
                                    <span class="text-xs text-gray-500">{{ $pendingInquiriesCount }} pending</span>
                                </div>
                                <div class="max-h-96 overflow-y-auto">
                                    @forelse($recentInquiries as $inquiry)
                                        <a href="{{ route('admin.contact-inquiries.show', $inquiry) }}"
                                            class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50 last:border-0">
                                            <div class="flex items-center">
                                                <div
                                                    class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center text-blue-600">
                                                    <i data-lucide="mail" class="w-4 h-4"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-gray-900">{{ $inquiry->name }}</p>
                                                    <p class="text-xs text-gray-500 truncate w-48">
                                                        {{ Str::limit($inquiry->message, 40) }}</p>
                                                    <p class="text-[10px] text-gray-400 mt-0.5">
                                                        {{ $inquiry->created_at->diffForHumans() }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="px-4 py-6 text-center">
                                            <p class="text-sm text-gray-500">No new inquiries</p>
                                        </div>
                                    @endforelse
                                </div>
                                @if($pendingInquiriesCount > 0)
                                    <div class="px-4 py-2 border-t border-gray-100 bg-gray-50">
                                        <a href="{{ route('admin.contact-inquiries.index') }}"
                                            class="text-xs font-medium text-blue-600 hover:text-blue-700 block text-center">
                                            View all inquiries
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- User Profile -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-2">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=3b82f6&color=fff"
                                    alt="{{ auth()->user()->name }}"
                                    class="w-8 h-8 rounded-full border border-gray-200">
                                <div class="hidden sm:block text-left">
                                    <p class="text-xs font-semibold text-gray-900 leading-none">
                                        {{ auth()->user()->name }}</p>
                                    <p class="text-[10px] text-gray-500 leading-none mt-1">Administrator</p>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 hidden sm:block" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Profile Dropdown -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 z-50">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                {{ $slot }}
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4 px-4 sm:px-6 lg:px-8">
                <div class="flex flex-col sm:flex-row justify-between items-center text-sm text-gray-600">
                    <p>&copy; {{ date('Y') }} Villa Admin. All rights reserved.</p>
                    <div class="flex space-x-4 mt-2 sm:mt-0">
                        <a href="#" class="hover:text-gray-900">Privacy</a>
                        <a href="#" class="hover:text-gray-900">Terms</a>
                        <a href="#" class="hover:text-gray-900">Support</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    @stack('scripts')
</body>

</html>