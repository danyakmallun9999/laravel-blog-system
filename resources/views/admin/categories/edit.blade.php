{{-- resources/views/admin/categories/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.categories.index') }}"
               class="mr-4 p-2 text-slate-600 hover:text-slate-800 hover:bg-slate-100 rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight"> {{-- Disesuaikan ke text-2xl seperti form post --}}
                {{ __('Edit Category') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-edit text-slate-600 mr-3 text-xl"></i> {{-- Icon color disesuaikan ke slate --}}
                            <div>
                                <h3 class="text-lg font-semibold text-slate-800">Edit Category</h3>
                                <p class="text-sm text-slate-600">Update category information</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-slate-500">Current slug:</p>
                            <span class="text-xs font-mono bg-slate-200 text-slate-700 px-2 py-1 rounded">{{ $category->slug }}</span>
                        </div>
                    </div>
                </div>

                <div class="p-6 md:p-8"> {{-- Tambahan md:p-8 untuk padding yang lebih konsisten --}}
                    <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700 mb-1"> {{-- mb-1 --}}
                                Category Name <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-tag text-slate-400"></i>
                                </div>
                                <input id="name"
                                       type="text"
                                       name="name"
                                       value="{{ old('name', $category->name) }}"
                                       required
                                       autofocus
                                       autocomplete="name"
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
                                The slug will be automatically updated if the name changes.
                            </p>
                        </div>

                        <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                            <h4 class="text-sm font-medium text-slate-700 mb-3">Category Statistics</h4>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="flex items-center">
                                    <i class="fas fa-newspaper text-slate-500 mr-2.5"></i> {{-- Icon color disesuaikan ke slate --}}
                                    <div>
                                        <p class="text-xs text-slate-500">Total Posts</p>
                                        <p class="text-sm font-medium text-slate-800">{{ $category->posts()->count() }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <i class="fas fa-calendar-alt text-slate-500 mr-2.5"></i> {{-- Icon color dan icon disesuaikan --}}
                                    <div>
                                        <p class="text-xs text-slate-500">Created</p>
                                        <p class="text-sm font-medium text-slate-800">{{ $category->created_at->format('M d, Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-between pt-6 mt-4 border-t border-slate-200 space-y-3 sm:space-y-0">
                            <a href="{{ route('admin.categories.index') }}"
                               class="inline-flex items-center w-full sm:w-auto justify-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-times mr-2"></i>
                                Cancel
                            </a>

                            <div class="flex items-center space-x-3 w-full sm:w-auto">
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this category? This action cannot be undone and will affect associated posts.');"
                                      class="inline w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold text-xs uppercase tracking-widest rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                                        <i class="fas fa-trash mr-2"></i>
                                        Delete
                                    </button>
                                </form>

                                <button type="submit"
                                        form="" {{-- Asumsi tombol ini submit form utama --}}
                                        class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white font-semibold text-xs uppercase tracking-widest rounded-lg shadow-sm hover:shadow-md transition-all duration-200 group active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300">
                                    <i class="fas fa-save mr-2 group-hover:scale-110 transition-transform"></i>
                                    Update Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if($category->posts()->count() > 0)
            <div class="mt-6 bg-yellow-50 rounded-xl border border-yellow-300 p-6 shadow-sm"> {{-- Border color sedikit disesuaikan --}}
                <div class="flex items-start">
                    <div class="shrink-0">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl mr-3 mt-0.5"></i> {{-- Warna & ukuran icon disesuaikan --}}
                    </div>
                    <div>
                        <h4 class="text-base font-semibold text-yellow-800 mb-1">Important Notice</h4>
                        <p class="text-sm text-yellow-700 mb-2">
                            This category contains <strong>{{ $category->posts()->count() }} post(s)</strong>.
                        </p>
                        <ul class="text-sm text-yellow-700 space-y-1 list-disc list-inside">
                            <li>Updating the name may change the URL slug.</li>
                            <li>Deleting this category will affect all associated posts. Ensure posts are reassigned or this is intended.</li>
                            <li>Consider the impact on your site's navigation and SEO.</li>
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>