<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-slate-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-slate-800 to-slate-700 rounded-xl shadow-lg mb-8 overflow-hidden">
                <div class="px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-white mb-2">
                                {{ __('Selamat Datang Kembali, ') }}{{ Auth::user()->name }}!
                            </h2>
                            <p class="text-slate-200">Inilah yang terjadi dengan konten Anda hari ini.</p>
                        </div>
                        <div class="hidden md:block">
                            <div class="w-20 h-20 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <i class="fas fa-chart-line text-3xl text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==================== PERBAIKAN OTORISASI DIMULAI DI SINI ==================== --}}

            {{-- Kartu Statistik --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @can('manage posts')
                    <div
                        class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Posts</h3>
                                <p class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_posts'] ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-newspaper text-xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('manage works')
                    <div
                        class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Works</h3>
                                <p class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_works'] ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-briefcase text-xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('manage categories')
                    <div
                        class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wide">Categories</h3>
                                <p class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_categories'] ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-folder text-xl text-yellow-600"></i>
                            </div>
                        </div>
                    </div>
                @endcan

                @can('manage users')
                    <div
                        class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-sm font-medium text-slate-500 uppercase tracking-wide">Total Users</h3>
                                <p class="text-3xl font-bold text-slate-800 mt-2">{{ $stats['total_users'] ?? 0 }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-users text-xl text-green-600"></i>
                            </div>
                        </div>
                    </div>
                @endcan
            </div>

            {{-- Quick Actions --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
                <h3 class="text-lg font-semibold text-slate-800 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @can('manage posts')
                        <a href="{{ route('admin.posts.create') }}"
                            class="flex flex-col items-center justify-center text-center p-4 rounded-lg border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors group min-h-[120px]">
                            <i
                                class="fas fa-plus text-3xl text-blue-600 mb-2 group-hover:scale-110 transition-transform"></i>
                            <span class="text-sm font-medium text-slate-700">New Post</span>
                        </a>
                    @endcan

                    @can('manage categories')
                        <a href="{{ route('admin.categories.create') }}"
                            class="flex flex-col items-center justify-center text-center p-4 rounded-lg border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors group min-h-[120px]">
                            <i
                                class="fas fa-folder-plus text-3xl text-yellow-600 mb-2 group-hover:scale-110 transition-transform"></i>
                            <span class="text-sm font-medium text-slate-700">Add Category</span>
                        </a>
                    @endcan

                    @can('manage works')
                        <a href="{{ route('admin.works.create') }}"
                            class="flex flex-col items-center justify-center text-center p-4 rounded-lg border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors group min-h-[120px]">
                            <i
                                class="fas fa-briefcase text-3xl text-purple-600 mb-2 group-hover:scale-110 transition-transform"></i>
                            <span class="text-sm font-medium text-slate-700">New Work</span>
                        </a>
                    @endcan

                    @can('manage users')
                        <a href="{{ route('admin.users.create') }}"
                            class="flex flex-col items-center justify-center text-center p-4 rounded-lg border border-slate-200 hover:bg-slate-50 hover:border-slate-300 transition-colors group min-h-[120px]">
                            <i
                                class="fas fa-user-plus text-3xl text-green-600 mb-2 group-hover:scale-110 transition-transform"></i>
                            <span class="text-sm font-medium text-slate-700">Add User</span>
                        </a>
                    @endcan
                </div>
            </div>
            {{-- ================== AKHIR DARI PERBAIKAN OTORISASI ================== --}}

        </div>
    </div>
</x-app-layout>
