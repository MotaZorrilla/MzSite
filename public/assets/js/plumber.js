/**
 * @file main.js
 * @brief Main entry point for the game application.
 * This script orchestrates component initialization, global state management,
 * and the execution of the main game loop.
 */

// =============================================================================
// IMPORTED MODULES
// =============================================================================

import { CANVAS_WIDTH, CANVAS_HEIGHT, TILE_SIZE, MAP_WIDTH, MAP_HEIGHT, FINAL_BOSS_BACKGROUND_START_X } from "./src/app/config.js";
import Background from "./src/app/background.js";
import Ground from "./src/app/ground.js";
import Plumber from "./src/app/plumber.js";
import Angel from "./src/app/Angel.js";
import Projectile from "./src/app/Projectile.js";
import Boss from "./src/app/Boss.js";
import Torch from "./src/app/Torch.js";
import HealthBar from "./src/app/HealthBar.js";
import GlobalHealthBar from "./src/app/GlobalHealthBar.js";
import FinalBoss from "./src/app/FinalBoss.js";
import FinalBossProjectile from "./src/app/FinalBossProjectile.js";
import Camera from "./src/app/camera.js";
import WelcomeScreen from "./src/app/WelcomeScreen.js";
import OnScreenControls from "./src/app/OnScreenControls.js";
import AudioManager from "./src/app/AudioManager.js";

// =============================================================================
// GESTIÓN DEL ESTADO GLOBAL DEL JUEGO
// =============================================================================

let gameState = 'WELCOME'; // Possible states: WELCOME, PLAYING, VICTORY, GAME_OVER

// =============================================================================
// AUDIO RESOURCE INITIALIZATION AND MANAGEMENT
// =============================================================================

const audioManager = new AudioManager();
window.audioManager = audioManager;
const soundList = {
    'jump': './assets/audio/jump.wav',
    'fire-ball': './assets/audio/fire-ball.wav',
    'hit': './assets/audio/hit.wav',
    'explosion': './assets/audio/explosion.wav',
    'torch-explosion': './assets/audio/torch-explosion.wav',
    'acid-shoot': './assets/audio/acid-shoot.wav',
    'diffusion-effect': './assets/audio/diffusion-effect.wav',
    'rafaga': './assets/audio/rafaga.wav',
    'enemy-death': './assets/audio/enemy-death.wav',
    'final-boss-death': './assets/audio/final-boss-death.wav',
    'bomb-explosion': './assets/audio/bomb-explosion.wav',
    'item-get': './assets/audio/item-get.wav',
    'select-player': './assets/audio/select-player.wav',
    'music': './assets/audio/music.mp3',
    'victory': './assets/audio/victory.wav',
    'game-over': './assets/audio/game-over.wav',
    'outro': './assets/audio/outro.mp3',
    'battle': './assets/audio/battle.mp3' // Añadido para la batalla final
}

const soundsToLoad = {
    'music': './assets/audio/music.mp3',
    'victory': './assets/audio/victory.wav',
    'game-over': './assets/audio/game-over.wav',
    'select-player': './assets/audio/select-player.wav',
    'acid-shoot': './assets/audio/acid-shoot.wav',
    'bomb-explosion': './assets/audio/bomb-explosion.wav',
    'diffusion-effect': './assets/audio/diffusion-effect.wav',
    'enemy-death': './assets/audio/enemy-death.wav',
    'explosion': './assets/audio/explosion.wav',
    'final-boss-death': './assets/audio/final-boss-death.wav',
    'hit': './assets/audio/hit.wav',
    'item-get': './assets/audio/item-get.wav',
    'rafaga': './assets/audio/rafaga.wav',
    'torch-explosion': './assets/audio/torch-explosion.wav'
};

// =============================================================================
// CANVAS CONFIGURATION AND INITIALIZATION
// =============================================================================

const canvas = document.getElementById('app');
canvas.width = CANVAS_WIDTH;
canvas.height = CANVAS_HEIGHT;
const ctx = canvas.getContext('2d');
ctx.imageSmoothingEnabled = false;

