<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}"
                class="mr-4 p-2 text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
                {{ __('Add New Category') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center">
                        <i class="fas fa-folder-plus text-slate-600 mr-3 text-xl"></i>
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800">Category Information</h3>
                            <p class="text-sm text-slate-600">Enter details for the new category</p>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1">
                                Category Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-slate-400"></i>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                    autofocus autocomplete="name"
                                    class="block w-full pl-10 pr-3 py-2.5 {{ $errors->has('name') ? 'border-red-300 ring-red-300' : 'border-slate-300' }} rounded-lg text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-slate-500 transition-colors"
                                    placeholder="Enter category name...">
                            </div>
                            @error('name')
                                <div class="mt-2 flex items-center text-sm text-red-600">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <p class="mt-2 text-xs text-slate-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                The slug will be automatically generated from the category name.
                            </p>
                        </div>

                        <div
                            class="flex flex-col sm:flex-row items-center justify-between pt-6 mt-4 border-t border-slate-200 space-y-3 sm:space-y-0">
                            <a href="{{ route('admin.categories.index') }}"
                                class="inline-flex items-center w-full sm:w-auto justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-times mr-2"></i>
                                Cancel
                            </a>

                            <button type="submit"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white font-semibold text-xs uppercase tracking-widest rounded-lg shadow-sm hover:shadow-md transition-all duration-200 group active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300">
                                <i class="fas fa-plus-circle mr-2 group-hover:scale-110 transition-transform"></i>
                                Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-6 bg-sky-50 rounded-xl border border-sky-300 p-6 shadow-sm">
                <div class="flex items-start">
                    <div class="shrink-0">
                        <i class="fas fa-info-circle text-sky-500 text-xl mr-3 mt-0.5"></i>
                    </div>
                    <div>
                        <h4 class="text-base font-semibold text-sky-800 mb-1">Helpful Tips</h4>
                        <ul class="text-sm text-sky-700 space-y-1 list-disc list-inside">
                            <li>Use clear, descriptive names that reflect your content.</li>
                            <li>Keep names concise but meaningful.</li>
                            <li>Avoid special characters; they'll be removed from the URL slug.</li>
                            <li>Categories help organize your posts for better navigation.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
