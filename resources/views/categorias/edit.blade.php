@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Categoria</h1>
    <form action="{{ route('categorias.update', $categoria) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="nombre">Nombre de la Categoria:</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $categoria->nombre) }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
