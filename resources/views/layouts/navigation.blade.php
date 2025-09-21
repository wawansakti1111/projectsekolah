<nav x-data="{ open: false }" class="fixed inset-y-0 left-0 w-64 bg-gray-100 text-gray-800 shadow-lg transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out z-50">

    <div class="h-full flex flex-col justify-between">
        <div class="flex-1 overflow-y-auto">
            <div class="shrink-0 flex items-center px-4 py-6 border-b border-gray-200">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
                <span class="ml-2 text-xl font-semibold text-gray-900">{{ config('app.name', 'Laravel') }}</span>
            </div>

            <div class="space-y-2 mt-4 px-4">
                <x-nav-link :href="route('home')" :active="request()->routeIs('dashboard') || request()->routeIs('home')" class="block w-full text-left">
                    {{ __('Dashboard') }}
                </x-nav-link>

                @can('is-admin')
                    <x-nav-link :href="route('admin.manajemen.index')" :active="request()->routeIs('admin.manajemen.index')" class="block w-full text-left">
                        {{ __('Akun & Kelas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.proyek.index')" :active="request()->routeIs('admin.proyek.index')" class="block w-full text-left">
                        {{ __('Proyek') }}
                    </x-nav-link>
                    <x-nav-link :href="route('admin.lms.index')" :active="request()->routeIs('admin.lms.index')" class="block w-full text-left">
                        {{ __('LMS') }}
                    </x-nav-link>
                @endcan

                @can('is-guru')
                    <x-nav-link :href="route('guru.proyek.index')" :active="request()->routeIs('guru.proyek.index')" class="block w-full text-left">
                        {{ __('Proyek Saya') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.rubrik.index')" :active="request()->routeIs('guru.rubrik.index')" class="block w-full text-left">
                        {{ __('Rubrik') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.lms.index')" :active="request()->routeIs('guru.lms.index')" class="block w-full text-left">
                        {{ __('LMS') }}
                    </x-nav-link>
                    <!--<x-nav-link :href="route('guru.quiz.index')" :active="request()->routeIs('guru.quiz.index')" class="block w-full text-left">
                        {{ __('Kuis') }}
                    </x-nav-link>-->
                @endcan

                @can('is-siswa')
                    <x-nav-link :href="route('siswa.proyek.index')" :active="request()->routeIs('siswa.proyek.index') || request()->routeIs('siswa.proyek.show') || request()->routeIs('siswa.proyek.enroll')" class="block w-full text-left">
                        {{ __('Daftar Proyek') }}
                    </x-nav-link>
                    <x-nav-link :href="route('siswa.proyek.myProjects')" :active="request()->routeIs('siswa.proyek.myProjects')" class="block w-full text-left">
                        {{ __('Proyek Saya') }}
                    </x-nav-link>
                    <x-nav-link :href="route('siswa.lms.index')" :active="request()->routeIs('siswa.lms.index')" class="block w-full text-left">
                        {{ __('Materi Belajar') }}
                    </x-nav-link>
                    <x-nav-link :href="route('siswa.lms.bookmarks')" :active="request()->routeIs('siswa.lms.bookmarks')" class="block w-full text-left">
                        {{ __('Materi Tersimpan') }}
                    </x-nav-link>
<!--                    <x-nav-link :href="route('siswa.quiz.index')" :active="request()->routeIs('siswa.quiz.index')" class="block w-full text-left">
                        {{ __('Kuis') }}
                    </x-nav-link>-->
                @endcan
            </div>
        </div>

        <div class="p-4 border-t border-gray-200">
            <div class="flex items-center space-x-2">
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8 rounded-full text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.156 0 7.749 1.545 10.158 3.996l1.838 1.997zm-14-6.5a6.5 6.5 0 100-13 6.5 6.5 0 000 13z"></path>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="font-medium text-gray-800 truncate">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-600 truncate">{{ Auth::user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();" class="block text-left text-gray-600 hover:text-gray-900 transition duration-200">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
        </div>
    </div>
</nav>

<div class="lg:hidden fixed inset-0 bg-gray-900 bg-opacity-75 z-40 transition-opacity duration-200 ease-in-out" x-show="open" x-transition.opacity.duration.200ms @click="open = false"></div>
<button @click="open = true" class="lg:hidden fixed top-4 left-4 p-3 rounded-md text-gray-500 bg-white hover:text-gray-700 hover:bg-gray-100 focus:outline-none z-50">
    <svg class="h-8 w-8" stroke="currentColor" fill="none" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
    </svg>
</button>
