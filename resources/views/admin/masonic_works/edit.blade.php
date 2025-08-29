@extends('layouts.admin')

@section('title', 'Editar Trabajo Masónico')

@section('content')
<section class="services">
    <div class="container">
        <div class="section-title">
            <h2>Editar Trabajo Masónico</h2>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="p-4 border rounded">
                    <form action="{{ route('admin.documents.update', $work) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $work->title }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description', $work->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="required_degree" class="form-label">Grado Requerido</label>
                            <select name="required_degree" id="required_degree" class="form-select" required>
                                <option value="0" {{ $work->required_degree == 0 ? 'selected' : '' }}>0° - Público</option>
                                @foreach($degrees as $degree)
                                    <option value="{{ $degree->id }}" {{ $work->required_degree == $degree->id ? 'selected' : '' }}>{{ $degree->id }}° - {{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="document_category_id" class="form-label">Categoría</label>
                            <select name="document_category_id" id="document_category_id" class="form-select" required>
                                @foreach($documentCategories as $category)
                                    <option value="{{ $category->id }}" {{ $work->document_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="source" class="form-label">Fuente</label>
                            <select name="source" id="source" class="form-select" required>
                                <option value="Propio" {{ $work->source == 'Propio' ? 'selected' : '' }}>Propio</option>
                                <option value="Biblioteca" {{ $work->source == 'Biblioteca' ? 'selected' : '' }}>Biblioteca</option>
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
