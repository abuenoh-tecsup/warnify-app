<button
    type="{{ $type ?? 'button' }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="{{ $attributes->merge(['class' => 'px-4 py-2 mt-1 bg-yellow-300 text-white rounded-xl hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500'])->get('class') }}"
    {{ $attributes }}>
    {{ $slot }}
</button>
