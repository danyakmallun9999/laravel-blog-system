{{-- resources/views/admin/posts/show.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight mb-3 sm:mb-0">
                {{ $post->title }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.posts.edit', $post) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
                <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                    <i class="fas fa-arrow-left mr-2"></i>Back to List
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8"> {{-- Disesuaikan dari py-12 ke py-8 --}}
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-4xl dipertahankan untuk readability --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200">
                <div class="p-6 md:p-8 text-slate-700">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full max-h-[400px] object-cover rounded-lg mb-6 shadow-md">
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6 pb-6 border-b border-slate-200">
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Category:</span>
                            <span class="text-sm text-slate-800 font-semibold">{{ $post->category->name }}</span>
                        </div>
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Author:</span>
                            <span class="text-sm text-slate-800 font-semibold">{{ $post->user->name }}</span>
                        </div>
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Published On:</span>
                            <span class="text-sm text-slate-800 font-semibold">{{ $post->created_at->format('F j, Y, g:i a') }}</span>
                        </div>
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Last Updated:</span>
                            <span class="text-sm text-slate-800 font-semibold">{{ $post->updated_at->format('F j, Y, g:i a') }}</span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="text-xs font-medium text-slate-500 block mb-1">Slug:</span>
                            <span class="text-sm text-slate-800 font-semibold break-all">{{ $post->slug }}</span>
                        </div>
                    </div>


                    <h3 class="text-xl font-semibold mb-3 text-slate-800">Content:</h3>
                    {{-- Tailwind Typography (prose) akan menangani styling konten HTML --}}
                    <div class="prose prose-lg max-w-none text-slate-700">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>