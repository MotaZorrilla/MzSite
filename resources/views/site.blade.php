<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Alpine.js for chat functionality -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.10/dist/cdn.min.js"></script>

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


    <x-site.header/>

    <x-site.hero/>

    <main id="main">

        <x-site.about/>

        <x-site.facts/>

        <x-site.skills/>

        <x-site.resume/>

        <x-site.portfolio/>

        <x-site.financial-analysis/>

        <x-site.engineering/>

        <x-site.services/>

        <x-site.testimonials/>

        <x-site.contact/>

        <!-- ======= Whatsapp Section ======= -->
        <div class="whatsapp-button">
            <a href="https://wa.me/584148873615" target="_blank">
                <i class="bi bi-whatsapp"></i>
            </a>
        </div>

        <x-site.games/>
    </main><!-- End #main -->

    <x-site.footer/>

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

    <!-- AI Chatbot Components and Logic -->
    <div x-data="chatBot()">
        <x-site.chat-window />
        <x-site.chat-trigger />
    </div>

    <script>
        function chatBot() {
            return {
                showChat: false,
                loading: false,
                newMessage: '',
                messages: [
                    { id: 1, from: 'ai', text: 'Hello! How can I help you learn more about Héctor?' }
                ],
                
                init() {
                    this.$watch('showChat', (value) => {
                        if (value) {
                            this.$nextTick(() => {
                                this.$refs.chatInput.focus();
                            });
                        }
                    });
                },

                sendMessage() {
                    if (this.newMessage.trim() === '') return;

                    this.messages.push({ id: Date.now(), from: 'user', text: this.newMessage });
                    this.scrollToBottom();

                    this.loading = true;
                    
                    const userMessage = this.newMessage;
                    this.newMessage = '';

                    fetch('/api/chat', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ message: userMessage })
                    })
                    .then(response => response.json())
                    .then(data => {
                        this.loading = false;
                        this.messages.push({ id: Date.now(), from: 'ai', text: data.reply });
                        this.scrollToBottom();
                    })
                    .catch(error => {
                        this.loading = false;
                        this.messages.push({ id: Date.now(), from: 'ai', text: 'Sorry, I am having trouble connecting. Please try again later.' });
                        this.scrollToBottom();
                        console.error('Error:', error);
                    });
                },

                scrollToBottom() {
                    this.$nextTick(() => {
                        this.$refs.messageContainer.scrollTop = this.$refs.messageContainer.scrollHeight;
                    });
                }
            }
        }
    </script>

</body>

</html>
