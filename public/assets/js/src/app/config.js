/**
 * @file config.js
 * @brief Global configuration file for the game.
 * Defines constants for dimensions, physics, entity behaviors,
 * and map structure, allowing centralized adjustment of game parameters.
 */

// =============================================================================
// RENDERING ENVIRONMENT CONFIGURATION (CANVAS)
// =============================================================================

export const CANVAS_WIDTH = 256;    // Canvas width in pixels.
export const CANVAS_HEIGHT = 224;   // Canvas height in pixels.
export const TILE_SIZE = 16;        // Dimension of an individual tile in pixels (square).

// =============================================================================
// GLOBAL PHYSICAL PARAMETERS
// =============================================================================

export const GRAVITY = 200;         // Gravity acceleration applied to entities in pixels/second^2.
export const GROUND_EPSILON = 1;    // Small value for ground collision detection, preventing floating point errors.

// =============================================================================
// ENTITY CONFIGURATION: PLUMBER (PLAYER 1)
// =============================================================================

export const PLUMBER_MAX_VELOCITY = 250;    // Maximum horizontal velocity of the Plumber in pixels/second.
export const PLUMBER_ACCELERATION = 100;    // Plumber's horizontal acceleration rate.
export const PLUMBER_FRICTION = 140;        // Deceleration (friction) rate applied to horizontal movement.
export const PLUMBER_JUMP_FORCE = 180;      // Initial vertical impulse applied when jumping.
export const PLUMBER_AUTO_JUMP_DISTANCE = 80; // Threshold distance to activate AI auto-jump.
export const PLUMBER_AUTO_JUMP_DELAY = 0.5;   // Cooldown in seconds for AI auto-jump.
export const PLUMBER_ATTACK_DELAY = 0.2;      // Delay in seconds for Plumber's attack after an Angel action.
export const PLUMBER_MAX_BURST_SHOTS = 5;   // Maximum shots before burst cooldown.
export const PLUMBER_BURST_COOLDOWN_DURATION = 2; // Duration of burst cooldown in seconds.

// =============================================================================
// ENTITY CONFIGURATION: ANGEL (PLAYER 2 / AI)
// =============================================================================

// --- Sprite Dimensions ---
export const ANGEL_WIDTH = 64;              // Angel sprite width in pixels.
export const ANGEL_HEIGHT = 64;             // Angel sprite height in pixels.

// --- Physical Parameters ---
export const ANGEL_MAX_VELOCITY = 250;      // Maximum horizontal velocity of the Angel.
export const ANGEL_ACCELERATION = 200;      // Angel's horizontal acceleration rate.
export const ANGEL_FRICTION = 100;          // Deceleration (friction) rate applied to horizontal movement.
export const ANGEL_JUMP_FORCE = 180;        // Initial vertical impulse for the first jump.
export const ANGEL_DOUBLE_JUMP_FORCE = 400; // Additional vertical impulse for double jump.
export const LEVITATION_DURATION = 0.2;     // Duration in seconds of levitation upon colliding with the ceiling.

// --- AI Behavior Parameters ---
export const ANGEL_ATTACK_DELAY = 0.2;      // Delay in seconds for Angel's attack after a Plumber action.
export const ANGEL_JUMP_DELAY = 0.5;        // Delay in seconds for Angel's jump after a Plumber action.
export const ANGEL_AUTO_JUMP_DISTANCE = 80; // Threshold distance to activate AI auto-jump.
export const ANGEL_AUTO_JUMP_DELAY = 0.5;   // Cooldown in seconds for AI auto-jump.
export const ANGEL_MAX_BURST_SHOTS = 5;   // Maximum shots before burst cooldown.
export const ANGEL_BURST_COOLDOWN_DURATION = 2; // Duration of burst cooldown in seconds.

// =============================================================================
// ENTITY CONFIGURATION: PROJECTILES
// =============================================================================

export const PROJECTILE_SPEED = 200;        // Movement speed of projectiles (fireballs, torches).
export const PROJECTILE_SIZE = 16;          // Reference size for projectiles in pixels.

// =============================================================================
// ANGEL ANIMATION CONFIGURATION (SPRITESHEET ROWS)
// =============================================================================
export const ANGEL_IDLE_ROW = 23; // Spritesheet row for idle animation.
export const ANGEL_RUN_ROW = 39;  // Spritesheet row for run animation.
export const ANGEL_JUMP_ROW = 27; // Spritesheet row for jump animation.
export const ANGEL_CROUCH_ROW = 31; // Spritesheet row for crouch animation.
export const ANGEL_ATTACK_ROW = 13; // Spritesheet row for attack animation.
export const ANGEL_SIT_ROW = 31;  // Spritesheet row for sit animation (can be the same as crouch).
export const ANGEL_DEATH_ROW = 20; // Spritesheet row for death animation (adjust according to actual spritesheet).

// =============================================================================
// LEVEL MAP DEFINITION
// =============================================================================

/**
 * Matrix representation of the game map.
 * Each element in the matrix represents a tile in the game world:
 * - `0`: Empty space, traversable by characters.
 * - `1`: Solid block, represents a collision or a platform.
 */
export const MAP = [
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,0,0,0,0,0,0,0],
    [0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
    [0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0],
    [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
    [1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]
];

// =============================================================================
// DERIVED MAP DIMENSIONS (DO NOT MANUALLY MODIFY)
// =============================================================================

/**
 * These constants are automatically calculated from the map definition
 * and should not be modified directly. They provide the game world dimensions
 * in tile and pixel units.
 */
export const MAP_WIDTH_TILES = MAP[0].length;   // Map width in number of tiles.
export const MAP_HEIGHT_TILES = MAP.length;     // Map height in number of tiles.
export const MAP_WIDTH = MAP_WIDTH_TILES * TILE_SIZE; // Total map width in pixels.
export const MAP_HEIGHT = MAP_HEIGHT_TILES * TILE_SIZE; // Total map height in pixels.
export const FINAL_BOSS_BACKGROUND_START_X = (MAP_WIDTH / 3) * 2; // X coordinate where the final boss area background starts (approximately two-thirds of the map width).

// =============================================================================
// ENTITY CONFIGURATION: FINAL BOSS
// =============================================================================

export const FINAL_BOSS_HORIZONTAL_SPEED = 0; // Horizontal patrol speed of the Final Boss.
export const FINAL_BOSS_PATROL_DISTANCE = 100; // Maximum patrol distance on each side of its initial point.