// =============================================================================
// PROJECTILE ENTITY MANAGEMENT
// =============================================================================

let projectiles = [];
let torches = [];
let finalBossProjectiles = [];

/**
 * Creates and registers a new standard projectile instance.
 * @param {number} x - Initial X coordinate of the projectile.
 * @param {number} y - Initial Y coordinate of the projectile.
 * @param {number} direction - Direction of the projectile (1 for right, -1 for left).
 * @param {number} [vy=0] - Optional: Initial vertical velocity of the projectile.
 */
const createProjectile = (x, y, direction, vy = 0) => {
    const newProjectile = new Projectile(x, y, direction, vy);
    newProjectile.setCamera(camera);
    projectiles.push(newProjectile);
};

/**
 * Creates and registers a new torch projectile instance.
 * @param {number} x - Initial X coordinate of the torch.
 * @param {number} y - Initial Y coordinate of the torch.
 * @param {number} direction - Direction of the torch (1 for right, -1 for left).
 */
const createTorch = (x, y, direction) => {
    const torch = new Torch(x, y, direction, audioManager);
    torch.setCamera(camera);
    torches.push(torch);
};

/**
 * Creates and registers a new Final Boss projectile instance.
 * @param {number} x - Initial X coordinate of the projectile.
 * @param {number} y - Initial Y coordinate of the projectile.
 * @param {number} direction - Direction of the projectile (1 for right, -1 for left).
 * @param {object} creator - Object that created the projectile (e.g., FinalBoss).
 * @param {number} [vy=0] - Optional: Initial vertical velocity of the projectile.
 */
const createFinalBossProjectile = (x, y, direction, creator, vy = 0) => {
    const newFinalBossProjectile = new FinalBossProjectile(x, y, direction, creator, vy, audioManager);
    newFinalBossProjectile.setCamera(camera);
    finalBossProjectiles.push(newFinalBossProjectile);
};

// =============================================================================
// GAME MAIN OBJECT INSTANTIATION
// =============================================================================

const welcomeScreen = new WelcomeScreen();
const background = new Background();
const ground = new Ground();
const camera = new Camera();
const onScreenControls = new OnScreenControls(audioManager);

let plumber;
let angel;
let bosses = []; // Array para múltiples instancias de Boss
let currentBossIndex = 0; // Índice del jefe actual
let finalBoss;

// =============================================================================
// BOSS SEQUENCE AND HEALTH BAR MANAGEMENT
// =============================================================================
/**
 * This block manages the appearance and defeat sequence of bosses in the game.
 * Multiple Neanderthal Boss instances are initialized in the `bosses` array.
 * `currentBossIndex` tracks the currently active Neanderthal boss.
 * When a Neanderthal boss is defeated, the `handleNeanderthalBossDeath` function:
 * 1. Marks the current boss for removal.
 * 2. Increments `currentBossIndex` to advance to the next boss.
 * 3. If there are more Neanderthal bosses, updates health bar references
 *    and adds the new boss to `gameItems`.
 * 4. If all Neanderthal bosses have been defeated, `activateFinalBoss` (currently commented out)
 *    would activate the Final Boss and display its health bar.
 * The `gameLoop` only updates and renders the current Neanderthal boss or the Final Boss
 * if active, and global health bars dynamically adjust based on progression.
 */

let plumberHealthBar;
let angelHealthBar;
let bossHealthBar; // Reference to the active Neanderthal boss's health bar.
let finalBossHealthBar;

let globalPlumberHealthBar;
let globalAngelHealthBar;
let globalBossHealthBar; // Reference to the active Neanderthal boss's global health bar.
let globalFinalBossHealthBar;

// =============================================================================
// MAIN GAME LOOP
// =============================================================================

let gameItems;

let lastTime = performance.now();
let plumberInactiveTimer = 0;
let isGameOver = false;
let battleMusicStarted = false; // Indicador para el inicio de la música de batalla
let isGameRunning = true;
let victorySelection = 'yes'; // 'yes' or 'no'

