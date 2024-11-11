<textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        placeholder="{{ $placeholder }}"
        class="w-full px-4 py-2 rounded-xl appearance-none text-heading text-md"
        autocomplete="off"
        spellcheck="false"
    >{{ old($name, $value) }}
</textarea>

