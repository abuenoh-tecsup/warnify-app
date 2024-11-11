<label class="block mb-4 mt-1">
    <input
        type="file"
        id="{{ $name ?? 'image' }}"
        name="{{ $name ?? 'image' }}"
        onchange="loadFile(event)"
        class="block w-full text-sm mt-1
            file:mr-4 file:py-2 file:px-4
            file:rounded-full file:border-0
            file:text-sm file:font-semibold
            hover:file:bg-blue-100"
    />
</label>
<div class="shrink-0 mb-4">
    <img
        id='preview_img'
        class="w-full h-48 object-cover rounded-xl"
        src="{{ $value ?? 'https://archive.org/download/placeholder-image/placeholder-image.jpg' }}"
        alt="Imagen" />
</div>
<script>
    var loadFile = function (event) {
        var input = event.target;
        var file = input.files[0];
        var type = file.type;
        var output = document.getElementById('preview_img');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