/**
 * Main game loop. Executes on each frame to update and render the game state.
 * @param {DOMHighResTimeStamp} now - Timestamp provided by `requestAnimationFrame`.
 */
function gameLoop(now) {
    const deltaTime = (now - lastTime) / 1000;
    lastTime = now;
    ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

    if (!plumber || !angel) {
        requestAnimationFrame(gameLoop);
        return;
    }

    switch (gameState) {
        case 'WELCOME':
            // Updates and renders the welcome screen.
            welcomeScreen.update(deltaTime);
            welcomeScreen.render(ctx);
            break;

        case 'PLAYING':
            // Determines the active boss for update and rendering.
            let activeBoss = null;
            if (currentBossIndex < bosses.length) {
                activeBoss = bosses[currentBossIndex];
            } else if (finalBoss.state.isActive) {
                activeBoss = finalBoss;
            }

            // Updates all game elements, including the active boss if it exists.
            gameItems.forEach(item => {
                if (typeof item.update === 'function') item.update(deltaTime);
            });
            background.update(deltaTime); // Updates the background for animations.

            plumber.update(deltaTime, angel);
            angel.update(deltaTime, plumber, plumber.state.playerFiredSignal);

            if (plumber.state.playerFiredSignal) {
                plumber.state.playerFiredSignal = false;
            }
            // Reset Angel's playerFiredSignal after Plumber's AI has processed it
            if (angel.state.playerFiredSignal) {
                angel.state.playerFiredSignal = false;
            }

            // Character switching logic
            if (plumber.state.isPlayerControlled && plumber.state.isDead && !angel.state.isDead) {
                plumber.state.isPlayerControlled = false;
                angel.state.isPlayerControlled = true;
                camera.setTarget(angel);
            } else if (angel.state.isPlayerControlled && angel.state.isDead && !plumber.state.isDead) {
                angel.state.isPlayerControlled = false;
                plumber.state.isPlayerControlled = true;
                camera.setTarget(plumber);
            }

            // --- FINAL BOSS PROGRESSION BARRIER ---
            // This barrier activates only if not all Neanderthal bosses have been defeated,
            // preventing players from advancing beyond a specific point until the condition is met.
            if (currentBossIndex < bosses.length) {
                const barrierX = FINAL_BOSS_BACKGROUND_START_X;

                // Restricts Plumber's movement if attempting to cross the barrier to the right.
                if (plumber.state.x + plumber.state.width > barrierX && plumber.state.vx > 0) {
                    plumber.state.x = barrierX; // Adjusts Plumber's position to the barrier edge.
                    plumber.state.vx = 0; // Stops Plumber's horizontal movement.
                }

                // Restricts Angel's movement if attempting to cross the barrier to the right.
                if (angel.state.x + angel.state.width > barrierX && angel.state.vx > 0) {
                    angel.state.x = barrierX; // Adjusts Angel's position to the barrier edge.
                    angel.state.vx = 0; // Stops Angel's horizontal movement.
                }
            }

            if (plumber.state.vx === 0) plumberInactiveTimer += deltaTime;
            else plumberInactiveTimer = 0;

            // Updates the state of the active boss (Neanderthal or Final Boss).
            if (activeBoss) {
                activeBoss.update(deltaTime, plumber, angel);
            }

            // Updates and manages collision detection for projectiles.
            projectiles.forEach(p => p.update(deltaTime, plumber, angel, activeBoss, finalBoss));
            torches.forEach(t => t.update(deltaTime, plumber, angel));
            finalBossProjectiles.forEach(p => p.update(deltaTime, plumber, angel));

            // Updates the camera position to follow the player. // Test comment
            camera.update();

            if (finalBoss.state.isDead && gameState === 'PLAYING') {
                gameState = 'VICTORY';
                audioManager.stopMusic();
                audioManager.playMusic('outro');
                stopGameTimer();
                addBossDamage(finalBoss.state.maxHealth);
            }

            if (plumber.state.isDead && angel.state.isDead && gameState === 'PLAYING') {
                gameState = 'GAME_OVER';
                audioManager.stopMusic();
                audioManager.playSound('game-over');
                stopGameTimer();
            }

            // Renders all game elements in the canvas context.
            gameItems.forEach(item => item.render(ctx));
            if (activeBoss) {
                activeBoss.render(ctx);
            }
            projectiles.forEach(p => p.render(ctx));
            torches.forEach(t => t.render(ctx));
            finalBossProjectiles.forEach(p => p.render(ctx));

            // --- Dificultad: dibujar icono ---
            if (gameState === 'PLAYING') {
                if (!window._difficultyIconCache) window._difficultyIconCache = {};
                let iconSrc = window.getDifficultyIconSrc ? window.getDifficultyIconSrc(gameDifficulty) : '';
                if (iconSrc) {
                    let img = window._difficultyIconCache[iconSrc];
                    if (!img) {
                        img = new window.Image();
                        img.src = iconSrc;
                        window._difficultyIconCache[iconSrc] = img;
                    }
                    // Si la imagen ya está cargada, dibujarla directamente
                    if (img.complete && img.naturalWidth > 0) {
                        let drawHeight = 15;
                        if (gameDifficulty === 'normal') drawHeight = 8;
                        let scale = drawHeight / img.naturalHeight;
                        let drawWidth = img.naturalWidth * scale;
                        let x = CANVAS_WIDTH / 2 - drawWidth / 2 + 5;
                        let y = CANVAS_HEIGHT - 25;

                        // Draw background and border
                        const padding = 4;
                        ctx.fillStyle = 'white';
                        ctx.strokeStyle = 'black';
                        ctx.lineWidth = 1;
                        ctx.fillRect(x - padding, y - padding, drawWidth + padding * 2, drawHeight + padding * 2);
                        ctx.strokeRect(x - padding, y - padding, drawWidth + padding * 2, drawHeight + padding * 2);

                        ctx.drawImage(img, x, y, drawWidth, drawHeight);
                    }
                }
            }

            // Removes projectiles and torches marked for removal.
            projectiles = projectiles.filter(p => !p.state.shouldBeRemoved);
            torches = torches.filter(t => !t.state.shouldBeRemoved);
            finalBossProjectiles = finalBossProjectiles.filter(p => !p.state.shouldBeRemoved);
            // Dibuja HUD sobre el canvas
            drawCanvasHUD(ctx);
            break;

        case 'VICTORY':
            // Renders game elements and overlays a victory screen.
            gameItems.forEach(item => item.render(ctx));
            ctx.fillStyle = 'rgba(0, 0, 0, 0.7)';
            ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            ctx.fillStyle = 'white';
            ctx.textAlign = 'center';

            ctx.font = '22px Arial';
            ctx.fillText('VICTORY!', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 - 100);
            ctx.font = '16px Arial';
            ctx.fillText('Thank you for playing!', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 - 70);
            ctx.fillText('Visit MotaZorrilla.com ', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 - 50);
            ctx.fillText('and view my portfolio.', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 - 30);

            ctx.font = '16px Arial';
            ctx.fillText('Do you want to save your score?', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 20);

            // Draw selection options
            ctx.font = '16px Arial';
            ctx.fillStyle = victorySelection === 'yes' ? 'yellow' : 'white';
            ctx.fillText('Yes', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 50);

            ctx.fillStyle = victorySelection === 'no' ? 'yellow' : 'white';
            ctx.fillText('No', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 70);
            break;

        case 'GAME_OVER':
            if (isGameRunning) { // Evita que el modal se muestre en cada frame
                isGameRunning = false; // Detiene el bucle del juego
            }
            // Renders game elements and overlays a Game Over screen.
            gameItems.forEach(item => item.render(ctx));
            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
            ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            ctx.fillStyle = 'red';
            ctx.textAlign = 'center';
            ctx.font = '24px Arial bold';
            ctx.fillText('GAME OVER', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);
            ctx.fillStyle = 'white';
            ctx.font = '16px Arial';
            ctx.fillText('Press Start to restart', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 72);
            break;

        case 'PAUSED':
            // Renders game elements and overlays a Paused screen.
            gameItems.forEach(item => item.render(ctx));
            projectiles.forEach(p => p.render(ctx));
            torches.forEach(t => t.render(ctx));
            finalBossProjectiles.forEach(p => p.render(ctx));
            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
            ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            ctx.fillStyle = 'white';
            ctx.textAlign = 'center';
            ctx.font = '24px Arial';
            ctx.fillText('PAUSED', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);
            break;
    }

    if (isGameRunning) {
        requestAnimationFrame(gameLoop);
    }
};

