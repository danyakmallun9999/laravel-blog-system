{{-- resources/views/errors/404.blade.php --}}
<x-public-layout>
    <div class="container mx-auto px-6 py-16 md:py-24 text-center">
        <div class="max-w-lg mx-auto">
            <img src="{{ asset('images/404-illustration.svg') }}" alt="Halaman Tidak Ditemukan" class="mx-auto mb-8 h-64">
            <h1 class="text-6xl md:text-8xl font-bold text-gray-800 mb-4">404</h1>
            <h2 class="text-2xl md:text-3xl font-semibold text-gray-700 mb-6">Oops! Halaman Tidak Ditemukan.</h2>
            <p class="text-gray-600 mb-10 leading-relaxed">
                Maaf, halaman yang kamu cari tidak ada, mungkin sudah dipindahkan, atau URL yang kamu masukkan salah.
            </p>
            <div class="space-x-4">
                <a href="{{ url()->previous() }}"
                   class="inline-block bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-3 px-6 rounded-lg transition duration-300">
                    Kembali ke Halaman Sebelumnya
                </a>
                <a href="{{ route('home') }}"
                   class="inline-block bg-gray-800 hover:bg-gray-700 text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                    Kembali ke Home
                </a>
            </div>
        </div>
    </div>
</x-public-layout>