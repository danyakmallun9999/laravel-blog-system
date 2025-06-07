<x-public-layout>
    {{-- Menggunakan padding yang lebih responsif untuk seluruh halaman --}}
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8 sm:py-8">
        <!-- Back Navigation -->
        <div class="mb-6 sm:mb-8">
            <a href="{{ route('blog.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Blog
            </a>
        </div>

        <article class="max-w-3xl mx-auto">
            <!-- Article Header -->
            <header class="mb-10">
                <!-- ==================== PERBAIKAN META INFORMATION ==================== -->
                <!-- Menggunakan flex-wrap dan gap yang lebih jelas untuk tahun dan kategori -->
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 mb-6">
                    <span class="inline-block px-3 py-1 text-xs font-semibold bg-gray-800 text-white rounded-lg">
                        {{ $post->created_at->format('Y') }}
                    </span>
                    <span class="text-sm text-gray-500 font-medium">
                        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" 
                           class="hover:text-gray-700 transition-colors duration-300">
                            {{ $post->category->name }}
                        </a>
                    </span>
                </div>
                <!-- ================== AKHIR PERBAIKAN META INFORMATION ================== -->

                <!-- Title -->
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- ==================== PERBAIKAN AUTHOR & DATE ==================== -->
                <!-- Menggunakan flex-wrap untuk tata letak yang lebih fleksibel di semua layar -->
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 text-sm text-gray-500">
                    {{-- Author Block --}}
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-300 rounded-full mr-3 flex items-center justify-center overflow-hidden">
                            @if ($post->user->avatar)
                                <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-xs font-semibold text-gray-600">
                                    {{ substr($post->user->name, 0, 1) }}
                                </span>
                            @endif
                        </div>
                        <span>By <a href="#" class="hover:text-gray-700 font-medium transition-colors duration-300">{{ $post->user->name }}</a></span>
                    </div>

                    {{-- Date & Time Block --}}
                    <div class="flex items-center gap-x-4">
                        {{-- Pemisah ini hanya muncul di layar yang lebih besar jika item berdampingan --}}
                        <span class="hidden sm:inline-block">•</span>
                        <span>{{ $post->created_at->format('F j, Y') }}</span>
                    </div>
                </div>
                <!-- ================== AKHIR PERBAIKAN AUTHOR & DATE ================== -->
            </header>

            <!-- Featured Image -->
            @if($post->image)
            <div class="mb-10 sm:mb-12">
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 aspect-[16/10]">
                    @if (Str::startsWith($post->image, 'http'))
                        <img src="{{ $post->image }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             alt="{{ $post->title }}" 
                             class="w-full h-full object-cover">
                    @endif
                </div>
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg prose-gray max-w-none">
                {!! $post->content !!}
            </div>

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
                    @if($previousPost ?? false)
                    <a href="{{ route('blog.show', $previousPost->slug) }}" 
                       class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300 w-1/2 pr-2">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <div class="text-left overflow-hidden">
                            <div class="text-xs text-gray-500">Previous</div>
                            <div class="font-medium truncate">{{ $previousPost->title }}</div>
                        </div>
                    </a>
                    @else
                    <div></div>
                    @endif

                    @if($nextPost ?? false)
                    <a href="{{ route('blog.show', $nextPost->slug) }}" 
                       class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300 w-1/2 justify-end pl-2">
                        <div class="text-right overflow-hidden">
                            <div class="text-xs text-gray-500">Next</div>
                            <div class="font-medium truncate">{{ $nextPost->title }}</div>
                        </div>
                        <svg class="w-4 h-4 ml-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Blog
            </a>
        </div>
    </div>
</x-public-layout>
