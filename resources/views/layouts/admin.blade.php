<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'Panel de Administración')</title>

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
                    <li><a href="{{ route('admin.documents') }}" class="nav-link {{ request()->routeIs('admin.documents') || request()->routeIs('admin.dashboard') ? 'active' : '' }}"><i class="bx bx-file"></i> <span>Documentos</span></a></li>
                    <li><a href="{{ route('admin.gallery') }}" class="nav-link {{ request()->routeIs('admin.gallery') ? 'active' : '' }}"><i class="bx bx-photo-album"></i> <span>Galería</span></a></li>
                    <li><a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}"><i class="bx bx-group"></i> <span>Usuarios</span></a></li>
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
        @yield('content')
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

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

</body>

</html>