// =============================================================================
// INPUT EVENT MANAGEMENT FOR GAME STATE CHANGES
// =============================================================================

document.addEventListener('keydown', async (event) => {
    await audioManager.resumeAudioContext();
    const key = event.key.toLowerCase();

    // Input handling in the WELCOME state.
    if (gameState === 'WELCOME') {
        if (key === 'arrowup') {
            welcomeScreen.moveSelectionUp();
            audioManager.playSound('select-player');
        } else if (key === 'arrowdown') {
            welcomeScreen.moveSelectionDown();
            audioManager.playSound('select-player');
        } else if (key === 'enter' || key === 'f' || key === 'control') {
            await audioManager.resumeAudioContext(); // Resume audio context on user gesture
            audioManager.playSound('item-get');
            const selectedCharacter = welcomeScreen.getSelection();
            // configureGame(selectedCharacter, window.selectedDifficulty || 'normal'); // Removed this line
            audioManager.playMusic('music'); // Iniciar música solo al pasar a PLAYING
            gameState = 'PLAYING';
            isGameRunning = true; // Asegura que el bucle se reanude
        }
    } else if (key === 'v' && gameState === 'PLAYING') { // Shortcut for testing victory
        gameState = 'VICTORY';
        audioManager.stopMusic();
        audioManager.playMusic('outro');
    }
    // Input handling in the VICTORY or GAME_OVER states to restart the game.
    else if (gameState === 'VICTORY') {
        if (key === 'arrowup' || key === 'arrowdown') {
            victorySelection = victorySelection === 'yes' ? 'no' : 'yes';
            audioManager.playSound('select-player');
        } else if (key === 'enter' || key === 'f') {
            if (victorySelection === 'yes') {
                const finalScore = calculateFinalScore();
                document.getElementById('finalScore').innerText = finalScore;
                document.getElementById('finalTime').innerText = formatTime(getTotalTimeSeconds());
                document.getElementById('finalDifficulty').innerText = gameDifficulty;
                new bootstrap.Modal(document.getElementById('gameOverModal')).show();
                isGameRunning = false;
            } else {
                location.reload();
            }
        }
    } else if (gameState === 'GAME_OVER') {
        if (event.key.toLowerCase() === 'enter' || event.key.toLowerCase() === 'f') {
            location.reload(); // Reloads the page to restart the game.
        }
    // Input handling to pause/resume the game in the PLAYING state.
    } else if (gameState === 'PLAYING' && key === 'enter') {
        audioManager.pauseMusic();
        gameState = 'PAUSED';
    } else if (gameState === 'PAUSED' && key === 'enter') {
        lastTime = performance.now(); // Restores time to avoid deltaTime jumps.
        audioManager.resumeMusic();
        gameState = 'PLAYING';
    }
});

