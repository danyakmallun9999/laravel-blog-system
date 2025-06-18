<x-public-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">
        <!-- Navigasi Kembali -->
        <div class="mb-8">
            <a href="{{ route('work.index') }}"
                class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to All Works
            </a>
        </div>

        <article class="max-w-3xl mx-auto">
            <!-- Header Artikel Proyek -->
            <header class="mb-10 text-center">
                <!-- Judul Proyek -->
                <h1 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4 leading-tight">
                    {{ $work->title }}
                </h1>
                <!-- Meta Informasi (Tahun & Kategori) -->
                <div class="flex items-center justify-center gap-4 text-sm text-gray-500 font-medium">
                    <span class="inline-block px-3 py-1 bg-gray-800 text-white rounded-lg text-xs font-semibold">
                        {{ $work->year }}
                    </span>
                    <span>{{ $work->category }}</span>
                </div>
            </header>

            <!-- Gambar Unggulan Proyek -->
            @if ($work->image)
                <div class="mb-10 sm:mb-12">
                    <div class="relative overflow-hidden rounded-2xl bg-gray-100 aspect-[16/10]">
                        @if (Str::startsWith($work->image, 'http'))
                            <img src="{{ $work->image }}" alt="{{ $work->title }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}"
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
            @endif

            <!-- Konten/Deskripsi Proyek -->
            <div class="prose prose-lg prose-gray max-w-none mb-10">
                <p>{{ $work->description }}</p>
            </div>

            <!-- Tombol Aksi (Link ke Proyek) -->
            @if ($work->project_url)
                <div class="text-center">
                    <a href="{{ $work->project_url }}" target="_blank" rel="noopener noreferrer"
                        class="inline-block bg-red-500 hover:bg-slate-700 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                        View Live Project
                        <i class="fas fa-external-link-alt ml-2 text-xs"></i>
                    </a>
                </div>
            @endif

            <!-- Navigasi ke Proyek Lain -->
            <nav class="mt-16 pt-8 border-t border-gray-200">
                <div class="flex justify-between items-center gap-4">
                    <!-- Proyek Sebelumnya -->
                    @if ($previousWork)
                        <a href="{{ route('work.show', $previousWork) }}"
                            class="flex items-center text-gray-600 hover:text-gray-800 transition w-1/2 pr-2">
                            <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7" />
                            </svg>
                            <div class="text-left overflow-hidden">
                                <div class="text-xs text-gray-500">Previous</div>
                                <div class="font-medium truncate">{{ $previousWork->title }}</div>
                            </div>
                        </a>
                    @else
                        <div></div>
                    @endif

                    <!-- Proyek Berikutnya -->
                    @if ($nextWork)
                        <a href="{{ route('work.show', $nextWork) }}"
                            class="flex items-center text-gray-600 hover:text-gray-800 transition w-1/2 justify-end pl-2">
                            <div class="text-right overflow-hidden">
                                <div class="text-xs text-gray-500">Next</div>
                                <div class="font-medium truncate">{{ $nextWork->title }}</div>
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
    </div>
</x-public-layout>
