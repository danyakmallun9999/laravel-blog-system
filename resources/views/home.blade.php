<x-public-layout>
    <div class="min-h-screen bg-gray-50">
        <section class="container mx-auto px-8 md:px-16 lg:px-32 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <div class="mb-8">
                    @if ($profile['profile_image_url'] ?? false)
                        <img src="{{ asset($profile['profile_image_url']) }}" alt="{{ $profile['name'] }}"
                            class="w-64 h-64 rounded-full object-cover mx-auto">
                    @else
                        <div class="w-24 h-24 bg-gray-200 rounded-full mx-auto flex items-center justify-center">
                            <span class="text-gray-400 text-sm">Photo</span>
                        </div>
                    @endif
                </div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">{{ $profile['name'] ?? 'John Doe' }}</h1>
                <p class="text-xl text-gray-600 mb-8 font-medium">
                    {{ $profile['profession'] ?? 'Creative Technologist' }}</p>
                <p class="text-gray-600 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                    {{ $profile['bio'] ?? 'Passionate about creating meaningful digital experiences through thoughtful design and innovative technology.' }}
                </p>
                @if ($profile['resume_url'] ?? false)
                    <a href="https://github.com/danyakmallun9999" target="_blank"
                        class="inline-block bg-red-500 hover:bg-gray-800 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        View Github
                    </a>
                @else
                    <a href="https://github.com/danyakmallun9999"
                        class="inline-block bg-gray-900 hover:bg-gray-800 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                        View Github
                    </a>
                @endif
            </div>
        </section>

        @if (($recentPosts ?? collect())->count() > 0)
            <section class="bg-white py-20">
                <div class="container mx-auto px-8 md:px-16 lg:px-32">
                    <div class="flex justify-between items-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800">Recent posts</h2>
                        <a href="{{ route('blog.index') }}" class="text-red-500 hover:text-red-600 font-medium">View
                            all</a>
                    </div>
                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach ($recentPosts->take(3) as $post)
                            <article class="bg-white">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    @if ($post->image)
                                        @if (Str::startsWith($post->image, 'http'))
                                            <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                class="w-full h-48 object-cover rounded-lg mb-6">
                                        @else
                                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                                class="w-full h-48 object-cover rounded-lg mb-6 shadow-md">
                                        @endif
                                    @endif
                                    <h3
                                        class="text-2xl font-bold text-gray-900 mb-4 hover:text-red-500 transition-colors">
                                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                                    </h3>
                                    <div class="flex items-center text-gray-600 text-sm mb-4 space-x-4">
                                        <span>{{ $post->created_at->format('d M Y') }}</span>
                                        <span>|</span>
                                        <span>{{ $post->category->name ?? 'Design, Pattern' }}</span>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed">
                                        {{ Str::limit(strip_tags($post->content), 150) }}
                                    </p>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @else
            <section class="bg-white py-20">
            </section>
        @endif

        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-8 md:px-16 lg:px-32">
                <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Featured works</h2>

                @if (($featuredWorks ?? collect())->count() > 0)
                    @foreach ($featuredWorks->take(3) as $work)
                        <a href="{{ route('work.show', $work) }}"
                            class="group block mb-12 pb-12 border-b border-gray-200 last:border-b-0 last:mb-0 last:pb-0">
                            <div class="flex flex-col md:flex-row gap-8">
                                <div class="md:w-1/3">
                                    @if ($work->image)
                                        @if (Str::startsWith($work->image, 'http'))
                                            <img src="{{ $work->image }}" alt="{{ $work->title }}"
                                                class="w-full h-48 object-cover rounded-lg  transition-transform duration-300 group-hover:scale-105">
                                        @else
                                            <img src="{{ asset('storage/' . $work->image) }}"
                                                alt="{{ $work->title }}"
                                                class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105">
                                        @endif
                                    @else
                                        <div
                                            class="w-full h-48 bg-gradient-to-br from-purple-600 to-blue-600 rounded-lg">
                                        </div>
                                    @endif
                                </div>
                                <div class="md:w-2/3">
                                    <h3
                                        class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-red-500 transition-colors">
                                        {{ $work->title }}</h3>
                                    <div class="flex items-center space-x-4 mb-4">
                                        <span
                                            class="bg-gray-800 text-white px-3 py-1 rounded-lg text-sm font-medium">{{ $work->year ?? '2020' }}</span>
                                        <span class="text-gray-600">{{ $work->category ?? 'Dashboard' }}</span>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed mb-4">
                                        {{ Str::limit($work->description, 150) ?? 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.' }}
                                    </p>
                                    <span class="text-red-500 font-medium group-hover:text-red-600">
                                        View Details →
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                @else
                @endif
            </div>
        </section>
    </div>
</x-public-layout>