function formatTime(seconds) {
    const min = String(Math.floor(seconds / 60)).padStart(2, '0');
    const sec = String(seconds % 60).padStart(2, '0');
    return `${min}:${sec}`;
}

let gameDifficulty = window.selectedDifficulty || 'normal'; // easy, normal, hard

let score = 0;
let totalBossDamage = 0;
let gameStartTime = null;
let gameEndTime = null;
let timeLeft = 600; // segundos
let timerInterval = null;

function updateScore(points) {
    score += points;
    const scoreElem = document.getElementById('score');
    if (scoreElem) {
        scoreElem.innerText = `Score: ${score}`;
    }
}

function addBossDamage(damage) {
    totalBossDamage += damage;
}

function getTotalTimeSeconds() {
    if (gameStartTime && gameEndTime) {
        return Math.min(600, Math.round((gameEndTime - gameStartTime) / 1000));
    }
    return 600;
}
window.getTotalTimeSeconds = getTotalTimeSeconds;

function calculateFinalScore() {
    // score = (daño total a jefes) × (vida restante total) × (600 / segundos_totales)
    const plumberLife = plumber?.state?.health || 0;
    const angelLife = angel?.state?.health || 0;
    const totalLife = plumberLife + angelLife;
    const seconds = getTotalTimeSeconds();
    if (totalBossDamage === 0 || totalLife === 0) return 0;
    return Math.round(totalBossDamage * totalLife * (600 / seconds));
}

