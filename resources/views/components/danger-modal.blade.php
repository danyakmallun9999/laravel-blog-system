{{-- 
    Komponen modal generik yang terinspirasi dari Breeze.
    - Props: $name (nama unik untuk modal). $title & $message adalah default.
    - x-data: Menyimpan state 'show' dan data dinamis (actionUrl, title, message).
    - @open-danger-modal.window: Mendengarkan event global untuk membuka modal dan menerima data dinamis.
--}}
@props(['name', 'title' => 'Konfirmasi Tindakan', 'message' => 'Tindakan ini tidak dapat diurungkan.'])

<div x-data="{
    show: false,
    actionUrl: '',
    title: '{{ $title }}',
    message: '{{ e($message) }}'
}"
    x-on:open-danger-modal.window="
        if ($event.detail.name === '{{ $name }}') {
            show = true;
            actionUrl = $event.detail.actionUrl;
            title = $event.detail.title || '{{ $title }}';
            message = $event.detail.message || '{{ e($message) }}';
        }
    "
    x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-show="show" class="relative z-50" x-cloak>
    {{-- Overlay Gelap --}}
    <div x-show="show" x-transition.opacity class="fixed inset-0 bg-gray-900 bg-opacity-75"></div>

    {{-- Konten Modal --}}
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
            <div x-show="show" @click.outside="show = false" x-transition
                class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">

                <form :action="actionUrl" method="POST" class="w-full">
                    @csrf
                    @method('DELETE')

                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                <i class="fas fa-exclamation-triangle text-xl text-red-600"></i>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left min-w-0 flex-1">
                                <h3 class="text-lg font-semibold leading-6 text-gray-900" x-text="title"></h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500" x-text="message"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                        <button type="submit"
                            class="inline-flex w-full justify-center rounded-md bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 sm:ml-3 sm:w-auto">
                            Ya, Hapus
                        </button>
                        <button type="button" @click="show = false"
                            class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-4 py-2 text-sm font-medium text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
