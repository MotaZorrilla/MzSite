import animate from "../core/animate.js";
import { TORCH_WIDTH, TORCH_HEIGHT } from "./Torch.js";

// --- BOSS ANIMATION CONSTANTS ---

// Sprite dimensions and spacing.
export const BOSS_WIDTH = 48;
export const BOSS_HEIGHT = 48;
export const BOSS_SPRITE_SPACING = 0;

// Coordinates and frame count for each animation.
export const BOSS_IDLE_SPRITE_X = 4;
export const BOSS_IDLE_SPRITE_Y = 27;
export const BOSS_ATTACK_SPRITE_X = 4;
export const BOSS_ATTACK_SPRITE_Y = 92;
export const BOSS_HURT_SPRITE_X = 4;
export const BOSS_HURT_SPRITE_Y = 173; // "Hurt" row
export const BOSS_DEATH_SPRITE_X = 4;
export const BOSS_DEATH_SPRITE_Y = 255; // "Death" row

/**
 * Boss Class - Represents the Neanderthal boss.
 * Manages its AI, animations, attacks, and lifecycle.
 */
export default class Boss {
    constructor(x, y, createTorchCallback, audioManager, onDeathCallback, health = 200, maxHealth = 200, updateScoreCallback) {
        this.createTorchCallback = createTorchCallback;
        this.audioManager = audioManager;
        this.onDeathCallback = onDeathCallback;
        this.updateScore = updateScoreCallback; // Store the callback

        this.state = {
            x,
            y,
            width: BOSS_WIDTH,
            height: BOSS_HEIGHT,
            health: health,
            maxHealth: maxHealth,
            isAttacking: false,
            isHurt: false,
            isDead: false,
            animation: 'idle', // Changed from currentAnimation to animation
            currentFrame: 0,
            frameTimer: 0,
            attackCooldown: 2, // Attacks every 5 seconds. Defines the waiting time between attack sequences.
            attackTimer: 1,    // Internal timer to control attack cooldown. Starts ready to attack.
            hurtTimer: 0,      // Timer for "hurt" animation duration.
            shouldBeRemoved: false, // Indicates if the boss should be removed from the game.
            facingLeft: true,  // Direction the boss is facing.
            torchesFiredInAttack: 0, // Counter for torches fired in the current attack sequence.
            animationFinished: false, // Flag to control if an animation (e.g., death) has finished.
        };

        // --- ANIMATION DEFINITION ---
        // Each animation has a per-frame duration and a list of frames.
        // Each frame defines its position (x, y), dimensions (width, height) and offsets
        // to align sprites of different sizes.
        this.animations = {
            idle: {
                frameDuration: 0.2,
                frames: [
                    { x: BOSS_IDLE_SPRITE_X, y: BOSS_IDLE_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT, yOffset: 0, xOffset: 0 },
                    { x: BOSS_IDLE_SPRITE_X + BOSS_WIDTH, y: BOSS_IDLE_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT, yOffset: 0, xOffset: 0 },
                    { x: BOSS_IDLE_SPRITE_X + (2 * BOSS_WIDTH) + 1, y: BOSS_IDLE_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT, yOffset: 0, xOffset: 0 },
                    { x: BOSS_IDLE_SPRITE_X + (3 * BOSS_WIDTH) + 2, y: BOSS_IDLE_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT, yOffset: 0, xOffset: 0 },
                ],
            },
            attack: {
                frameDuration: 0.15,
                frames: [
                    { x: BOSS_ATTACK_SPRITE_X, y: BOSS_ATTACK_SPRITE_Y, width: 60, height: 64, yOffset: BOSS_HEIGHT - 64, xOffset: 0 },
                    { x: BOSS_ATTACK_SPRITE_X + 60, y: BOSS_ATTACK_SPRITE_Y, width: 38, height: 64, yOffset: BOSS_HEIGHT - 64, xOffset: 5 },
                    { x: BOSS_ATTACK_SPRITE_X + 98, y: BOSS_ATTACK_SPRITE_Y, width: 44, height: 59, yOffset: BOSS_HEIGHT - 59, xOffset: -1 },
                    { x: BOSS_ATTACK_SPRITE_X + 140, y: BOSS_ATTACK_SPRITE_Y, width: 44, height: 55, yOffset: BOSS_HEIGHT - 55, xOffset: 7 },
                    { x: BOSS_ATTACK_SPRITE_X + 184, y: BOSS_ATTACK_SPRITE_Y, width: 50, height: 62, yOffset: BOSS_HEIGHT - 62, xOffset: -3 },
                    { x: BOSS_ATTACK_SPRITE_X + 234, y: BOSS_ATTACK_SPRITE_Y, width: 42, height: 62, yOffset: BOSS_HEIGHT - 62, xOffset: 2 },
                    { x: BOSS_ATTACK_SPRITE_X + 278, y: BOSS_ATTACK_SPRITE_Y, width: 48, height: 64, yOffset: BOSS_HEIGHT - 64, xOffset: 0 },
                ],
            },
            hurt: {
                frameDuration: 0.2, // The hurt animation lasts 0.4s
                frames: [
                    { x: BOSS_HURT_SPRITE_X, y: BOSS_HURT_SPRITE_Y, width: BOSS_WIDTH + 14, height: BOSS_HEIGHT + 18, yOffset: -18, xOffset: 0 },
                ],
            },
            death: {
                frameDuration: 0.2,
                frames: [
                    { x: BOSS_DEATH_SPRITE_X, y: BOSS_DEATH_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT + 14, yOffset: -14, xOffset: 0 },
                    { x: BOSS_DEATH_SPRITE_X + BOSS_WIDTH, y: BOSS_DEATH_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT + 14, yOffset: -14, xOffset: 0 },
                    { x: BOSS_DEATH_SPRITE_X + (2 * BOSS_WIDTH), y: BOSS_DEATH_SPRITE_Y, width: BOSS_WIDTH, height: BOSS_HEIGHT + 14, yOffset: -14, xOffset: 0 },
                ],
            },
        };

        this.image = new Image();
        this.image.src = 'assets/images/plumber/boss.png';

        this.isReady = false;
        this.image.onload = () => { this.isReady = true; };
    }

