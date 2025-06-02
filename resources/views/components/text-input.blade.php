{{-- @props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}> --}}

{{-- resources/views/components/text-input.blade.php (Contoh Modifikasi) --}}
@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => 'block w-full '. // Tambahkan block w-full jika belum ada atau jika ingin default
               'bg-white border-slate-300 text-slate-900 placeholder:text-slate-400 '. // Style dasar light mode
               'focus:border-slate-500 focus:ring-2 focus:ring-slate-500 focus:ring-offset-0 '. // Style fokus
               'rounded-md shadow-sm' // Style bawaan Breeze yang mungkin ingin dipertahankan
               // Hapus atau sesuaikan bagian dark: jika tidak diperlukan/ingin diubah
               // 'dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 ' .
               // 'dark:focus:border-indigo-600 dark:focus:ring-indigo-600'
]) !!}>