function startGameTimer() {
    gameStartTime = Date.now();
    timeLeft = 600;
    if (timerInterval) clearInterval(timerInterval);
    timerInterval = setInterval(() => {
        const elapsed = Math.floor((Date.now() - gameStartTime) / 1000);
        timeLeft = Math.max(0, 600 - elapsed);
        // Actualizar el HUD directamente en el canvas
        ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        ctx.fillStyle = '#FFD700';
        ctx.font = 'bold 18px monospace';
        ctx.textAlign = 'left';
        // Time (izquierda)
        const min = String(Math.floor(timeLeft / 60)).padStart(2, '0');
        const sec = String(timeLeft % 60).padStart(2, '0');
        const timeStr = `TIME: ${min}:${sec}`;
        ctx.fillText(timeStr, 16, CANVAS_HEIGHT - 16);
        // Score (derecha)
        ctx.textAlign = 'right';
        const scoreStr = `SCORE: ${score}`;
        ctx.fillText(scoreStr, CANVAS_WIDTH - 16, CANVAS_HEIGHT - 16);
        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            // Forzar game over si se acaba el tiempo
            if (gameState === 'PLAYING') {
                gameState = 'GAME_OVER';
                isGameRunning = false;
            }
        }
    }, 1000);
}

function stopGameTimer() {
    gameEndTime = Date.now();
    if (timerInterval) clearInterval(timerInterval);
}

// Eliminar el HUD flotante y la llamada a updateHUD
// (Ya no se usa el div ni la función updateHUD)

/**
 * Configures the initial game state based on character selection.
 * Initializes characters, bosses, health bars, and assigns cameras and audio managers.
 * @param {string} selectedCharacterId - Identifier of the selected character ('plumber' or 'angel').
 * @param {string} difficulty - The selected difficulty level ('easy', 'normal', 'hard').
 */

