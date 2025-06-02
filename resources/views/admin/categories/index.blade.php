{{-- resources/views/admin/categories/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-3xl text-slate-800 leading-tight">
                {{ __('Blog Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform"></i>
                Add New Category
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Categories Card -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-folder text-yellow-600 mr-3 text-xl"></i>
                            <h3 class="text-lg font-semibold text-slate-800">All Categories</h3>
                        </div>
                        <span class="px-3 py-1 bg-slate-200 text-slate-700 text-sm font-medium rounded-full">
                            {{ $categories->total() }} total
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    @if($categories->count() > 0)
                        <!-- Desktop Table View -->
                        <div class="hidden md:block overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-slate-200">
                                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wide">Name</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wide">Slug</th>
                                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wide">Posts</th>
                                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wide">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200">
                                    @foreach($categories as $category)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-4 py-4">
                                            <div class="flex items-center">
                                                <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                                                <span class="text-sm font-medium text-slate-800">{{ $category->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="text-sm text-slate-600 font-mono bg-slate-100 px-2 py-1 rounded">{{ $category->slug }}</span>
                                        </td>
                                        <td class="px-4 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                {{ $category->posts_count ?? $category->posts()->count() }} posts
                                            </span>
                                        </td>
                                        <td class="px-4 py-4 text-right">
                                            <div class="flex items-center justify-end space-x-2">
                                                <a href="{{ route('admin.categories.edit', $category) }}" 
                                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors">
                                                    <i class="fas fa-edit mr-1"></i>
                                                    Edit
                                                </a>
                                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                                                      onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg transition-colors">
                                                        <i class="fas fa-trash mr-1"></i>
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="md:hidden space-y-4">
                            @foreach($categories as $category)
                            <div class="bg-slate-50 rounded-lg p-4 border border-slate-200">
                                <div class="flex items-center justify-between mb-3">
                                    <div class="flex items-center">
                                        <div class="w-2 h-2 bg-yellow-500 rounded-full mr-3"></div>
                                        <h4 class="text-sm font-medium text-slate-800">{{ $category->name }}</h4>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $category->posts_count ?? $category->posts()->count() }} posts
                                    </span>
                                </div>
                                <div class="mb-3">
                                    <span class="text-xs text-slate-500 font-mono bg-slate-200 px-2 py-1 rounded">{{ $category->slug }}</span>
                                </div>
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" 
                                       class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-800 hover:bg-blue-100 rounded-lg transition-colors">
                                        <i class="fas fa-edit mr-1"></i>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                                          onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-800 hover:bg-red-100 rounded-lg transition-colors">
                                            <i class="fas fa-trash mr-1"></i>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        @if($categories->hasPages())
                        <div class="mt-6 pt-6 border-t border-slate-200">
                            {{ $categories->links() }}
                        </div>
                        @endif
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-12">
                            <i class="fas fa-folder-open text-slate-400 text-4xl mb-4"></i>
                            <h3 class="text-lg font-medium text-slate-800 mb-2">No categories found</h3>
                            <p class="text-slate-500 mb-6">Get started by creating your first category</p>
                            <a href="{{ route('admin.categories.create') }}" 
                               class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-xl shadow-sm hover:shadow-md transition-all duration-200 group">
                                <i class="fas fa-plus mr-2 group-hover:scale-110 transition-transform"></i>
                                Create Category
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>