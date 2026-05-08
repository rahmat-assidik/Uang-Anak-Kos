@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1 ml-1']) }}>
    {{ $value ?? $slot }}
</label>
