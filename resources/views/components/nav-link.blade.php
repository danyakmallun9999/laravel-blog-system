{{-- @props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a> --}}

{{-- resources/views/components/nav-link.blade.php (Contoh Modifikasi) --}}
@props(['active'])

@php
// Kelas dasar untuk semua nav-link
$baseClasses = 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition-colors focus:outline-none';

// Kelas spesifik untuk state aktif dan tidak aktif sesuai tema Anda
$activeClasses = 'border-slate-700 text-slate-900 font-semibold focus:border-slate-800'; // Tema slate untuk aktif
$inactiveClasses = 'border-transparent text-slate-600 hover:text-slate-900 hover:border-slate-400 focus:text-slate-900 focus:border-slate-400'; // Tema slate untuk tidak aktif

$classes = $baseClasses . ' ' . ($active ? $activeClasses : $inactiveClasses);
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>