<x-public-layout>
    <div class="max-w-4xl mx-auto px-6 py-16">
        <h1 class="text-5xl font-bold text-gray-800 mb-16">Blog</h1>
        {{-- Opsional: Filter Kategori --}}
        @if($categories->count() > 0)
        <div class="mb-12">
            <a href="{{ route('blog.index') }}" class="inline-block px-4 py-2 mr-3 mb-3 text-sm font-medium {{ !request('category') ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-red-500 hover:text-gray-100' }} rounded-lg transition">All</a>
            @foreach($categories as $category)
            <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
               class="inline-block px-4 py-2 mr-3 mb-3 text-sm font-medium {{ request('category') == $category->slug ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-red-500 hover:text-gray-100'}} rounded-lg transition">
                {{ $category->name }}
            </a>
            @endforeach
        </div>
        @endif

        @if($posts->count() > 0)
            <div class="mb-16 flex justify-center">
                {{ $posts->links() }}
            </div>
            <div class="space-y-16">
                @foreach($posts as $post)
                <article class="group">
                    <div class="flex flex-col lg:flex-row gap-8 items-start">
                        @if($post->image)
                        <div class="lg:w-1/2">
                            <a href="{{ route('blog.show', $post->slug) }}" class="block">
                                <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 aspect-[4/3]">
                                    <img src="{{ asset('storage/' . $post->image) }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                </div>
                            </a>
                        </div>
                        @endif
                        
                        <div class="{{ $post->image ? 'lg:w-1/2' : 'w-full' }} lg:pt-4">
                            <!-- Meta Information -->
                            <div class="flex items-center gap-4 mb-4">
                                <span class="inline-block px-3 py-1 text-xs font-semibold bg-gray-800 text-white rounded-lg">
                                    {{ $post->created_at->format('Y') }}
                                </span>
                                <span class="text-sm text-gray-500 font-medium">
                                    {{ $post->category->name }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                                <a href="{{ route('blog.show', $post->slug) }}" 
                                   class="hover:text-red-600 transition-colors duration-300">
                                    {{ $post->title }}
                                </a>
                            </h2>

                            <!-- Excerpt -->
                            <p class="text-gray-600 leading-relaxed mb-6 text-base">
                                {!! Str::limit(strip_tags($post->content), 180) !!}
                            </p>

                            <!-- Author & Date -->
                            <div class="text-sm text-gray-500">
                                <span>By {{ $post->user->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $post->created_at->format('M j, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-xl text-gray-600 mb-2">No posts available</p>
                @if(request('category'))
                    <p class="text-gray-500">in this category.</p>
                @endif
            </div>
        @endif
    </div>
</x-public-layout>