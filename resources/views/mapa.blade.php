@extends('layouts.layout')

@section('title', 'Mapa')

@section('content')
    <div class="flex-grow h-full grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="col-span-1 bg-blue-500 p-4">
            <p>Columna 1 (1/3)</p>
        </div>
        <div class="col-span-1 md:col-span-2 bg-green-500 p-4">
            <p>Columna 2 (2/3)</p>
        </div>
    </div>
@endsection
