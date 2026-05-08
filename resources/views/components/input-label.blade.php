@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 ml-1']) }}>
    {{ $value ?? $slot }}
</label>