    /**
     * Main boss state machine.
     * @param {number} dt - Delta time.
     */
    update(dt, plumber, angel) {
        // --- 1. GLOBAL STATE MANAGEMENT ---
        // If the boss is dead, updates its death animation and performs no other actions.
        if (this.state.isDead) {
            this.updateAnimation(dt, this.animations.death, () => {
                this.state.shouldBeRemoved = true;
                if (this.onDeathCallback && !this.state.animationFinished) {
                    this.onDeathCallback();
                    this.state.animationFinished = true; // Ensures the callback is called only once
                }
            });
            return; // If dead, does nothing else.
        }

        // If the boss is hurt, updates its hurt animation and performs no other actions.
        if (this.state.isHurt) {
            this.state.hurtTimer -= dt;
            if (this.state.hurtTimer <= 0) {
                this.state.isHurt = false;
                this.state.animation = 'idle'; // Returns to idle animation after being hurt
            }
            this.updateAnimation(dt, this.animations.hurt); // Calls updateAnimation without onComplete for hurt
            return; // If hurt, does not attack or move.
        }

        // --- 2. AI AND ATTACK LOGIC ---
        // Reduces the attack timer. If it reaches zero and is not attacking, initiates an attack.
        this.state.attackTimer -= dt;
        if (this.state.attackTimer <= 0 && !this.state.isAttacking) {
            this.startAttack();
        }

        // --- 3. ANIMATION MANAGEMENT ---
        // If the boss is attacking, updates the attack animation; otherwise, the idle animation.
        if (this.state.isAttacking) {
            this.updateAttackAnimation(dt, plumber, angel);
        } else {
            this.updateAnimation(dt, this.animations.idle);
        }
    }

    /**
     * Initiates the attack sequence.
     */
    startAttack() {
        // Sets the attack state to true.
        this.state.isAttacking = true;
        // Resets the current frame and frame timer for the new animation.
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        // Resets the count of torches fired for the new attack sequence.
        this.state.torchesFiredInAttack = 0;
        // Resets the attack timer to the defined cooldown value.
        this.state.attackTimer = this.state.attackCooldown; // Resets cooldown.
        // Sets the boss's current animation to 'attack'.
        this.state.animation = 'attack'; // Sets current animation to 'attack'
    }

    /**
     * Updates the attack animation and fires projectiles at keyframes.
     * @param {number} dt 
     */
    updateAttackAnimation(dt, plumber, angel) {
        // Updates the boss's attack animation.
        // When the animation ends, the isAttacking state becomes false and the animation returns to 'idle'.
        this.updateAnimation(dt, this.animations.attack, () => {
            this.state.isAttacking = false; // Ends the attack at the end of the animation.
            this.state.animation = 'idle'; // Returns to idle animation
        });

        // Synchronizes torch launching with specific frames of the attack animation.
        // Launches the first torch on frame 1 of the attack animation.
        if (this.state.currentFrame === 1 && this.state.torchesFiredInAttack === 0) {
            this.fireTorch(plumber, angel);
            this.state.torchesFiredInAttack++;
        } 
        // Launches the second torch on frame 4 of the attack animation.
        else if (this.state.currentFrame === 4 && this.state.torchesFiredInAttack === 1) {
            this.fireTorch(plumber, angel);
            this.state.torchesFiredInAttack++;
        }
    }

