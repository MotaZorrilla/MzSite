@extends('layouts.admin')

@section('title', 'Gestión de Documentos')

@section('content')
<!-- ======= Documents Section ======= -->
<section id="documents" class="services" data-aos="fade-up">
    <div class="container">
        <div class="section-title">
            <h2>Gestión de Documentos</h2>
            <p>Sube y administra los trabajos masónicos (PDFs).</p>
        </div>

        <!-- PDF Upload Form -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h4 class="mb-3">Subir Nuevo Documento</h4>
                <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="doc_title" class="form-label">Título del Documento</label>
                            <input type="text" name="title" id="doc_title" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="doc_degree" class="form-label">Grado Requerido</label>
                            <select name="required_degree" id="doc_degree" class="form-select" required>
                                <option value="">Seleccionar...</option>
                                <option value="0">0° - Público</option>
                                @foreach ($degrees as $degree)
                                    <option value="{{ $degree->id }}">{{ $degree->id }}° - {{ $degree->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6 form-group">
                            <label for="doc_category" class="form-label">Categoría</label>
                            <div class="input-group">
                                <select name="document_category_id" id="doc_category" class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($documentCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#manageDocumentCategoryModal">+</button>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="doc_source" class="form-label">Fuente</label>
                            <select name="source" id="doc_source" class="form-select" required>
                                <option value="Propio" selected>Propio</option>
                                <option value="Biblioteca">Biblioteca</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="doc_description" class="form-label">Descripción Breve</label>
                        <textarea name="description" id="doc_description" class="form-control @error('description') is-invalid @enderror" rows="3" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mt-3">
                        <label for="file" class="form-label">Archivo PDF</label>
                        <input type="file" name="file" class="form-control" id="file" accept="application/pdf" required>
                    </div>
                    <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Subir Archivo</button></div>
                </form>
            </div>
        </div>

        <!-- PDF Management Table -->
        <div class="row">
            <div class="col-lg-12">
                @livewire('admin-documents-table')
            </div>
        </div>
    </div>
</section><!-- End Documents Section -->
@endsection
