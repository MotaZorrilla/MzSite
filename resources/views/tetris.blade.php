<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MZ TETRIS </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="icon">
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    <link href="{{ asset('css/tetris.css') }}" rel="stylesheet">

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
    <header class="header">
        <div class="content">
            <div class="logo">
                <a href="https://motazorrilla.com">
                    <img class="logo" src="assets/images/Motazorrilla.png" alt="" width="250" />
                </a>
            </div>
            <div class="title">
                TETRIS
            </div>
            <div class="help">
                <!-- Button trigger Select Label Modal -->
                <button type="button" class="btn btn-transparent" data-bs-toggle="modal"
                    data-bs-target="#selectLabelModal">
                    <img src="assets/images/niveles.png" alt="" height="30">
                </button>

                <!-- Button trigger Questions Modal -->
                <button type="button" class="btn btn-transparent" data-bs-toggle="modal"
                    data-bs-target="#questionsModal">
                    <img src="assets/images/Questions.png" alt="" height="30">
                </button>

                <!-- Button muted -->
                <button id="buttonMuted" type="button" class="btn btn-transparent">
                    <img src="assets/images/muted.png" alt="" height="30">
                </button>
            </div>
        </div>
    </header>
    <!-- Select Label Modal -->
    <div class="modal fade" id="selectLabelModal" tabindex="-1" aria-labelledby="selectLabelModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="selectLabelModalLabel">Selecciona tu Nivel de
                        Dificultad
                    </h1>
                    <button type="button" class="btn btn-danger ms-auto" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body text-center">
                    <button id="buttonEasy" type="button" class="btn btn-transparent" data-bs-toggle="modal"
                        data-bs-target="#selectLevel">
                        <img src="assets/images/nivel-facil.png" alt="" height="60" />
                    </button>
                    <br><br>
                    <button id="buttonNormal" type="button" class="btn btn-transparent" data-bs-toggle="modal"
                        data-bs-target="#selectLevel">
                        <img src="assets/images/nivel-normal.png" alt="" height="30" />
                    </button>
                    <br><br>
                    <button id="buttonHard" type="button" class="btn btn-transparent" data-bs-toggle="modal"
                        data-bs-target="#selectLevel">
                        <img src="assets/images/nivel-dificil.png" alt="" height="50" />
                    </button>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    <!-- Quesion Modal -->
    <div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="questionsModalLabel">Tetris: Un Juego de Bloques
                        Adictivo
                    </h1>
                    <button type="button" class="btn btn-danger ms-auto" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body ">
                    <p>
                        Tetris es un juego de bloques en el que el jugador debe rotar y mover bloques que
                        caen para
                        formar líneas completas.<br>
                        Si una línea completa se forma, desaparece, lo que otorga al jugador puntos.<br>
                        El objetivo del juego es mantener la menor cantidad de líneas posible.<br><br>

                        <span style="font-weight: bold;">Reglas básicas:</span><br>

                        * El jugador debe rotar y mover bloques que caen para formar líneas completas.<br>
                        * Si una línea completa se forma, desaparece, lo que otorga al jugador
                        puntos.<br><br>

                        <span style="font-weight: bold;">Controles:</span><br>

                        <span style="font-weight: bold;">Tecla arriba:</span> Rota el bloque 90 grados en el
                        sentido
                        de las agujas del reloj.<br>
                        <span style="font-weight: bold;">Tecla abajo:</span> Hace caer el bloque una
                        fila.<br>
                        <span style="font-weight: bold;">Tecla izquierda:</span> Mueve el bloque una columna
                        hacia
                        la izquierda.<br>
                        <span style="font-weight: bold;">Tecla derecha:</span> Mueve el bloque una columna
                        hacia la
                        derecha.<br>
                        <span style="font-weight: bold;">Barra:</span> Hace caer el bloque
                        rápidamente.<br><br>

                        <span style="font-weight: bold;">Consejos:</span><br>

                        Intenta mantener los bloques alineados para formar líneas completas.<br>
                        No tengas miedo de rotar los bloques.<br>
                        Prueba a usar la tecla barra para hacer caer el bloque rápidamente.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="game_board_wrap">
            <img class="logo" src="assets/images/tetris.png" alt="" width="250" />
            <div class="game_container">
                <div id="game_board"></div>
                <div id="game_info">
                    <div style="display: flex; gap: 10px">
                        <div id="score">Score: 0</div>
                        <div id="level">Level: 1</div>
                        <div id="lives">vidas: 3</div>
                    </div>
                    <h4>Top Scores:</h4>
                    <div id="top-scores">
                        <div class="score-item score-gold">
                            <span><i class="bi bi-trophy-fill"></i> Oro</span>
                            <span>5000 puntos</span>
                        </div>
                        <div class="score-item score-silver">
                            <span><i class="bi bi-trophy-fill"></i> Plata</span>
                            <span>4500 puntos</span>
                        </div>
                        <div class="score-item score-bronze">
                            <span><i class="bi bi-trophy-fill"></i> Bronce</span>
                            <span>4000 puntos</span>
                        </div>
                    </div>
                    <div id="recent-scores">
                        <div class="score-item">
                            <span>4</span>
                            <span>3000 puntos</span>
                        </div>
                        <div class="score-item">
                            <span>5</span>
                            <span>2500 puntos</span>
                        </div>
                        <!-- Agrega más elementos según sea necesario -->
                    </div>
                    <h5>Nivel Fácil</h5>
                    <div id="difficulty-levels">
                        <div class="level-item">
                            <span>Primer Nivel</span>
                            <span>100 puntos</span>
                        </div>
                    </div>

                </div>
            </div>
            <!-- Button Game Over Modal -->
            <button type="button" class="btn btn-transparent " data-bs-toggle="modal"
                data-bs-target="#gameOverModal" style="display: none">
                <img src="assets/images/gameOver.png" alt="" width="250" />
            </button>
        </div>
    </main>
    <!-- GameOver Modal -->
    <div class="modal fade" id="gameOverModal" tabindex="-1" aria-labelledby="gameOverModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="gameOverModalLabel">Perdiste
                    </h1>
                    <button type="button" class="btn btn-danger ms-auto" data-bs-dismiss="modal"
                        aria-label="Close">X</button>
                </div>
                <div class="modal-body ">
                    <p>
                        ¿quieres jugar una vez mas?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button id="resetButton" type="button" class="btn btn-primary">¡Volver a jugar!</button>
                  </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <a href="https://motazorrilla.com">@motazorrilla</a>
    </footer>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- script Tetris -->
    <script src="{{ asset('js/tetris.js') }}"></script>
</body>

</html>
