{{-- resources/views/auth/confirm-password.blade.php --}}
<x-guest-layout>
    {{-- Menambahkan pembungkus kartu agar konsisten --}}
    <div class="w-full max-w-md bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8">
        <div class="mb-6 text-center sm:text-left">
            <h1 class="text-2xl font-semibold text-slate-800 mb-2">
                {{ __('Konfirmasi Password Anda') }}
            </h1>
            <p class="text-sm text-slate-700 leading-relaxed">
                {{ __('Ini adalah area aman aplikasi. Harap konfirmasikan kata sandi Anda sebelum melanjutkan.') }}
            </p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="space-y-6">
                <div>
                    {{-- Asumsi komponen input-label.blade.php sudah menggunakan text-slate-700 --}}
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password"
                                  class="block mt-1 w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 shadow-sm transition-colors duration-200"
                                  type="password"
                                  name="password"
                                  placeholder="Masukkan password Anda"
                                  required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end pt-2">
                    {{-- Mengganti x-primary-button dengan style yang konsisten --}}
                    <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-white transition-colors duration-150">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ __('Konfirmasi') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>