<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MZ Portfolio </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="icon">
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="apple-touch-icon">
    {{-- <link href="{{ asset('img/favicon.png') }}" rel="icon">
    <link href="{{ asset('img/apple-touch-icon.png') }}" rel="apple-touch-icon"> --}}

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

    <!-- =======================================================
      Name: motazorrilla.com
      URL: https://motazorrilla.com/
      Author: motazorrilla.com
      License: motazorrilla.com
      
      ███╗   ███╗ ██████╗ ████████╗ █████╗     ███████╗ ██████╗ ██████╗ ██████╗ ██╗██╗     ██╗      █████╗
      ████╗ ████║██╔═══██╗╚══██╔══╝██╔══██╗    ╚══███╔╝██╔═══██╗██╔══██╗██╔══██╗██║██║     ██║     ██╔══██╗
      ██╔████╔██║██║   ██║   ██║   ███████║      ███╔╝ ██║   ██║██████╔╝██████╔╝██║██║     ██║     ███████║
      ██║╚██╔╝██║██║   ██║   ██║   ██╔══██║     ███╔╝  ██║   ██║██╔══██╗██╔══██╗██║██║     ██║     ██╔══██║
      ██║ ╚═╝ ██║╚██████╔╝   ██║   ██║  ██║    ███████╗╚██████╔╝██║  ██║██║  ██║██║███████╗███████╗██║  ██║
      ╚═╝     ╚═╝ ╚═════╝    ╚═╝   ╚═╝  ╚═╝    ╚══════╝ ╚═════╝ ╚═╝  ╚═╝╚═╝  ╚═╝╚═╝╚══════╝╚══════╝╚═╝  ╚═╝
                                                                                                      

    ======================================================= -->
</head>

