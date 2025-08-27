<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Archivo Masónico</title>

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

    <style>
        #header .nav-menu {
            overflow-y: auto;
        }
    </style>

</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column h-100">

            <div class="profile">
                <img src="{{ asset('img/profile.jpg') }}" alt="" class="img-fluid rounded-circle">
                <h1 class="text-light"><a href="/masonry">Archivo Masónico</a></h1>
                <h2 class="text-light" style="font-size: 1rem; text-align: center;">Héctor Mota</h2>
                <div class="social-links mt-3 text-center">
                    <a href="https://x.com/motazorrilla" target="_blank" class="twitter">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.6.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"/>
                        </svg>
                    </a>
                    <a href="https://facebook.com/MotaZorrilla" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
                    <a href="https://www.instagram.com/motazorrilla/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                    <a href="https://www.linkedin.com/in/motazorrilla/" target="_blank" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                    <a href="/" target="_blank" class="website"><i class="bx bx-globe"></i></a>
                </div>
            </div>

            <nav id="navbar" class="nav-menu navbar align-items-start">
                <ul>
                    <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Inicio</span></a></li>
                    <li><a href="#repository" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Archivo</span></a></li>
                    <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>Acerca de</span></a></li>
                    <li><a href="#gallery" class="nav-link scrollto"><i class="bx bx-photo-album"></i> <span>Galería</span></a></li>
                    <li><a href="#faq" class="nav-link scrollto"><i class="bx bx-question-mark"></i> <span>FAQ</span></a></li>
                    <hr class="my-2">
                    <li><a href="{{ route('login') }}" class="nav-link"><i class="bx bx-log-in"></i> <span>Iniciar Sesión</span></a></li>
                    <li><a href="{{ route('register') }}" class="nav-link"><i class="bx bx-user-plus"></i> <span>Registrarse</span></a></li>
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

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="hero-container" data-aos="fade-in">
            <h1>Archivo Masónico</h1>
            <p>Mis hermanos me reconocen <span class="typed" data-typed-items="como Aprendiz, como Compañero, como Maestro, como Masón, como Héctor Mota"></span></p>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Repository Section ======= -->
        <section id="repository" class="portfolio section-bg" data-aos="fade-up">
            <div class="container">
                <div class="section-title">
                    <h2>Archivo Masónico</h2>
                    <p>Un repositorio de documentos donde encontrarás piezas de arquitectura, trazados, planchas, libros y más, organizados por grado para facilitar su estudio.</p>
                </div>

                {{-- Público General --}}
                <h3 class="degree-title">Público General</h3>
                <ul class="nav nav-tabs" id="public-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="public-propio-tab" data-bs-toggle="tab" data-bs-target="#public-propio" type="button" role="tab" aria-controls="public-propio" aria-selected="true">Propio</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="public-biblioteca-tab" data-bs-toggle="tab" data-bs-target="#public-biblioteca" type="button" role="tab" aria-controls="public-biblioteca" aria-selected="false">Biblioteca</button>
                    </li>
                </ul>
                <div class="tab-content" id="public-tabContent">
                    <div class="tab-pane fade show active" id="public-propio" role="tabpanel" aria-labelledby="public-propio-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                                <div class="card w-100"><div class="card-body d-flex flex-column"><h5 class="card-title"><a href="#">La Masonería y la Sociedad</a></h5><p class="card-text flex-grow-1">Un análisis sobre el impacto de la orden en el mundo moderno.</p><a href="#" class="btn btn-primary align-self-start">Leer más</a></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="public-biblioteca" role="tabpanel" aria-labelledby="public-biblioteca-tab">
                        <div class="row">
                             <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                                <div class="card w-100"><div class="card-body d-flex flex-column"><h5 class="card-title"><a href="#">Introducción a la Masonería</a></h5><p class="card-text flex-grow-1">Libro de dominio público para entender los conceptos básicos.</p><a href="#" class="btn btn-primary align-self-start">Leer más</a></div></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Grado 1 --}}
                <h3 class="degree-title mt-5">1° - Grado de Aprendiz</h3>
                <ul class="nav nav-tabs" id="aprendiz-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="aprendiz-propio-tab" data-bs-toggle="tab" data-bs-target="#aprendiz-propio" type="button" role="tab" aria-controls="aprendiz-propio" aria-selected="true">Propio</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="aprendiz-biblioteca-tab" data-bs-toggle="tab" data-bs-target="#aprendiz-biblioteca" type="button" role="tab" aria-controls="aprendiz-biblioteca" aria-selected="false">Biblioteca</button>
                    </li>
                </ul>
                <div class="tab-content" id="aprendiz-tabContent">
                    <div class="tab-pane fade show active" id="aprendiz-propio" role="tabpanel" aria-labelledby="aprendiz-propio-tab">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
                                <div class="card w-100"><div class="card-body d-flex flex-column"><h5 class="card-title"><a href="#">El Mandil y su Simbolismo</a></h5><p class="card-text flex-grow-1">Análisis profundo sobre la importancia, uso y significado de la primera herramienta del masón.</p><a href="#" class="btn btn-primary align-self-start">Leer más</a></div></div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="aprendiz-biblioteca" role="tabpanel" aria-labelledby="aprendiz-biblioteca-tab">
                        <p class="p-3">No hay documentos en la biblioteca para este grado.</p>
                    </div>
                </div>

                 {{-- Aquí irían los 32 grados restantes, siguiendo el mismo patrón de pestañas --}}

            </div>
        </section><!-- End Repository Section -->


        <!-- ======= About Section ======= -->
        <section id="about" class="about" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Respetable Logia Simbólica Domingo Faustino Sarmiento N° 167</h2>
                    <p style="text-align: left;">Actualmente formo parte de la R∴L∴S∴ Domingo Faustino Sarmiento N° 167, adscrita a la Gran Logia de la República de Venezuela. Nuestro taller está ubicado en los templos masónicos de la Asociación Civil Armonía, en el Edificio Anacaona, Primer Piso, en Ciudad Guayana, Estado Bolívar, Venezuela. Practicamos el Rito Escocés Antiguo y Aceptado, reuniéndonos para nuestros trabajos todos los lunes a las 6:00 PM.</p>
                </div>

                <div class="row content mt-5">
                    <div class="col-lg-12">
                        <h4 style="color: #149ddd;">El Epónimo: Domingo Faustino Sarmiento</h4>
                        <p>Domingo Faustino Sarmiento (1811-1888) fue una de las figuras más determinantes de la historia argentina del siglo XIX. Reconocido como "el padre del aula", fue un visionario maestro, escritor, militar y estadista que llegó a la presidencia de la nación. Su vida estuvo marcada por una incansable lucha por la educación pública, el progreso y la libertad de pensamiento, valores que lo llevaron a iniciarse en la Masonería en 1854. Dentro de la orden, tuvo un ascenso notable, alcanzando el Grado 33 y siendo elegido Gran Maestre de la Gran Logia Argentina, consolidándose como un pilar fundamental de la masonería sudamericana.</p>

                        <h4 style="color: #149ddd;" class="mt-4">La Gran Logia de la República de Venezuela</h4>
                        <p>Es el cuerpo masónico de más alta jerarquía en el país. Fundada en 1824, la Gran Logia agrupa y gobierna a todas las logias simbólicas (que trabajan los tres primeros grados) de la jurisdicción, garantizando la regularidad y el apego a las antiguas tradiciones de la orden. A lo largo de su historia, ha contado entre sus filas a figuras ilustres de la historia de Venezuela. Para más información, puede visitar su sitio web oficial.</p>
                        <p class="text-center">
                            <a href="https://granlogia.org.ve/" class="btn btn-primary" target="_blank">Visitar Web de la Gran Logia</a>
                        </p>

                        <h4 style="color: #149ddd;" class="mt-4">El Rito Escocés Antiguo y Aceptado</h4>
                        <p>El R.E.A.A. es uno de los sistemas masónicos más practicados en el mundo. Se estructura en 33 grados que ofrecen un camino de profundización filosófica y moral. Su objetivo no es acumular grados, sino proporcionar al masón un conjunto de herramientas simbólicas y enseñanzas para su perfeccionamiento individual, con la misión de aplicar los valores de Libertad, Igualdad y Fraternidad en la construcción de una mejor sociedad.</p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="portfolio section-bg" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Galería Masónica</h2>
                    <p>Un vistazo a nuestros encuentros, tenidas blancas, y momentos de fraternidad.</p>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">Todas</li>
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

                </div>

            </div>
        </section><!-- End Gallery Section -->

        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq" data-aos="fade-up">
            <div class="container">

                <div class="section-title">
                    <h2>Preguntas Frecuentes (FAQ)</h2>
                </div>

                <div class="accordion" id="faqAccordion">

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-1" aria-expanded="true" aria-controls="faq-collapse-1">
                                <strong>¿Qué es la Masonería?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-1" class="accordion-collapse collapse show" aria-labelledby="faq-heading-1" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Es una fraternidad universal que busca el desarrollo moral e intelectual de sus miembros, fomentando valores como la Libertad, la Igualdad y la Fraternidad. No es una religión ni una secta, sino un sistema de formación humana.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-2">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-2" aria-expanded="false" aria-controls="faq-collapse-2">
                                <strong>¿Es una sociedad secreta?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-2" class="accordion-collapse collapse" aria-labelledby="faq-heading-2" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No, es una sociedad discreta. Sus lugares de reunión son conocidos y los miembros son libres de revelar su pertenencia. Lo único que se mantiene en reserva son los modos de reconocimiento entre miembros y los detalles de sus ceremonias internas.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-3">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-3" aria-expanded="false" aria-controls="faq-collapse-3">
                                <strong>¿La Masonería es una religión?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-3" class="accordion-collapse collapse" aria-labelledby="faq-heading-3" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No. La Masonería no es una religión y no tiene un dogma teológico. Acoge a hombres de cualquier creencia religiosa, siempre que crean en un principio creador universal, al que simbólicamente se le denomina "Gran Arquitecto del Universo".
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-4">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-4" aria-expanded="false" aria-controls="faq-collapse-4">
                                <strong>¿Qué hacen en sus reuniones?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-4" class="accordion-collapse collapse" aria-labelledby="faq-heading-4" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Las reuniones, llamadas "Tenidas", son ceremonias donde se estudian símbolos y se presentan trabajos sobre filosofía, historia o ciencia, con el fin de promover el diálogo y el crecimiento personal. Están estrictamente prohibidos los debates sobre política partidista y religión dogmática para mantener la armonía.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-5">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-5" aria-expanded="false" aria-controls="faq-collapse-5">
                                <strong>¿Por qué usan símbolos como la escuadra y el compás?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-5" class="accordion-collapse collapse" aria-labelledby="faq-heading-5" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Estas herramientas provienen de los gremios de constructores medievales. En la masonería moderna (o "especulativa"), se usan de forma alegórica para enseñar lecciones de moral y conducta, como "medir nuestras acciones" (escuadra) o "mantener nuestros deseos dentro de límites" (compás).
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-6">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-6" aria-expanded="false" aria-controls="faq-collapse-6">
                                <strong>¿Las mujeres pueden ser masonas?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-6" class="accordion-collapse collapse" aria-labelledby="faq-heading-6" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Sí. Aunque la masonería tradicionalmente fue masculina, hoy existen obediencias y logias masónicas femeninas y mixtas en todo el mundo, que trabajan con los mismos principios y valores.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-7">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-7" aria-expanded="false" aria-controls="faq-collapse-7">
                                <strong>¿Cómo se puede ingresar?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-7" class="accordion-collapse collapse" aria-labelledby="faq-heading-7" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                El ingreso es voluntario y requiere que el candidato sea un hombre (o mujer, en logias femeninas/mixtas) libre, mayor de edad y de "buenas costumbres". El proceso inicia cuando el interesado contacta a una logia, seguido de entrevistas y una votación por parte de los miembros.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-8">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-8" aria-expanded="false" aria-controls="faq-collapse-8">
                                <strong>¿Los masones se ayudan entre sí para obtener poder o dinero?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-8" class="accordion-collapse collapse" aria-labelledby="faq-heading-8" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No. El objetivo es la ayuda mutua en el crecimiento moral y el apoyo en momentos de necesidad, no el tráfico de influencias ni la obtención de beneficios materiales. Usar la masonería para esos fines va en contra de sus principios fundamentales.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-9">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-9" aria-expanded="false" aria-controls="faq-collapse-9">
                                <strong>¿Es cierto que los masones controlan el mundo?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-9" class="accordion-collapse collapse" aria-labelledby="faq-heading-9" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                No, eso es un mito sin fundamento. Si bien muchos masones han sido figuras influyentes en la historia, actuaron a título personal, no como parte de una conspiración. La diversidad de opiniones dentro de la masonería haría imposible un plan de esa naturaleza.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="faq-heading-10">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-collapse-10" aria-expanded="false" aria-controls="faq-collapse-10">
                                <strong>¿Qué aporta la Masonería a la sociedad?</strong>
                            </button>
                        </h2>
                        <div id="faq-collapse-10" class="accordion-collapse collapse" aria-labelledby="faq-heading-10" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Fomenta la formación de ciudadanos libres, responsables y tolerantes, comprometidos con el progreso social y el bienestar de la humanidad. A lo largo de la historia, ha impulsado valores como la educación pública, la democracia y los derechos humanos.
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