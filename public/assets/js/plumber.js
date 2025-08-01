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
    'battle': './assets/audio/Battle.mp3' // Añadido para la batalla final
};

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
const onScreenControls = new OnScreenControls();

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

/**
 * Main game loop. Executes on each frame to update and render the game state.
 * @param {DOMHighResTimeStamp} now - Timestamp provided by `requestAnimationFrame`.
 */
function gameLoop(now) {
    const deltaTime = (now - lastTime) / 1000;
    lastTime = now;
    ctx.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

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

            // Updates the camera position to follow the player.
            camera.update();

            // Renders all game elements in the canvas context.
            gameItems.forEach(item => item.render(ctx));
            if (activeBoss) {
                activeBoss.render(ctx);
            }
            projectiles.forEach(p => p.render(ctx));
            torches.forEach(t => t.render(ctx));
            finalBossProjectiles.forEach(p => p.render(ctx));

            // Removes projectiles and torches marked for removal.
            projectiles = projectiles.filter(p => !p.state.shouldBeRemoved);
            torches = torches.filter(t => !t.state.shouldBeRemoved);
            finalBossProjectiles = finalBossProjectiles.filter(p => !p.state.shouldBeRemoved);
            gameItems = gameItems.filter(item => !item.state || !item.state.shouldBeRemoved);

            // Resets player fire signals at the end of the frame for the next cycle.
            plumber.state.playerFiredSignal = false;
            angel.state.playerFiredSignal = false;

            // Logic for global health bar visibility based on game progression and camera position.
            globalBossHealthBar.visible = currentBossIndex < bosses.length && !bosses[currentBossIndex].state.isDead;
            if (camera.x >= FINAL_BOSS_BACKGROUND_START_X && !battleMusicStarted) {
                audioManager.stopMusic();
                audioManager.playMusic('battle');
                battleMusicStarted = true;
            }

            if (camera.x >= MAP_WIDTH * 2 / 3) {
                globalFinalBossHealthBar.visible = true;
                globalBossHealthBar.visible = false;
            } else {
                globalFinalBossHealthBar.visible = false;
                globalBossHealthBar.visible = true;
            }

            // Transition to victory state if the Final Boss has been removed.
            if (finalBoss.state.shouldBeRemoved) {
                audioManager.stopMusic();
                audioManager.playMusic('outro'); // Plays outro music in a loop.
                gameState = 'VICTORY';
            }

            // Determines the character currently controlled by the player.
            let currentPlayer = null;
            if (plumber.state.isPlayerControlled) {
                currentPlayer = plumber;
            } else if (angel.state.isPlayerControlled) {
                currentPlayer = angel;
            }

            // Logic for handling the death of the player-controlled character.
            if (currentPlayer && currentPlayer.state.isDead) {
                // Attempts to switch control to the other character if alive.
                if (plumber.state.isPlayerControlled && !angel.state.isDead) {
                    plumber.state.isPlayerControlled = false;
                    angel.state.isPlayerControlled = true;
                    camera.setTarget(angel); // Camera follows Angel.
                } else if (angel.state.isPlayerControlled && !plumber.state.isDead) {
                    angel.state.isPlayerControlled = false;
                    plumber.state.isPlayerControlled = true;
                    camera.setTarget(plumber); // Camera follows Plumber.
                } else {
                    // Both characters are dead, or the only remaining character died.
                    if (!isGameOver) {
                        audioManager.stopMusic();
                        audioManager.playSound('game-over');
                        gameState = 'GAME_OVER';
                        isGameOver = true;
                    }
                }
            }
            break;

        case 'VICTORY':
            // Renders game elements and overlays a victory screen.
            gameItems.forEach(item => item.render(ctx));
            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
            ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            ctx.fillStyle = 'white';
            ctx.textAlign = 'center';
            ctx.font = '24px Arial';
            ctx.fillText('VICTORY!', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 - 60);
            ctx.font = '14px Arial';
            ctx.fillText('Thank you for playing this game!', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);
            ctx.fillText('Visit MotaZorrilla.com for more games', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 18);
            ctx.fillText('and view my portfolio.', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 36);
            ctx.font = '16px Arial';
            ctx.fillText('Press A to restart', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 72);
            break;

        case 'GAME_OVER':
            // Renders game elements and overlays a Game Over screen.
            gameItems.forEach(item => item.render(ctx));
            ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
            ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            ctx.fillStyle = 'red';
            ctx.textAlign = 'center';
            ctx.font = '24px Arial bold';
            ctx.fillText('GAME OVER', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);
            ctx.font = '16px Arial';
            ctx.fillText('Press A to restart', CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2 + 72);
            break;
    }

    requestAnimationFrame(gameLoop);
};

// =============================================================================
// INPUT EVENT MANAGEMENT FOR GAME STATE CHANGES
// =============================================================================

document.addEventListener('keydown', (event) => {
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
            audioManager.playSound('item-get');
            const selectedCharacter = welcomeScreen.getSelection();
            configureGame(selectedCharacter);
            audioManager.playMusic('music');
            gameState = 'PLAYING';
        }
    // Input handling in the VICTORY or GAME_OVER states to restart the game.
    } else if (gameState === 'VICTORY' || gameState === 'GAME_OVER') {
        if (event.key.toLowerCase() === 'enter' || event.key.toLowerCase() === 'f') {
            location.reload(); // Reloads the page to restart the game.
        }
    // Input handling to pause/resume the game in the PLAYING state.
    } else if (gameState === 'PLAYING' && key === 'enter') {
        gameState = 'PAUSED';
    } else if (gameState === 'PAUSED' && key === 'enter') {
        lastTime = performance.now(); // Restores time to avoid deltaTime jumps.
        gameState = 'PLAYING';
    }
});

