<nav x-data="{ open: false }" class="fixed inset-y-0 left-0 w-64 bg-white border-r border-green-100 shadow-xl transform -translate-x-full lg:translate-x-0 transition-transform duration-300 ease-in-out z-50 flex flex-col">

    <!-- Sidebar Content -->
    <div class="flex-1 flex flex-col min-h-0">
        
        <!-- Logo Header -->
        <div class="flex items-center h-16 px-6 border-b border-green-100 bg-gradient-to-r from-green-50 to-emerald-50/50">
            <a href="{{ route('home') }}" class="flex items-center group">
                <x-application-logo class="block h-8 w-auto text-green-600 group-hover:scale-105 transition-transform duration-300" />
                <span class="ml-3 text-lg font-bold bg-gradient-to-r from-green-600 to-emerald-700 bg-clip-text text-transparent">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>
        </div>

        <!-- Navigation -->
        <div class="flex-1 overflow-y-auto py-4">
            <nav class="px-3 space-y-1">
                
                <!-- Dashboard -->
                <a href="{{ route('home') }}" 
                   class="{{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                    <svg class="mr-3 h-5 w-5 {{ request()->routeIs('dashboard') || request()->routeIs('home') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5h.01M12 5h.01M16 5h.01M5 12h14" />
                    </svg>
                    Dashboard
                </a>

                <!-- Admin Section -->
                @can('is-admin')
                    <div class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Admin Panel</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('admin.manajemen.index') }}" 
                               class="{{ request()->routeIs('admin.manajemen.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.manajemen.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Akun & Kelas
                            </a>
                            <a href="{{ route('admin.proyek.index') }}" 
                               class="{{ request()->routeIs('admin.proyek.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.proyek.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Proyek
                            </a>
                            <a href="{{ route('admin.lms.index') }}" 
                               class="{{ request()->routeIs('admin.lms.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('admin.lms.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                </svg>
                                LMS
                            </a>
                        </div>
                    </div>
                @endcan

                <!-- Guru Section -->
                @can('is-guru')
                    <div class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Guru Panel</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('guru.proyek.index') }}" 
                               class="{{ request()->routeIs('guru.proyek.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('guru.proyek.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Proyek Saya
                            </a>
                            <a href="{{ route('guru.rubrik.index') }}" 
                               class="{{ request()->routeIs('guru.rubrik.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('guru.rubrik.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Rubrik
                            </a>
                            <a href="{{ route('guru.lms.index') }}" 
                               class="{{ request()->routeIs('guru.lms.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('guru.lms.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                </svg>
                                LMS
                            </a>
                        </div>
                    </div>
                @endcan

                <!-- Siswa Section -->
                @can('is-siswa')
                    <div class="mt-6">
                        <h3 class="px-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Siswa Panel</h3>
                        <div class="mt-2 space-y-1">
                            <a href="{{ route('siswa.proyek.index') }}" 
                               class="{{ request()->routeIs('siswa.proyek.index') || request()->routeIs('siswa.proyek.show') || request()->routeIs('siswa.proyek.enroll') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('siswa.proyek.index') || request()->routeIs('siswa.proyek.show') || request()->routeIs('siswa.proyek.enroll') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                </svg>
                                Daftar Proyek
                            </a>
                            <a href="{{ route('siswa.proyek.myProjects') }}" 
                               class="{{ request()->routeIs('siswa.proyek.myProjects') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('siswa.proyek.myProjects') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Proyek Saya
                            </a>
                            <a href="{{ route('siswa.lms.index') }}" 
                               class="{{ request()->routeIs('siswa.lms.index') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('siswa.lms.index') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253z" />
                                </svg>
                                Materi Belajar
                            </a>
                            <a href="{{ route('siswa.lms.bookmarks') }}" 
                               class="{{ request()->routeIs('siswa.lms.bookmarks') ? 'bg-green-50 text-green-800 border-r-2 border-green-500' : 'text-gray-700 hover:bg-green-50 hover:text-green-800' }} group flex items-center px-3 py-2.5 text-sm font-medium rounded-lg transition-all duration-200">
                                <svg class="mr-3 h-5 w-5 {{ request()->routeIs('siswa.lms.bookmarks') ? 'text-green-600' : 'text-gray-400 group-hover:text-green-600' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                Materi Tersimpan
                            </a>
                        </div>
                    </div>
                @endcan
            </nav>
        </div>
    </div>

    <!-- User Profile Footer -->
    <div class="border-t border-green-100 p-4 bg-gray-50/50">
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white font-semibold text-sm shadow-sm">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" 
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-gray-400 hover:text-red-500 p-1.5 rounded-full hover:bg-red-50 transition-all duration-200 group">
                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Mobile Overlay -->
<div class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-40 transition-opacity duration-300 ease-in-out" 
     x-show="open" 
     x-transition:enter="transition-opacity duration-300" 
     x-transition:enter-start="opacity-0" 
     x-transition:enter-end="opacity-100" 
     x-transition:leave="transition-opacity duration-300" 
     x-transition:leave-start="opacity-100" 
     x-transition:leave-end="opacity-0" 
     @click="open = false">
</div>

<!-- Mobile Menu Button -->
<button @click="open = true" 
        class="lg:hidden fixed top-4 left-4 p-2.5 rounded-lg text-green-600 bg-white hover:bg-green-50 hover:text-green-700 shadow-md focus:outline-none z-50 transition-all duration-300 group">
    <svg class="h-6 w-6 group-hover:rotate-90 transition-transform duration-300" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>