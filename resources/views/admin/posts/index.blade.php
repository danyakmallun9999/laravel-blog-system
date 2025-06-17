<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <h2 class="font-semibold text-2xl sm:text-3xl text-slate-800 leading-tight">
                {{ __('Blog Posts') }}
            </h2>
            <a href="{{ route('admin.posts.create') }}"
                class="inline-flex items-center px-4 py-2 bg-slate-800 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-700 active:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition ease-in-out duration-150 group">
                <i class="fas fa-plus transition-transform group-hover:scale-110"></i>
                <span class="hidden sm:inline ml-2">Add New Post</span>
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-200 rounded-xl ">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-3"></i>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Posts Container -->
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden ">
                <div class="px-6 py-4 border-b border-slate-200 bg-slate-50">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-newspaper text-blue-500 mr-3 text-xl"></i>
                            <h3 class="text-lg font-semibold text-slate-800">All Posts</h3>
                        </div>
                        <span class="px-3 py-1 bg-slate-200 text-slate-700 text-sm font-medium rounded-full">
                            {{ $posts->total() }} total
                        </span>
                    </div>
                </div>

                @if ($posts->count() > 0)
                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        <table class="min-w-full">
                            <thead class="bg-slate-50/50">
                                <tr class="border-b border-slate-200">
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Image</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Title</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Author</th>
                                    <th
                                        class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200">
                                @foreach ($posts as $post)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4">
                                            @if ($post->image)
                                                @if (Str::startsWith($post->image, 'http'))
                                                    <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                        class="h-10 w-16 object-cover rounded-md shadow-sm">
                                                @else
                                                    <img src="{{ asset('storage/' . $post->image) }}"
                                                        alt="{{ $post->title }}"
                                                        class="h-10 w-16 object-cover rounded-md shadow-sm">
                                                @endif
                                            @else
                                                <span class="text-xs text-slate-400 italic">No Image</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-medium text-slate-900">
                                                {{ Str::limit($post->title, 40) }}</div>
                                            <div class="text-xs text-slate-500">{{ $post->created_at->format('d M Y') }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ $post->category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                                            {{ $post->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div x-data="{ show: false }"
                                                class="flex items-center justify-end space-x-3">
                                                <a href="{{ route('admin.posts.show', $post) }}"
                                                    class="font-medium text-sky-600 hover:text-sky-800">View</a>
                                                <a href="{{ route('admin.posts.edit', $post) }}"
                                                    class="font-medium text-amber-600 hover:text-amber-800">Edit</a>
                                                <form x-ref="deleteForm"
                                                    action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                                    class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" @click.prevent="show = true"
                                                        class="font-medium text-red-600 hover:text-red-800">Delete</button>
                                                </form>
                                                <x-confirm-deletion-modal title="Hapus Postingan"
                                                    message="Apakah Anda yakin ingin menghapus postingan?">
                                                    <x-slot:footer>
                                                        <button type="button" @click="$refs.deleteForm.submit()"
                                                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto">Ya,
                                                            Hapus</button>
                                                        <button type="button" @click="show = false"
                                                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                                                    </x-slot:footer>
                                                </x-confirm-deletion-modal>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden divide-y divide-slate-200">
                        @foreach ($posts as $post)
                            <div x-data="{ show: false }" class="p-4">
                                <div class="flex gap-4">
                                    @if ($post->image)
                                        <div class="w-20 h-20 flex-shrink-0">
                                            @if (Str::startsWith($post->image, 'http'))
                                                <img src="{{ $post->image }}" alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover rounded-lg shadow">
                                            @else
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                    alt="{{ $post->title }}"
                                                    class="w-full h-full object-cover rounded-lg shadow">
                                            @endif
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-slate-800 truncate">{{ $post->title }}</h4>
                                        <p class="text-xs text-slate-500 mt-1">
                                            <span class="font-medium text-blue-600">{{ $post->category->name }}</span>
                                            <span class="mx-1">•</span>
                                            <span>{{ $post->user->name }}</span>
                                        </p>
                                        <p class="text-xs text-slate-400 mt-1">
                                            {{ $post->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                {{-- ==================== PERBAIKAN DI SINI (MOBILE) ==================== --}}
                                <div
                                    class="flex items-center justify-end space-x-2 mt-3 pt-3 border-t border-slate-200">
                                    <a href="{{ route('admin.posts.show', $post) }}"
                                        class="px-3 py-1 text-sm font-medium text-sky-600 hover:bg-sky-50 rounded-md transition-colors">View</a>
                                    <a href="{{ route('admin.posts.edit', $post) }}"
                                        class="px-3 py-1 text-sm font-medium text-amber-600 hover:bg-amber-50 rounded-md transition-colors">Edit</a>

                                    <form x-ref="deleteForm" action="{{ route('admin.posts.destroy', $post) }}"
                                        method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="button" @click.prevent="show = true"
                                            class="px-3 py-1 text-sm font-medium text-red-600 hover:text-red-800 transition">Delete</button>
                                    </form>
                                    <x-confirm-deletion-modal title="Hapus Postingan"
                                        message="Apakah Anda yakin ingin menghapus postingan '{{ e(Str::limit($post->title, 30)) }}'?">
                                        <x-slot:footer>
                                            <button type="button" @click="$refs.deleteForm.submit()"
                                                class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto">Ya,
                                                Hapus</button>
                                            <button type="button" @click="show = false"
                                                class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Batal</button>
                                        </x-slot:footer>
                                    </x-confirm-deletion-modal>
                                </div>
                                {{-- ================== AKHIR DARI PERBAIKAN ================== --}}
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if ($posts->hasPages())
                        <div class="p-6 border-t border-slate-200">
                            {{ $posts->links() }}
                        </div>
                    @endif
                @else
                    {{-- Empty State --}}
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