    /**
     * Generic function to update an animation's state.
     * @param {number} dt - Delta time.
     * @param {object} animation - The animation to update.
     * @param {function} onComplete - Callback executed when the animation finishes.
     */
    updateAnimation(dt, animation, onComplete) {
        // If an animation has only one frame, there's nothing to update.
        if (animation.frames.length <= 1) {
            this.state.currentFrame = 0;
            return;
        }

        this.state.frameTimer += dt;
        if (this.state.frameTimer >= animation.frameDuration) {
            this.state.frameTimer = 0;
            this.state.currentFrame++;

            if (this.state.currentFrame >= animation.frames.length) {
                // Logic for non-looping animations (like death).
                if (animation === this.animations.death) {
                    this.state.currentFrame = animation.frames.length - 1; // Stays on the last frame.
                    if (onComplete && !this.state.animationFinished) {
                        onComplete();
                        this.state.animationFinished = true;
                    }
                } else {
                    // For looping animations, returns to the beginning.
                    this.state.currentFrame = 0;
                    if (onComplete) onComplete();
                }
            }
        }
    }

    /**
     * Creates and fires a torch.
     */
    fireTorch(plumber, angel) {
        // Calculates the torch's starting position.
        const torchX = this.state.x + (this.state.width / 2) - (TORCH_WIDTH / 2);
        const torchY = this.state.y + (this.state.height / 2) - (TORCH_HEIGHT / 2);
        // Determines the torch's direction based on the boss's facing direction.
        const direction = this.state.facingLeft ? -1 : 1;
        // Calls the callback to create a new torch instance.
        this.createTorchCallback(torchX, torchY, direction, plumber, angel);
        this.audioManager.playSound('explosion'); // Play torch launch sound
    }

    /**
     * Reduces the boss's health and activates the "hurt" state.
     * @param {number} amount - The amount of damage to receive.
     */
    takeDamage(amount) {
        // If the boss is already dead, it takes no more damage.
        if (this.state.isDead) return;

        // Reduces the boss's health.
        this.state.health -= amount;
        if (this.updateScore) {
            this.updateScore(amount);
        }
        this.audioManager.playSound('hit'); // Damage sound
        
        // Activates the "hurt" state and resets the hurt animation.
        this.state.isHurt = true;
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        this.state.animation = 'hurt'; // Ensures the hurt animation is activated
        this.state.hurtTimer = this.animations.hurt.frameDuration; // Sets the hurt timer

        // If health reaches zero or less, the boss dies.
        if (this.state.health <= 0) {
            this.state.isDead = true;
            this.state.isHurt = false; // Cannot be hurt and dead at the same time.
            this.state.currentFrame = 0;
            this.state.frameTimer = 0;
            this.state.animation = 'death'; // Sets animation to 'death'
            this.audioManager.playSound('enemy-death'); // Boss death sound
        }
        // Displays the health bar if assigned.
        if (this.healthBar) {
            this.healthBar.show();        }
    }

    /**
     * Assigns the camera to the boss for rendering.
     * @param {Camera} camera 
     */
    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Assigns the contextual health bar to the boss.
     * @param {HealthBar} healthBar - The contextual health bar instance.
     */
    setHealthBar(healthBar) {
        this.healthBar = healthBar;
    }

    /**
     * Injects the audio manager dependency.
     * @param {AudioManager} audioManager - The audio manager instance.
     */
    setAudioManager(audioManager) {
        this.audioManager = audioManager;
    }

    /**
     * Draws the boss on the canvas.
     * @param {CanvasRenderingContext2D} ctx 
     */
    render(ctx) {
        // If the boss is not ready or has no camera assigned, it is not rendered.
        if (!this.isReady || !this.camera) return;

        // Gets the current animation data.
        const currentAnim = this.animations[this.state.animation];
        if (!currentAnim || !currentAnim.frames || currentAnim.frames.length === 0) {
            return; // Do not render if the animation or its frames are not defined.
        }

        animate(
            this.state, // Pass the original state
            this.image,
            currentAnim.frames,
            currentAnim.frameDuration,
            ctx,
            this.camera           // Pass the camera object
        );
    }
}
