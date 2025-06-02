{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Inter:300,400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- FontAwesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script src="https://cdn.tiny.cloud/1/dzidaxtxrn6a2cgls7wf067g6foa5l8vw2snpqxxz74ccpxo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        
        <style>
            body { font-family: 'Inter', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-slate-50">
        <div class="min-h-screen">
            <!-- Navigation -->
            <nav x-data="{ open: false }" class="bg-white border-b border-slate-200 shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center">
                            <!-- Brand -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('admin.dashboard') }}">
                                    <h1 class="text-2xl font-bold text-slate-800">Admin Panel</h1>
                                </a>
                            </div>

                            <!-- Desktop Navigation -->
                            <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')"
                                    class="border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-slate-700 text-slate-900 font-semibold' : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-400' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors">
                                    <i class="fas fa-chart-line mr-2"></i>
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                                <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')"
                                    class="border-b-2 {{ request()->routeIs('admin.categories.*') ? 'border-slate-700 text-slate-900 font-semibold' : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-400' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors">
                                    <i class="fas fa-folder mr-2"></i>
                                    {{ __('Categories') }}
                                </x-nav-link>
                                <x-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')"
                                    class="border-b-2 {{ request()->routeIs('admin.posts.*') ? 'border-slate-700 text-slate-900 font-semibold' : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-400' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors">
                                    <i class="fas fa-newspaper mr-2"></i>
                                    {{ __('Posts') }}
                                </x-nav-link>
                                <x-nav-link :href="route('admin.works.index')" :active="request()->routeIs('admin.works.*')"
                                    class="border-b-2 {{ request()->routeIs('admin.works.*') ? 'border-slate-700 text-slate-900 font-semibold' : 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-400' }} inline-flex items-center px-1 pt-1 text-sm font-medium transition-colors">
                                    <i class="fas fa-briefcase mr-2"></i>
                                    {{ __('Works') }}
                                </x-nav-link>
                            </div>
                        </div>

                        <!-- User Dropdown -->
                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-slate-700 bg-white hover:text-slate-800 focus:outline-none  transition ease-in-out duration-150">
                                        <div class="h-8 w-8 rounded-full bg-slate-800 flex items-center justify-center text-white font-medium mr-3">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div>{{ Auth::user()->name }}</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('admin.profile.edit')" class="flex items-center">
                                        <i class="fas fa-user-cog mr-3"></i>
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();" class="flex items-center">
                                            <i class="fas fa-sign-out-alt mr-3"></i>
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>

                        <!-- Mobile menu button -->
                        <div class="sm:hidden flex items-center">
                            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-slate-400 hover:text-slate-500 hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-slate-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Mobile Navigation -->
                <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                    <div class="pt-2 pb-3 space-y-1 bg-slate-50 border-t border-slate-200">
                        <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')" class="{{ request()->routeIs('admin.dashboard') ? 'bg-slate-100 border-l-4 border-slate-800 text-slate-800' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50 hover:border-slate-300 border-l-4' }} block pl-3 pr-4 py-2 text-base font-medium">
                            <i class="fas fa-chart-line mr-2"></i>
                            {{ __('Dashboard') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')" class="{{ request()->routeIs('admin.categories.*') ? 'bg-slate-100 border-l-4 border-slate-800 text-slate-800' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50 hover:border-slate-300 border-l-4' }} block pl-3 pr-4 py-2 text-base font-medium">
                            <i class="fas fa-folder mr-2"></i>
                            {{ __('Categories') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.posts.index')" :active="request()->routeIs('admin.posts.*')" class="{{ request()->routeIs('admin.posts.*') ? 'bg-slate-100 border-l-4 border-slate-800 text-slate-800' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50 hover:border-slate-300 border-l-4' }} block pl-3 pr-4 py-2 text-base font-medium">
                            <i class="fas fa-newspaper mr-2"></i>
                            {{ __('Posts') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.works.index')" :active="request()->routeIs('admin.works.*')" class="{{ request()->routeIs('admin.works.*') ? 'bg-slate-100 border-l-4 border-slate-800 text-slate-800' : 'border-transparent text-slate-500 hover:text-slate-700 hover:bg-slate-50 hover:border-slate-300 border-l-4' }} block pl-3 pr-4 py-2 text-base font-medium">
                            <i class="fas fa-briefcase mr-2"></i>
                            {{ __('Works') }}
                        </x-responsive-nav-link>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm border-b border-slate-200">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <div class="flex items-center justify-between">
                            {{ $header }}
                            <div class="text-sm text-slate-500">
                                <i class="fas fa-calendar mr-2"></i>
                                <span id="currentDate"></span>
                            </div>
                        </div>
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        {{-- Stack untuk script per halaman --}}
        @stack('scripts')
        
        <script>
            // Set current date
            document.addEventListener('DOMContentLoaded', function() {
                const dateElement = document.getElementById('currentDate');
                if (dateElement) {
                    dateElement.textContent = new Date().toLocaleDateString('en-US', {
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