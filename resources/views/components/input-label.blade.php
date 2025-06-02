{{-- resources/views/components/input-label.blade.php (atau path komponen Anda) --}}
@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-slate-700']) }}>
    {{ $value ?? $slot }}
</label>