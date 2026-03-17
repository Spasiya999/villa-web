<!-- Sidebar -->
<aside
    class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-slate-900 to-slate-800 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-6 bg-slate-900/50">
        @php
            $siteLogo = \App\Models\Setting::get('site_logo');
            $siteName = \App\Models\Setting::get('site_name', 'Villa Admin');
            $showLogo = \App\Models\Setting::get('show_logo', '1');
        @endphp

        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
            @if($siteLogo && $showLogo === '1')
                <img src="{{ $siteLogo }}" alt="{{ $siteName }}" class="h-8 max-w-[120px] object-contain">
            @else
                <div
                    class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
            @endif
            <span class="text-xl font-bold text-white hidden sm:block">{{ $siteName }}</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="px-4 py-6 space-y-2 overflow-y-auto h-[calc(100vh-4rem)]">
        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Dashboard
        </a>

        <!-- Content Management -->
        <div class="pt-2 pb-2">
            <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">Content</p>
        </div>

        <!-- Hero Section -->
        <a href="{{ route('admin.hero.edit') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.hero.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Hero Section
        </a>

        <!-- About Villa -->
        <a href="{{ route('admin.about.edit') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.about.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            About Villa
        </a>

        <!-- Highlights -->
        <a href="{{ route('admin.highlights.index') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.highlights.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
            </svg>
            Highlights
        </a>

        <!-- Rooms -->
        <a href="{{ route('admin.rooms.index') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.rooms.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Rooms
        </a>

        <!-- Gallery -->
        <a href="{{ route('admin.galleries.index') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.galleries.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Gallery
        </a>

        <!-- Reviews -->
        <a href="{{ route('admin.reviews.index') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.reviews.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
            Reviews
        </a>

        <!-- Location -->
        <a href="{{ route('admin.location.edit') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.location.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            Location
        </a>

        <!-- Contact Inquiries -->
        <a href="{{ route('admin.contact-inquiries.index') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.contact-inquiries.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            Contact Inquiries
        </a>

        <!-- Social Links -->
        <a href="{{ route('admin.social-links.index') }}"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200 {{ request()->routeIs('admin.social-links.*') ? 'bg-slate-700 text-white' : '' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
            </svg>
            Social Links
        </a>

        <!-- Settings -->
        <div x-data="{ open: false }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Settings
                </div>
                <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div x-show="open" x-collapse class="ml-4 mt-2 space-y-2">
                <a href="{{ route('admin.settings.edit') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'text-white bg-slate-700/50' : 'text-gray-400 hover:text-white hover:bg-slate-700/30' }}">
                    General Settings
                </a>
                <a href="{{ route('admin.seo.edit') }}"
                    class="flex items-center px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('admin.seo.*') ? 'text-white bg-slate-700/50' : 'text-gray-400 hover:text-white hover:bg-slate-700/30' }}">
                    SEO Settings
                </a>
            </div>
        </div>

        <!-- View Website -->
        <a href="{{ url('/') }}" target="_blank"
            class="flex items-center px-4 py-3 text-gray-300 hover:bg-slate-700/50 hover:text-white rounded-lg transition-all duration-200">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            View Website
        </a>
    </nav>
</aside>