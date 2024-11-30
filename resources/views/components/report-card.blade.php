<!-- resources/views/components/report-card.blade.php -->
<div class="max-w mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl flex mb-3">
    <div class="p-3 bg-white w-5/6">
        <div class="uppercase tracking-wide text-sm text-gray-500 font-semibold">{{ $fecha }}</div>
        <p class="block mt-1 text-lg leading-tight font-medium text-black">{{ $titulo }}</p>
        <p class="mt-2 text-gray-500 truncate">{{ $descripcion }}</p>
        <p class="mt-2 text-gray-500 font-bold">{{ $estado }}</p>
    </div>
    <a class="w-1/6 bg-yellow-300 hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-500 flex items-center justify-center" href="{{ route('reportes.list', ['filter' => request('filter', 'all'), 'state' => request('state'), 'order' => request('order', 'desc'), 'id' => $reporteId]) }}">
        <span class="font-bold text-2xl">+</span>
    </a>
</div>
