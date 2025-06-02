{{-- resources/views/admin/profile/partials/update-profile-information-form.blade.php --}}
<section>
    <header>
        <h2 class="text-xl font-semibold text-slate-800"> {{-- Warna & ukuran teks disesuaikan --}}
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-slate-600"> {{-- Warna teks disesuaikan --}}
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('admin.profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" class="!text-slate-700" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="!text-slate-700" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-slate-800"> {{-- Warna teks disesuaikan --}}
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-slate-600 hover:text-slate-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500"> {{-- Style tombol & fokus disesuaikan --}}
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600"> {{-- Warna teks hijau dipertahankan --}}
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150"> {{-- Mengganti x-primary-button --}}
                <i class="fas fa-save mr-2"></i>
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-slate-600" {{-- Warna teks disesuaikan --}}
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>