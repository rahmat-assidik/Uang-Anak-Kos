<button {{ $attributes->merge(['type' => 'submit', 'class' => 'px-6 py-3 bg-blue-600 border border-blue-600 text-white font-bold text-[10px] uppercase tracking-widest hover:bg-blue-700 transition rounded']) }}>
    {{ $slot }}
</button>
