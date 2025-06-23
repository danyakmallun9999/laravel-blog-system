<x-public-layout>
    <div class="flex items-center justify-center min-h-[60vh] sm:min-h-[70vh] px-6 py-16">
        <div class="max-w-lg mx-auto text-center">
            {{-- Anda bisa menggunakan ilustrasi SVG atau gambar di sini --}}
            <div class="mb-8">
                <i class="fas fa-cogs text-6xl sm:text-7xl text-slate-400"></i>
            </div>

            {{-- Kode Error dan Judul --}}
            <p class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-2">Error 500</p>
            <h1 class="text-3xl sm:text-4xl font-bold text-slate-800 mb-4">
                Terjadi Masalah pada Server
            </h1>

            {{-- Pesan Penjelasan yang Ramah --}}
            <p class="text-slate-600 mb-8 leading-relaxed">
                Mohon maaf, kami sedang mengalami kendala teknis. Tim kami telah diberitahu dan sedang bekerja untuk
                memperbaikinya. Silakan coba lagi nanti.
            </p>

            {{-- Tombol Aksi untuk Pengguna --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                {{-- Tombol untuk mencoba kembali (refresh) --}}
                <a href="{{ request()->url() }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-white border border-slate-300 rounded-lg font-semibold text-sm text-slate-700 hover:bg-slate-50 active:bg-slate-100 transition ease-in-out duration-150">
                    <i class="fas fa-redo-alt mr-2"></i>
                    Coba Lagi
                </a>
                {{-- Tombol untuk kembali ke Halaman Utama --}}
                <a href="{{ route('home') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-slate-800 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-slate-700 active:bg-slate-900 transition ease-in-out duration-150">
                    <i class="fas fa-home mr-2"></i>
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>
</x-public-layout>
