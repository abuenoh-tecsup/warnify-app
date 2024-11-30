<div x-data
    x-init="flatpickr($refs.datetimewidget, {
        wrap: true, 
        enableTime: true, 
        dateFormat: 'M j, Y h:i K', 
        maxDate: new Date()  // Restringir a fechas anteriores o iguales a la actual
    });"
    x-ref="datetimewidget" class="flatpickr container mx-auto col-span-6 sm:col-span-6">
    <input
        x-ref="datetime"
        type="text"
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder ?? 'Select Date and Time' }}"
        class="w-full px-4 py-2 mt-1 rounded-xl"
        data-input
        value="{{ $value ?? '' }}"
        @focus="flatpickrInstance = flatpickr($refs.datetime, { 
            wrap: true, 
            enableTime: true, 
            dateFormat: 'M j, Y h:i K',
            maxDate: new Date()  // Restringir a fechas anteriores o iguales a la actual
        })"
    >
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.9/themes/airbnb.min.css">
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js" defer></script>
