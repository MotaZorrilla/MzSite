<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MZ Dash </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('images/iconDash.png') }}" rel="icon">
    <link href="{{ asset('images/iconDash.png') }}" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">



    <!-- Template Main CSS File -->
    <link href="{{ asset('css/tetris.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dash.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P" rel="stylesheet" />

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
    <script>
        window.console = window.console || function(t) {};
    </script>
    <script>
        if (document.location.search.match(/type=embed/gi)) {
            window.parent.postMessage("resize", "*");
        }
    </script>
</head>

<body translate="no">
    <header class="header">
        <div class="content">
            <div class="logo">
                <a href="https://motazorrilla.com">
                    <img class="logo" src="assets/images/Motazorrilla.png" alt="" width="250" />
                </a>
            </div>
            <div class="title">
                MZ Dash
            </div>
        </div>
    </header>
    <main>
        <div id="game">
            <div id="road">
                <div id="cloud"></div>
                <div id="hero"></div>
            </div>
            <div id="hud">
                <span id="time" class="topUI">0</span>
                <span id="score" class="topUI">0</span>
                <span id="lap" class="topUI">0'00"000</span>
                <span id="tacho">0</span>
            </div>
            <div id="home">
                <h1>MZDash</h1>
                <p id="text"></p>
                <div id="highscore"></div>
            </div>
        </div>
        <div id="controls">
            <span><span>C</span>insert coin</span>
            <span><span>M</span>mute</span>
            <span><span>&lt;</span><span>&gt;</span>move</span>
            <span><span>&lt;</span><span>&gt;</span>accelerate</span>
        </div>
    </main>
    <footer class="footer">
        <a href="https://motazorrilla.com">@motazorrilla</a>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/dash.js') }}"></script>
    <script src="{{ asset('js/rendered-js.js') }}"></script>
    <script src="{{ asset('js/null.js') }}"></script>
</body>

</html>
