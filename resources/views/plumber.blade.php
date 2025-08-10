<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MZ Plumber Battle JS </title>
    <meta content="" name="Plumber Battle JS">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="icon">
    <link href="{{ asset('img/profile-img.jpeg') }}" rel="apple-touch-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Template Main CSS File -->
    
    <link href="{{ asset('css/plumber.css') }}" rel="stylesheet">
    <link href="{{ asset('css/difficulty-indicator.css') }}" rel="stylesheet">

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
        <div class="content d-flex justify-content-between align-items-center position-relative">
            <div class="logo">
                <a href="https://motazorrilla.com">
                    <img class="logo" src="assets/images/Motazorrilla.png" alt="" width="250" />
                </a>
            </div>
            <div class="game-title-image d-none d-md-block">
                <img src="{{ asset('images/plumber/PlumberBattleJS.png') }}" alt="Plumber Battle JS" style="max-width: 200px; height: auto;" />
            </div>
            <div class="help">
                <button class="navbar-toggler d-block d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#headerControls" aria-controls="headerControls" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-md-block" id="headerControls">
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
                    <button id="buttonEasy" type="button" class="btn btn-transparent">
                        <img src="assets/images/nivel-facil.png" alt="" height="60" />
                    </button>
                    <br><br>
                    <button id="buttonNormal" type="button" class="btn btn-transparent">
                        <img src="assets/images/nivel-normal.png" alt="" height="30" />
                    </button>
                    <br><br>
                    <button id="buttonHard" type="button" class="btn btn-transparent">
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
                    <h1 class="modal-title fs-5" id="questionsModalLabel">Plumber Battle JS: La Aventura Clásica</h1>
                    <button type="button" class="btn btn-danger ms-auto" data-bs-dismiss="modal" aria-label="Close">X</button>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Plumber Battle JS</strong> es un homenaje a los grandes juegos de plataformas como Mario, Contra y Metal Slug, desarrollado en JavaScript puro.
                    </p>
                    <p>
                        <strong>Objetivo:</strong> ¡Avanza por el nivel, derrota a los enemigos neandertales y enfréntate al poderoso Jefe Final para ganar!
                    </p>
                    <p>
                        <strong>Regla Especial:</strong> Empiezas con un personaje, pero si muere, ¡no te preocupes! Continuarás la partida automáticamente con el segundo personaje si aún sigue con vida.
                    </p>
                    <hr>
                    <strong>Controles:</strong>
                    <ul>
                        <li><strong>Controles Táctiles (Móvil):</strong></li>
                        <ul>
                            <li><strong>Cruceta (D-pad):</strong> Mover personaje.</li>
                            <li><strong>Botón A (Azul):</strong> Saltar.</li>
                            <li><strong>Botón B (Rojo):</strong> Disparar.</li>
                            <li><strong>Botón Start:</strong> Pausar / Iniciar / Seleccionar Personaje.</li>
                        </ul>
                        <br>
                        <li><strong>Teclado (PC):</strong></li>
                        <ul>
                            <li><strong>Mover/Saltar:</strong> Flechas de dirección.</li>
                            <li><strong>Disparar:</strong> Tecla `Control`.</li>
                            <li><strong>Pausa/Inicio:</strong> Tecla `Enter`.</li>
                        </ul>
                    </ul>
                    <hr>
                    <strong>Consejo:</strong> No todo lo que parece un error, lo es. ¡Algunas mecánicas están diseñadas para ayudarte a ganar!
                </div>
            </div>
        </div>
    </div>
    <main>
        <div class="game-main-content">
            <div class="game_board_wrap">
                <div class="game_container">
                    <div class="game-board-container">
                        <div id="console-body">
                            <div id="screen-area">
                                <canvas id="app"></canvas>
                            </div>
                            <div id="controls-container">
                                <div class="dpad">
                                    <div id="btn-left" class="dpad-btn"></div>
                                    <div id="btn-right" class="dpad-btn"></div>
                                    <div id="btn-up" class="dpad-btn"></div>
                                    <div id="btn-down" class="dpad-btn"></div>
                                </div>
                                <div class="start-button">
                                    <div id="btn-start" class="start-btn">START</div>
                                </div>
                                <div class="action-buttons">
                                    <div id="btn-b" class="action-btn">B</div>
                                    <div id="btn-a" class="action-btn">A</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div id="game_info">
                <h4>Top Scores:</h4>
                <div id="top-scores">
                   @foreach ($topScores as $difficulty => $score)
                      @php
                          $class = '';
                          if ($difficulty === 'hard') $class = 'gold';
                          if ($difficulty === 'normal') $class = 'silver';
                          if ($difficulty === 'easy') $class = 'bronze';
                      @endphp
                      <div class="score-item score-{{ $class }}">
                          <span><i class="bi bi-trophy-fill"></i> {{ $score->name }}</span>
                          <span>{{ $score->score }}</span>
                      </div>
                   @endforeach
                </div>
                <h4>Recent Scores:</h4>
                <div id="recent-scores">
                    @foreach ($recentScores as $score)
                      <div class="score-item">
                          <span>{{ $score->name }}</span>
                          <span>{{ $score->score }}</span>
                      </div>
                   @endforeach
                </div>
            </div>
        </div>
    </main>
    <!-- GameOver Modal -->
    <div class="modal fade" id="gameOverModal" tabindex="-1" aria-labelledby="gameOverModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="gameOverModalLabel">Save Your Score</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="score-modal-info" style="font-family: monospace, Arial, sans-serif; font-size: 1.2em; color: #FFD700; background: #222; border-radius: 8px; padding: 10px; margin-bottom: 10px; text-align: center;">
                        <div>Score: <span id="finalScore"></span></div>
                        <div>Tiempo: <span id="finalTime"></span></div>
                        <div>Dificultad: <span id="finalDifficulty"></span></div>
                    </div>
                    <form id="scoreForm">
                        <div class="mb-3">
                            <label for="playerName" class="form-label">Enter your name:</label>
                            <input type="text" class="form-control" id="playerName" required maxlength="12">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Save Score</button>
                        </div>
                    </form>
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

    <script type="module" src="{{ asset('js/plumber.js') }}"></script>

    <script>
    // Solo provee la ruta de la imagen según dificultad para el canvas
    window.getDifficultyIconSrc = function(difficulty) {
        const difficultyImages = {
            easy: 'assets/images/nivel-facil.png',
            normal: 'assets/images/nivel-normal.png',
            hard: 'assets/images/nivel-dificil.png'
        };
        return difficultyImages[difficulty] || '';
    };
    </script>

    <script>
        let selectedDifficulty = 'normal'; // Valor por defecto


        document.addEventListener('DOMContentLoaded', (event) => {
            function restartGameWithDifficulty(difficulty) {
                selectedDifficulty = difficulty;
                if (window.updateDifficultyIndicator) {
                    window.updateDifficultyIndicator(difficulty);
                }
                // Reinicia el juego desde cero con la dificultad seleccionada
                if (window.configureGame) {
                    // Por defecto inicia con plomero, puedes cambiarlo si quieres guardar selección
                    window.configureGame('plumber', difficulty);
                }
                // Cierra el modal
                if (document.activeElement) {
                    document.activeElement.blur();
                }
                const modal = bootstrap.Modal.getInstance(document.getElementById('selectLabelModal'));
                if (modal) modal.hide();
            }
            // Proteger addEventListener para evitar error si el botón no existe
            const btnEasy = document.getElementById('buttonEasy');
            if (btnEasy) btnEasy.addEventListener('click', (e) => { e.preventDefault(); restartGameWithDifficulty('easy'); });
            const btnNormal = document.getElementById('buttonNormal');
            if (btnNormal) btnNormal.addEventListener('click', (e) => { e.preventDefault(); restartGameWithDifficulty('normal'); });
            const btnHard = document.getElementById('buttonHard');
            if (btnHard) btnHard.addEventListener('click', (e) => { e.preventDefault(); restartGameWithDifficulty('hard'); });

            const scoreForm = document.getElementById('scoreForm');
            scoreForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const playerName = document.getElementById('playerName').value;
                const finalScore = document.getElementById('finalScore').innerText;
                const finalTime = window.getTotalTimeSeconds();
                const finalDifficulty = document.getElementById('finalDifficulty').innerText;
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('/plumber/score', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        name: playerName,
                        score: finalScore,
                        time: finalTime,
                        difficulty: finalDifficulty
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data.message);
                    location.reload();
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            });

            const resetBtn = document.getElementById('resetButton');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    location.reload();
                });
            }
        });
    </script>
</body>

</html>
