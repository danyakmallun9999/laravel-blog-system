<x-public-layout>
    <div class="max-w-4xl mx-auto px-6 py-16">
        <!-- Back Navigation -->
        <div class="mb-8">
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
                <!-- Meta Information -->
                <div class="flex items-center gap-4 mb-6">
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

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                    {{ $post->title }}
                </h1>

                <!-- Author & Date -->
                <div class="flex items-center text-sm text-gray-500 space-x-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-300 rounded-full mr-3 flex items-center justify-center">
                            <span class="text-xs font-semibold text-gray-600">
                                {{ substr($post->user->name, 0, 1) }}
                            </span>
                        </div>
                        <span>By <a href="#" class="hover:text-gray-700 font-medium transition-colors duration-300">{{ $post->user->name }}</a></span>
                    </div>
                    <span>•</span>
                    <span>{{ $post->created_at->format('F j, Y') }}</span>
                    <span>•</span>
                    <span>{{ $post->created_at->format('g:i a') }}</span>
                </div>
            </header>

            <!-- Featured Image -->
            @if($post->image)
            <div class="mb-12">
                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 aspect-[16/10]">
                    <img src="{{ asset('storage/' . $post->image) }}" 
                         alt="{{ $post->title }}" 
                         class="w-full h-full object-cover">
                </div>
            </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-lg prose-gray max-w-none">
                <style>
                    .prose {
                        color: #374151;
                        line-height: 1.75;
                    }
                    .prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
                        color: #111827;
                        font-weight: 700;
                        margin-top: 2em;
                        margin-bottom: 1em;
                    }
                    .prose h1 { font-size: 2.25em; }
                    .prose h2 { font-size: 1.875em; }
                    .prose h3 { font-size: 1.5em; }
                    .prose h4 { font-size: 1.25em; }
                    .prose p {
                        margin-bottom: 1.5em;
                        font-size: 1.125em;
                    }
                    .prose a {
                        color: #3B82F6;
                        text-decoration: none;
                        font-weight: 500;
                    }
                    .prose a:hover {
                        text-decoration: underline;
                    }
                    .prose strong {
                        color: #111827;
                        font-weight: 600;
                    }
                    .prose ul, .prose ol {
                        margin: 1.5em 0;
                        padding-left: 1.5em;
                    }
                    .prose li {
                        margin: 0.5em 0;
                    }
                    .prose blockquote {
                        border-left: 4px solid #E5E7EB;
                        padding-left: 1.5em;
                        margin: 2em 0;
                        font-style: italic;
                        color: #6B7280;
                    }
                    .prose code {
                        background-color: #F3F4F6;
                        padding: 0.25em 0.5em;
                        border-radius: 0.25rem;
                        font-size: 0.9em;
                        color: #EF4444;
                    }
                    .prose pre {
                        background-color: #1F2937;
                        color: #F9FAFB;
                        padding: 1.5em;
                        border-radius: 0.5rem;
                        overflow-x: auto;
                        margin: 2em 0;
                    }
                    .prose pre code {
                        background: none;
                        color: inherit;
                        padding: 0;
                    }
                    .prose img {
                        border-radius: 0.5rem;
                        margin: 2em 0;
                        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
                    }
                    .prose hr {
                        border: none;
                        border-top: 1px solid #E5E7EB;
                        margin: 3em 0;
                    }
                </style>
                {!! $post->content !!}
            </div>

            <!-- Article Footer -->
            <footer class="mt-16 pt-8 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <!-- Tags/Categories -->
                    <div class="flex items-center gap-2">
                        <span class="text-sm text-gray-500">Filed under:</span>
                        <a href="{{ route('blog.index', ['category' => $post->category->slug]) }}" 
                           class="inline-block px-3 py-1 text-xs font-medium bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-300">
                            {{ $post->category->name }}
                        </a>
                    </div>

                    <!-- Share or Date -->
                    <div class="text-sm text-gray-500">
                        Published {{ $post->created_at->diffForHumans() }}
                    </div>
                </div>
            </footer>

            <!-- Navigation to other posts (optional) -->
            <nav class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <!-- Previous Post -->
                    @if($previousPost ?? false)
                    <a href="{{ route('blog.show', $previousPost->slug) }}" 
                       class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        <div class="text-left">
                            <div class="text-xs text-gray-500">Previous</div>
                            <div class="font-medium">{{ Str::limit($previousPost->title, 30) }}</div>
                        </div>
                    </a>
                    @else
                    <div></div>
                    @endif

                    <!-- Next Post -->
                    @if($nextPost ?? false)
                    <a href="{{ route('blog.show', $nextPost->slug) }}" 
                       class="flex items-center text-gray-600 hover:text-gray-800 transition-colors duration-300">
                        <div class="text-right">
                            <div class="text-xs text-gray-500">Next</div>
                            <div class="font-medium">{{ Str::limit($nextPost->title, 30) }}</div>
                        </div>
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                    @else
                    <div></div>
                    @endif
                </div>
            </nav>
        </article>
    </div>
</x-public-layout>