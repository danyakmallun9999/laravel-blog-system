<x-public-layout>
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-8 sm:py-8">
        <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-8">Blog</h1>

        @if ($categories->count() > 0)
            <div class="mb-12">
                {{-- Tampilan Dropdown untuk Mobile (terlihat di bawah breakpoint 'md') --}}
                <div class="md:hidden">
                    <label for="category_filter_mobile" class="sr-only">Filter by category</label>
                    <select id="category_filter_mobile" onchange="if (this.value) window.location.href = this.value;"
                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500">
                        <option value="{{ route('blog.index') }}" {{ !request('category') ? 'selected' : '' }}>All Posts
                        </option>
                        @foreach ($categories as $category)
                            <option value="{{ route('blog.index', ['category' => $category->slug]) }}"
                                {{ request('category') == $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tampilan Tombol/Link untuk Desktop (terlihat di 'md' dan lebih besar) --}}
                <div class="hidden md:flex flex-wrap items-center gap-3">
                    <a href="{{ route('blog.index') }}"
                        class="inline-block px-4 py-2 text-sm font-medium {{ !request('category') ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg transition">All</a>
                    @foreach ($categories as $category)
                        <a href="{{ route('blog.index', ['category' => $category->slug]) }}"
                            class="inline-block px-4 py-2 text-sm font-medium {{ request('category') == $category->slug ? 'bg-gray-800 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} rounded-lg transition">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        @if ($posts->count() > 0)
            <div class="space-y-8">
                @foreach ($posts as $post)
                    <article class="group">
                        <div class="flex flex-col lg:flex-row gap-8 items-start border border-gray-200 p-3 rounded-2xl">
                            @if ($post->image)
                                <div class="lg:w-1/2">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="block">
                                        <div
                                            class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 aspect-[16/9]">
                                            @if (Str::startsWith($post->image, 'http'))
                                                <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                            @else
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                    alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endif

                            <div class="{{ $post->image ? 'lg:w-1/2' : 'w-full' }} lg:pt-4">
                                <!-- Meta Information -->
                                <div class="flex items-center gap-4 mb-4">
                                    <span
                                        class="inline-block px-3 py-1 text-xs font-semibold bg-gray-800 text-white rounded-lg">
                                        {{ $post->created_at->format('Y') }}
                                    </span>
                                    <span class="text-sm text-gray-500 font-medium">
                                        {{ $post->category->name }}
                                    </span>
                                </div>

                                <!-- Title -->
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                                    <a href="{{ route('blog.show', $post->slug) }}"
                                        class="hover:text-red-500 transition-colors duration-300">
                                        {{ $post->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    <p
                                        class="text-gray-600 leading-relaxed mb-6 text-base hover:text-red-500 transition-colors duration-300">
                                        {!! Str::limit(strip_tags($post->content), 180) !!}
                                    </p>
                                </a>
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

            {{-- Pagination diletakkan hanya di bawah daftar postingan untuk UX yang lebih baik --}}
            <div class="mt-16 flex justify-center">
                {{ $posts->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-xl text-gray-600 mb-2">No posts available</p>
                @if (request('category'))
                    <p class="text-gray-500">in this category.</p>
                @endif
            </div>
        @endif
    </div>
</x-public-layout>
