@extends('layouts.layout')

@section('title', 'Inicio')

@section('content')
    <div class="flex-grow h-full grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-blue-500 p-4">1</div>
        <div class="bg-green-500 p-4">2</div>
        <div class="bg-red-500 p-4 md:col-span-2">3</div>
    </div>
@endsection