<body>

    <!-- ======= Mobile nav toggle button ======= -->
    <div class="mobile-banner d-xl-none text-center" style="margin: 0;">
        <h6>Best experience on PC!</h6>
    </div>
    <i class="bi bi-list mobile-nav-toggle d-xl-none"></i>


    <!-- ======= Header ======= -->
    <header id="header">
        <div class="d-flex flex-column">

            <div class="profile">
                <img src="{{ asset('img/profile.jpg') }}" alt="" class="img-fluid rounded-circle">
                <h1 class="text-light"><a href="index.html">Mota Zorrilla</a></h1>
                <div class="social-links mt-3 text-center">
                    <a href="https://twitter.com/motazorrilla" target="_blank" class="twitter"><i
                            class="bx bxl-twitter"></i></a>
                    <a href="https://www.linkedin.com/in/h%C3%A9ctor-mota-2b172771/" target="_blank" class="linkedin"><i
                            class="bx bxl-linkedin"></i></a>
                    <a href="https://github.com/MotaZorrilla" target="_blank" class="github"><i
                            class="bx bxl-github"></i></a>
                </div>
            </div>

            <nav id="navbar" class="nav-menu navbar">
                <ul>
                    <li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i>
                            <span>Home</span></a></li>
                    <li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a>
                    </li>
                    <li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i>
                            <span>Resume</span></a></li>
                    <li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i>
                            <span>Portfolio</span></a></li>
                    <li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i>
                            <span>Services</span></a></li>
                    <li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i>
                            <span>Contact</span></a></li>
                    <li><a href="#games" class="nav-link scrollto"><i class="bx bx-game"></i>
                            <span>Games</span></a></li>
                </ul>
            </nav><!-- .nav-menu -->
        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex flex-column justify-content-center align-items-center">
        <div class="hero-container" data-aos="fade-in">
            <h1>Mota Zorrilla</h1>
            <p>I'm <span class="typed" data-typed-items="Engineer, Designer, Developer, Freelancer"></span></p>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container">

                <div class="section-title">
                    <h2>About</h2>
                    <p>Héctor Ramón Mota Zorrilla is an Electrical Engineer specializing in Power, graduated from the
                        Central University of Venezuela. Born in Maturín, Venezuela.
                        With a solid academic background and extensive experience in engineering projects.</p>
                </div>

                <div class="row">
                    <div class="col-lg-4" data-aos="fade-right">
                        <img src="{{ asset('img/profile.jpg') }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 pt-4 pt-lg-0 content" data-aos="fade-left">
                        <h3>Electrical Engineer &amp; Web Developer.</h3>
                        <p class="fst-italic">
                            As an engineer, I thrive on problem-solving and innovation, consistently seeking new
                            challenges to apply my expertise.
                            My experience encompasses a wide range of engineering projects, from power systems design to
                            automation and control. <br>

                            In parallel, my journey as a web developer has allowed me to explore the dynamic
                            intersection of technology and creativity.
                            I specialize in crafting elegant and user-friendly web experiences,
                            utilizing a blend of front-end and back-end technologies to bring ideas to life on the
                            digital canvas.
                        </p>
                        <div class="row">
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Birthday:</strong> <span>
                                            1985</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>City:</strong> <span>Puerto Ordaz,
                                            Venezuela</span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Website:</strong>
                                        <span>www.motazorrilla.com</span>
                                    </li>
                                </ul>

                            </div>
                            <div class="col-lg-6">
                                <ul>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Age:</strong> <span
                                            id="age"></span></li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Degree:</strong>
                                        <span>Engineer</span>
                                    </li>
                                    <li><i class="bi bi-chevron-right"></i> <strong>Email:</strong>
                                        <span>hector@motazorrilla.com</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <p>
                            Combining my engineering prowess with my passion for web development,
                            I strive to deliver solutions that are not only technically sound but also visually engaging
                            and intuitive. <br>
                            With each project, my goal is to exceed expectations and leave a lasting impression.
                            Let's connect and collaborate to turn your digital vision into reality.
                        </p>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Facts Section ======= -->
        <section id="facts" class="facts">
            <div class="container">

                <div class="section-title">
                    <h2>Facts</h2>
                    <p>"Additionally, I am currently venturing into Building Information Modeling (BIM),
                        expanding my expertise beyond traditional engineering and web development realms.
                        Embracing the dynamic landscape of BIM allows me to explore innovative approaches to design,
                        collaboration, and project management, ensuring optimal outcomes in construction projects.""
                    </p>
                    <br>
                    <p>
                        "My dedication to mastering emerging technologies underscores my commitment to delivering
                        cutting-edge solutions and staying at the forefront of industry advancements."</p>
                </div>

                <div class="row no-gutters">

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="count-box">
                            <i class="bi bi-people"></i>
                            <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="2"
                                class="purecounter"></span>
                            <p><strong>&amp More Solid Network Of Associates</strong> <br>High-quality outcomes in all
                                endeavors.</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="200">
                        <div class="count-box">
                            <i class="bi bi-journal-richtext"></i>
                            <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="3"
                                class="purecounter"></span>
                            <p><strong>&amp More Track Record Successful Collaboration </strong> <br>Across diverse
                                projects and industries</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="300">
                        <div class="count-box">
                            <i class="bi bi-emoji-smile"></i>
                            <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="4"
                                class="purecounter"></span>
                            <p><strong>&amp More Happy Clients</strong> <br>Served and satisfied</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch" data-aos="fade-up"
                        data-aos-delay="400">
                        <div class="count-box">
                            <i class="bi bi-headset"></i>
                            <span data-purecounter-start="0" data-purecounter-end="10000"
                                data-purecounter-duration="5" class="purecounter"></span>
                            <p><strong>&amp More Hours Invested </strong><br> In various projects</p>
                        </div>
                    </div>


                </div>

            </div>
        </section><!-- End Facts Section -->

        <!-- ======= Skills Section ======= -->
        <section id="skills" class="skills section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Skills</h2>
                    <p>In the realm of web development, I possess a diverse array of competencies aimed at crafting
                        robust and dynamic online experiences. From front-end technologies like HTML, CSS, and
                        JavaScript, to back-end frameworks such as PHP and databases like MySQL, I leverage a
                        comprehensive skill set to bring digital visions to life. Proficient in popular frameworks like
                        Laravel, I excel in building scalable and efficient web applications. <br>
                        My dedication to staying
                        current with emerging technologies ensures that I remain at the forefront of web development
                        trends, continuously expanding my skill set to deliver innovative solutions.</p>
                </div>

                <div class="row skills-content">

                    <div class="col-lg-6" data-aos="fade-up">

                        <div class="progress">
                            <span class="skill">HTML <i class="val">100%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">CSS <i class="val">90%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">JavaScript <i class="val">75%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                        <div class="progress">
                            <span class="skill">PHP <i class="val">80%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">WordPress/CMS <i class="val">90%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="progress">
                            <span class="skill">Photoshop <i class="val">55%</i></span>
                            <div class="progress-bar-wrap">
                                <div class="progress-bar" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                                    aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section><!-- End Skills Section -->

        <!-- ======= Resume Section ======= -->
        <section id="resume" class="resume">
            <div class="container">

                <div class="section-title">
                    <h2>Resume</h2>
                    <p>Dynamic and results-oriented Electrical Engineer and Web Developer with a solid academic
                        background and extensive experience in engineering projects.
                        Thrives on problem-solving and innovation, consistently seeking new challenges to apply
                        expertise. <br>
                        Excels in crafting elegant and user-friendly web experiences, utilizing a blend of front-end and
                        back-end technologies to bring ideas to life on the digital canvas.
                        Currently venturing into Building Information Modeling (BIM) to explore innovative approaches to
                        design, collaboration, and project management./p>
                </div>

                <div class="row">
                    <div class="col-lg-6" data-aos="fade-up">
                        <h3 class="resume-title">Sumary</h3>
                        <div class="resume-item pb-0">
                            <h4>Héctor Mota</h4>
                            <p><em>Electrical Engineer with experience in project management and web development.
                                    My technical background is complemented by courses and skills in the fields of
                                    electrical engineering, design, and web technologies."</em></p>
                            <ul>
                                <li>Puerto Ordaz, Bolívar state, Venezuela</li>
                                <li>hector@motazorrilla.com</li>
                            </ul>
                        </div>

                        <h3 class="resume-title">Education</h3>
                        <div class="resume-item">
                            <h4>Electrical Engineering</h4>
                            <h5>2003 - 2009</h5>
                            <p><em>University Central of Venezuela, Caracas, Venezuela</em></p>
                            <p>Specialization: Power Systems</p>
                        </div>
                        <div class="resume-item">
                            <h4>Bachelor of Science </h4>
                            <h5>1997-2002</h5>
                            <p><em>U.E.C. "Nuestra Sra. del Rosario" San Felíx, Bolívar state, Venezuela</em></p>
                        </div>

                        <h3 class="resume-title">Skills</h3>
                        <div class="resume-item">
                            <h4>Key Skills</h4>
                            <ul>
                                <li>Web development with HTML, CSS, JavaScript, PHP, MySQL, Laravel</li>
                                <li>Excellent communication and interpersonal skills</li>
                                <li>Ability to work under pressure and lead teams</li>
                                <li>Problem-solving and analytical skills</li>
                                <li>Technical report writing</li>
                                <li>Interpretation of blueprints and regulations</li>
                                <li>Technical evaluation of equipment and instruments</li>
                                <li>Preparation of plans and operation manuals</li>
                                <li>Proficiency in engineering software and simulation</li>
                                <li>Knowledge in lighting and process control</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="resume-title">Professional Experience</h3>
                        <div class="resume-item">
                            <h4>Engineer</h4>
                            <h5>2011 - Present</h5>
                            <p><em>Main Work Experience</em></p>
                            <ul>
                                <li>Speaker "Introduction to BIM Methodology". School of Engineering.
                                    Gran Mariscal de Ayacucho University. October 2023</li>
                                <li>Speaker "Introduction to BIM Methodology". VII Civil Engineering Conference.
                                    Andrés Bello Catholic University. Ciudad Guayana. June 2023</li>
                                <li>C.T.O. Neobranding. 2022 - Present</li>
                                <li>Executive Director. Guayana Intelligent and Sustainable Foundation. 2022 - Present
                                </li>
                                <li>Coordinator of Special Projects. II Venezuelan Symposium on Smart and Sustainable
                                    Cities. Ciudad Guayana 2021</li>
                                <li>General Manager. Dennys Zorrilla Investments C.A. Puerto Ordaz 2019-2022</li>
                                <li>General Manager. Professional Currency Exchange AD Dinners. Cúcuta, Colombia.
                                    2018-2019</li>
                                <li>Project Manager. Construcciones Bachacos C.A. Maturín 2013-2015</li>
                                <li>Project Engineer. CEPI C.A. Maturín. 2012-2013</li>
                            </ul>
                        </div>
                        <div class="resume-item">
                            <h4>Main Courses</h4>
                            <ul>
                                <li>BIM Roles Bootcamp. Venezuelan Construction Chamber, BIM Forum VE. November 2023
                                </li>
                                <li>Lean Production Course. Innovalo Learn. Tutellus.com. 2020</li>
                                <li>PHP, MySQL, REACT, LARAVEL, DOCKER, REST API Courses. Youtube.com. 2021-2022</li>
                                <li>HTML, CSS, JavaScript for Beginners Courses. Fazt. Youtube.com. 2021</li>
                                <li>Introduction to Gravitational Waves Course. University of Cordoba. Edx.org. 2020.
                                </li>
                                <li>Quantum Gravity and String Theory Course. University of Navarra. Tutellus.com. 2020
                                </li>
                                <li>Lean Production Course. Innovalo Learn. Tutellus.com. 2020</li>
                                <li>Financial Education Course. Club Empremier. Tutellus.com. 2018</li>
                                <li>Professional Trading Initiation Course. Tutellus.com. 2018</li>
                                <li>Open English. Online English Course. Intermediate Level. 2011.</li>
                                <li>Course in Civil Works Inspection and Supervision. Professional Improvement
                                    Commission, College of Engineers of Venezuela. Ciudad Guayana Section. 2011.</li>
                                <li>Project Management Course. Professional Improvement Institute Foundation, College of
                                    Engineers of Venezuela. Caracas. 2011.</li>
                            </ul>
                        </div>
                    </div>

                </div>
        </section><!-- End Resume Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Portfolio</h2>
                    <p>While my background primarily lies in electrical engineering, this space is dedicated to
                        showcasing my passion for web development.
                        Explore a selection of my web design and development projects, including applications and
                        website designs I've crafted.</p>
                </div>

                <div class="row" data-aos="fade-up">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                            <li data-filter=".filter-app">App</li>
                            <li data-filter=".filter-card">Ads</li>
                            <li data-filter=".filter-web">Web</li>
                        </ul>
                    </div>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="100">

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A1.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A1.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A1.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A2.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A2.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A2.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/Pintura.png') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/Pintura.png') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="App"><i class="bx bx-plus"></i></a>
                                <a href="https://pinturaintumescente.cl/home" target="_blank" title="App"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A3.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A3.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A3.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A4.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A4.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A4.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
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
                                    title="Web Neobranding"><i class="bx bx-plus"></i></a>
                                <a href="https://neobrandingagency.com/" target="_blank" title="Web Neobranding"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/tetris.png') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/tetris.png') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="App"><i class="bx bx-plus"></i></a>
                                <a href="/tetris" target="_blank"title="App"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A5.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A5.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A5.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/metroscuadrados.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/metroscuadrados.jpg') }}"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox"
                                    title="Web metroscuadrados.jpg"><i class="bx bx-plus"></i></a>
                                <a href="https://metroscuadrados.com.ve/" target="_blank"
                                    title="Web Metros Cuadrados"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A6.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A6.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A6.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/A7.jpg') }}" class="img-fluid" alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/A7.jpg') }}" data-gallery="portfolioGallery"
                                    class="portfolio-lightbox" title="Ads"><i class="bx bx-plus"></i></a>
                                <a href="{{ asset('img/portfolio/A7.jpg') }}" target="_blank" title="Ads"><i
                                        class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
                        <div class="portfolio-wrap">
                            <img src="{{ asset('img/portfolio/guayanaisevento.jpg') }}" class="img-fluid"
                                alt="">
                            <div class="portfolio-links">
                                <a href="{{ asset('img/portfolio/guayanaisevento.jpg') }}"
                                    data-gallery="portfolioGallery" class="portfolio-lightbox"
                                    title="Web II SVCIS"><i class="bx bx-plus"></i></a>
                                <a href="https://guayanais.com/evento/" target="_blank"
                                    title="Web Metros Cuadrados"><i class="bx bx-link"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section><!-- End Portfolio Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services">
            <div class="container">
                <div class="section-title">
                    <h2>Services</h2>
                    <p>Here are the services I offer to help you achieve your goals.</p>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up">
                        <div class="icon"><i class="bi bi-laptop"></i></div>
                        <h4 class="title"><a href="#">Web Development</a></h4>
                        <p class="description">Crafting responsive and user-friendly websites tailored to your needs.
                        </p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon"><i class="bi bi-puzzle"></i></div>
                        <h4 class="title"><a href="#">Software Development</a></h4>
                        <p class="description">Building custom software solutions to streamline your business
                            processes.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon"><i class="bi bi-lightbulb"></i></div>
                        <h4 class="title"><a href="#">Consulting</a></h4>
                        <p class="description">Providing expert advice and guidance to help you make informed
                            decisions.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon"><i class="bi bi-vector-pen"></i></div>
                        <h4 class="title"><a href="#">UI/UX Design</a></h4>
                        <p class="description">Designing intuitive and visually appealing interfaces for your
                            applications.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                        <div class="icon"><i class="bi bi-briefcase"></i></div>
                        <h4 class="title"><a href="#">Project Management</a></h4>
                        <p class="description">Leading and coordinating projects from inception to successful
                            completion.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon"><i class="bi bi-code-slash"></i></div>
                        <h4 class="title"><a href="#">Technical Support</a></h4>
                        <p class="description">Offering technical assistance and troubleshooting for your IT systems.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Testimonials</h2>
                    <p>Discover what our clients and associates have to say about their experience working with Héctor
                        Mota.</p>
                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        <!-- Testimonial 1: René Ambiado, CEO of NeoBranding -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Working with Héctor has been a game-changer for our business. His expertise
                                    and dedication to delivering exceptional results have exceeded our
                                    expectations. I highly recommend him to anyone looking for top-notch web solutions.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('img/testimonials/rene.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>René Ambiado</h3>
                                <h4>CEO, NeoBranding</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimonial 2: Simón Boada, CFO of Neo TV -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="100">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Héctor Mota's expertise and professionalism have been instrumental in the success of
                                    our projects at Neo TV. His ability to translate our vision into reality is
                                    unmatched. Working with him has been a pleasure, and I look forward to future
                                    collaborations.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('img/testimonials/simon.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Simón Boada</h3>
                                <h4>CFO, Neo TV</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimonial 3: Liz Ruiz, Copywriter at NeoBranding -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    As a copywriter, I've had the pleasure of collaborating with Héctor
                                    Mota on several projects. His professionalism, creativity, and attention to detail
                                    are truly impressive. Working with him has been inspiring, and I highly recommend
                                    his services.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('img/testimonials/liz.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Liz Ruiz</h3>
                                <h4>Copywriter</h4>
                            </div>
                        </div><!-- End testimonial item -->

                        <!-- Testimonial 4: Omar Martínez, Attorney at Law -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                                <p>
                                    <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                    Héctor Mota's expertise and professionalism have been invaluable to our
                                    organization. His ability to navigate complex matters with ease and provide
                                    strategic advice has greatly benefited our business. I highly recommend him to
                                    anyone.
                                    <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                </p>
                                <img src="{{ asset('img/testimonials/omar.jpg') }}" class="testimonial-img"
                                    alt="">
                                <h3>Omar Martínez</h3>
                                <h4>Attorney</h4>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section -->

        <!-- ======= Contact Section ======= -->
        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Have a project in mind or just want to say hello? Feel free to reach out! You can send me an
                        email or message me on WhatsApp. I'm always
                        excited to hear from you!</p>
                </div>

                <div class="row" data-aos="fade-in">
                    <div class="col-lg-5 d-flex align-items-stretch">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Puerto Ordaz, Bolívar State, Venezuela</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p><a href="mailto:hector@motazorrilla.com" target="_blank">Send email to Héctor Mota
                                        Zorrilla</a></p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-whatsapp"></i>
                                <h4>WhatsApp:</h4>
                                <p><a href="https://wa.me/584148873615" target="_blank">Send message</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                        <div class="info">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-62.6482025!3d8.3087142!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fe500d7b5589e3d%3A0x76831463a4f3e469!2sPuerto%20Ordaz%2C%20Bol%C3%ADvar%2C%20Venezuela!5e0!3m2!1sen!2sus!4v1649822262192"
                                frameborder="0" style="border:0; width: 100%; height: 290px;"
                                allowfullscreen></iframe>
                            {{-- <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="name">Your Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="name">Your Email</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name">Subject</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Message</label>
                                <textarea class="form-control" name="message" rows="10" required></textarea>
                            </div>
                            <div class="my-3">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="text-center"><button type="submit">Send Message</button></div>
                        </form> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- End Contact Section -->

        <!-- ======= Whatsapp Section ======= -->
        <div class="whatsapp-button">
            <a href="https://wa.me/584148873615" target="_blank">
                <i class="bi bi-whatsapp"></i>
            </a>
        </div>

        <!-- ======= Games Section ======= -->
        <section id="games" class="testimonials section-bg">
            <div class="container">

                <div class="section-title">
                    <h2>Video Games</h2>
                    <p>✨I dedicate part of my free time to developing video games as a hobby.
                        This section arises as a tribute to video games, which have been major drivers of the
                        technological development we experience today. </p>
                </div>

                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        <!-- Primer juego (Tetris) -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="100">
                                <a href="/tetris" target="blank">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        🕹️ The addictive experience of the classic Tetris, reinvented with a modern
                                        twist.
                                        Combine skill and strategy to fit the pieces into the right place and complete
                                        lines,
                                        challenging your limits in this timeless puzzle game.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                    <img src="{{ asset('img/tetris.png') }}" class="testimonial-icon" alt=""
                                        style="width: auto; height: 100px;">
                                    <h3>Tetris</h3>
                                    <h4>2D</h4>
                                </a>
                            </div>
                        </div><!-- Fin del primer juego -->

                        <!-- Segundo juego (Laberinto 3D) -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="200">
                                <a href="/dash" target="blank">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        🏎️ Take the wheel and experience the thrill of high-speed racing! <br>
                                        Put your
                                        reflexes to the test as you navigate challenging courses and compete for the top
                                        spot.🏁
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                    <img src="{{ asset('img/dash.png') }}" class="testimonial-icon"
                                        alt="" style="width: auto; height: 100px;">
                                    <h3>Dash</h3>
                                    <h4>2D->3D</h4>
                                </a>
                            </div>
                        </div><!-- Fin del segundo juego -->

                        <!-- tercer juego (Laberinto 3D) -->
                        <div class="swiper-slide">
                            <div class="testimonial-item" data-aos="fade-up" data-aos-delay="300">
                                <a href="/ray" target="blank">
                                    <p>
                                        <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                                        ⚡ Explore a three-dimensional maze full of mysteries and challenges.
                                        Navigate through intricate passageways and search for the exit while facing
                                        obstacles
                                        and puzzles in this third-dimensional adventure game.
                                        <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                                    </p>
                                    <img src="{{ asset('img/labyrinth.png') }}" class="testimonial-icon"
                                        alt="" style="width: auto; height: 100px;">
                                    <h3>labyrinth</h3>
                                    <h4>3D</h4>
                                </a>
                            </div>
                        </div><!-- Fin del tercer juego -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section><!-- End video game Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>MotaZorrilla</span></strong>
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/iportfolio-bootstrap-portfolio-websites-template/ -->
                {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
            </div>
        </div>
    </footer><!-- End  Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>



    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/typed.js/typed.umd.js') }}"></script>
    <script src="{{ asset('vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- script current age -->
    <script src="{{ asset('js/age.js') }}"></script>

</body>

</html>
