<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Archivo Masónico</title>

    <!-- Favicons -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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
                <h1 class="text-light"><a href="/masonry">Archivo Masónico</a></h1>
                <h2 class="text-light" style="font-size: 1rem; text-align: center;">Héctor Mota</h2>
                <div class="social-links mt-3 text-center">
                    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                </div>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Inicio</span></a></li>
                    <li><a href="#repository" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Repositorio</span></a></li>
                    <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Acerca de</span></a></li>
                    <li><a href="#faq" class="nav-link scrollto"><i class="bx bx-question-mark"></i> <span>FAQ</span></a></li>
                    <hr class="my-2">
                    <li><a href="{{ route('login') }}" class="nav-link"><i class="bx bx-log-in"></i> <span>Iniciar Sesión</span></a></li>
                    <li><a href="{{ route('register') }}" class="nav-link"><i class="bx bx-user-plus"></i> <span>Registrarse</span></a></li>
                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="hero-container" data-aos="fade-in">
            <h1>Archivo Masónico</h1>
            <p><span class="typed" data-typed-items="Mis hermanos me reconocen como Aprendiz, Mis hermanos me reconocen como Compañero, Mis hermanos me reconocen como Maestro, Mis hermanos me reconocen como Masón, Mis hermanos me reconocen como Héctor Mota"></span></p>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Admin Upload Section ======= -->
        <section id="upload" class="services" data-aos="fade-up">
            <div class="container">
                <div class="section-title">
                    <h2>Panel de Administrador</h2>
                    <p>Esta sección solo será visible para los administradores.</p>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <form action="{{ route('masonry.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="title" class="form-control" placeholder="Título del Documento" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <select name="required_degree" class="form-select" required>
                                        <option value="">Seleccionar Grado...</option>
                                        <option value="1">Aprendiz</option>
                                        <option value="2">Compañero</option>
                                        <option value="3">Maestro</option>
                                        <!-- Añadir más grados si es necesario -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <textarea name="description" class="form-control" rows="3" placeholder="Descripción breve"></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <label for="file" class="form-label">Archivo PDF (máx. 10MB)</label>
                                <input type="file" name="file" class="form-control" id="file" accept="application/pdf" required>
                            </div>
                            <div class="form-group mt-3 form-check">
                                <input type="checkbox" name="is_public" class="form-check-input" id="is_public">
                                <label class="form-check-label" for="is_public">Hacer público (visible sin login)</label>
                            </div>
                            <div class="text-center mt-3"><button type="submit" class="btn btn-primary">Subir Archivo</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section><!-- End Admin Upload Section -->

        <!-- ======= Repository Section ======= -->
        <section id="repository" class="portfolio section-bg" data-aos="fade-up">
            <div class="container">
                <div class="section-title">
                    <h2>Repositorio de Trazados y Planchas</h2>
                    <p>Documentos disponibles según el grado del miembro.</p>
                </div>

                <!-- Apprentice Degree -->
                <h3 class="degree-title">Grado de Aprendiz</h3>
                <div class="row portfolio-container">
                    <div class="col-lg-4 col-md-6 portfolio-item">
                        <div class="portfolio-wrap">
                            <div class="portfolio-info">
                                <h4><a href="#">El Mandil</a></h4>
                                <p>Simbolismo e importancia del mandil masónico.</p>
                                <a href="#" class="btn btn-sm btn-outline-primary mt-2">Leer más</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fellowcraft Degree -->
                <h3 class="degree-title mt-5">Grado de Compañero</h3>
                <div class="row portfolio-container">
                    <div class="col-lg-4 col-md-6 portfolio-item">
                        <div class="portfolio-wrap">
                            <div class="portfolio-info">
                                <h4><a href="#">La Letra G</a></h4>
                                <p>Estudio sobre el significado de la letra G.</p>
                                <a href="#" class="btn btn-sm btn-outline-primary mt-2">Leer más</a>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- Master Degree -->
                 <h3 class="degree-title mt-5">Grado de Maestro</h3>
                 <div class="row portfolio-container">
                     <div class="col-lg-4 col-md-6 portfolio-item">
                         <div class="portfolio-wrap">
                             <div class="portfolio-info">
                                 <h4><a href="#">La Leyenda de Hiram</a></h4>
                                 <p>Análisis del simbolismo en la leyenda del tercer grado.</p>
                                 <a href="#" class="btn btn-sm btn-outline-primary mt-2">Leer más</a>
                             </div>
                         </div>
                     </div>
                 </div>

            </div>
        </section><!-- End Repository Section -->

        <!-- ======= About Section ======= -->
        <section id="about" class="about" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Logia Domingo Faustino Sarmiento número 167</h2>
                    <p>Nuestra logia, fundada en los Valles de Caracas, Venezuela, trabaja bajo los auspicios de la Gran Logia de la República de Venezuela. Llevamos con orgullo el nombre de Domingo Faustino Sarmiento, destacado educador, escritor, y presidente de Argentina, quien fue un iniciado masón comprometido con el progreso y la libertad. Su legado ilumina nuestro propósito de cultivar la fraternidad, el conocimiento y la virtud.</p>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Info Section ======= -->
        <section id="info" class="services section-bg" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Información para Interesados</h2>
                    <p>La masonería es una institución discreta, no secreta, dedicada al desarrollo moral y ético del ser humano. Si sientes curiosidad y buscas un camino de crecimiento personal basado en principios universales, puedes encontrar más información en los sitios oficiales de las Grandes Logias. Para reuniones y eventos, el Templo Masónico de la Gran Logia se encuentra en la Av. Este 3, Caracas, Distrito Capital, Venezuela.</p>
                </div>

            </div>
        </section><!-- End Info Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="portfolio" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Galería Masónica</h2>
                    <p>Un vistazo a nuestros encuentros, tenidas blancas, y momentos de fraternidad.</p>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">Todos</li>
                            <li data-filter=".filter-app">Actos</li>
                            <li data-filter=".filter-card">Celebraciones</li>
                            <li data-filter=".filter-web">Templo</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A1.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A1.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Celebracion 1"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/Neobranding.png') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/Neobranding.png') }}"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox"
                                    title="Templo"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/Pintura.png') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/Pintura.png') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Acto 1"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A3.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A3.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Celebracion 2"><i class="bx bx-plus"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Gallery Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq section-bg" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Preguntas Frecuentes (FAQ)</h2>
                </div>

                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                ¿Qué es la Masonería?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                La masonería es una de las fraternidades más antiguas del mundo. Es una organización de personas que creen en la hermandad y en ayudarse mutuamente a ser mejores personas. No es una religión, sino un sistema de moralidad velado por alegorías e ilustrado por símbolos.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                ¿Es la Masonería una religión?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No. La masonería no es una religión, aunque sus miembros deben creer en un Ser Supremo. No tiene un dogma teológico y no ofrece un plan de salvación. Hombres de diferentes religiones pueden ser masones y la discusión de temas religiosos o políticos está prohibida en la logia.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                ¿Es una sociedad secreta?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No, es una sociedad discreta. Sus lugares de reunión son conocidos y a menudo están listados en directorios. Los miembros son libres de revelar su afiliación. Los únicos "secretos" son los modos tradicionales de reconocimiento entre miembros.
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Frequently Asked Questions Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact" data-aos="fade-up">
            <div class="container text-center">

                <div class="section-title">
                    <h2>Contacto</h2>
                    <p>Si tienes alguna pregunta o deseas discutir algún tema en particular, no dudes en contactarme.</p>
                </div>

                <a href="https://wa.me/584148873615" class="btn btn-primary btn-lg" target="_blank" style="padding: 10px 40px; border-radius: 50px;">Enviar Mensaje por WhatsApp</a>

            </div>
        </section><!-- End Contact Section -->

    </main><!-- End #main -->

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
