@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-2xl font-bold mb-4">Tareas Completadas por el Usuario: {{ $usuario_id }}</h1>
        <p>El usuario ha completado {{ $conteoTareasCompletadas }} tareas.</p>
    </div>
</div>
@endsection
