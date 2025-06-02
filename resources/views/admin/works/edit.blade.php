{{-- resources/views/admin/works/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight"> {{-- Style judul disesuaikan --}}
                {{ __('Edit Portfolio Work') }}
            </h2>
            <a href="{{ route('admin.works.show', $work) }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150"> {{-- Tombol View Work ditambahkan --}}
                <i class="fas fa-eye mr-2"></i>View Work
            </a>
        </div>
    </x-slot>

    <div class="py-8"> {{-- Padding disesuaikan --}}
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-3xl dipertahankan --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200"> {{-- Style kartu disesuaikan --}}
                <div class="p-6 md:p-8 text-slate-700"> {{-- Warna teks & padding disesuaikan --}}
                    <form method="POST" action="{{ route('admin.works.update', $work) }}" enctype="multipart/form-data" class="space-y-6"> {{-- space-y-6 untuk jarak antar field --}}
                        @csrf
                        @method('PUT')

                        {{-- Work Title --}}
                        <div>
                            <x-input-label for="title" :value="__('Work Title')" class="!text-slate-700" />
                            <x-text-input id="title" class="block mt-1 w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" type="text" name="title" :value="old('title', $work->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Description --}}
                        <div>
                            <x-input-label for="description" :value="__('Description')" class="!text-slate-700" />
                            <textarea id="description" name="description" rows="5" required
                                      class="block mt-1 w-full border-slate-300 bg-white text-slate-700 focus:border-slate-500 focus:ring-slate-500 rounded-md shadow-sm">{{ old('description', $work->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        {{-- Year --}}
                        <div>
                            <x-input-label for="year" :value="__('Year (e.g., 2024)')" class="!text-slate-700" />
                            <x-text-input id="year" class="block mt-1 w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" type="number" name="year" :value="old('year', $work->year)" required placeholder="YYYY" />
                            <x-input-error :messages="$errors->get('year')" class="mt-2" />
                        </div>

                        {{-- Work Category --}}
                        <div>
                            <x-input-label for="category" :value="__('Work Category (e.g., Web Development)')" class="!text-slate-700" />
                            <x-text-input id="category" class="block mt-1 w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" type="text" name="category" :value="old('category', $work->category)" required />
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>

                        {{-- Project URL --}}
                        <div>
                            <x-input-label for="project_url" :value="__('Project URL (Optional)')" class="!text-slate-700" />
                            <x-text-input id="project_url" class="block mt-1 w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" type="url" name="project_url" :value="old('project_url', $work->project_url)" placeholder="https://example.com" />
                            <x-input-error :messages="$errors->get('project_url')" class="mt-2" />
                        </div>

                        {{-- Current Image --}}
                        <div>
                            <x-input-label :value="__('Current Image')" class="!text-slate-700" />
                            @if($work->image)
                                <img src="{{ asset('storage/' . $work->image) }}" alt="{{ $work->title }}" class="mt-2 h-32 w-auto rounded-md shadow-sm border border-slate-200 p-1"> {{-- Style gambar disesuaikan --}}
                            @else
                                <p class="mt-2 text-sm text-slate-500">No image uploaded.</p> {{-- Warna teks disesuaikan --}}
                            @endif
                        </div>

                        {{-- Change Image --}}
                        <div>
                            <x-input-label for="image" :value="__('Change Image (Optional)')" class="!text-slate-700" />
                            <x-text-input id="image" name="image" type="file" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" accept="image/*" />
                            <p class="mt-1 text-xs text-slate-500">Leave blank to keep current image. Max 2MB.</p> {{-- Warna teks & info tambahan --}}
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- Form Actions --}}
                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-slate-200 space-x-3"> {{-- Jarak & border atas --}}
                            <a href="{{ route('admin.works.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150"> {{-- Style tombol Cancel disesuaikan --}}
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150"> {{-- Style tombol Update disesuaikan --}}
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Update Work') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>