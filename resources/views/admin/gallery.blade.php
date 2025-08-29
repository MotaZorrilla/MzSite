@extends('layouts.admin')

@section('title', 'Gestión de Galería')

@section('content')
<!-- ======= Gallery Section ======= -->
<section id="gallery" class="services section-bg" data-aos="fade-up">
    <div class="container">
        <div class="section-title">
            <h2>Gestión de Galería</h2>
            <p>Sube y administra las imágenes de la galería.</p>
        </div>

        <!-- Image Upload Form -->
        <div class="row mb-5">
            <div class="col-lg-12">
                <h4 class="mb-3">Subir Nueva Imagen</h4>
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="img_title" class="form-label">Título de la Imagen</label>
                            <input type="text" name="title" id="img_title" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mt-3 mt-md-0">
                            <label for="gallery_category" class="form-label">Categoría</label>
                            <div class="input-group">
                                <select name="image_category_id" id="gallery_category" class="form-select" required>
                                    <option value="">Seleccionar...</option>
                                    @foreach ($imageCategories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#manageImageCategoryModal">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="image" class="form-label">Archivo de Imagen</label>
                        <input type="file" name="image" class="form-control" id="image" accept="image/jpeg,image/png,image/gif" required>
                    </div>
                    <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Subir Imagen</button></div>
                </form>
            </div>
        </div>

        <!-- Image Management Table -->
        <div class="row">
            <div class="col-lg-12">
                @livewire('admin-gallery-table')
            </div>
        </div>
    </div>
</section><!-- End Gallery Section -->
@endsection