function configureGame(selectedCharacterId, difficulty = 'normal') {
    bosses = [];
    currentBossIndex = 0;
    gameDifficulty = difficulty;
    score = 0;
    totalBossDamage = 0;
    updateScore(0);
    plumber = new Plumber(TILE_SIZE * 5, TILE_SIZE * 1, createProjectile, audioManager);
    angel = new Angel(TILE_SIZE, TILE_SIZE * 1, createProjectile, audioManager);
    gameStartTime = null;
    gameEndTime = null;
    startGameTimer();

    // --- Ajuste de vida y daño según dificultad ---
    // Vida y daño según dificultad:
    // Neanderthal: fácil 100, normal 200, difícil 500
    // Kraken: fácil 200, normal 1000, difícil 2000
    // Plumber/Angel: fácil 200, normal 100, difícil 100
    let bossLife = 100, bossMaxLife = 100, bossDamage = 10;
    let finalBossLife = 200, finalBossMaxLife = 200, finalBossDamage = 20;
    let plumberLife = 100, angelLife = 100;
    let enemyDamage = 10;

    if (gameDifficulty === 'easy') {
        plumberLife = 200;
        angelLife = 200;
        bossLife = bossMaxLife = 100; // Neanderthal
        finalBossLife = finalBossMaxLife = 200; // Kraken
        enemyDamage = 5; // Menos de la mitad
        finalBossDamage = 10;
    } else if (gameDifficulty === 'normal') {
        plumberLife = 100;
        angelLife = 100;
        bossLife = bossMaxLife = 200; // Neanderthal
        finalBossLife = finalBossMaxLife = 1000; // Kraken
        enemyDamage = 10;
        finalBossDamage = 20;
    } else if (gameDifficulty === 'hard') {
        plumberLife = 100;
        angelLife = 100;
        bossLife = bossMaxLife = 500; // Neanderthal
        finalBossLife = finalBossMaxLife = 2000; // Kraken
        enemyDamage = 20; // Doble
        finalBossDamage = 40;
    }

    // Asignar vida a los personajes
    plumber.state.health = plumber.state.maxHealth = plumberLife;
    angel.state.health = angel.state.maxHealth = angelLife;

    // Inicializar jefes con la vida y daño correctos
    bosses.push(new Boss(TILE_SIZE * 12, TILE_SIZE * 9, createTorch, audioManager, () => handleNeanderthalBossDeath(), bossLife, bossMaxLife, updateScore));
    bosses.push(new Boss(TILE_SIZE * 20, TILE_SIZE * 9, createTorch, audioManager, () => handleNeanderthalBossDeath(), bossLife, bossMaxLife, updateScore));
    bosses.push(new Boss(TILE_SIZE * 39, TILE_SIZE * 6, createTorch, audioManager, () => handleNeanderthalBossDeath(), bossLife, bossMaxLife, updateScore));

    // Final Boss
    finalBoss = new FinalBoss(TILE_SIZE * 60 - 29, TILE_SIZE * 8, createProjectile, createTorch, createFinalBossProjectile, audioManager, gameDifficulty, finalBossLife, finalBossMaxLife, finalBossDamage, updateScore);
    finalBoss.state.isActive = false;

    // Control principal
    if (selectedCharacterId === 'plumber') {
        plumber.state.isPlayerControlled = true;
        angel.state.isPlayerControlled = false;
        camera.setTarget(plumber);
    } else if (selectedCharacterId === 'angel') {
        plumber.state.isPlayerControlled = false;
        angel.state.isPlayerControlled = true;
        camera.setTarget(angel);
    }

    let currentBoss = bosses[currentBossIndex];

    plumberHealthBar = new HealthBar(plumber);
    angelHealthBar = new HealthBar(angel);
    bossHealthBar = new HealthBar(currentBoss);
    finalBossHealthBar = new HealthBar(finalBoss);

    globalPlumberHealthBar = new GlobalHealthBar(plumber, 'Plumber', 5, 15);
    globalAngelHealthBar = new GlobalHealthBar(angel, 'Angel', 88, 15);
    globalBossHealthBar = new GlobalHealthBar(currentBoss, 'Neanderthal', 171, 15);
    globalFinalBossHealthBar = new GlobalHealthBar(finalBoss, 'Kraken', 171, 15);
    globalFinalBossHealthBar.visible = false;

    plumber.setHealthBar(plumberHealthBar);
    angel.setHealthBar(angelHealthBar);
    currentBoss.setHealthBar(bossHealthBar);
    finalBoss.setHealthBar(finalBossHealthBar);

    // Forzar actualización de la barra de vida del Neanderthal
    bossHealthBar.setTarget(currentBoss);
    globalBossHealthBar.setTarget(currentBoss);

    plumberHealthBar.setCamera(camera);
    angelHealthBar.setCamera(camera);
    bossHealthBar.setCamera(camera);
    finalBossHealthBar.setCamera(camera);

    plumber.setCamera(camera);
    angel.setCamera(camera);
    currentBoss.setCamera(camera);
    finalBoss.setCamera(camera);
    ground.setCamera(camera);
    background.setCamera(camera);

    currentBoss.setAudioManager(audioManager);
    finalBoss.setAudioManager(audioManager);

    gameItems = [
        background, ground, plumber, angel,
        plumberHealthBar, angelHealthBar, bossHealthBar, finalBossHealthBar,
        globalPlumberHealthBar, globalAngelHealthBar, globalBossHealthBar, globalFinalBossHealthBar,
    ];

    // Al cambiar dificultad, volver a la pantalla de bienvenida
    gameState = 'WELCOME';
    window.selectedDifficulty = gameDifficulty;
    // Detener la música al volver a la pantalla de bienvenida
    audioManager.stopMusic();
}
window.configureGame = configureGame;

