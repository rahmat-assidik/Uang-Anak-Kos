@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded shadow-none focus:ring-0 focus:border-blue-600 transition-colors text-sm font-medium']) !!}>
