{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Panel</title>
    <link rel="icon" type="image/png" href="{{ asset('images/profile.jpg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tiny.cloud/1/dzidaxtxrn6a2cgls7wf067g6foa5l8vw2snpqxxz74ccpxo/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <style>
        /* Menggunakan style tag untuk memastikan font Inter menjadi default */
        body {
            font-family: 'Inter', sans-serif;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-slate-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm">
            {{-- Container utama navigasi dengan padding responsif --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Brand -->
                        <div class="shrink-0 flex items-center">
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="flex items-center space-x-3">
                                    <span class="text-lg font-semibold text-slate-800 sm:inline">Admin Panel</span>
                                </div>
                            </a>
                        </div>

                        <!-- Desktop Navigation -->
                        <div class="hidden space-x-6 sm:-my-px sm:ms-8 sm:flex">
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                <i class="fas fa-chart-line w-5 sm:mr-2"></i>
                                <span class="hidden md:inline">{{ __('Dashboard') }}</span>
                            </x-nav-link>

                            {{-- ==================== PENAMBAHAN OTORISASI ==================== --}}
                            @can('manage categories')
                                <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                                    <i class="fas fa-folder w-5 sm:mr-2"></i>
                                    <span class="hidden md:inline">{{ __('Categories') }}</span>
                                </x-nav-link>
                            @endcan

                            @can('manage posts')
                                <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">
                                    <i class="fas fa-newspaper w-5 sm:mr-2"></i>
                                    <span class="hidden md:inline">{{ __('Posts') }}</span>
                                </x-nav-link>
                            @endcan

                            @can('manage works')
                                <x-nav-link :href="route('admin.works.index')" :active="request()->routeIs('admin.works.*')">
                                    <i class="fas fa-briefcase w-5 sm:mr-2"></i>
                                    <span class="hidden md:inline">{{ __('Works') }}</span>
                                </x-nav-link>
                            @endcan
                            {{-- ================== AKHIR DARI PENAMBAHAN ================== --}}
                        </div>
                    </div>

                    <!-- User Dropdown & Mobile Menu Button -->
                    <div class="flex items-center">
                        {{-- ... (kode user dropdown tidak berubah) ... --}}
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-600  bg-white  hover:text-slate-800  focus:outline-none transition ease-in-out duration-150">
                                        <div
                                            class="h-8 w-8 rounded-full bg-slate-200  flex items-center justify-center mr-2">
                                            @if (Auth::user()->avatar)
                                                <img src="{{ Auth::user()->avatar }}" alt="Avatar"
                                                    class="w-full h-full rounded-full object-cover">
                                            @else
                                                <i class="fas fa-user text-slate-600 "></i>
                                            @endif
                                        </div>
                                        <div class="hidden md:block">{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="px-4 py-3 border-b border-slate-200 ">
                                        <p class="text-sm font-semibold text-slate-800 ">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-slate-500  truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    <x-dropdown-link :href="route('admin.profile.edit')" class="flex items-center">
                                        <i class="fas fa-user-cog w-4 mr-3 text-slate-500 "></i>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="flex items-center text-red-600 hover:bg-red-50  ">
                                            <i class="fas fa-sign-out-alt w-4 mr-3"></i>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                        <div class="sm:hidden flex items-center">
                            <button @click="open = ! open"
                                class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100  focus:outline-none focus:ring-2 focus:ring-inset focus:ring-slate-500 transition">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Navigation Menu -->
            <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden" x-cloak>
                <div class="pt-2 pb-3 space-y-1">
                    <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <i class="fas fa-chart-line w-5 mr-3"></i>{{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    {{-- ==================== PENAMBAHAN OTORISASI ==================== --}}
                    @can('manage categories')
                        <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                            <i class="fas fa-folder w-5 mr-3"></i>{{ __('Categories') }}
                        </x-responsive-nav-link>
                    @endcan

                    @can('manage posts')
                        <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')">
                            <i class="fas fa-newspaper w-5 mr-3"></i>{{ __('Posts') }}
                        </x-responsive-nav-link>
                    @endcan

                    @can('manage works')
                        <x-responsive-nav-link :href="route('admin.works.index')" :active="request()->routeIs('admin.works.*')">
                            <i class="fas fa-briefcase w-5 mr-3"></i>{{ __('Works') }}
                        </x-responsive-nav-link>
                    @endcan
                    {{-- ================== AKHIR DARI PENAMBAHAN ================== --}}
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-slate-200 ">
                    {{-- ... (kode responsive user dropdown tidak berubah) ... --}}
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        {{ $header }}
                        <div class="text-sm text-slate-500  flex items-center">
                            <i class="fas fa-calendar-alt mr-2"></i>
                            <span id="currentDate"></span>
                        </div>
                    </div>
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none">
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>

    @stack('scripts')

    <script>
        // Set current date
        document.addEventListener('DOMContentLoaded', function() {
            const dateElement = document.getElementById('currentDate');
            if (dateElement) {
                dateElement.textContent = new Date().toLocaleDateString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
            }
        });
    </script>
</body>

</html>