/**
 * Handles the logic for a Neanderthal boss's defeat.
 * Advances to the next boss in the sequence or prepares for Final Boss activation.
 */
function handleNeanderthalBossDeath() {
    // Suponiendo que cada jefe tiene una propiedad maxHealth
    if (bosses[currentBossIndex]) {
        addBossDamage(bosses[currentBossIndex].maxHealth || 0);
    }
    updateScore(1000);
    currentBossIndex++;
    if (currentBossIndex < bosses.length) {
        let nextBoss = bosses[currentBossIndex];
        bossHealthBar.setTarget(nextBoss);
        globalBossHealthBar.setTarget(nextBoss);
        nextBoss.setCamera(camera);
        nextBoss.setAudioManager(audioManager);
    } else {
        // All Neanderthal bosses are defeated, activate the Final Boss.
        globalBossHealthBar.visible = false;
        globalFinalBossHealthBar.visible = true;
        finalBoss.state.isActive = true;
    }
}

// Añadir función para dibujar Time y Score en el canvas
function drawCanvasHUD(ctx) {
    const min = String(Math.floor(timeLeft / 60)).padStart(2, '0');
    const sec = String(timeLeft % 60).padStart(2, '0');
    const timeStr = `TIME: ${min}:${sec}`;
    const scoreStr = `SCORE: ${score}`;
    ctx.save();
    ctx.font = 'bold 12px monospace';
    ctx.fillStyle = '#39ff14'; // Verde chillón
    ctx.strokeStyle = '#003366'; // Azul oscuro
    ctx.lineWidth = 4;
    ctx.textAlign = 'left';
    ctx.strokeText(timeStr, 16, CANVAS_HEIGHT - 14);
    ctx.fillText(timeStr, 16, CANVAS_HEIGHT - 14);
    ctx.textAlign = 'right';
    ctx.strokeText(scoreStr, CANVAS_WIDTH - 16, CANVAS_HEIGHT - 14);
    ctx.fillText(scoreStr, CANVAS_WIDTH - 16, CANVAS_HEIGHT - 14);
    ctx.restore();
}

// Agregar función initializeGame si no existe
async function initializeGame() {
    ctx.fillStyle = 'black';
    ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
    ctx.fillStyle = 'white';
    ctx.textAlign = 'center';
    ctx.font = '16px Arial';
    ctx.fillText('Loading assets, please wait...', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);

    // Loads sounds and handles potential errors.
    await audioManager.loadSounds(soundList)
        .then(() => { /* Éxito en la carga de sonidos */ })
        .catch(error => { console.error('Error loading sounds:', error); });

    // Initialize game with default character and difficulty
    configureGame('plumber', 'normal');

    const muteButton = document.getElementById('buttonMuted');
    if (muteButton) {
        const muteIcon = muteButton.querySelector('img');
        muteButton.addEventListener('click', async () => {
            await audioManager.resumeAudioContext();
            audioManager.toggleMute();
            const muteState = audioManager.muteState;
            switch (muteState) {
                case 0: // All sounds on
                    muteIcon.src = "assets/images/muted.png";
                    break;
                case 1: // Music only muted
                    // Icon does not change
                    break;
                case 2: // All muted
                    muteIcon.src = "assets/images/music-note.png";
                    break;
            }
        });
    }
    // Starts the main game loop.
    requestAnimationFrame(gameLoop);
}

// Starts game execution.
initializeGame();
