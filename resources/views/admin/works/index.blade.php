<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
                {{ __('Portfolio Works') }}
            </h2>
            <a href="{{ route('admin.works.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-slate-800  border border-transparent rounded-lg font-semibold text-xs text-white  uppercase tracking-widest hover:bg-slate-700  focus:bg-slate-700  active:bg-slate-900focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2  transition ease-in-out duration-150 group">
                <i class="fas fa-plus transition-transform group-hover:scale-110"></i
                <span class="hidden sm:inline ml-2">Add New Work</span>
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200">
                <div class="p-6 text-slate-700"
                    @if($works->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50"
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
                            <tbody class="bg-white divide-y divide-slate-200"> 
                                @foreach($works as $work)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($work->image)
                                            <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}" class="h-10 w-16 object-cover rounded-md shadow-sm"> 
                                        @else
                                             <span class="text-xs text-slate-400 italic">No Image</span> 
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ Str::limit($work->title, 40) }}</td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $work->year }}</td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $work->category }}</td> 
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-3"> 
                                        <a href="{{ route('admin.works.show', $work) }}" class="text-sky-600 hover:text-sky-800 font-medium transition-colors">View</a>
                                        <a href="{{ route('admin.works.edit', $work) }}" class="text-amber-600 hover:text-amber-800 font-medium transition-colors">Edit</a>
                                        <form action="{{ route('admin.works.destroy', $work) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this work?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition-colors">Delete</button> 
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if ($works->hasPages())
                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-200"> 
                        {{ $works->links() }}
                    </div>
                    @endif
                    @else
                    <div class="text-center py-10">
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