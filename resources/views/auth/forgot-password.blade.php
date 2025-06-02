{{-- resources/views/auth/forgot-password.blade.php --}}
<x-guest-layout>
    {{-- Menambahkan pembungkus kartu agar konsisten --}}
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8">
        <div class="mb-6 text-center sm:text-left">
            <h1 class="text-2xl font-semibold text-slate-800 mb-2">
                {{ __('Lupa Password Anda?') }}
            </h1>
            <p class="text-sm text-slate-700 leading-relaxed">
                {{ __('Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan tautan pengaturan ulang kata sandi melalui email yang memungkinkan Anda memilih yang baru.') }}
            </p>
        </div>

        {{-- x-auth-session-status biasanya menampilkan pesan dengan warna hijau, yang dapat diterima --}}
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 p-3 bg-green-50 rounded-md border border-green-200">
                {{ session('status') }}
            </div>
        @endif


        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="space-y-6">
                <div>
                    {{-- Asumsi komponen input-label.blade.php sudah menggunakan text-slate-700 --}}
                    <x-input-label for="email" :value="__('Alamat Email')" />
                    <x-text-input id="email"
                                  class="block mt-1 w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 shadow-sm transition-colors duration-200"
                                  type="email" name="email" :value="old('email')" required autofocus placeholder="contoh@email.com"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end pt-2">
                    {{-- Mengganti x-primary-button dengan style yang konsisten --}}
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-white transition-colors duration-150">
                        <i class="fas fa-paper-plane mr-2"></i>
                        {{ __('Kirim Tautan Reset Password') }}
                    </button>
                </div>
            </div>
        </form>

        <div class="mt-8 text-center border-t border-slate-200 pt-6">
            <a href="{{ route('login') }}" class="text-sm text-slate-600 hover:text-slate-800 hover:underline transition-colors duration-200">
                <i class="fas fa-arrow-left mr-1"></i>
                {{ __('Kembali ke Login') }}
            </a>
        </div>
    </div>
</x-guest-layout>