<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight mb-3 sm:mb-0"> 
                {{ $work->title }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.works.edit', $work) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-600 active:bg-amber-700 focus:outline-none focus:border-amber-700 focus:ring ring-amber-300 disabled:opacity-25 transition ease-in-out duration-150"> 
                    <i class="fas fa-edit mr-2"></i>Edit
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-2">
        <a href="{{ route('admin.works.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 mb-3">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to List
        </a>
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200">
                <div class="p-6 md:p-8 text-slate-700"> 
                    @if($work->image)
                        <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}" class="w-full max-h-[400px] object-cover rounded-lg mb-6 shadow-md"> 
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 mb-6 pb-6 border-b border-slate-200">
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Year:</span>
                            <p class="text-sm text-slate-800 font-semibold">{{ $work->year }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Category:</span>
                            <p class="text-sm text-slate-800 font-semibold">{{ $work->category }}</p>
                        </div>
                        @if($work->project_url)
                        <div class="md:col-span-2">
                            <span class="text-xs font-medium text-slate-500 block mb-1">Project URL:</span>
                            <p class="text-sm text-slate-800 font-semibold">
                                <a href="{{ $work->project_url }}" target="_blank" class="text-sky-600 hover:text-sky-800 hover:underline break-all">{{ $work->project_url }}</a>
                            </p>
                        </div>
                        @endif
                         <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Created At:</span>
                            <p class="text-sm text-slate-800 font-semibold">{{ $work->created_at->format('M d, Y, H:i A') }}</p>
                        </div>
                        <div>
                            <span class="text-xs font-medium text-slate-500 block mb-1">Last Updated:</span>
                            <p class="text-sm text-slate-800 font-semibold">{{ $work->updated_at->format('M d, Y, H:i A') }}</p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <h3 class="text-xl font-semibold mb-3 text-slate-800">Description:</h3> 
                    @if($work->description)
                    <div class="prose prose-lg max-w-none text-slate-700">
                        {!! nl2br(e($work->description)) !!}
                    </div>
                    @else
                    <p class="text-slate-500 italic">No description provided.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>