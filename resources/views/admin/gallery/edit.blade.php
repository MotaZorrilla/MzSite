@extends('layouts.admin')

@section('title', 'Editar Imagen de la Galería')

@section('content')
<section class="services">
    <div class="container">
        <div class="section-title">
            <h2>Editar Imagen de la Galería</h2>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="p-4 border rounded">
                    <form action="{{ route('admin.gallery.update', $galleryImage) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $galleryImage->title }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="image_category_id" class="form-label">Categoría</label>
                            <select name="image_category_id" id="image_category_id" class="form-select" required>
                                @foreach($imageCategories as $category)
                                    <option value="{{ $category->id }}" {{ $galleryImage->image_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection