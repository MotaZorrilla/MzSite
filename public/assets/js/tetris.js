document.addEventListener('DOMContentLoaded', function () {
    let gameOver = false;
    let gameInterval;

    // Modals
    const modalLevelsElement = document.getElementById("selectLabelModal");
    const bootstrapLevelModal = new bootstrap.Modal(modalLevelsElement, {
        keyboard: false,
        backdrop: 'static'
    });

    const modalGameOverElement = document.getElementById("gameOverModal");
    const bootstrapGameOverModal = new bootstrap.Modal(modalGameOverElement);


    // Buttons
    const levelEasy = document.getElementById("buttonEasy");
    const levelNormal = document.getElementById("buttonNormal");
    const levelHard = document.getElementById("buttonHard");
    const reset = document.getElementById("resetButton");
    const sound = document.getElementById("buttonMuted");

    // Game state variables
    let speed = 0;
    let lives = 3;
    let score = 0;
    let level = 1;
    let isEasyMode = false;

    // Sounds
    const bgm = new Audio("/assets/sounds/tetris.mp3");
    bgm.loop = true;
    const breakSound = new Audio("/assets/sounds/Whoosh.mp3");
    const drop = new Audio("/assets/sounds/drop.mp3");
    const lose = new Audio("/assets/sounds/sadTrombone.mp3");

    function toggleMute() {
        const allSounds = [bgm, breakSound, drop, lose];
        const isMuted = bgm.muted;
        allSounds.forEach(s => s.muted = !isMuted);
        if (isMuted) {
            bgm.play().catch(e => console.log("Audio play was prevented."));
        } else {
            bgm.pause();
        }
    }

    sound.addEventListener("click", toggleMute);
    
    function startGame(selectedSpeed, easyMode = false) {
        if (gameInterval) {
            clearInterval(gameInterval);
        }
        restartGame();
        speed = selectedSpeed;
        isEasyMode = easyMode;

        if (bgm.muted) {
            toggleMute();
        }
        bgm.play().catch(e => console.log("Audio play was prevented until user interaction."));

        gameInterval = setInterval(gameLoop, speed);
        bootstrapLevelModal.hide();
    }

    levelEasy.addEventListener('click', () => startGame(700, true));
    levelNormal.addEventListener('click', () => startGame(500));
    levelHard.addEventListener('click', () => startGame(100));

    reset.addEventListener("click", function () {
        bootstrapGameOverModal.hide();
        bootstrapLevelModal.show();
    });

    //Generación de fondo dinámico
    let angulo_fondo = Math.random() * 360;
    let tono_fondo = Math.random() * 360;
    setInterval(() => {
        document.body.style.background = `linear-gradient(
                    ${angulo_fondo}deg, 
                    hsl(${tono_fondo},100%,50%),
                    hsl(${tono_fondo},100%,20%)
                )`
        angulo_fondo += Math.random();
        tono_fondo += Math.random();
    }, 100);

    // Game board setup
    const BOARD_WIDTH = 10;
    const BOARD_HEIGHT = 20;
    const board = [];

    let rotatedShape;

    // init board
    function initializeBoard() {
        for (let row = 0; row < BOARD_HEIGHT; row++) {
            board[row] = [];
            for (let col = 0; col < BOARD_WIDTH; col++) {
                board[row][col] = 0;
            }
        }
    }

    // Tetrominoes
    const tetrominoes = [
        { shape: [[1, 1], [1, 1]], color: "#ff9e0b" },
        { shape: [[0, 2, 0], [2, 2, 2]], color: "#f20b33" },
        { shape: [[0, 3, 3], [3, 3, 0]], color: "#c01ebb" },
        { shape: [[4, 4, 0], [0, 4, 4]], color: "#238f18" },
        { shape: [[5, 0, 0], [5, 5, 5]], color: "#fe5f09" },
        { shape: [[0, 0, 6], [6, 6, 6]], color: "#003cbe" },
        { shape: [[7, 7, 7, 7]], color: "#0098df" },
    ];

    // Tetromino randomizer
    function randomTetromino() {
        const index = Math.floor(Math.random() * tetrominoes.length);
        const tetromino = tetrominoes[index];
        return {
            shape: tetromino.shape,
            color: tetromino.color,
            row: 0,
            col: Math.floor(Math.random() * (BOARD_WIDTH - tetromino.shape[0].length + 1)),
        };
    }

    let currentTetromino = randomTetromino();
    let currentGhostTetromino;

    function drawTetromino() {
        const { shape, color, row, col } = currentTetromino;
        for (let r = 0; r < shape.length; r++) {
            for (let c = 0; c < shape[r].length; c++) {
                if (shape[r][c]) {
                    const block = document.createElement("div");
                    block.classList.add("block");
                    block.style.backgroundColor = color;
                    block.style.top = (row + r) * 24 + "px";
                    block.style.left = (col + c) * 24 + "px";
                    block.setAttribute("id", `block-${row + r}-${col + c}`);
                    document.getElementById("game_board").appendChild(block);
                }
            }
        }
        moveGhostTetromino(); // Ensure ghost is updated
    }

    function eraseTetromino() {
        for (let i = 0; i < currentTetromino.shape.length; i++) {
            for (let j = 0; j < currentTetromino.shape[i].length; j++) {
                if (currentTetromino.shape[i][j] !== 0) {
                    let row = currentTetromino.row + i;
                    let col = currentTetromino.col + j;
                    let block = document.getElementById(`block-${row}-${col}`);
                    if (block) {
                        block.parentElement.removeChild(block);
                    }
                }
            }
        }
    }

    function canTetrominoMove(rowOffset, colOffset, shape = currentTetromino.shape) {
        for (let i = 0; i < shape.length; i++) {
            for (let j = 0; j < shape[i].length; j++) {
                if (shape[i][j] !== 0) {
                    let row = currentTetromino.row + i + rowOffset;
                    let col = currentTetromino.col + j + colOffset;
                    if (row >= BOARD_HEIGHT || col < 0 || col >= BOARD_WIDTH || (row >= 0 && board[row][col] !== 0)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    function canTetrominoRotate() {
        for (let i = 0; i < rotatedShape.length; i++) {
            for (let j = 0; j < rotatedShape[i].length; j++) {
                if (rotatedShape[i][j] !== 0) {
                    let row = currentTetromino.row + i;
                    let col = currentTetromino.col + j;
                    if (row >= BOARD_HEIGHT || col < 0 || col >= BOARD_WIDTH || (row >= 0 && board[row][col] !== 0)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    function lockTetromino() {
        if (gameOver) return;

        // Copy piece data into the board grid
        for (let i = 0; i < currentTetromino.shape.length; i++) {
            for (let j = 0; j < currentTetromino.shape[i].length; j++) {
                if (currentTetromino.shape[i][j] !== 0) {
                    let row = currentTetromino.row + i;
                    let col = currentTetromino.col + j;
                    if (row < 0) {
                        handleGameOver();
                        return;
                    }
                    board[row][col] = currentTetromino.color;
                }
            }
        }

        // Redraw the board to show the locked piece
        redrawBoard();

        // Find and handle cleared rows
        const clearedRows = findClearedRows();
        if (clearedRows.length > 0) {
            score += 10 * clearedRows.length; // Update score
            document.getElementById("score").innerText = "Score: " + score;
            if (score > 0 && score % 500 === 0) {
                level++;
                document.getElementById("level").innerText = "Level: " + level;
            }
            animateAndRemoveRows(clearedRows);
        }

        // Spawn a new tetromino
        currentTetromino = randomTetromino();
        if (!canTetrominoMove(0, 0)) {
            handleGameOver();
        }
        moveGhostTetromino();
    }
    
    function handleGameOver() {
        lives--;
        document.getElementById("lives").innerText = "vidas: " + lives;

        if (lives > 0) {
            // Reset board but keep score and level
            initializeBoard();
            redrawBoard();
            currentTetromino = randomTetromino();
        } else {
            // Truly game over
            gameOver = true;
            clearInterval(gameInterval);
            bgm.pause();
            lose.play();
            document.getElementById('finalScore').innerText = score;
            bootstrapGameOverModal.show();
        }
    }

    document.getElementById('scoreForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const playerName = document.getElementById('playerName').value;
        const finalScore = score;

        fetch('/tetris/score', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name: playerName, score: finalScore })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
            bootstrapGameOverModal.hide();
            location.reload(); // Reload the page to show updated scores
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    function findClearedRows() {
        let rowsToClear = [];
        for (let y = BOARD_HEIGHT - 1; y >= 0; y--) {
            if (board[y].every(value => value !== 0)) {
                rowsToClear.push(y);
            }
        }
        return rowsToClear;
    }

    function animateAndRemoveRows(rowsToClear) {
        breakSound.play();
        rowsToClear.forEach(y => {
            for (let x = 0; x < BOARD_WIDTH; x++) {
                const block = document.getElementById(`board-block-${y}-${x}`);
                if (block) {
                    block.classList.add("line-clear-animation");
                }
            }
        });

        // Wait for animation to finish
        setTimeout(() => {
            // Remove rows from bottom to top to avoid index issues
            rowsToClear.sort((a, b) => b - a).forEach(y => {
                board.splice(y, 1);
            });
            // Add new empty rows at the top
            for (let i = 0; i < rowsToClear.length; i++) {
                board.unshift(Array(BOARD_WIDTH).fill(0));
            }
            redrawBoard();
        }, 500); // Duration of the animation
    }
    
    function redrawBoard() {
        const gameBoard = document.getElementById("game_board");
        gameBoard.innerHTML = "";
        for (let row = 0; row < BOARD_HEIGHT; row++) {
            for (let col = 0; col < BOARD_WIDTH; col++) {
                if (board[row][col]) {
                    const block = document.createElement("div");
                    block.classList.add("block");
                    block.style.backgroundColor = board[row][col];
                    block.style.top = row * 24 + "px";
                    block.style.left = col * 24 + "px";
                    block.setAttribute("id", `board-block-${row}-${col}`);
                    gameBoard.appendChild(block);
                }
            }
        }
    }

    function rotateTetromino() {
        if (gameOver) return;
        rotatedShape = [];
        const shape = currentTetromino.shape;
        for (let i = 0; i < shape[0].length; i++) {
            let row = [];
            for (let j = shape.length - 1; j >= 0; j--) {
                row.push(shape[j][i]);
            }
            rotatedShape.push(row);
        }

        if (canTetrominoRotate()) {
            drop.play();
            eraseTetromino();
            currentTetromino.shape = rotatedShape;
            drawTetromino();
            moveGhostTetromino();
        }
    }

    function moveTetromino(direction) {
        if (gameOver) return;
        let row = currentTetromino.row;
        let col = currentTetromino.col;
        eraseTetromino();

        if (direction === "left" && canTetrominoMove(0, -1)) {
            currentTetromino.col -= 1;
        } else if (direction === "right" && canTetrominoMove(0, 1)) {
            currentTetromino.col += 1;
        } else if (direction === "down") {
            if (canTetrominoMove(1, 0)) {
                currentTetromino.row += 1;
            } else {
                drawTetromino(); // Redraw at old position before locking
                lockTetromino();
                return; // Exit to avoid double draw
            }
        }
        
        drawTetromino();
        if (direction !== "down") {
             moveGhostTetromino();
        }
    }
    
    function gameLoop() {
        if (!gameOver) {
            moveTetromino('down');
        }
    }

    function handleKeyPress(event) {
        if (gameOver) return;
        drop.play(); // Play sound on any key press
        switch (event.keyCode) {
            case 37: moveTetromino("left"); break;
            case 39: moveTetromino("right"); break;
            case 40: moveTetromino("down"); break;
            case 38: rotateTetromino(); break;
            case 32: dropTetromino(); break;
        }
    }

    document.addEventListener("keydown", handleKeyPress);

    function dropTetromino() {
        if (gameOver) return;
        drop.play();
        eraseTetromino();
        while (canTetrominoMove(1, 0)) {
            currentTetromino.row++;
        }
        drawTetromino();
        lockTetromino();
    }

    function drawGhostTetromino() {
        const ghost = document.querySelector(".ghost");
        if(ghost) ghost.parentElement.removeChild(ghost);
        
        const shape = currentGhostTetromino.shape;
        const color = "rgba(255,255,255,0.05)";
        const row = currentGhostTetromino.row;
        const col = currentGhostTetromino.col;

        const ghostContainer = document.createElement('div');
        ghostContainer.classList.add('ghost');
        
        for (let r = 0; r < shape.length; r++) {
            for (let c = 0; c < shape[r].length; c++) {
                if (shape[r][c]) {
                    const block = document.createElement("div");
                    block.style.backgroundColor = color;
                    block.style.top = (row + r) * 24 + "px";
                    block.style.left = (col + c) * 24 + "px";
                    block.style.position = 'absolute';
                    block.style.width = '24px';
                    block.style.height = '24px';
                    ghostContainer.appendChild(block);
                }
            }
        }
        document.getElementById("game_board").appendChild(ghostContainer);
    }

    function eraseGhostTetromino() {
        const ghost = document.querySelector(".ghost");
        if (ghost) {
            ghost.remove();
        }
    }

    function canGhostTetrominoMove(rowOffset, colOffset) {
        for (let i = 0; i < currentGhostTetromino.shape.length; i++) {
            for (let j = 0; j < currentGhostTetromino.shape[i].length; j++) {
                if (currentGhostTetromino.shape[i][j] !== 0) {
                    let row = currentGhostTetromino.row + i + rowOffset;
                    let col = currentGhostTetromino.col + j + colOffset;
                    if (row >= BOARD_HEIGHT || col < 0 || col >= BOARD_WIDTH || (row >= 0 && board[row][col] !== 0)) {
                        return false;
                    }
                }
            }
        }
        return true;
    }

    function moveGhostTetromino() {
        if (isEasyMode) {
            eraseGhostTetromino();
            currentGhostTetromino = { ...currentTetromino };
            while (canGhostTetrominoMove(1, 0)) {
                currentGhostTetromino.row++;
            }
            drawGhostTetromino();
        }
    }

    function restartGame() {
        gameOver = false;
        lives = 3;
        score = 0;
        level = 1;
        initializeBoard();
        redrawBoard();
        document.getElementById("score").innerText = "Score: " + score;
        document.getElementById("level").innerText = "Level: " + level;
        document.getElementById("lives").innerText = "vidas: " + lives;
        currentTetromino = randomTetromino();
    }
    
    // Initial setup
    initializeBoard();
    bootstrapLevelModal.show();
});
