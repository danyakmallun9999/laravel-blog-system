<x-guest-layout>
    <div class="w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Login</h1>
            <p class="text-slate-600">Masukkan Email & Password Kamu</p> 
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-text-input id="email"
                    class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200" {{-- Kelas input disesuaikan --}}
                    type="email"
                    name="email"
                    :value="old('email')"
                    placeholder="Email"
                    required
                    autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="relative">
                <x-text-input id="password"
                    class="block w-full px-4 py-3 pr-12 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200" {{-- Kelas input disesuaikan --}}
                    type="password"
                    name="password"
                    placeholder="Password"
                    required
                    autocomplete="current-password" />

                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer group" onclick="togglePassword()">
                    <svg id="eye-icon" class="h-5 w-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Warna ikon mata disesuaikan --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="text-right">
                @if (Route::has('password.request'))
                    <a class="text-sm text-slate-600 hover:text-slate-800 hover:underline transition-colors duration-200" {{-- Warna link disesuaikan --}}
                        href="{{ route('password.request') }}">
                        Lupa Password? {{-- Teks diubah agar lebih umum --}}
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-slate-700 text-white font-semibold py-3 px-4 rounded-lg hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-100 transition-colors duration-150 transform hover:scale-[1.01]"> {{-- Style tombol utama disesuaikan --}}
                Sign In
            </button>
        </form>

        {{-- <div class="mt-8 mb-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-300"></div> 
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-slate-500">Atau lanjutkan dengan</span> 
                </div>
            </div>
        </div> --}}

        {{-- <a class="grid grid-cols-1 gap-3" href="{{ route('auth.google.redirect') }}">
            <button type="button" class="flex justify-center items-center px-4 py-3 border border-slate-300 rounded-lg bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-1 transition-colors duration-200"> 
                <svg class="w-5 h-5" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
            </button>
        </a> --}}

    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = `
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                    </svg>
                `;
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = `
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                `;
            }
        }
    </script>
</x-guest-layout>