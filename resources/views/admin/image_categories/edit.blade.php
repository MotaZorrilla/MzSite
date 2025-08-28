@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Categoría de Imagen</h1>

    <form action="{{ route('admin.image_categories.update', $imageCategory) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $imageCategory->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
