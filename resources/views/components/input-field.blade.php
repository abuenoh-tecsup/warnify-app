<input
    type="{{ $type ?? 'text' }}"
    name="{{ $name ?? '' }}"
    id="{{ $name ?? '' }}"
    placeholder="{{ $placeholder ?? '' }}"
    class="{{ $attributes->merge(['class' => 'w-full px-4 py-2 mt-1 text-md rounded-xl'])->get('class') }}"
    value="{{ $value ?? '' }}"
    {{ $attributes }}
/>
