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
        <div class="d-flex flex-column">

            <div class="profile">
                <img src="{{ asset('img/profile.jpg') }}" alt="" class="img-fluid rounded-circle">
                <h1 class="text-light"><a href="/admin">Admin</a></h1>
                <h2 class="text-light" style="font-size: 1rem; text-align: center;">Archivo Masónico</h2>
            </div>

            <nav id="navbar" class="nav-menu navbar">
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
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
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
                        <form action="{{ route('masonry.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
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
                                        <option value="1">1° - Aprendiz</option>
                                        <option value="2">2° - Compañero</option>
                                        <option value="3">3° - Maestro</option>
                                        <option value="4">4° - Maestro Secreto</option>
                                        <option value="5">5° - Maestro Perfecto</option>
                                        <option value="6">6° - Secretario Íntimo</option>
                                        <option value="7">7° - Preboste y Juez</option>
                                        <option value="8">8° - Intendente de los Edificios</option>
                                        <option value="9">9° - Maestro Elegido de los Nueve</option>
                                        <option value="10">10° - Ilustre Elegido de los Quince</option>
                                        <option value="11">11° - Sublime Caballero Elegido</option>
                                        <option value="12">12° - Gran Maestro Arquitecto</option>
                                        <option value="13">13° - Real Arco</option>
                                        <option value="14">14° - Gran Elegido, Perfecto y Sublime Masón</option>
                                        <option value="15">15° - Caballero de Oriente o de la Espada</option>
                                        <option value="16">16° - Príncipe de Jerusalén</option>
                                        <option value="17">17° - Caballero de Oriente y Occidente</option>
                                        <option value="18">18° - Soberano Caballero Rosacruz</option>
                                        <option value="19">19° - Gran Pontífice</option>
                                        <option value="20">20° - Gran Maestro de todas las Logias Simbólicas</option>
                                        <option value="21">21° - Patriarca Noaquita</option>
                                        <option value="22">22° - Caballero del Real Hacha</option>
                                        <option value="23">23° - Jefe del Tabernáculo</option>
                                        <option value="24">24° - Príncipe del Tabernáculo</option>
                                        <option value="25">25° - Caballero de la Serpiente de Bronce</option>
                                        <option value="26">26° - Príncipe de Merced</option>
                                        <option value="27">27° - Soberano Comendador del Templo</option>
                                        <option value="28">28° - Caballero del Sol</option>
                                        <option value="29">29° - Gran Escocés de San Andrés</option>
                                        <option value="30">30° - Caballero Kadosh</option>
                                        <option value="31">31° - Gran Inspector Inquisidor Comendador</option>
                                        <option value="32">32° - Sublime y Valiente Príncipe del Real Secreto</option>
                                        <option value="33">33° - Soberano Gran Inspector General</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6 form-group">
                                    <label for="doc_category" class="form-label">Categoría</label>
                                    <div class="input-group">
                                        <select name="category" id="doc_category" class="form-select" required>
                                            <option value="">Seleccionar...</option>
                                            <option value="pieza_arquitectura">Pieza de Arquitectura</option>
                                            <option value="libro">Libro</option>
                                            <option value="manual_ritual">Manual o Ritual</option>
                                            <option value="documento_historico">Documento Histórico</option>
                                            <option value="otro">Otro</option>
                                        </select>
                                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#manageCategoryModal">+</button>
                                    </div>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label for="doc_source" class="form-label">Origen</label>
                                    <select name="source" id="doc_source" class="form-select" required>
                                        <option value="">Seleccionar...</option>
                                        <option value="propio">Propio</option>
                                        <option value="externo">Externo</option>
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
                        <h4 class="mb-3">Documentos Existentes</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Categoría</th>
                                        <th>Origen</th>
                                        <th>Grado Req.</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>El Mandil</td>
                                        <td><span class="badge bg-info">Pieza de Arquitectura</span></td>
                                        <td><span class="badge bg-light text-dark">Propio</span></td>
                                        <td><span class="badge bg-secondary">1°</span></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary">Editar</button>
                                            <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Símbolos Secretos</td>
                                        <td><span class="badge bg-info">Libro</span></td>
                                        <td><span class="badge bg-light text-dark">Externo</span></td>
                                        <td><span class="badge bg-secondary">3°</span></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary">Editar</button>
                                            <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                        <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data" class="p-4 border rounded">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="img_title" class="form-label">Título de la Imagen</label>
                                    <input type="text" name="title" id="img_title" class="form-control" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <label for="gallery_category" class="form-label">Categoría</label>
                                    <div class="input-group">
                                        <select name="category" id="gallery_category" class="form-select" required>
                                            <option value="">Seleccionar...</option>
                                            <option value="filter-app">Actos</option>
                                            <option value="filter-card">Celebraciones</option>
                                            <option value="filter-web">Templo</option>
                                        </select>
                                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#manageCategoryModal">+</button>
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
                        <h4 class="mb-3">Imágenes Existentes</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Miniatura</th>
                                        <th>Título</th>
                                        <th>Categoría</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td><img src="{{ asset('img/portfolio/A1.jpg') }}" alt="A1" style="width: 100px; height: auto;"></td>
                                        <td>Celebracion 1</td>
                                        <td><span class="badge bg-info">Celebraciones</span></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary">Editar</button>
                                            <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td><img src="{{ asset('img/portfolio/Pintura.png') }}" alt="Pintura" style="width: 100px; height: auto;"></td>
                                        <td>Acto 1</td>
                                        <td><span class="badge bg-info">Actos</span></td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary">Editar</button>
                                            <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
                        <form action="#" method="POST" class="p-4 border rounded">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Nombre Completo" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" name="email" class="form-control" placeholder="Correo Electrónico" required>
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
                                        <option value="usuario">Usuario</option>
                                        <option value="administrador">Administrador</option>
                                    </select>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <select name="degree" class="form-select">
                                        <option value="">Asignar Grado (si es Usuario)...</option>
                                        <option value="1">1° - Aprendiz</option>
                                        <option value="2">2° - Compañero</option>
                                        <option value="3">3° - Maestro</option>
                                        <option value="4">4° - Maestro Secreto</option>
                                        <option value="5">5° - Maestro Perfecto</option>
                                        <option value="9">9° - Maestro Elegido de los Nueve</option>
                                        <option value="14">14° - Gran Elegido, Perfecto y Sublime Masón</option>
                                        <option value="18">18° - Soberano Caballero Rosacruz</option>
                                        <option value="19">19° - Gran Pontífice</option>
                                        <option value="21">21° - Patriarca Noaquita</option>
                                        <option value="25">25° - Caballero de la Serpiente de Bronce</option>
                                        <option value="29">29° - Gran Escocés de San Andrés</option>
                                        <option value="30">30° - Caballero Kadosh</option>
                                        <option value="31">31° - Gran Inspector Inquisidor Comendador</option>
                                        <option value="32">32° - Sublime y Valiente Príncipe del Real Secreto</option>
                                        <option value="33">33° - Soberano Gran Inspector General</option>
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
                        <h4 class="mb-3">Usuarios Existentes</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Nivel de Acceso</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                {{-- Aquí iría la lógica para mostrar Rol o Grado --}}
                                                <select name="access_level" class="form-select form-select-sm">
                                                    <option value="admin" @if($user->role == 'administrador') selected @endif>Administrador</option>
                                                    <option value="3" @if($user->role == 'usuario' && $user->degree_id == 3) selected @endif>3° - Maestro</option>
                                                    <option value="2" @if($user->role == 'usuario' && $user->degree_id == 2) selected @endif>2° - Compañero</option>
                                                    <option value="1" @if($user->role == 'usuario' && $user->degree_id == 1) selected @endif>1° - Aprendiz</option>
                                                </select>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-sm btn-success">Guardar</button>
                                                <button type="button" class="btn btn-sm btn-danger">Eliminar</button>
                                            </td>
                                        </form>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Users Section -->

    </main><!-- End #main -->

    <!-- ======= Manage Category Modal ======= -->
    <div class="modal fade" id="manageCategoryModal" tabindex="-1" aria-labelledby="manageCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="manageCategoryModalLabel">Gestionar Categorías</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    
                    <!-- List of existing categories -->
                    <h6 class="mb-3">Categorías Existentes</h6>
                    <ul class="list-group mb-4">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Pieza de Arquitectura
                            <span>
                                <button class="btn btn-sm btn-outline-primary py-0 px-1"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger py-0 px-1"><i class="bi bi-trash"></i></button>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Libro
                            <span>
                                <button class="btn btn-sm btn-outline-primary py-0 px-1"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger py-0 px-1"><i class="bi bi-trash"></i></button>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Celebraciones
                            <span>
                                <button class="btn btn-sm btn-outline-primary py-0 px-1"><i class="bi bi-pencil"></i></button>
                                <button class="btn btn-sm btn-outline-danger py-0 px-1"><i class="bi bi-trash"></i></button>
                            </span>
                        </li>
                    </ul>

                    <!-- Form to add a new category -->
                    <h6 class="mb-3">Crear Nueva Categoría</h6>
                    <form id="addCategoryForm">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Nombre de la nueva categoría">
                            <button class="btn btn-primary" type="button">Crear</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>MotaZorrilla</span></strong>
            </div>
        </div>
    </footer><!-- End  Footer -->

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

</body>

</html>