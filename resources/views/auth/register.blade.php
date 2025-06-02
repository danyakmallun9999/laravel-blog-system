{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    <div class="w-full">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-slate-800 mb-2">Buat Akun!</h1> {{-- Warna teks diubah --}}
            <p class="text-slate-600">Bergabunglah dan mulai perjalanan luar biasamu</p> {{-- Warna teks diubah --}}
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <x-text-input id="name"
                    class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200" {{-- Kelas input disesuaikan --}}
                    type="text"
                    name="name"
                    :value="old('name')"
                    placeholder="Nama Lengkap"
                    required
                    autofocus
                    autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-text-input id="email"
                    class="block w-full px-4 py-3 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200" {{-- Kelas input disesuaikan --}}
                    type="email"
                    name="email"
                    :value="old('email')"
                    placeholder="Alamat Email"
                    required
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
                    autocomplete="new-password" />

                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer group" onclick="togglePassword('password', 'eye-icon-1')">
                    <svg id="eye-icon-1" class="h-5 w-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Warna ikon mata disesuaikan --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="relative">
                <x-text-input id="password_confirmation"
                    class="block w-full px-4 py-3 pr-12 border border-slate-300 rounded-lg bg-white text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-all duration-200" {{-- Kelas input disesuaikan --}}
                    type="password"
                    name="password_confirmation"
                    placeholder="Konfirmasi Password"
                    required
                    autocomplete="new-password" />

                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer group" onclick="togglePassword('password_confirmation', 'eye-icon-2')">
                    <svg id="eye-icon-2" class="h-5 w-5 text-slate-400 group-hover:text-slate-600 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"> {{-- Warna ikon mata disesuaikan --}}
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-start">
                <div class="flex items-center h-5">
                    <input id="terms"
                        type="checkbox"
                        name="terms" {{-- Pastikan ada atribut name untuk checkbox jika diperlukan di backend --}}
                        class="w-4 h-4 bg-white border-slate-300 rounded text-slate-600 focus:ring-2 focus:ring-slate-500 focus:ring-offset-0" {{-- Style checkbox disesuaikan --}}
                        required>
                </div>
                <div class="ml-3 text-sm">
                    <label for="terms" class="text-slate-600"> {{-- Warna teks label disesuaikan --}}
                        Saya setuju dengan
                        <a href="#" class="text-slate-700 hover:text-slate-900 hover:underline font-medium">Syarat & Ketentuan</a> {{-- Warna link disesuaikan --}}
                        dan
                        <a href="#" class="text-slate-700 hover:text-slate-900 hover:underline font-medium">Kebijakan Privasi</a> {{-- Warna link disesuaikan --}}
                    </label>
                </div>
            </div>

            <button type="submit"
                class="w-full bg-slate-700 text-white font-semibold py-3 px-4 rounded-lg hover:bg-slate-600 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 focus:ring-offset-slate-100 transition-colors duration-150 transform hover:scale-[1.01]"> {{-- Style tombol utama disesuaikan --}}
                Buat Akun
            </button>

            <div class="text-center">
                <span class="text-slate-600">Sudah punya akun? </span> {{-- Warna teks diubah --}}
                <a class="text-slate-700 hover:text-slate-900 hover:underline font-medium transition-colors duration-200" {{-- Warna link disesuaikan --}}
                    href="{{ route('login') }}">
                    Masuk
                </a>
            </div>
        </form>

        <div class="mt-8 mb-6">
            <div class="relative">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-slate-300"></div> {{-- Warna border diubah --}}
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-slate-500">Atau daftar dengan</span> {{-- Warna teks diubah --}}
                </div>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-3">
            <button type="button" class="flex justify-center items-center px-4 py-3 border border-slate-300 rounded-lg bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-1 transition-colors duration-200"> {{-- Style tombol sosial disesuaikan --}}
                <svg class="w-5 h-5" viewBox="0 0 24 24"> {{-- SVG Google --}}
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                </svg>
            </button>

            <button type="button" class="flex justify-center items-center px-4 py-3 border border-slate-300 rounded-lg bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-1 transition-colors duration-200"> {{-- Style tombol sosial disesuaikan --}}
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"> {{-- SVG Apple --}}
                    <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                </svg>
            </button>

            <button type="button" class="flex justify-center items-center px-4 py-3 border border-slate-300 rounded-lg bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-1 transition-colors duration-200"> {{-- Style tombol sosial disesuaikan --}}
                <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"> {{-- SVG Facebook --}}
                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                </svg>
            </button>
        </div>
    </div>

    <script>
        // Fungsi togglePassword bisa digunakan bersama untuk kedua field password
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const eyeIcon = document.getElementById(iconId);

            if (!passwordInput || !eyeIcon) return; // Guard clause

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                // Path untuk ikon mata terbuka (contoh)
                eyeIcon.innerHTML = `
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21" />
                    </svg>
                `;
            } else {
                passwordInput.type = 'password';
                // Path untuk ikon mata tertutup (asli)
                eyeIcon.innerHTML = `
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                `;
            }
        }

        // Real-time password validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        function validatePassword() {
            if (confirmPassword && password) { // Pastikan elemen ada
                if (confirmPassword.value && password.value !== confirmPassword.value) {
                    confirmPassword.setCustomValidity('Passwords tidak cocok.'); // Pesan disesuaikan
                    confirmPassword.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500'); // Tambah style error pada fokus
                    confirmPassword.classList.remove('border-slate-300', 'focus:border-slate-500', 'focus:ring-slate-500'); // Hapus style normal
                } else {
                    confirmPassword.setCustomValidity('');
                    confirmPassword.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
                    // Kembalikan style normal jika sudah benar (atau biarkan Tailwind default jika tidak ada error)
                    // confirmPassword.classList.add('border-slate-300', 'focus:border-slate-500', 'focus:ring-slate-500');
                }
            }
        }

        if (password && confirmPassword) { // Pastikan elemen ada sebelum menambah event listener
            password.addEventListener('input', validatePassword);
            confirmPassword.addEventListener('input', validatePassword);
        }
    </script>
</x-guest-layout>