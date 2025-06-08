<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-2xl sm:text-3xl text-slate-800 leading-tight">
                {{ __('Blog Categories') }}
            </h2>
            <a href="{{ route('admin.categories.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150 group">
                <i class="fas fa-plus transition-transform group-hover:scale-110"></i>
                <span class="hidden sm:inline ml-2">Add New Category</span>
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-200 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle text-red-600 mr-3"></i>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Categories Container -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-folder text-yellow-500 mr-3 text-xl"></i>
                            <h3 class="text-lg font-semibold text-slate-800">All Categories</h3>
                        </div>
                        <span class="px-3 py-1 bg-slate-200 text-slate-700 text-sm font-medium rounded-full">
                            {{ $categories->total() }} total
                        </span>
                    </div>
                </div>

                @if($categories->count() > 0)
                    <!-- Desktop Table View (md ke atas) -->
                    <div class="hidden md:block">
                        <table class="min-w-full">
                            <thead class="bg-slate-50/50">
                                <tr class="border-b border-slate-200">
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Slug</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Posts</th>
                                    <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach($categories as $category)
                                <tr class="hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap"><span class="font-semibold text-slate-800">{{ $category->name }}</span></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><span class="text-sm text-slate-600 font-mono">{{ $category->slug }}</span></td>
                                    <td class="px-6 py-4 whitespace-nowrap"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $category->posts_count ?? $category->posts()->count() }}</span></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?');" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View (di bawah md) - Style Lebih Rapi -->
                    <div class="md:hidden divide-y divide-slate-200">
                        @foreach($categories as $category)
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-slate-800">{{ $category->name }}</h4>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $category->posts_count ?? $category->posts()->count() }} posts
                                </span>
                            </div>
                            <p class="text-xs text-slate-500 mb-4">
                                Slug: <span class="font-mono bg-slate-100 px-2 py-0.5 rounded">{{ $category->slug }}</span>
                            </p>
                            <div class="flex justify-end items-center">
                                <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1 text-sm font-medium text-blue-600 hover:text-blue-800 transition">
                                    Edit
                                </a>
                                <div class="border-l border-slate-300 h-4 mx-2"></div>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 text-sm font-medium text-red-600 hover:text-red-800 transition">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($categories->hasPages())
                    <div class="p-6 border-t border-slate-200">
                        {{ $categories->links() }}
                    </div>
                    @endif
                @else
                    <div class="text-center py-16 px-6">
                        <i class="fas fa-folder-open text-slate-400 text-5xl mb-4"></i>
                        <h3 class="text-xl font-medium text-slate-800 mb-2">No Categories Found</h3>
                        <p class="text-slate-500 mb-6">Get started by creating your first category to organize your blog posts.</p>
                        <a href="{{ route('admin.categories.create') }}" 
                           class="inline-flex items-center px-6 py-3 bg-slate-800 hover:bg-slate-700 text-white font-semibold rounded-lg shadow-sm hover:shadow-md transition-all duration-200 group">
                            <i class="fas fa-plus mr-2 transition-transform group-hover:scale-110"></i>
                            Create First Category
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
