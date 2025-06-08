<x-public-layout>
    <div class="max-w-4xl mx-auto px-6 py-8">
        <h1 class="text-5xl font-bold text-gray-800 mb-8">Work</h1>
        
        @if($works->count() > 0)
            <div class="space-y-8">
                @foreach($works as $work)
                {{-- PENAMBAHAN: Seluruh <article> dibungkus dengan tag <a> --}}
                <a href="{{ route('work.show', $work) }}" class="group block">
                    <article> {{-- Kelas 'group' dipindahkan ke tag <a> di atas --}}
                        <div class="flex flex-col lg:flex-row gap-8 items-start border border-gray-200 p-3 rounded-2xl">
                            <!-- Project Image -->
                            <div class="lg:w-1/2">
                                <div class="relative overflow-hidden rounded-lg bg-gradient-to-br {{ $loop->odd ? 'from-purple-600 to-blue-600' : ($loop->iteration % 4 == 2 ? 'from-orange-400 to-pink-600' : ($loop->iteration % 4 == 3 ? 'from-gray-800 to-gray-600' : 'from-red-500 to-orange-500')) }} aspect-[4/3]">
                                    @if($work->image)
                                        {{-- PENAMBAHAN: Logika untuk gambar lokal dan eksternal --}}
                                        @if(Str::startsWith($work->image, 'http'))
                                            <img src="{{ $work->image }}" 
                                                 alt="{{ $work->title }}" 
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <img src="{{ asset('storage/' . $work->image) }}" 
                                                 alt="{{ $work->title }}" 
                                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                        @endif
                                    @else
                                        <!-- Placeholder with project initial or icon -->
                                        <div class="w-full h-full flex items-center justify-center">
                                            <div class="text-white text-6xl font-bold opacity-20">
                                                {{ substr($work->title, 0, 1) }}
                                            </div>
                                        </div>
                                    @endif
                                    
                                    @if($work->project_url)
                                    <!-- Hover overlay -->
                                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        {{-- PENAMBAHAN: Mengubah <a> menjadi <span> untuk menghindari nested link, styling tetap sama --}}
                                        <span class="bg-white text-gray-800 px-6 py-3 rounded-lg font-semibold">
                                            View Project
                                        </span>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Project Info -->
                            <div class="lg:w-1/2 lg:pt-4">
                                <!-- Title -->
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight transition-colors group-hover:text-red-500">
                                    {{ $work->title }}
                                </h2>

                                <!-- Meta Information -->
                                <div class="flex items-center gap-4 mb-6">
                                    <span class="inline-block px-3 py-1 text-xs font-semibold bg-gray-800 text-white rounded-lg">
                                        {{ $work->year }}
                                    </span>
                                    <span class="text-sm text-gray-500 font-medium">
                                        {{ $work->category }}
                                    </span>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 leading-relaxed text-base mb-6">
                                    {!! Str::limit(strip_tags($work->description), 150) !!}
                                </p>

                                <!-- Additional project details if available -->
                                @if($work->technologies ?? false)
                                <div class="mb-6">
                                    <h4 class="text-sm font-semibold text-gray-800 mb-2">Technologies:</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach(explode(',', $work->technologies) as $tech)
                                        <span class="inline-block px-3 py-1 text-xs bg-gray-100 text-gray-700 rounded-lg">
                                            {{ trim($tech) }}
                                        </span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                @if($work->project_url)
                                <!-- External link for desktop view -->
                                <div class="hidden lg:block">
                                    {{-- PENAMBAHAN: Mengubah <a> menjadi <span> agar tidak ada nested link --}}
                                    <span class="inline-flex items-center text-gray-800 font-semibold">
                                        View Project
                                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                        </svg>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </article>
                </a>
                @endforeach
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $works->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-xl text-gray-600">No projects available at the moment.</p>
            </div>
        @endif
    </div>
</x-public-layout>
