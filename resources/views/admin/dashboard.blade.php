<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Panel de Administración</title>

    <!-- Favicons -->
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="icon">
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column h-100">

            <div class="profile">
                <img src="{{ asset('img/profile.jpg') }}" alt="" class="img-fluid rounded-circle">
                <h1 class="text-light"><a href="/admin">Admin</a></h1>
                <h2 class="text-light" style="font-size: 1rem; text-align: center;">Archivo Masónico</h2>
                <div class="social-links mt-3 text-center">
                    <a href="https://x.com/motazorrilla" target="_blank" class="twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.6.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com/MotaZorrilla" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="https://www.instagram.com/motazorrilla_/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/motazorrilla/" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    <a href="/" target="_blank" class="website"><i class="bx bx-globe"></i></a>
                </div>
            </div>

            <nav id="navbar" class="nav-menu navbar align-items-start">
                <ul>
                    <li><a href="#documents" class="nav-link scrollto active"><i class="bx bx-file"></i> <span>Documentos</span></a></li>
                    <li><a href="#gallery" class="nav-link scrollto"><i class="bx bx-photo-album"></i> <span>Galería</span></a></li>
                    <li><a href="#users" class="nav-link scrollto"><i class="bx bx-group"></i> <span>Usuarios</span></a></li>
                    <hr class="my-2">
                    <li><a href="/masonry" class="nav-link"><i class="bx bx-world"></i> <span>Ver Sitio Público</span></a></li>
                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
                        <i class="bx bx-log-out"></i> <span>Cerrar Sesión</span></a>
                    </li>
                </ul>
            </nav><!-- .nav-menu -->
            <footer id="footer" class="mt-auto">
                <div class="container">
                    <div class="copyright">
                        &copy; Copyright <strong><span>MotaZorrilla</span></strong>
                    </div>
                </div>
            </footer><!-- End  Footer -->
        </div>
    </header><!-- End Header -->

    <main id="main">

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
                                <textarea name="description" id="doc_description" class="form-control" rows="3"></textarea>
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

        <!-- ======= Users Section ======= -->
        <section id="users" class="services" data-aos="fade-up">
            <div class="container">
                <div class="section-title">
                    <h2>Gestión de Usuarios</h2>
                    <p>Crea nuevos usuarios y administra sus roles y grados.</p>
                </div>

                <!-- Add User Form -->
                <div class="row mb-5">
                    <div class="col-lg-12">
                        <h4 class="mb-3">Agregar Nuevo Usuario</h4>
                        <form action="{{ route('admin.users.store') }}" method="POST" class="p-4 border rounded">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Nombre Completo" required value="{{ old('name') }}">
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirmar Contraseña" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <select name="role" class="form-select" required>
                                        <option value="">Asignar Rol...</option>
                                        <option value="usuario" @if(old('role') == 'usuario') selected @endif>Usuario</option>
                                        <option value="administrador" @if(old('role') == 'administrador') selected @endif>Administrador</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <select name="degree_id" class="form-select">
                                        <option value="">Asignar Grado (si es Usuario)...</option>
                                        @foreach ($degrees as $degree)
                                            <option value="{{ $degree->id }}" @if(old('degree_id') == $degree->id) selected @endif>{{ $degree->id }}° - {{ $degree->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Crear Usuario</button></div>
                        </form>
                    </div>
                </div>

                <!-- Users Management Table -->
                <div class="row">
                    <div class="col-lg-12">
                        @livewire('admin-users-table')
                    </div>
                </div>
            </div>
        </section><!-- End Users Section -->

    </main><!-- End #main -->

    <!-- ======= Manage Document Category Modal ======= -->
    <div class="modal fade" id="manageDocumentCategoryModal" tabindex="-1" aria-labelledby="manageDocumentCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageDocumentCategoryModalLabel">Gestionar Categorías de Documentos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3">Categorías Existentes</h6>
                    @if($documentCategories->isEmpty())
                        <p>No hay categorías de documentos definidas.</p>
                    @else
                        <ul class="list-group mb-4">
                            @foreach ($documentCategories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $category->name }}
                                    <span>
                                        <form action="{{ route('admin.document_categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-1" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?')"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <h6 class="mb-3">Crear Nueva Categoría</h6>
                    <form action="{{ route('admin.document_categories.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Nombre de la nueva categoría" required>
                            <button class="btn btn-primary" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Manage Image Category Modal ======= -->
    <div class="modal fade" id="manageImageCategoryModal" tabindex="-1" aria-labelledby="manageImageCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageImageCategoryModalLabel">Gestionar Categorías de Imágenes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6 class="mb-3">Categorías Existentes</h6>
                    @if($imageCategories->isEmpty())
                        <p>No hay categorías de imágenes definidas.</p>
                    @else
                        <ul class="list-group mb-4">
                            @foreach ($imageCategories as $category)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $category->name }}
                                    <span>
                                        <form action="{{ route('admin.image_categories.destroy', $category) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger py-0 px-1" onclick="return confirm('¿Estás seguro de que quieres eliminar esta categoría?')"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                    <h6 class="mb-3">Crear Nueva Categoría</h6>
                    <form action="{{ route('admin.image_categories.store') }}" method="POST">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="name" class="form-control" placeholder="Nombre de la nueva categoría" required>
                            <button class="btn btn-primary" type="submit">Crear</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <div class="whatsapp-button">
        <a href="https://wa.me/584148873615" target="_blank">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</body>

</html>
