@props(['active'])
@php
$classes = ($active ?? false)
            // Kelas untuk link yang AKTIF
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-slate-700  text-start text-base font-medium text-slate-800 bg-slate-100 focus:outline-none focus:text-slate-900 focus:bg-slate-200focus:border-slate-800 transition duration-150 ease-in-out'
            // Kelas untuk link yang TIDAK AKTIF
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-slate-600 hover:text-slate-800 hover:bg-slate-50 hover:border-slate-300 focus:outline-none focus:text-slate-800 focus:bg-slate-50 focus:border-slate-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
