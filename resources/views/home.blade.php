<x-public-layout>
     <div class="min-h-screen bg-gray-50">
        {{-- Section Hero/Profil - Minimalist Version --}}
        <section class="container mx-auto px-8 md:px-16 lg:px-32 py-24">
            <div class="max-w-4xl mx-auto text-center">
                {{-- Profile Image --}}
                <div class="mb-8">
                    @if($profile['profile_image_url'] ?? false)
                    <img src="{{ asset($profile['profile_image_url']) }}" alt="{{ $profile['name'] }}"
                        class="w-64 h-64 rounded-full object-cover mx-auto shadow-lg">
                    @else
                    <div class="w-32 h-32 bg-gray-200 rounded-full mx-auto flex items-center justify-center">
                        <span class="text-gray-400 text-sm">Photo</span>
                    </div>
                    @endif
                </div>

                {{-- Name and Title --}}
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ $profile['name'] ?? 'John Doe' }}
                </h1>
                
                <p class="text-xl text-gray-600 mb-8 font-medium">
                    {{ $profile['profession'] ?? 'Creative Technologist' }}
                </p>

                {{-- Bio --}}
                <p class="text-gray-600 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                    {{ $profile['bio'] ?? 'Passionate about creating meaningful digital experiences through thoughtful design and innovative technology.' }}
                </p>

                {{-- CTA Button --}}
                @if($profile['resume_url'] ?? false)
                <a href="{{ asset($profile['resume_url']) }}" target="_blank"
                class="inline-block bg-red-500 hover:bg-gray-800 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                    View Resume
                </a>
                @else
                <a href="#" class="inline-block bg-gray-900 hover:bg-gray-800 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                    View Resume
                </a>
                @endif
            </div>
        </section>

        {{-- Section Recent Posts --}}
        @if(($recentPosts ?? collect())->count() > 0)
        <section class="bg-white py-20">
            <div class="container mx-auto px-8 md:px-16 lg:px-32">
                <div class="flex justify-between items-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Recent posts</h2>
                    <a href="{{ route('blog.index') }}" class="text-red-500 hover:text-red-600 font-medium">View all</a>
                </div>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($recentPosts->take(3) as $post)
                    <article class="bg-white">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" 
                                 class="w-full h-48 object-cover rounded-lg mb-6 shadow-md">
                        @endif
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-red-500 transition-colors">
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
                    </article>
                    @endforeach
                </div>
            </div>
        </section>
        @else
        <section class="bg-white py-20">
            <div class="container mx-auto px-8 md:px-16 lg:px-32">
                <div class="flex justify-between items-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800">Recent posts</h2>
                    <a href="#" class="text-red-500 hover:text-red-600 font-medium">View all</a>
                </div>
                <div class="grid md:grid-cols-2 gap-8">
                    <article class="bg-white">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg mb-6 shadow-md flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-4xl mb-2">🎨</div>
                                <div class="text-sm opacity-75">Design System</div>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-red-500 transition-colors">
                            <a href="#">Making a design system from scratch</a>
                        </h3>
                        <div class="flex items-center text-gray-600 text-sm mb-4 space-x-4">
                            <span>12 Feb 2020</span>
                            <span>|</span>
                            <span>Design, Pattern</span>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                        </p>
                    </article>
                    <article class="bg-white">
                        <div class="w-full h-48 bg-gradient-to-br from-pink-500 to-red-500 rounded-lg mb-6 shadow-md flex items-center justify-center">
                            <div class="text-white text-center">
                                <div class="text-4xl mb-2">🔍</div>
                                <div class="text-sm opacity-75">Figma Icons</div>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4 hover:text-red-500 transition-colors">
                            <a href="#">Creating pixel perfect icons in Figma</a>
                        </h3>
                        <div class="flex items-center text-gray-600 text-sm mb-4 space-x-4">
                            <span>12 Feb 2020</span>
                            <span>|</span>
                            <span>Figma, Icon Design</span>
                        </div>
                        <p class="text-gray-700 leading-relaxed">
                            Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                        </p>
                    </article>
                </div>
            </div>
        </section>
        @endif

        {{-- Section Featured Works --}}
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-8 md:px-16 lg:px-32">
                <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">Featured works</h2>
                
                @if(($featuredWorks ?? collect())->count() > 0)
                    @foreach($featuredWorks->take(3) as $work)
                    <div class="flex flex-col md:flex-row gap-8 mb-12 pb-12 border-b border-gray-200 last:border-b-0">
                        <div class="md:w-1/3">
                            @if($work->image)
                                <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}" 
                                     class="w-full h-48 object-cover rounded-lg shadow-lg">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-purple-600 to-blue-600 rounded-lg shadow-lg"></div>
                            @endif
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ $work->title }}</h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="bg-gray-800 text-white px-3 py-1 rounded-lg text-sm font-medium">{{ $work->year ?? '2020' }}</span>
                                <span class="text-gray-600">{{ $work->category ?? 'Dashboard' }}</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                {{ $work->description ?? 'Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.' }}
                            </p>
                            @if($work->project_url)
                                <a href="{{ $work->project_url }}" target="_blank" class="text-red-500 hover:text-red-600 font-medium">View Project →</a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                @else
                    {{-- Sample featured works --}}
                    <div class="flex flex-col md:flex-row gap-8 mb-12 pb-12 border-b border-gray-200">
                        <div class="md:w-1/3">
                            <div class="w-full h-48 bg-gradient-to-br from-indigo-600 via-purple-600 to-blue-600 rounded-lg shadow-lg flex items-center justify-center">
                                <div class="text-white text-center">
                                    <div class="text-4xl mb-2">📊</div>
                                    <div class="text-sm opacity-75">Dashboard Preview</div>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Designing Dashboards</h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-sm font-medium">2020</span>
                                <span class="text-gray-600">Dashboard</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8 mb-12 pb-12 border-b border-gray-200">
                        <div class="md:w-1/3">
                            <div class="w-full h-48 bg-gradient-to-br from-pink-500 via-red-500 to-yellow-500 rounded-lg shadow-lg flex items-center justify-center">
                                <div class="text-white text-center">
                                    <div class="text-4xl mb-2">🎨</div>
                                    <div class="text-sm opacity-75">Portrait Art</div>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Vibrant Portraits of 2020</h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-sm font-medium">2018</span>
                                <span class="text-gray-600">Illustration</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="md:w-1/3">
                            <div class="w-full h-48 bg-gradient-to-br from-gray-800 to-gray-600 rounded-lg shadow-lg flex items-center justify-center">
                                <div class="text-white text-center">
                                    <div class="text-6xl mb-2 font-serif">Aa</div>
                                    <div class="text-sm opacity-75">Typography</div>
                                </div>
                            </div>
                        </div>
                        <div class="md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">36 Days of Malayalam type</h3>
                            <div class="flex items-center space-x-4 mb-4">
                                <span class="bg-gray-800 text-white px-3 py-1 rounded-full text-sm font-medium">2018</span>
                                <span class="text-gray-600">Typography</span>
                            </div>
                            <p class="text-gray-700 leading-relaxed">
                                Amet minim mollit non deserunt ullamco est sit aliqua dolor do amet sint. Velit officia consequat duis enim velit mollit. Exercitation veniam consequat sunt nostrud amet.
                            </p>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
</x-public-layout>