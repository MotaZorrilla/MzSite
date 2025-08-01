import animate from "../core/animate.js";
import { TILE_SIZE, MAP, GRAVITY, FINAL_BOSS_HORIZONTAL_SPEED, FINAL_BOSS_PATROL_DISTANCE } from "./config.js";
import { FINAL_BOSS_PROJECTILE_WIDTH, FINAL_BOSS_PROJECTILE_HEIGHT } from "./FinalBossProjectile.js";

// =============================================================================
// FINAL BOSS ANIMATION AND DIMENSION CONSTANTS
// =============================================================================

// Final Boss sprite dimensions.
export const FINAL_BOSS_WIDTH = 64;
export const FINAL_BOSS_HEIGHT = 64;
export const FINAL_BOSS_SPRITE_SPACING = 0; // Spacing between sprites in the spritesheet.

// X and Y starting coordinates in the spritesheet for each Final Boss animation.
export const FINAL_BOSS_IDLE_SPRITE_X = 16;
export const FINAL_BOSS_IDLE_SPRITE_Y = 970;
export const FINAL_BOSS_ATTACK_SPRITE_X = 16;
export const FINAL_BOSS_ATTACK_SPRITE_Y = 845;
export const FINAL_BOSS_HURT_SPRITE_X = 16;
export const FINAL_BOSS_HURT_SPRITE_Y = 1980; // "Hurt" animation row.
export const FINAL_BOSS_DEATH_SPRITE_X = 16;
export const FINAL_BOSS_DEATH_SPRITE_Y = 2667; // "Death" animation row.

/**
 * @class FinalBoss
 * @brief Represents the Final Boss entity in the game.
 * Manages its artificial intelligence, combat states, animations, attacks,
 * and full lifecycle, including defeat and disappearance.
 */
