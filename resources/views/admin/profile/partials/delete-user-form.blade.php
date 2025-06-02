{{-- resources/views/admin/profile/partials/delete-user-form.blade.php --}}
<section class="space-y-6">
    <header>
        <h2 class="text-xl font-semibold text-slate-800"> {{-- Warna & ukuran teks disesuaikan --}}
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-slate-600"> {{-- Warna teks disesuaikan --}}
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    {{-- Tombol Delete Account Utama --}}
    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
        <i class="fas fa-trash-alt mr-2"></i>
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('admin.profile.destroy') }}" class="p-6 bg-white rounded-lg"> {{-- Tambahan bg-white & rounded-lg untuk modal content --}}
            @csrf
            @method('delete')

            <h2 class="text-xl font-semibold text-slate-800"> {{-- Warna & ukuran teks disesuaikan --}}
                {{ __('Are you sure you want to delete your account?') }}
            </h2>

            <p class="mt-2 text-sm text-slate-600"> {{-- Warna teks & margin disesuaikan --}}
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password_delete" value="{{ __('Password') }}" class="sr-only !text-slate-700" />
                <x-text-input
                    id="password_delete" {{-- ID diubah agar unik --}}
                    name="password"
                    type="password"
                    class="mt-1 block w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" {{-- Style input disesuaikan, w-full --}}
                    placeholder="{{ __('Password') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                {{-- Tombol Cancel dalam Modal --}}
                <button type="button" x-on:click="$dispatch('close')" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-times mr-2"></i>
                    {{ __('Cancel') }}
                </button>

                {{-- Tombol Delete Account dalam Modal --}}
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-800 focus:outline-none focus:border-red-800 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-trash-alt mr-2"></i>
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>