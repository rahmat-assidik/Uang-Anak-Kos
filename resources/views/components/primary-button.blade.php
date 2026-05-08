<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-2.5 bg-blue-600 border border-blue-600 text-white font-semibold text-xs transition rounded hover:bg-blue-700']) }}>
    {{ $slot }}
</button>
