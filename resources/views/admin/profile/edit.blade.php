{{-- resources/views/admin/profile/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 leading-tight"> {{-- Style judul disesuaikan --}}
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-8"> {{-- Padding disesuaikan --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6"> {{-- max-w-4xl untuk layout yang sedikit lebih lebar --}}
            {{-- Update Profile Information Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200"> {{-- Style kartu disesuaikan --}}
                <div class="p-6 md:p-8"> {{-- Padding dalam kartu --}}
                    {{-- max-w-xl diatur di dalam partial jika diperlukan --}}
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Update Password Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200"> {{-- Style kartu disesuaikan --}}
                <div class="p-6 md:p-8"> {{-- Padding dalam kartu --}}
                    @include('admin.profile.partials.update-password-form')
                </div>
            </div>

            {{-- Delete Account Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-slate-200"> {{-- Style kartu disesuaikan --}}
                <div class="p-6 md:p-8"> {{-- Padding dalam kartu --}}
                    @include('admin.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>