export default class FinalBoss {
    /**
     * Constructor for the FinalBoss class.
     * @param {number} x - Initial X position of the boss.
     * @param {number} y - Initial Y position of the boss.
     * @param {function} createProjectileCallback - Callback to create standard projectiles (fireballs).
     * @param {function} createTorchCallback - Callback to create torch-type projectiles.
     * @param {function} createFinalBossProjectileCallback - Callback to create boss-specific projectiles (acid).
     */
    constructor(x, y, createProjectileCallback, createTorchCallback, createFinalBossProjectileCallback) {
        this.createProjectileCallback = createProjectileCallback; // Callback for fireball projectile creation.
        this.createTorchCallback = createTorchCallback; // Callback for torch projectile creation.
        this.createFinalBossProjectileCallback = createFinalBossProjectileCallback; // Callback for acid projectile creation.
        this.audioManager = null; // Audio manager for sound effect playback.

        /**
         * @property {object} state - Object encapsulating the Final Boss's current state.
         * @property {number} state.x - Current X position.
         * @property {number} state.y - Current Y position.
         * @property {number} state.initialY - Initial Y position for floating.
         * @property {number} state.initialX - Initial X position for horizontal patrol.
         * @property {number} state.width - Boss's width.
         * @property {number} state.height - Boss's height.
         * @property {number} state.health - Current health of the boss.
         * @property {number} state.maxHealth - Maximum health of the boss.
         * @property {boolean} state.isAttacking - Indicates if the boss is performing an attack.
         * @property {boolean} state.isHurt - Indicates if the boss is in a "hurt" state.
         * @property {boolean} state.isDead - Indicates if the boss has been defeated.
         * @property {string} state.animation - Name of the current animation (e.g., 'idle', 'attack').
         * @property {number} state.currentFrame - Index of the current animation frame.
         * @property {number} state.frameTimer - Timer for controlling animation speed.
         * @property {number} state.attackCooldown - Time to wait between attacks.
         * @property {number} state.attackTimer - Timer for attack cooldown.
         * @property {number} state.hurtTimer - Timer for "hurt" state duration.
         * @property {boolean} state.shouldBeRemoved - Flag to indicate that the boss should be removed from the game.
         * @property {boolean} state.facingLeft - Indicates if the boss is facing left.
         * @property {number} state.torchesFiredInAttack - Counter for torches fired in the current attack sequence.
         * @property {boolean} state.animationFinished - Flag to indicate if an animation (e.g., death) has finished.
         * @property {boolean} state.isActive - Indicates if the final boss is active and processing game logic.
         * @property {boolean} state.isActivatedAndReady - Indicates if the final boss has been activated and is ready to start its attacks.
         * @property {number} state.verticalSpeed - Vertical floating speed.
         * @property {number} state.verticalDirection - Vertical floating direction (1: down, -1: up).
         * @property {number} state.patrolDirection - Horizontal patrol direction (1: right, -1: left).
         * @property {number} state.baseFireballCooldown - Base cooldown for fireball attack.
         * @property {number} state.baseTorchCooldown - Base cooldown for torch attack.
         * @property {number} state.baseAcidCooldown - Base cooldown for acid projectile attack.
         * @property {number} state.baseFireballSpeed - Base speed of fireballs.
         * @property {number} state.baseTorchSpeed - Base speed of torches.
         * @property {number} state.baseAcidSpeed - Base speed of acid projectiles.
         * @property {number} state.fireballAttackTimer - Timer for fireball attack.
         * @property {number} state.torchAttackTimer - Timer for torch attack.
         * @property {number} state.acidAttackTimer - Timer for acid projectile attack.
         * @property {boolean} state.rafagaSoundPlayed - Flag to control the playback of the burst sound.
         * @property {number} state.vy - Current vertical velocity of the boss (used in death fall).
         * @property {boolean} state.isOnGround - Indicates if the boss is on the ground (used in death fall).
         */
        this.state = {
            x: x,
            y: y,
            initialY: y, // Store the initial Y position
            initialX: x, // Stores the initial X position
            width: FINAL_BOSS_WIDTH,
            height: FINAL_BOSS_HEIGHT,
            health: 1000,
            maxHealth: 1000,
            isAttacking: false,
            isHurt: false,
            isDead: false,
            animation: 'idle',
            currentFrame: 0,
            frameTimer: 0,
            attackCooldown: 3, // Attacks every 3 seconds.
            attackTimer: 0,    // Internal timer to control attack cooldown.
            hurtTimer: 0,      // Timer for "hurt" animation duration.
            shouldBeRemoved: false, // Indicates if the boss should be removed from the game.
            facingLeft: true,  // Direction the boss is facing.
            torchesFiredInAttack: 0, // Counter for torches fired in the current attack sequence.
            animationFinished: false, // Flag to control if an animation (e.g., death) has finished.
            isActive: false, // New: Indicates if the final boss is active in the game
            isActivatedAndReady: false, // New: Indicates if the final boss has been activated and is ready to attack
            verticalSpeed: 50, // Vertical floating speed
            verticalDirection: 1, // 1 for down, -1 for up
            patrolDirection: 1, // 1 for right, -1 for left
            baseFireballCooldown: 3.0,    // Base cooldown for fireballs
            baseTorchCooldown: 3.0,    // Base cooldown for torches
            baseAcidCooldown: 3.0,     // Base cooldown for acid projectiles
            baseFireballSpeed: 200,    // Base speed of fireballs
            baseTorchSpeed: 150,       // Base speed of torches
            baseAcidSpeed: 100,        // Base speed of acid projectiles
            fireballAttackTimer: 0,    // Timer for fireballs
            torchAttackTimer: 0,       // Timer for torches
            acidAttackTimer: 0,        // Timer for acid projectiles
            rafagaSoundPlayed: false,  // To control burst sound playback
            vy: 0, // Vertical velocity
            isOnGround: false, // Indicates if the boss is on the ground
        };

        /**
         * @property {object} animations - Defines the Final Boss's animation properties.
         * Each property is an object containing:
         * @property {number} frameDuration - Duration of each frame in seconds.
         * @property {Array<object>} frames - Array of objects, each describing a frame:
         * @property {number} frames[].x - X coordinate in the spritesheet.
         * @property {number} frames[].y - Y coordinate in the spritesheet.
         * @property {number} frames[].width - Frame width.
         * @property {number} frames[].height - Frame height.
         * @property {number} frames[].yOffset - Vertical offset for rendering.
         * @property {number} frames[].xOffset - Horizontal offset for rendering.
         */
        this.animations = {
            idle: {
                frameDuration: 0.1,
                frames: [
                    { x: FINAL_BOSS_IDLE_SPRITE_X,                              y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: 0 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + FINAL_BOSS_WIDTH + 13,      y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: 0 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 2 * FINAL_BOSS_WIDTH + 27,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 4, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -3 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 3 * FINAL_BOSS_WIDTH + 43 ,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 6, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -6 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 5 * FINAL_BOSS_WIDTH - 2 ,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 8, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -8 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 6 * FINAL_BOSS_WIDTH + 18,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 10, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -10 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 7 * FINAL_BOSS_WIDTH + 40 ,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 10, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -10 },
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 9 * FINAL_BOSS_WIDTH  ,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 11, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 11},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 10 * FINAL_BOSS_WIDTH +24 ,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 19, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 17},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 12 * FINAL_BOSS_WIDTH - 10,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 20, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 20},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 13 * FINAL_BOSS_WIDTH  +20,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 20, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 18},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 15 * FINAL_BOSS_WIDTH  -13,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 14, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 13},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 16 * FINAL_BOSS_WIDTH  +10,y: FINAL_BOSS_IDLE_SPRITE_Y - 9, width: FINAL_BOSS_WIDTH + 14, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 11},
                    { x: FINAL_BOSS_IDLE_SPRITE_X, y: FINAL_BOSS_IDLE_SPRITE_Y + 92, width: FINAL_BOSS_WIDTH + 14, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 12},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + FINAL_BOSS_WIDTH + 17, y: FINAL_BOSS_IDLE_SPRITE_Y + 92, width: FINAL_BOSS_WIDTH + 14, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: - 12},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + FINAL_BOSS_WIDTH + 25, y: FINAL_BOSS_IDLE_SPRITE_Y + 92, width: FINAL_BOSS_WIDTH + 14, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -4},
                    { x: FINAL_BOSS_IDLE_SPRITE_X + 3 * FINAL_BOSS_WIDTH - 25, y: FINAL_BOSS_IDLE_SPRITE_Y + 92, width: FINAL_BOSS_WIDTH + 14, height: FINAL_BOSS_HEIGHT + 12, yOffset: - 12, xOffset: -5},
                ],
            },
            attack: {
                frameDuration: 0.4,
                frames: [
                    { x: FINAL_BOSS_ATTACK_SPRITE_X, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT, yOffset: -11, xOffset: 1 },
                    { x: FINAL_BOSS_ATTACK_SPRITE_X + FINAL_BOSS_WIDTH + 10, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT, yOffset:-11, xOffset: 1 },
                    { x: FINAL_BOSS_ATTACK_SPRITE_X + 2 * FINAL_BOSS_WIDTH + 21, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT, yOffset: -11, xOffset: 0 },
                    { x: FINAL_BOSS_ATTACK_SPRITE_X + 3 * FINAL_BOSS_WIDTH + 33, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT + 4, yOffset: -11, xOffset: 0 },
                    { x: FINAL_BOSS_ATTACK_SPRITE_X + 4 * FINAL_BOSS_WIDTH + 46, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT + 10, yOffset: -11, xOffset: 0 },
                    { x: FINAL_BOSS_ATTACK_SPRITE_X + 6 * FINAL_BOSS_WIDTH - 4, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT + 10, yOffset: -11, xOffset: 0 },
                    { x: FINAL_BOSS_ATTACK_SPRITE_X + 7 * FINAL_BOSS_WIDTH + 10, y: FINAL_BOSS_ATTACK_SPRITE_Y, width: FINAL_BOSS_WIDTH, height: FINAL_BOSS_HEIGHT + 10, yOffset: -11, xOffset: 1 },
                ],
            },
            hurt: {
                frameDuration: 0.1, 
                frames: [
                    { x: FINAL_BOSS_HURT_SPRITE_X, y: FINAL_BOSS_HURT_SPRITE_Y, width: FINAL_BOSS_WIDTH , height: FINAL_BOSS_HEIGHT - 2, yOffset: + 2, xOffset: 0 },
                ],
            },
            death: {
                frameDuration: 0.8,
                frames: [
                    { x: FINAL_BOSS_DEATH_SPRITE_X, y: FINAL_BOSS_DEATH_SPRITE_Y, width: FINAL_BOSS_WIDTH + 32, height: FINAL_BOSS_HEIGHT , yOffset: 0, xOffset: 0 },
                    { x: FINAL_BOSS_DEATH_SPRITE_X + FINAL_BOSS_WIDTH + 38, y: FINAL_BOSS_DEATH_SPRITE_Y, width: FINAL_BOSS_WIDTH + 32, height: FINAL_BOSS_HEIGHT , yOffset: 0, xOffset: 0 },
                    { x: FINAL_BOSS_DEATH_SPRITE_X + 2*(FINAL_BOSS_WIDTH + 38), y: FINAL_BOSS_DEATH_SPRITE_Y, width: FINAL_BOSS_WIDTH + 32, height: FINAL_BOSS_HEIGHT , yOffset: 0, xOffset: 0 },
                    { x: FINAL_BOSS_DEATH_SPRITE_X + 3*(FINAL_BOSS_WIDTH + 38), y: FINAL_BOSS_DEATH_SPRITE_Y, width: FINAL_BOSS_WIDTH + 32, height: FINAL_BOSS_HEIGHT , yOffset: 0, xOffset: 0 },
                ],
            },
            disappear: {
                frameDuration: 0.15,
                frames: Array.from({ length: 19 }, (_, i) => ({
                    x: 20 + i * (48 + 4),
                    y: 1409,
                    width: 48,
                    height: 48,
                    yOffset: 16,
                    xOffset: 10,
                })),
            },
        };

        this.image = new Image();
        this.image.src = './assets/FinalBoss.png';

        this.isReady = false;
        this.image.onload = () => { this.isReady = true; };
    }

    /**
     * Updates the Final Boss's state on each game frame.
     * Manages activation logic, death, "hurt" state, attacks, and movement.
     * @param {number} dt - Delta time (time elapsed since last frame) in seconds.
     * @param {Plumber} plumber - Plumber character instance (player 1).
     * @param {Angel} angel - Angel character instance (player 2 / AI).
     */
    update(dt, plumber, angel) {
        if (!this.state.isActive) return; // Does not update logic if boss is not active.

        // If the final boss has just been activated, initializes attack and direction timers.
        if (this.state.isActive && !this.state.isActivatedAndReady) {
            this.state.isActivatedAndReady = true;
            this.state.fireballAttackTimer = 0;
            this.state.torchAttackTimer = 0;
            this.state.acidAttackTimer = 0;
            this.state.rafagaSoundPlayed = false;
            this.state.verticalDirection = 1; // Ensures it starts floating downwards.
            this.state.patrolDirection = 1; // Ensures it starts patrolling to the right.
        }
        
        // Death state logic and disappearance animations.
        if (this.state.isDead) {
            this.state.vx = 0; // Stops horizontal movement upon death.
            this.applyVerticalPhysics(dt); // Apply physics for falling when dead.

            if (this.state.animation === 'death') {
                const finishedDeath = this.updateAnimation(dt, this.animations.death);
                if (finishedDeath) {
                    this.state.animation = 'disappear'; // Transition to disappear animation
                    this.state.currentFrame = 0; // Reset frame for new animation
                    this.state.frameTimer = 0; // Reset timer for new animation
                }
            } else if (this.state.animation === 'disappear') {
                const finishedDisappear = this.updateAnimation(dt, this.animations.disappear);
                if (finishedDisappear) {
                    this.state.shouldBeRemoved = true; // Marks for removal once the disappearance animation ends.
                }
            }
            return; // Exit update function as boss is dead.
        }

        // "Hurt" state logic.
        if (this.state.isHurt) {
            this.state.hurtTimer -= dt;
            if (this.state.hurtTimer <= 0) {
                this.state.isHurt = false;
                this.state.animation = 'idle'; // Returns to idle animation.
            }
            this.updateAnimation(dt, this.animations.hurt);
        }

        // Main boss logic when alive and not hurt.
        if (!this.state.isDead && !this.state.isHurt) {
            const healthPercentage = this.state.health / this.state.maxHealth;
            this.state.fireballAttackTimer -= dt;
            this.state.torchAttackTimer -= dt;
            this.state.acidAttackTimer -= dt;

            let speedMultiplier = 1;
            let fireRateMultiplier = 1;

            // Adjusts speed and fire rate based on health percentage.
            if (healthPercentage < 0.9) {
                speedMultiplier *= 1.4;
                fireRateMultiplier *= 0.5;
            }
            if (healthPercentage < 0.3) {
                fireRateMultiplier *= 0.6;
                if (!this.state.rafagaSoundPlayed) {
                    if (this.audioManager) { this.audioManager.playSound('rafaga'); }
                    this.state.rafagaSoundPlayed = true;
                }
            }
            if (healthPercentage < 0.2) {
                fireRateMultiplier *= 0.6;
            }
            if (healthPercentage < 0.1) {
                speedMultiplier *= 2.0;
                fireRateMultiplier *= 0.5;
            }

            // Calculates current attack cooldowns.
            const currentFireballCooldown = this.state.baseFireballCooldown * fireRateMultiplier;
            const currentTorchCooldown = this.state.baseTorchCooldown * fireRateMultiplier;
            const currentAcidCooldown = this.state.baseAcidCooldown * fireRateMultiplier;

            // Fires projectiles based on timers and health percentage.
            if (this.state.fireballAttackTimer <= 0) {
                this.fireFireballs(healthPercentage, speedMultiplier);
                this.state.fireballAttackTimer = currentFireballCooldown;
            }
            if (healthPercentage < 0.7 && this.state.torchAttackTimer <= 0) {
                this.fireTorches(healthPercentage, speedMultiplier);
                this.state.torchAttackTimer = currentTorchCooldown;
            }
            if (healthPercentage < 0.5 && this.state.acidAttackTimer <= 0) {
                this.fireAcidProjectiles(healthPercentage, speedMultiplier);
                this.state.acidAttackTimer = currentAcidCooldown;
            }

            // Burst attack when health is very low.
            if (healthPercentage < 0.2) {
                if (this.state.fireballAttackTimer <= 0 || this.state.torchAttackTimer <= 0 || this.state.acidAttackTimer <= 0) {
                    this.fireFireballs(healthPercentage, speedMultiplier);
                    this.fireTorches(healthPercentage, speedMultiplier);
                    this.fireAcidProjectiles(healthPercentage, speedMultiplier);
                    this.state.fireballAttackTimer = currentFireballCooldown;
                    this.state.torchAttackTimer = currentTorchCooldown;
                    this.state.acidAttackTimer = currentAcidCooldown;
                }
            }

            // Updates attack or idle animation.
            if (this.state.isAttacking) {
                const finished = this.updateAnimation(dt, this.animations.attack);
                if (finished) {
                    this.state.isAttacking = false;
                    this.state.animation = 'idle';
                }
            } else {
                this.updateAnimation(dt, this.animations.idle);
            }

            // Applies vertical floating movement.
            this.state.vy = this.state.verticalSpeed * this.state.verticalDirection;
            if (this.state.y <= 0 && this.state.verticalDirection === -1) {
                this.state.verticalDirection = 1; // Changes direction downwards when reaching the upper limit.
            } else if (this.state.y >= this.state.initialY && this.state.verticalDirection === 1) {
                this.state.verticalDirection = -1; // Changes direction upwards when reaching the lower limit.
            }

            // Applies horizontal patrol movement if not attacking.
            if (!this.state.isAttacking) {
                this.state.x += this.state.patrolDirection * FINAL_BOSS_HORIZONTAL_SPEED * dt;
                const patrolLimit = FINAL_BOSS_PATROL_DISTANCE;
                // Inverts patrol direction when reaching limits.
                if (Math.abs(this.state.x - this.state.initialX) >= patrolLimit) {
                    this.state.patrolDirection *= -1;
                    this.state.x = this.state.initialX + (this.state.patrolDirection * patrolLimit);
                }
            }
            this.applyVerticalPhysics(dt); // Applies vertical physics (floating or falling).
        }
    }

    /**
     * Initiates the Final Boss's attack animation.
     * Resets the animation frame and timer to ensure the animation starts from the beginning.
     */
    startAttack() {
        this.state.isAttacking = true;
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        this.state.animation = 'attack';
    }

    /**
     * Updates the current frame of the Final Boss's animation.
     * @param {number} dt - Delta time (time elapsed since last frame) in seconds.
     * @param {object} animation - Animation object containing frames and duration.
     * @returns {boolean} - True if the animation has completed a cycle (or reached the last frame in non-cyclic animations), false otherwise.
     */
    updateAnimation(dt, animation) {
        if (animation.frames.length <= 1) {
            this.state.currentFrame = 0;
            if (animation === this.animations.hurt) {
                this.state.frameTimer += dt;
                return this.state.frameTimer >= animation.frameDuration;
            }
            return false;
        }
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= animation.frameDuration) {
            this.state.frameTimer = 0;
            this.state.currentFrame++;
            if (this.state.currentFrame >= animation.frames.length) {
                // Para animaciones de muerte y desaparición, se detiene en el último frame.
                if (animation === this.animations.death || animation === this.animations.disappear) {
                    this.state.currentFrame = animation.frames.length - 1;
                    return true;
                } else {
                    // Para otras animaciones, se reinicia al principio.
                    this.state.currentFrame = 0;
                }
            }
        }
        return false;
    }

    /**
     * Fires fireball projectiles from the Final Boss.
     * The quantity and speed of projectiles vary based on the boss's health percentage.
     * @param {number} healthPercentage - Current health percentage of the boss (0.0 to 1.0).
     * @param {number} speedMultiplier - Speed multiplier for projectiles.
     */
    fireFireballs(healthPercentage, speedMultiplier) {
        const projectileX = this.state.facingLeft ? this.state.x - FINAL_BOSS_PROJECTILE_WIDTH : this.state.x + this.state.width;
        const projectileY = this.state.y + (this.state.height / 2) - (FINAL_BOSS_PROJECTILE_HEIGHT / 2);
        const direction = this.state.facingLeft ? -1 : 1;
        const currentSpeed = this.state.baseFireballSpeed * speedMultiplier;

        // Fires multiple projectiles at different angles if health is low.
        if (healthPercentage < 0.8) {
            this.createProjectileCallback(projectileX, projectileY, direction, -currentSpeed * 1.0);
            this.createProjectileCallback(projectileX, projectileY, direction, 0);
            this.createProjectileCallback(projectileX, projectileY, direction, currentSpeed * 1.0);
        } else {
            this.createProjectileCallback(projectileX, projectileY, direction);
        }
        this.startAttack();
        if (this.audioManager) { this.audioManager.playSound('fire-ball'); }
    }

    /**
     * Fires torch-type projectiles from the Final Boss.
     * The speed and quantity of torches vary based on the boss's health percentage.
     * @param {number} healthPercentage - Current health percentage of the boss (0.0 to 1.0).
     * @param {number} speedMultiplier - Speed multiplier for projectiles.
     */
    fireTorches(healthPercentage, speedMultiplier) {
        const projectileX = this.state.facingLeft ? this.state.x - FINAL_BOSS_PROJECTILE_WIDTH : this.state.x + this.state.width;
        const projectileY = this.state.y + (this.state.height / 2) - (FINAL_BOSS_PROJECTILE_HEIGHT / 2);
        const direction = this.state.facingLeft ? -1 : 1;
        let torchSpeed = this.state.baseTorchSpeed;

        if (healthPercentage < 0.7) {
            torchSpeed *= 1.5;
        }
        torchSpeed *= speedMultiplier;

        // Fires multiple torches at different angles if health is low.
        if (healthPercentage < 0.6) {
            this.createTorchCallback(projectileX, projectileY, direction, -torchSpeed * 1.0);
            this.createTorchCallback(projectileX, projectileY, direction, 0);
            this.createTorchCallback(projectileX, projectileY, direction, torchSpeed * 1.0);
        } else {
            this.createTorchCallback(projectileX, projectileY, direction);
        }
        this.startAttack();
        if (this.audioManager) { this.audioManager.playSound('explosion'); }
    }

    /**
     * Fires acid projectiles from the Final Boss.
     * The speed and quantity of acid projectiles vary based on the boss's health percentage.
     * @param {number} healthPercentage - Current health percentage of the boss (0.0 to 1.0).
     * @param {number} speedMultiplier - Speed multiplier for projectiles.
     */
    fireAcidProjectiles(healthPercentage, speedMultiplier) {
        const projectileX = this.state.facingLeft ? this.state.x - FINAL_BOSS_PROJECTILE_WIDTH : this.state.x + this.state.width;
        const projectileY = this.state.y + (this.state.height / 2) - (FINAL_BOSS_PROJECTILE_HEIGHT / 2);
        const direction = this.state.facingLeft ? -1 : 1;
        let acidSpeed = this.state.baseAcidSpeed;

        if (healthPercentage < 0.4) {
            acidSpeed *= 1.5;
        }
        acidSpeed *= speedMultiplier;

        // Fires multiple acid projectiles at different angles if health is low.
        if (healthPercentage < 0.3) {
            this.createFinalBossProjectileCallback(projectileX, projectileY, direction, this, -acidSpeed * 1.0);
            this.createFinalBossProjectileCallback(projectileX, projectileY, direction, this, 0);
            this.createFinalBossProjectileCallback(projectileX, projectileY, direction, this, acidSpeed * 1.0);
        } else {
            this.createFinalBossProjectileCallback(projectileX, projectileY, direction, this);
        }
        this.startAttack();
    }

    /**
     * Applies damage to the Final Boss.
     * Reduces the boss's health and activates the "hurt" animation.
     * If health reaches zero, initiates the death process.
     * @param {number} amount - Amount of damage to apply.
     */
    takeDamage(amount) {
        if (this.state.isDead) return; // Ignores damage if the boss is already dead.

        this.state.health -= amount;
        this.state.isHurt = true;
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        this.state.animation = 'hurt';
        this.state.hurtTimer = this.animations.hurt.frameDuration;
        if (this.audioManager) { this.audioManager.playSound('hit'); }

        // Death logic if health reaches zero or less.
        if (this.state.health <= 0) {
            this.state.isDead = true;
            this.state.isHurt = false;
            this.state.currentFrame = 0;
            this.state.frameTimer = 0;
            this.state.animation = 'death'; // Starts death animation.
            this.state.isFallingDead = false; // Resets falling state.
            if (this.audioManager) { this.audioManager.stopMusic(); } // Stops background music.
            if (this.audioManager) { this.audioManager.playSound('final-boss-death'); } // Plays main death sound.
            if (this.audioManager) { this.audioManager.playSound('bomb-explosion'); } // Plays secondary explosion sound.
        }
        if (this.healthBar) {
            this.healthBar.show(); // Ensures the health bar is visible when taking damage.
        }
    }

    /**
     * Applies vertical physics to the Final Boss.
     * Manages gravity fall when dead and floating when alive.
     * @param {number} dt - Delta time in seconds.
     */
    applyVerticalPhysics(dt) {
        if (this.state.isDead) {
            // Applies gravity when the boss is dead and falling.
            this.state.vy += GRAVITY * dt;
            let proposedY = this.state.y + this.state.vy * dt;

            const groundY = (MAP.length - 2) * TILE_SIZE; // Calculates the Y position of the ground (second to last row of the map).
            const maxY = groundY - this.state.height; // Upper limit for collision with the ground.

            if (proposedY >= maxY) {
                proposedY = maxY;
                this.state.vy = 0;
                this.state.isOnGround = true; // Marks that the boss has touched the ground.
            }
            this.state.y = proposedY;
        } else {
            // Floating behavior when the boss is alive.
            this.state.y += this.state.verticalSpeed * this.state.verticalDirection * dt;

            const minY = 0; // Upper floating limit (top of the canvas).
            const groundY = (MAP.length - 2) * TILE_SIZE; 
            const maxY = groundY - this.state.height; // Lower floating limit (just above the ground).

            if (this.state.y <= minY) {
                this.state.y = minY;
                this.state.verticalDirection = 1; // Changes direction to float downwards.
            } else if (this.state.y >= maxY) {
                this.state.y = maxY;
                this.state.verticalDirection = -1; // Changes direction to float upwards.
            }
        }
    }

    /**
     * Assigns the camera instance to the Final Boss.
     * @param {Camera} camera - Game camera instance.
     */
    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Assigns the health bar to the Final Boss.
     * @param {HealthBar} healthBar - Health bar instance associated with the boss.
     */
    setHealthBar(healthBar) {
        this.healthBar = healthBar;
    }

    /**
     * Assigns the audio manager to the Final Boss.
     * @param {AudioManager} audioManager - Audio manager instance.
     */
    setAudioManager(audioManager) {
        this.audioManager = audioManager;
    }

    /**
     * Renders the Final Boss on the canvas context.
     * @param {CanvasRenderingContext2D} ctx - 2D rendering context of the canvas.
     */
    render(ctx) {
        if (!this.state.isActive) return; // Does not render if boss is not active.
        if (!this.isReady || !this.camera) return; // Ensures image is loaded and camera is assigned.

        const currentAnim = this.animations[this.state.animation];
        if (!currentAnim || !currentAnim.frames || currentAnim.frames.length === 0) {
            return; // Does not render if the current animation is invalid.
        }

        // Uses the generic animation function to draw the current frame.
        animate(
            this.state,
            this.image,
            currentAnim.frames,
            currentAnim.frameDuration,
            ctx,
            this.camera
        );
    }
}