/**
 * Configures the initial game state based on character selection.
 * Initializes characters, bosses, health bars, and assigns cameras and audio managers.
 * @param {string} selectedCharacterId - Identifier of the selected character ('plumber' or 'angel').
 */
function configureGame(selectedCharacterId) {
    plumber = new Plumber(TILE_SIZE * 5, TILE_SIZE * 1, createProjectile, audioManager);
    angel = new Angel(TILE_SIZE, TILE_SIZE * 1, createProjectile, audioManager);

    // Assigns main control to the character selected by the player.
    if (selectedCharacterId === 'plumber') {
        plumber.state.isPlayerControlled = true;
        angel.state.isPlayerControlled = false;
        camera.setTarget(plumber); // Camera follows Plumber.
    } else if (selectedCharacterId === 'angel') {
        plumber.state.isPlayerControlled = false;
        angel.state.isPlayerControlled = true;
        camera.setTarget(angel); // Camera follows Angel.
    }
    // Initializes multiple instances of the Neanderthal Boss at predefined positions.
    bosses.push(new Boss(TILE_SIZE * 12, TILE_SIZE * 9, createTorch, audioManager, () => handleNeanderthalBossDeath())); // First instance.
    bosses.push(new Boss(TILE_SIZE * 20, TILE_SIZE * 9, createTorch, audioManager, () => handleNeanderthalBossDeath())); // Second instance.
    bosses.push(new Boss(TILE_SIZE * 39, TILE_SIZE * 6, createTorch, audioManager, () => handleNeanderthalBossDeath())); // Third instance.

    // Initializes the Final Boss and activates it from the start of the game.
    finalBoss = new FinalBoss(TILE_SIZE * 60 - 29, TILE_SIZE * 8, createProjectile, createTorch, createFinalBossProjectile, audioManager);
    finalBoss.state.isActive = true; // Activates the final boss for internal processing.

    // Sets the current boss as the first instance of the Neanderthal bosses.
    let currentBoss = bosses[currentBossIndex];

    // Initializes individual health bars for characters and bosses.
    plumberHealthBar = new HealthBar(plumber);
    angelHealthBar = new HealthBar(angel);
    bossHealthBar = new HealthBar(currentBoss); // Associates the health bar with the current Neanderthal boss.
    finalBossHealthBar = new HealthBar(finalBoss);

    // Initializes global health bars to display health status in the UI.
    globalPlumberHealthBar = new GlobalHealthBar(plumber, 'Plumber', 5, 15);
    globalAngelHealthBar = new GlobalHealthBar(angel, 'Angel', 88, 15);
    globalBossHealthBar = new GlobalHealthBar(currentBoss, 'Boss', 171, 15); // Associates the global health bar with the current Neanderthal boss.
    globalFinalBossHealthBar = new GlobalHealthBar(finalBoss, 'Kraken', 171, 15);
    globalFinalBossHealthBar.visible = false; // Initially hides the Final Boss health bar.

    // Assigns health bars to their respective entities.
    plumber.setHealthBar(plumberHealthBar);
    angel.setHealthBar(angelHealthBar);
    currentBoss.setHealthBar(bossHealthBar); // Assigns the health bar to the current Neanderthal boss.
    finalBoss.setHealthBar(finalBossHealthBar);

    // Configures the camera to follow health bars.
    plumberHealthBar.setCamera(camera);
    angelHealthBar.setCamera(camera);
    bossHealthBar.setCamera(camera);
    finalBossHealthBar.setCamera(camera);

    // Configura la cámara para los objetos del juego que requieren seguimiento.
    plumber.setCamera(camera);
    angel.setCamera(camera);
    currentBoss.setCamera(camera); // Assigns the camera to the current Neanderthal boss.
    finalBoss.setCamera(camera);
    ground.setCamera(camera);
    background.setCamera(camera); // Assigns the camera to the background.

    // Assigns the audio manager to game objects that play sounds.
    plumber.setAudioManager(audioManager);
    angel.setAudioManager(audioManager);
    currentBoss.setAudioManager(audioManager); // Assigns the audioManager to the current Neanderthal boss.
    finalBoss.setAudioManager(audioManager);

    // Initializes the `gameItems` array with all objects that need to be updated and rendered in the main loop.
    gameItems = [
        background, ground, plumber, angel,
        plumberHealthBar, angelHealthBar, bossHealthBar, finalBossHealthBar,
        globalPlumberHealthBar, globalAngelHealthBar, globalBossHealthBar, globalFinalBossHealthBar,
    ];
}

/**
 * Handles the logic for a Neanderthal boss's defeat.
 * Advances to the next boss in the sequence or prepares for Final Boss activation.
 */
function handleNeanderthalBossDeath() {
    // Increments the index to activate the next Neanderthal boss.
    currentBossIndex++;

    // If there are still Neanderthal bosses remaining, initializes the next one.
    if (currentBossIndex < bosses.length) {
        let nextBoss = bosses[currentBossIndex];
        // Updates health bar references to point to the new active boss.
        bossHealthBar.setTarget(nextBoss);
        globalBossHealthBar.setTarget(nextBoss);
        nextBoss.setCamera(camera);
        nextBoss.setAudioManager(audioManager);
    } else {
        // All Neanderthal bosses have been defeated. Final boss activation
        // is managed in the gameLoop based on camera position.
        // activateFinalBoss(); // Commented: activation is handled by the camera in the gameLoop.
    }
}



/**
 * Initializes the game application.
 * Displays a loading screen, preloads audio resources,
 * and then starts the main game loop.
 */
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

    // Starts the main game loop.
    requestAnimationFrame(gameLoop);
}

// Starts game execution.
initializeGame();
