<button
    type="{{ $type ?? 'button' }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="{{ $attributes->merge(['class' => 'px-4 py-2 mt-1 text-white rounded-xl focus:outline-none focus:ring-2 focus:ring-yellow-500'])->get('class') }}"
    {{ $attributes }}>
    {{ $slot }}
</button>
