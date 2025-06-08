{{-- resources/views/components/dropdown-link.blade.php --}}

@props(['active'])

@php
// Kelas-kelas warna default 'gray' telah diganti dengan 'slate' untuk konsistensi tema.
// Kelas-kelas 'dark:' telah dihapus karena tidak digunakan.
$classes = 'block w-full px-4 py-2 text-start text-sm leading-5 text-slate-700 hover:bg-slate-100 focus:outline-none focus:bg-slate-100 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
