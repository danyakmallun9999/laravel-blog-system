{{-- resources/views/auth/reset-password.blade.php --}}
<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-slate-800 mb-2">{{ __('Atur Ulang Password Anda') }}</h1>
        <p class="text-slate-600">{{ __('Masukkan alamat email Anda dan password baru.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="space-y-6"> {{-- Menambahkan space-y-6 untuk jarak konsisten --}}
            <div>
                <x-input-label for="email" :value="__('Email')" class="!text-slate-700" /> {{-- Pastikan label konsisten --}}
                <x-text-input id="email"
                              class="block mt-1 w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 shadow-sm transition-colors duration-200" {{-- Style input disamakan dengan login/register --}}
                              type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password Baru')" class="!text-slate-700" />
                <x-text-input id="password"
                              class="block mt-1 w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 shadow-sm transition-colors duration-200" {{-- Style input disamakan --}}
                              type="password" name="password" required autocomplete="new-password" placeholder="Masukkan password baru"/>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" class="!text-slate-700" />
                <x-text-input id="password_confirmation"
                              class="block mt-1 w-full px-4 py-3 bg-white border border-slate-300 rounded-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 shadow-sm transition-colors duration-200" {{-- Style input disamakan --}}
                              type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi password baru"/>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end pt-2"> {{-- pt-2 untuk sedikit jarak tambahan --}}
                {{-- Mengganti x-primary-button dengan style yang konsisten --}}
                <button type="submit"
                        class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-slate-700 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-100 transition-colors duration-150">
                    <i class="fas fa-key mr-2"></i>
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>
</x-guest-layout>