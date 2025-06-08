<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
                {{ __('Edit Blog Post') }}
            </h2>
            <a href="{{ route('admin.posts.show', $post) }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                <i class="fas fa-eye mr-2"></i>View Post
            </a>
        </div>
    </x-slot>

    <div class="py-2">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> 
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200">
                <div class="p-6 md:p-8 text-slate-700">
                    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Post Title --}}
                        <div>
                            <x-input-label for="title" :value="__('Post Title')" class="!text-slate-700" />
                            <x-text-input id="title" class="block mt-1 w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" type="text" name="title" :value="old('title', $post->title)" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Category --}}
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Category')" class="!text-slate-700" />
                            <select name="category_id" id="category_id" required
                                    class="block mt-1 w-full border-slate-300 bg-white text-slate-700 focus:border-slate-500 focus:ring-slate-500 rounded-md shadow-sm">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        {{-- Content --}}
                        <div class="mt-4">
                            <x-input-label for="content-editor" :value="__('Content')" class="!text-slate-700" />
                            <textarea id="content-editor" name="content" rows="10"
                                      class="block mt-1 w-full border-slate-300 bg-white text-slate-700 focus:border-slate-500 focus:ring-slate-500 rounded-md shadow-sm tinymce-textarea">{{ old('content', $post->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        {{-- Current Image --}}
                        <div class="mt-6">
                            <x-input-label :value="__('Current Image')" class="!text-slate-700" />
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="mt-2 h-32 w-auto rounded-md shadow-sm border border-slate-200 p-1">
                            @else
                                <p class="mt-2 text-sm text-slate-500">No image uploaded.</p>
                            @endif
                        </div>

                        {{-- Change Image --}}
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Change Image (Optional)')" class="!text-slate-700" />
                            {{-- Untuk x-text-input type file, stylingnya mungkin lebih terbatas --}}
                            <x-text-input id="image" name="image" type="file" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" accept="image/*" />
                            <p class="mt-1 text-xs text-slate-500">Leave blank to keep the current image. Max 2MB.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- Form Actions --}}
                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-slate-200 space-x-3">
                             <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-save mr-2"></i>
                                {{ __('Update Post') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea#content-editor',
                    plugins: 'code table lists image media link wordcount fullscreen preview autoresize',
                    toolbar: 'undo redo | blocks | bold italic underline | alignleft aligncenter alignright alignjustify | indent outdent | bullist numlist | code | table | image media link | fullscreen preview | wordcount',
                    height: 550,
                    autoresize_bottom_margin: 50,
                    // Tambahan: Konfigurasi untuk upload gambar jika diperlukan (memerlukan backend)
                    // images_upload_url: '{{-- route('admin.tinymce.upload') --}}', // Contoh route
                    // images_upload_credentials: true, // Jika menggunakan session/cookie
                    // file_picker_types: 'image media',
                    // file_picker_callback: function (cb, value, meta) { /* ... */ }
                    skin: 'oxide', // (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
                    content_css: 'default' // (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default')
                });
            } else {
                console.error('TinyMCE script not loaded');
            }
        });
    </script>
    @endpush
</x-app-layout>