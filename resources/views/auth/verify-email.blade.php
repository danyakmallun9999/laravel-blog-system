{{-- resources/views/auth/verify-email.blade.php --}}
<x-guest-layout>
    {{-- Menambahkan pembungkus kartu agar konsisten dengan halaman auth lainnya --}}
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-slate-800 mb-2 text-center sm:text-left">
                {{ __('Verifikasi Alamat Email Anda') }}
            </h1>
            <p class="text-sm text-slate-700 leading-relaxed text-center sm:text-left">
                {{ __('Terima kasih telah mendaftar! Sebelum memulai, dapatkah Anda memverifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan melalui email kepada Anda? Jika Anda tidak menerima email tersebut, kami dengan senang hati akan mengirimkan email lainnya.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-6 font-medium text-sm text-green-700 p-3 bg-green-50 rounded-md border border-green-200">
                {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.') }}
            </div>
        @endif

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between space-y-4 sm:space-y-0 sm:space-x-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <div>
                    {{-- Mengganti x-primary-button dengan style yang konsisten --}}
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-white transition-colors duration-150">
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ __('Kirim Ulang Email Verifikasi') }}
                    </button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center text-sm text-slate-600 hover:text-slate-800 hover:underline rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-slate-500 transition-colors duration-150 px-4 py-2">
                    <i class="fas fa-sign-out-alt mr-2"></i>
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>