<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-6 md:p-8">
                    @include('admin.profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-6 md:p-8">
                    @include('admin.profile.partials.update-password-form')
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-slate-200">
                <div class="p-6 md:p-8">
                    @include('admin.profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
