<x-public-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-8">
        <!-- Back Navigation -->
        <div class="mb-6 sm:mb-8">
            <a href="{{ route('blog.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Blog
            </a>
        </div>

        <article class="max-w-4xl mx-auto">
            <!-- Article Header -->
            <header class="mb-10">
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-6">
                    <span class="inline-block px-3 py-1 text-xs font-semibold bg-red-500 text-white rounded-lg">
                        {{ $post->created_at->format('Y') }}
                    </span>
                    <span class="text-sm text-gray-500 font-medium">
                        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                            class="hover:text-gray-700 transition-colors duration-300">
                            {{ $post->category->name }}
                        </a>
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-gray-500">
                    {{-- Author Block --}}
                    <div class="flex items-center">
                        <div
                            class="w-8 h-8 bg-gray-300 rounded-full mr-3 flex items-center justify-center overflow-hidden">
                            @if ($post->user->avatar)
                                {{-- PERTAMA: Cek apakah avatar adalah URL lengkap (misal: dari login Google) --}}
                                @if (Str::startsWith($post->user->avatar, 'http'))
                                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                                        class="w-full h-full object-cover">
                                @else
                                    {{-- KEDUA: Jika bukan URL, anggap itu adalah file dari storage --}}
                                    <img src="{{ asset('storage/' . $post->user->avatar) }}"
                                        alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                                @endif
                            @else
                                {{-- KETIGA: Jika tidak ada avatar sama sekali, tampilkan gambar default dari public/images --}}
                                <img src="{{ asset('images/profile.jpg') }}" alt="Default Avatar"
                                    class="w-full h-full object-cover">
                            @endif
                        </div>
                        <span>By <a href="#"
                                class="hover:text-gray-700 font-medium transition-colors duration-300">{{ $post->user->name }}</a></span>
                    </div>

                    {{-- Date & Time Block --}}
                    <div class="flex items-center gap-x-4">
                        <span class="hidden sm:inline-block">•</span>
                        <span>{{ $post->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if ($post->image)
                <div class="mb-10 sm:mb-12">
                    <div
                        class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 aspect-[16/9]">
                        @if (Str::startsWith($post->image, 'http'))
                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
            @endif

            <!-- Article Content -->
            <article class="prose prose-lg prose-gray max-w-none">
                {!! $post->content !!}
            </article>

            <!-- Article Footer -->
            <footer class="mt-16 pt-8 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm text-gray-500">Filed under:</span>
                        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}"
                            class="inline-block px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-300">
                            {{ $post->category->name }}
                        </a>
                    </div>
                    <div class="text-sm text-gray-500 flex-shrink-0">
                        Published {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </footer>

            <!-- Navigation to other posts -->
            <nav class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex justify-between items-center gap-4">
                    @if ($previousPost ?? false)
                        <a href="{{ route('blog.show', $previousPost->slug) }}"
                            class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300 w-1/2 pr-2">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <div class="text-left overflow-hidden">
                                <div class="text-xs text-gray-500">Previous</div>
                                <div class="font-medium truncate">{{ $previousPost->title }}</div>
                            </div>
                        </a>
                    @else
                        <div></div>
                    @endif

                    @if ($nextPost ?? false)
                        <a href="{{ route('blog.show', $nextPost->slug) }}"
                            class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300 w-1/2 justify-end pl-2">
                            <div class="text-right overflow-hidden">
                                <div class="text-xs text-gray-500">Next</div>
                                <div class="font-medium truncate">{{ $nextPost->title }}</div>
                            </div>
                            <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    @else
                        <div></div>
                    @endif
                </div>
            </nav>
        </article>

        <div class="mb-6 sm:mb-8">
            <a href="{{ route('blog.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Blog
            </a>
        </div>
    </div>
</x-public-layout>
