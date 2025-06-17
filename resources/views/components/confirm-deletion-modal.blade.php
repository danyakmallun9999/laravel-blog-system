{{-- 
    Komponen modal konfirmasi dengan perbaikan layout shift dan text wrap.
--}}
@props([
    'title' => 'Konfirmasi Tindakan',
    'message' => 'Apakah Anda yakin ingin melanjutkan? Tindakan ini tidak dapat diurungkan.',
])

<div x-show="show" x-cloak {{-- MENAMBAHKAN LOGIKA UNTUK MENCEGAH LAYOUT SHIFT --}} x-init="$watch('show', value => {
    if (value) {
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;
        document.body.style.paddingRight = `${scrollbarWidth}px`;
        document.body.classList.add('overflow-y-hidden');
    } else {
        // Menunggu transisi selesai sebelum mengembalikan padding
        setTimeout(() => {
            document.body.classList.remove('overflow-y-hidden');
            document.body.style.paddingRight = '';
        }, 300); // Durasi harus cocok dengan x-transition:leave
    }
})" @keydown.escape.window="show = false"
    class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    {{-- Lapisan Overlay Gelap --}}
    <div x-show="show" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" @click="show = false"></div>

    {{-- Kontainer untuk memosisikan panel modal di tengah --}}
    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">

            <div x-show="show" @click.outside="show = false" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg">
                <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <i class="fas fa-exclamation-triangle text-xl text-red-600"></i>
                        </div>

                        <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left min-w-0 flex-1">
                            <h3 class="text-lg font-semibold leading-6 text-gray-900" id="modal-title">
                                {{ $title }}
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500 break-words">
                                    {{ $message }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                    {{ $footer }}
                </div>
            </div>
        </div>
    </div>
</div>
