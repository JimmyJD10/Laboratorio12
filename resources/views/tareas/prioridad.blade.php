@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Tareas con Prioridad: {{ $prioridad }}</h1>
        <ul class="list-disc pl-5 space-y-2">
            @foreach ($tareas as $tarea)
                <li class="flex justify-between items-center bg-gray-100 px-4 py-2 rounded-lg">
                    <span>{{ $tarea->descripcion }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
