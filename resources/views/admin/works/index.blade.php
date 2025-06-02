{{-- resources/views/admin/works/index.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight"> {{-- Ukuran font disesuaikan --}}
                {{ __('Portfolio Works') }}
            </h2>
            <a href="{{ route('admin.works.create') }}" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150"> {{-- Style tombol disesuaikan --}}
                <i class="fas fa-plus mr-2"></i>
                {{ __('Add New Work') }}
            </a>
        </div>
    </x-slot>

    <div class="py-8"> {{-- Padding disesuaikan --}}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm"> {{-- Style notifikasi disesuaikan --}}
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200"> {{-- Style kartu disesuaikan --}}
                <div class="p-6 text-slate-700"> {{-- Warna teks disesuaikan --}}
                    @if($works->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200"> {{-- Warna border disesuaikan --}}
                            <thead class="bg-slate-50"> {{-- Warna bg disesuaikan --}}
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Image</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Title</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Year</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200"> {{-- Warna border disesuaikan --}}
                                @foreach($works as $work)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($work->image)
                                            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}" class="h-10 w-16 object-cover rounded-md shadow-sm"> {{-- Style gambar disesuaikan --}}
                                        @else
                                             <span class="text-xs text-slate-400 italic">No Image</span> {{-- Style teks disesuaikan --}}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ Str::limit($work->title, 40) }}</td> {{-- Warna teks disesuaikan --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $work->year }}</td> {{-- Warna teks disesuaikan --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $work->category }}</td> {{-- Warna teks disesuaikan --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3"> {{-- space-x-3 untuk jarak --}}
                                        <a href="{{ route('admin.works.show', $work) }}" class="text-sky-600 hover:text-sky-800 font-medium transition-colors">View</a> {{-- Style link disesuaikan --}}
                                        <a href="{{ route('admin.works.edit', $work) }}" class="text-amber-600 hover:text-amber-800 font-medium transition-colors">Edit</a> {{-- Style link disesuaikan --}}
                                        <form action="{{ route('admin.works.destroy', $work) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this work?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Delete</button> {{-- Style tombol disesuaikan --}}
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($works->hasPages())
                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200"> {{-- Style paginasi disesuaikan --}}
                        {{ $works->links() }}
                    </div>
                    @endif
                    @else
                    <div class="text-center py-10"> {{-- Style empty state disesuaikan --}}
                        <i class="fas fa-briefcase text-slate-400 text-4xl mb-3"></i>
                        <h3 class="text-lg font-medium text-slate-700 mb-1">No Works Found</h3>
                        <p class="text-sm text-slate-500 mb-4">There are no portfolio works to display at the moment.</p>
                        <a href="{{ route('admin.works.create') }}" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-plus mr-2"></i>
                            {{ __('Create New Work') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>