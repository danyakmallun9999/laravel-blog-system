@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col items-center space-y-4"> {{-- Mengubah flex container utama menjadi kolom dan memberi jarak --}}
        {{-- Bagian untuk Tombol Navigasi Halaman (Previous, Angka, Next) --}}
        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Tombol Previous Page --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-l-md leading-5" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-l-md leading-5 hover:bg-gray-100 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring-1 ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Elemen Pagination (Angka Halaman) --}}
                @foreach ($elements as $element)
                    {{-- Separator "Three Dots" --}}
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                        </span>
                    @endif

                    {{-- Array Link Halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    {{-- Ganti bg-gray-800 dengan warna aktif pilihanmu, misal bg-red-500 --}}
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gray-800 border border-gray-800 cursor-default leading-5">{{ $page }}</span>
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-300 leading-5 hover:bg-gray-100 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring-1 ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next Page --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-600 bg-white border border-gray-300 rounded-r-md leading-5 hover:bg-gray-100 hover:text-gray-800 focus:z-10 focus:outline-none focus:ring-1 ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-default rounded-r-md leading-5" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </span>
        </div>

        {{-- Bagian untuk Teks "Showing..." --}}
        {{-- Ini akan muncul di bawah tombol karena parent <nav> sekarang flex-col --}}
        <div>
            <p class="text-sm text-gray-600 dark:text-gray-400 leading-5"> {{-- Warna disesuaikan agar lebih soft --}}
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                    <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $paginator->firstItem() }}</span>
                    {!! __('to') !!}
                    <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $paginator->lastItem() }}</span>
                @else
                    {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-semibold text-gray-700 dark:text-gray-300">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        {{-- Kode untuk tampilan mobile (jika ada) bisa diletakkan di sini atau diatur berbeda --}}
        {{-- Untuk contoh ini, kita hilangkan sementara bagian mobile agar fokus ke struktur utama --}}
        {{-- Namun, idealnya kamu tetap mempertahankan dan menyesuaikan bagian mobile juga --}}
        {{-- <div class="flex justify-between flex-1 sm:hidden"> ... </div> --}}

    </nav>
@endif