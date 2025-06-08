{{-- resources/views/admin/posts/create.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-2xl text-slate-800 leading-tight">
                {{ __('Add New Blog Post') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-2"> {{-- Disesuaikan dari py-12 ke py-8 --}}
           <a href="{{ route('admin.posts.index') }}" 
               class="inline-flex items-center text-gray-600 hover:text-gray-800 font-medium transition-colors duration-300 mb-3">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Back to Blog
            </a>
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8"> {{-- max-w-3xl dipertahankan untuk form --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-xl border border-slate-200">
                <div class="p-6 md:p-8 text-slate-700">
                    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Post Title --}}
                        <div>
                            <x-input-label for="title" :value="__('Post Title')" class="!text-slate-700" />
                            <x-text-input id="title" class="block mt-1 w-full !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Category --}}
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Category')" class="!text-slate-700" />
                            <select name="category_id" id="category_id" required
                                    class="block mt-1 w-full border-slate-300 bg-white text-slate-700 focus:border-slate-500 focus:ring-slate-500 rounded-md shadow-sm">
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                      class="block mt-1 w-full border-slate-300 bg-white text-slate-700 focus:border-slate-500 focus:ring-slate-500 rounded-md shadow-sm tinymce-textarea">{{ old('content') }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                        {{-- Post Image --}}
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Post Image (Optional)')" class="!text-slate-700" />
                            <x-text-input id="image" name="image" type="file" class="block mt-1 w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 !border-slate-300 focus:!border-slate-500 focus:!ring-slate-500" accept="image/*" />
                            <p class="mt-1 text-xs text-slate-500">Recommended size: 1200x630. Max 2MB.</p>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- Form Actions --}}
                        <div class="flex items-center justify-end mt-8 pt-6 border-t border-slate-200 space-x-3">
                             <a href="{{ route('admin.posts.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-300 rounded-lg font-semibold text-xs text-slate-700 uppercase tracking-widest hover:bg-slate-50 active:bg-slate-100 focus:outline-none focus:border-slate-400 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Cancel
                            </a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-slate-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-slate-600 active:bg-slate-800 focus:outline-none focus:border-slate-800 focus:ring ring-slate-300 disabled:opacity-25 transition ease-in-out duration-150">
                                <i class="fas fa-plus-circle mr-2"></i>
                                {{ __('Save Post') }}
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
                    skin: 'oxide',//(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'oxide-dark' : 'oxide'),
                    content_css: 'default', //(window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'default'),
                    // images_upload_handler: function (blobInfo, success, failure, progress) {
                    //     var xhr, formData;
                    //     xhr = new XMLHttpRequest();
                    //     xhr.withCredentials = false;
                    //     xhr.open('POST', '{{-- route('admin.tinymce.upload') --}}'); // Ganti dengan route Anda
                    //     xhr.setRequestHeader("X-CSRF-Token", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                    //
                    //     xhr.upload.onprogress = function (e) {
                    //         progress(e.loaded / e.total * 100);
                    //     };
                    //
                    //     xhr.onload = function() {
                    //         var json;
                    //         if (xhr.status === 403) {
                    //             failure('HTTP Error: ' + xhr.status, { remove: true });
                    //             return;
                    //         }
                    //         if (xhr.status < 200 || xhr.status >= 300) {
                    //             failure('HTTP Error: ' + xhr.status);
                    //             return;
                    //         }
                    //         json = JSON.parse(xhr.responseText);
                    //         if (!json || typeof json.location != 'string') {
                    //             failure('Invalid JSON: ' + xhr.responseText);
                    //             return;
                    //         }
                    //         success(json.location);
                    //     };
                    //
                    //     xhr.onerror = function () {
                    //         failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                    //     };
                    //
                    //     formData = new FormData();
                    //     formData.append('file', blobInfo.blob(), blobInfo.filename());
                    //     xhr.send(formData);
                    // }
                });
            } else {
                console.error('TinyMCE script not loaded');
            }
        });
    </script>
    @endpush
</x-app-layout>