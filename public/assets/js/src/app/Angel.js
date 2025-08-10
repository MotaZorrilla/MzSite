/**
 * @file Angel.js
 * @brief Implements the logic and behavior for the Angel character.
 * This class manages movement, animations, attacks, and artificial intelligence
 * when not under player control.
 */

import animate from "../core/animate.js";
import { applyAcceleration, applyDeceleration, applyMovement } from "../core/motion.js";
import { MAP, TILE_SIZE, GRAVITY, ANGEL_WIDTH, ANGEL_HEIGHT, ANGEL_MAX_VELOCITY, ANGEL_ACCELERATION, ANGEL_FRICTION, ANGEL_JUMP_FORCE, ANGEL_DOUBLE_JUMP_FORCE, CANVAS_WIDTH, CANVAS_HEIGHT, MAP_WIDTH, MAP_HEIGHT, GROUND_EPSILON, LEVITATION_DURATION, ANGEL_ATTACK_DELAY, ANGEL_JUMP_DELAY, ANGEL_AUTO_JUMP_DISTANCE, ANGEL_AUTO_JUMP_DELAY, ANGEL_IDLE_ROW, ANGEL_RUN_ROW, ANGEL_JUMP_ROW, ANGEL_CROUCH_ROW, ANGEL_ATTACK_ROW, ANGEL_SIT_ROW, ANGEL_DEATH_ROW, ANGEL_MAX_BURST_SHOTS, ANGEL_BURST_COOLDOWN_DURATION } from "./config.js";
import { FIREBALL_WIDTH, FIREBALL_HEIGHT } from "./Projectile.js";

export default class Angel {
    /**
     * Constructor for the Angel class.
     * @param {number} x - Initial X position of the Angel.
     * @param {number} y - Initial Y position of the Angel.
     * @param {function} createProjectileCallback - Callback function to create projectiles.
     */
    constructor(x, y, createProjectileCallback, audioManager) {
        this.createProjectileCallback = createProjectileCallback;
        this.audioManager = audioManager;
        this.createProjectileCallback = createProjectileCallback;
        this.attackCooldown = 0.5; // Attack cooldown in seconds.
        this.attackTimer = 0; // Timer to control attack cooldown.

        /**
         * @property {object} state - Object encapsulating the Angel's current state.
         * @property {number} state.x - Current X position.
         * @property {number} state.y - Current Y position.
         * @property {number} state.direction - Horizontal movement direction (-1: left, 0: stopped, 1: right).
         * @property {number} state.vx - Current X velocity.
         * @property {number} state.vy - Current Y velocity.
         * @property {number} state.height - Angel's height.
         * @property {number} state.width - Angel's width.
         * @property {boolean} state.isOnGround - Indicates if the Angel is touching the ground.
         * @property {number} state.jumpsLeft - Number of available jumps (for double jump).
         * @property {boolean} state.isCrouching - Indicates if the Angel is crouching.
         * @property {boolean} state.isSitting - Indicates if the Angel is sitting.
         * @property {boolean} state.isAttacking - Indicates if the Angel is performing an attack.
         * @property {string} state.animation - Name of the current animation (e.g., 'idle', 'run').
         * @property {boolean} state.facingLeft - Indicates if the Angel is facing left.
         * @property {number} state.health - Current health of the Angel.
         * @property {number} state.maxHealth - Maximum health of the Angel.
         * @property {boolean} state.isDead - Indicates if the Angel has been defeated.
         * @property {boolean} state.animationFinished - Flag to indicate if an animation (e.g., death) has finished.
         * @property {number} state.currentFrame - Index of the current animation frame.
         * @property {number} state.frameTimer - Timer for controlling animation speed.
         * @property {boolean} state.isPlayerControlled - Indicates if the Angel is under player control.
         * @property {number} state.idleSitDelayTimer - Timer for activating the sitting animation due to inactivity.
         * @property {boolean} state.isLevitating - Indicates if the Angel is levitating (e.g., hitting the ceiling).
         * @property {number} state.levitationTimer - Timer for levitation duration.
         * @property {number} state.angelAttackDelayTimer - Timer for the Angel's AI attack delay.
         * @property {number} state.angelJumpDelayTimer - Timer for the Angel's AI jump delay.
         * @property {number} state.angelAutoJumpTimer - Timer for the Angel's AI auto-jump delay.
         * @property {number} state.playerIdleTimer - Timer for the Angel's inactivity when controlled by the player.
         */
        this.state = {
            x,
            y,
            direction: 0,
            vx: 0,
            vy: 0,
            height: ANGEL_HEIGHT,
            width: ANGEL_WIDTH,
            isOnGround: false,
            jumpsLeft: 2,
            isCrouching: false,
            isSitting: false,
            isAttacking: false,
            animation: 'idle',
            facingLeft: false,
            health: 100,
            maxHealth: 100,
            isDead: false,
            animationFinished: false,
            currentFrame: 0,
            frameTimer: 0,
            isPlayerControlled: false, // By default, controlled by AI
            idleSitDelayTimer: 0, // Timer for inactivity-based sitting animation delay.
            isLevitating: false, // New state to control levitation.
            levitationTimer: 0, // Timer for levitation duration.
            angelAttackDelayTimer: 0, // Timer for Angel's attack delay.
            angelJumpDelayTimer: 0, // Timer for Angel's jump delay.
            angelAutoJumpTimer: 0, // Timer for Angel's auto-jump delay.
            
            playerIdleTimer: 0, // Timer for player-controlled Angel's inactivity.
            shotsFiredCount: 0,         // Number of shots fired in the current burst.
            burstCooldownTimer: 0,      // Timer for the burst cooldown.
        };

        /**
         * @property {object} animations - Defines the Angel's animation properties.
         * Each property is an object containing:
         * @property {number} frameDuration - Duration of each frame in milliseconds.
         * @property {Array<object>} frames - Array of objects, each describing a frame:
         * @property {number} frames[].x - X coordinate in the spritesheet.
         * @property {number} frames[].y - Y coordinate in the spritesheet.
         * @property {number} frames[].width - Frame width.
         * @property {number} frames[].height - Frame height.
         * @property {number} frames[].yOffset - Vertical offset for rendering (optional).
         */
        this.animations = {
            idle: {
                frames: [
                    { x: 0 * ANGEL_WIDTH, y: ANGEL_IDLE_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_IDLE_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                ],
                frameDuration: 400, // Slower for idle
            },
            run: {
                frames: [
                    { x: 0 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 2 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 3 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 4 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 5 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 6 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 7 * ANGEL_WIDTH, y: ANGEL_RUN_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                ],
                frameDuration: 100, // Faster for run
            },
            jump: {
                frames: [
                    { x: 0 * ANGEL_WIDTH, y: ANGEL_JUMP_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_JUMP_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 2 * ANGEL_WIDTH, y: ANGEL_JUMP_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 3 * ANGEL_WIDTH, y: ANGEL_JUMP_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 4 * ANGEL_WIDTH, y: ANGEL_JUMP_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                ],
                frameDuration: 150, // Default duration
            },
            crouch: {
                frames: [
                    { x: 0 * ANGEL_WIDTH, y: ANGEL_CROUCH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_CROUCH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                ],
                frameDuration: 150, // Default duration
            },
            attack: {
                frames: [
                    { x: 0 * ANGEL_WIDTH, y: ANGEL_ATTACK_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_ATTACK_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 2 * ANGEL_WIDTH, y: ANGEL_ATTACK_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 3 * ANGEL_WIDTH, y: ANGEL_ATTACK_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 4 * ANGEL_WIDTH, y: ANGEL_ATTACK_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 5 * ANGEL_WIDTH, y: ANGEL_ATTACK_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                ],
                frameDuration: 100, // Duración por defecto
            },
            sit: {
                frames: [
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_SIT_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT, yOffset: -2 },
                ],
                frameDuration: 150, // Default duration
            },
            death: {
                frames: [
                    { x: 0 * ANGEL_WIDTH, y: ANGEL_DEATH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 1 * ANGEL_WIDTH, y: ANGEL_DEATH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 2 * ANGEL_WIDTH, y: ANGEL_DEATH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 3 * ANGEL_WIDTH, y: ANGEL_DEATH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 4 * ANGEL_WIDTH, y: ANGEL_DEATH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                    { x: 5 * ANGEL_WIDTH, y: ANGEL_DEATH_ROW * ANGEL_HEIGHT, width: ANGEL_WIDTH, height: ANGEL_HEIGHT },
                ],
                frameDuration: 150, // Default duration
            },
        };

        this.image = new Image();
        this.image.src = '/assets/images/plumber/Angel.png';

        this.isReady = false;
        this.image.onload = () => { this.isReady = true; }

    // Track key states to prevent repeated firing on key hold
    this.keyStates = { control: false };
    document.addEventListener('keydown', this.onKeyDown.bind(this));
    document.addEventListener('keyup', this.onKeyUp.bind(this));
    }

    /**
     * Reduces the Angel's health.
     * If health reaches zero or less, the Angel is marked as dead.
     * @param {number} amount - The amount of damage to apply.
     */
    takeDamage(amount) {
        if (this.state.isDead) return; // Ignores damage if the Angel is already dead.
        this.state.health -= amount;
        
        if (this.state.health <= 0) {
            this.state.health = 0;
            this.state.isDead = true;
            this.state.animationFinished = false; // Reinicia la bandera de animación al morir.
        }
        if (this.healthBar) {
            this.healthBar.show(); // Ensures the health bar is visible when taking damage.
            
        }
    }

    /**
     * Fires a projectile from the Angel's current position.
     * Activates the attack animation and plays the corresponding sound.
     */
    fireProjectile() {
        this.state.isAttacking = true;
        this.attackTimer = ANGEL_ATTACK_DELAY; // Reinicia el cooldown de ataque usando la constante.
        this.state.shotsFiredCount++;

        if (this.state.shotsFiredCount >= ANGEL_MAX_BURST_SHOTS) {
            this.state.burstCooldownTimer = ANGEL_BURST_COOLDOWN_DURATION;
            this.state.shotsFiredCount = 0; // Reset shots fired after burst cooldown is activated
        }

        const projectileX = this.state.facingLeft ? this.state.x - FIREBALL_WIDTH : this.state.x + this.state.width;
        const projectileY = this.state.y + (this.state.height / 2) - (FIREBALL_HEIGHT / 2);
        const direction = this.state.facingLeft ? -1 : 1;
        this.createProjectileCallback(projectileX, projectileY, direction);
        this.audioManager.playSound('fire-ball'); // Plays the firing sound.
    }

    /**
     * Notifies the Angel (when AI-controlled) that the Plumber has fired.
     * This can trigger a coordinated attack action.
     */
    notifyPlayerFired() {
        if (!this.state.isPlayerControlled && this.state.angelAttackDelayTimer <= 0) {
            this.fireProjectile();
            this.state.angelAttackDelayTimer = ANGEL_ATTACK_DELAY;
        }
    }

    /**
     * Handles key press events for Angel's control.
     * Only active if the Angel is under player control.
     * @param {KeyboardEvent} event - The keyboard event object.
     */
    async onKeyDown(event) {
        await this.audioManager.resumeAudioContext();
        if (!this.state.isPlayerControlled || this.state.isDead) return; // Ignores input if not player-controlled or dead.

        const key = event.key.toLowerCase();

        if (key === 'arrowleft') {
            this.state.direction = -1; // Sets movement direction to left.
            this.state.playerIdleTimer = 0; // Resets inactivity timer.
            this.state.isSitting = false; // Stands up if sitting.
        } else if (key === 'arrowright') {
            this.state.direction = 1; // Sets movement direction to right.
            this.state.playerIdleTimer = 0;
            this.state.isSitting = false;
        } else if (key === 'arrowup' && this.state.isOnGround) {
            this.state.vy = -ANGEL_JUMP_FORCE; // Applies initial jump force.
            this.state.isOnGround = false;
            this.state.jumpsLeft--;
            this.state.playerIdleTimer = 0;
            this.state.isSitting = false;
        } else if (key === 'arrowup' && !this.state.isOnGround && this.state.jumpsLeft > 0) {
            this.state.vy = -ANGEL_DOUBLE_JUMP_FORCE; // Applies double jump force.
            this.state.jumpsLeft--;
            this.state.playerIdleTimer = 0;
            this.state.isSitting = false;
        } else if (key === 'control') {
            if (!this.keyStates.control && this.attackTimer <= 0 && this.state.burstCooldownTimer <= 0) {
                this.fireProjectile(); // Fires a projectile.
                this.state.playerFiredSignal = true; // Signals the other character (AI) that a shot has been fired.
                this.state.playerIdleTimer = 0;
                this.state.isSitting = false;
            }
            this.keyStates.control = true;
        } else if (key === 'arrowdown' && this.state.isOnGround && !this.state.isAttacking) {
            // Toggles sitting/crouching state.
            this.state.isSitting = !this.state.isSitting;
            this.state.playerIdleTimer = 0; // Resets inactivity timer when changing state.
            if (this.state.isSitting) {
                this.state.isCrouching = false; // If sitting, not crouching.
            } else {
                this.state.isCrouching = false; // If standing up, not crouching.
            }
        }
    }

    /**
     * Handles key release events for Angel's control.
     * @param {KeyboardEvent} event - The keyboard event object.
     */
    onKeyUp(event) {
        const key = event.key.toLowerCase();

        if (key === 'arrowleft' || key === 'arrowright') {
            this.state.direction = 0; // Stops horizontal movement.
            this.state.playerIdleTimer = 0; // Resets inactivity timer.
            this.state.isSitting = false; // Stands up when movement stops.
        } else if (key === 'control') {
            this.state.isAttacking = false;
            this.keyStates.control = false;
        } else if (key === 'arrowdown') {
            // Sitting/crouching logic is managed in `onKeyDown` to allow toggling.
        }
    }

    /**
     * Updates the Angel's state on each game frame.
     * Manages movement logic, animations, attacks, and AI for following/attacking.
     * @param {number} dt - Delta time (time elapsed since last frame) in seconds.
     * @param {Plumber} plumber - Reference to the Plumber object for AI logic.
     * @param {boolean} plumberFiredSignal - Signal indicating if the Plumber has fired in the current frame.
     */
    update(dt, plumber, plumberFiredSignal) {
        // Detecta flanco de subida de plumberFiredSignal
        if (this._prevPlumberFiredSignal === undefined) this._prevPlumberFiredSignal = false;
        // Solo dispara si plumberFiredSignal pasa de false a true (flanco de subida)
        if (!this.state.isPlayerControlled && plumberFiredSignal && !this._prevPlumberFiredSignal && this.state.angelAttackDelayTimer <= 0) {
            this.state.isSitting = false;
            this.fireProjectile();
            this.state.angelAttackDelayTimer = ANGEL_ATTACK_DELAY;
        }
        this._prevPlumberFiredSignal = plumberFiredSignal;

        // Updates attack cooldown timer.
        if (this.attackTimer > 0) {
            this.attackTimer -= dt;
        } else {
            this.state.isAttacking = false;
        }

        // Manages burst cooldown.
        if (this.state.burstCooldownTimer > 0) {
            this.state.burstCooldownTimer -= dt;
            if (this.state.burstCooldownTimer <= 0) {
                this.state.shotsFiredCount = 0; // Reset shots fired count after burst cooldown
            }
        }

        

        // Handles levitation timer.
        if (this.state.isLevitating) {
            this.state.levitationTimer -= dt;
            if (this.state.levitationTimer <= 0) {
                this.state.isLevitating = false;
            }
        }

        // Handles delay timers for AI actions (attack/jump).
        if (this.state.angelAttackDelayTimer > 0) this.state.angelAttackDelayTimer -= dt;
        if (this.state.angelJumpDelayTimer > 0) this.state.angelJumpDelayTimer -= dt;
        if (this.state.angelAutoJumpTimer > 0) this.state.angelAutoJumpTimer -= dt;

        // Death logic: stops movement and plays death animation.
        if (this.state.isDead) {
            this.state.vx = 0; // Stops horizontal movement upon death.
            this.computeAnimation(); // Computes death animation.
            if (!this.state.animationFinished) {
                this.state.frameTimer += dt;
                const currentAnimation = this.animations.death;
                if (currentAnimation && currentAnimation.frames.length > 0) {
                    const animationFrameDuration = currentAnimation.frameDuration / 1000;
                    if (this.state.frameTimer >= animationFrameDuration) {
                        this.state.frameTimer = 0;
                        this.state.currentFrame++;
                        if (this.state.currentFrame >= currentAnimation.frames.length) {
                            this.state.currentFrame = currentAnimation.frames.length - 1;
                            this.state.animationFinished = true;
                        }
                    }
                }
            }
            this.applyVerticalPhysics(dt); // Applies vertical physics (fall).
            return;
        }

        // Specific logic for AI or player control.
        if (!this.state.isPlayerControlled) {
            const INACTIVITY_VELOCITY_THRESHOLD = 1;
            // Determines if the Plumber is idle for the Angel to sit.
            const isPlumberIdle = plumber && plumber.state &&
                                  plumber.state.direction === 0 && // Check if Plumber is not trying to move
                                  !plumber.state.isDead;

            // AI logic for sitting due to Plumber's inactivity.
            if (isPlumberIdle && !this.state.isAttacking) {
                this.state.idleSitDelayTimer += dt;
                if (this.state.idleSitDelayTimer >= 2) { // If Plumber is idle for 2 seconds.
                    this.state.isSitting = true;
                }
            } else {
                this.state.idleSitDelayTimer = 0;
                this.state.isSitting = false; // Angel stands up if Plumber moves or attacks.
            }

            this.followAndAttackPlumber(plumber, plumberFiredSignal); // Executes AI follow and attack logic.

        } else { // Angel is player-controlled.
            const PLAYER_IDLE_SIT_THRESHOLD = 4; // Inactivity threshold for Angel to sit when player-controlled.

            // Resets inactivity timer if there is movement or attack.
            if (this.state.vx !== 0 || this.state.vy !== 0 || this.state.isAttacking) {
                this.state.playerIdleTimer = 0;
                this.state.isSitting = false; // Angel stands up if moving.
            } else {
                this.state.playerIdleTimer += dt;
            }

            if (this.state.playerIdleTimer >= PLAYER_IDLE_SIT_THRESHOLD) {
                this.state.isSitting = true;
            } else {
                // If the player moves or attacks, the Angel stands up.
                if (this.state.vx !== 0 || this.state.vy !== 0 || this.state.isAttacking) {
                    this.state.isSitting = false;
                }
            }
        }

        // If the Angel is sitting (either by AI or player), stops horizontal movement.
        // This condition is applied AFTER the AI/player logic to allow direction to be set first.
        if (this.state.isSitting) {
            this.state.vx = 0;
            // If the player tries to move while sitting, the direction is nullified.
            if (this.state.isPlayerControlled && this.state.direction !== 0) {
                this.state.direction = 0;
            }
        }

        this.applyHorizontalPhysics(dt); // Applies horizontal movement physics.
        this.applyVerticalPhysics(dt); // Applies vertical movement physics (gravity, jumps).
        this.computeAnimation(); // Determines the current animation based on state.

        // Updates the current animation frame (excluding death animation, which is handled separately).
        if (this.state.animation !== 'death') {
            this.state.frameTimer += dt;
            const currentAnimation = this.animations[this.state.animation];
            if (currentAnimation && currentAnimation.frames.length > 0) {
                const animationFrameDuration = currentAnimation.frameDuration / 1000;
                if (this.state.frameTimer >= animationFrameDuration) {
                    this.state.frameTimer = 0;
                    if (this.state.animation === 'crouch') {
                        // For crouching animation, only advances one frame and stops.
                        if (this.state.currentFrame < currentAnimation.frames.length - 1) {
                            this.state.currentFrame++;
                        }
                    } else {
                        // For other animations, advances to the next frame and cycles if it reaches the end.
                        this.state.currentFrame = (this.state.currentFrame + 1) % currentAnimation.frames.length;
                    }
                }
            } else {
                this.state.currentFrame = 0; // Resets frame if animation is invalid.
            }
        }
    }

    /**
     * AI logic for following and attacking the Plumber.
     * @param {Plumber} plumber 
     */
    followAndAttackPlumber(plumber, plumberFiredSignal) {
        // If the Angel is crouching or sitting, AI does not act.
        if (this.state.isCrouching || this.state.isSitting) {
            this.state.direction = 0; // Ensure AI doesn't try to move if sitting/crouching
            return;
        }

        // If the Angel is already in a sitting state, do not allow AI to move it.
        if (this.state.isSitting) {
            this.state.direction = 0;
            this.state.vx = 0;
            return;
        }

        if (!plumber) {
            this.state.direction = 0;
            return;
        }

        // Calculate target position behind the Plumber
        const followDistance = 10; // Distance behind the Plumber (adjusted to be closer)
        let targetX;

        if (plumber.state.facingLeft) {
            targetX = plumber.state.x + plumber.state.width + followDistance;
        } else {
            targetX = plumber.state.x - this.state.width - followDistance;
        }

        const distanceToTarget = targetX - this.state.x;
        const movementThreshold = 2; // Threshold to stop movement (adjusted for greater precision)

        if (distanceToTarget < -movementThreshold) {
            this.state.direction = -1; // Move left
            this.state.facingLeft = true; // Face left
        } else if (distanceToTarget > movementThreshold) {
            this.state.direction = 1; // Move right
            this.state.facingLeft = false; // Face right
        } else {
            this.state.direction = 0; // Stop
        }

        // Auto-jump logic if Mario moves far away and there's an obstacle
        const autoJumpDistance = ANGEL_AUTO_JUMP_DISTANCE; // Use the constant defined in config.js
        if (this.state.isOnGround && this.state.angelAutoJumpTimer <= 0 && Math.abs(distanceToTarget) > autoJumpDistance) {
            // Detect if Angel is "stuck" (trying to move but not actually moving)
            const isStuck = (this.state.direction !== 0 && Math.abs(this.state.vx) < 0.1);

            if (isStuck) {
                this.state.vy = -ANGEL_JUMP_FORCE;
                this.state.isOnGround = false;
                this.state.jumpsLeft--;
                this.state.angelAutoJumpTimer = ANGEL_AUTO_JUMP_DELAY;
            }
        }

        // Jumps if the plumber jumps and the cooldown has ended.
        // First jump: if Mario jumps from the ground and Angel is on the ground.
        if (!plumber.state.isOnGround && this.state.isOnGround && this.state.angelJumpDelayTimer <= 0) {
            this.state.vy = -ANGEL_JUMP_FORCE;
            this.state.isOnGround = false;
            this.state.jumpsLeft--;
            this.state.angelJumpDelayTimer = ANGEL_JUMP_DELAY; // Resets jump delay timer
        } 
        // Double jump: if Angel is in the air, has available jumps, the timer allows it, and is near the apex of its own jump.
        else if (!this.state.isOnGround && this.state.jumpsLeft > 0 && this.state.angelJumpDelayTimer <= 0 && Math.abs(this.state.vy) < 10) { // < 10 to detect Angel's apex
            this.state.vy = -ANGEL_DOUBLE_JUMP_FORCE;
            this.state.jumpsLeft--;
            this.state.angelJumpDelayTimer = ANGEL_JUMP_DELAY; // Resets jump delay timer
        }
    }

    applyHorizontalPhysics(dt) {
        // Applies acceleration or deceleration to get the new velocity.
        let proposedVx = this.state.direction !== 0 ?
            applyAcceleration(this.state.vx, ANGEL_ACCELERATION, dt, this.state.direction, ANGEL_MAX_VELOCITY) :
            applyDeceleration(this.state.vx, ANGEL_FRICTION, dt);

        // Calculates the new proposed X position.
        let proposedX = applyMovement(this.state.x, this.state.vx, dt);

        // Horizontal collision detection.
        const headRow = Math.floor(this.state.y / TILE_SIZE);
        const footRow = Math.floor((this.state.y + this.state.height - 1) / TILE_SIZE);
        const leftCol = Math.floor(proposedX / TILE_SIZE);
        const rightCol = Math.floor((proposedX + this.state.width) / TILE_SIZE);

        // Collision with obstacles to the right.
        if (proposedVx > 0) {
            if (MAP[headRow][rightCol] === 1 || MAP[footRow][rightCol] === 1) {
                proposedVx = 0;
                proposedX = (rightCol * TILE_SIZE) - this.state.width;
            }
        }

        // Collision with obstacles to the left.
        if (proposedVx < 0) {
            if (MAP[headRow][leftCol] === 1 || MAP[footRow][leftCol] === 1) {
                proposedVx = 0;
                proposedX = (leftCol * TILE_SIZE) + this.state.width;
            }
        }

        // Updates X velocity and position.
        this.state.vx = proposedVx;
        this.state.x = proposedX;

        // Collision with map boundaries on X
        if (this.state.x < 0) {
            this.state.x = 0;
            this.state.vx = 0;
        } else if (this.state.x + this.state.width > MAP_WIDTH) {
            this.state.x = MAP_WIDTH - this.state.width;
            this.state.vx = 0;
        }
    }

    applyVerticalPhysics(dt) {
        // Applies gravity to get the new vertical velocity.
        let proposedVy = this.state.isLevitating ? 0 : applyAcceleration(this.state.vy, GRAVITY, dt);
        // Calculates the new proposed Y position.
        let proposedY = applyMovement(this.state.y, proposedVy, dt);

        // Vertical collision detection.
        const headRow = Math.floor(proposedY / TILE_SIZE);
        const footRow = Math.floor((proposedY + this.state.height - 1) / TILE_SIZE);
        const leftCol = Math.floor(this.state.x / TILE_SIZE);
        const rightCol = Math.floor((this.state.x + this.state.width - 1) / TILE_SIZE);

        // Collision with the ground.
        if (proposedVy > 0) {
            // Add GROUND_EPSILON to give a small buffer for ground detection
            const checkY = proposedY + this.state.height + GROUND_EPSILON;
            const footRowCheck = Math.floor((checkY - 1) / TILE_SIZE); // Adjust for 0-based index

            if (MAP[footRowCheck][leftCol] === 1 || MAP[footRowCheck][rightCol] === 1) {
                proposedVy = 0;
                proposedY = (footRowCheck * TILE_SIZE) - this.state.height;
                this.state.isOnGround = true;
                this.state.jumpsLeft = 2; // Resets available jumps upon touching the ground.
            }
        }
        // Collision with the ceiling.
        else {
            // Collision with the ceiling.
            // Jump is limited so that the Angel does not exceed the upper map limit.
            if (MAP[headRow][leftCol] === 1 || MAP[headRow][rightCol] === 1 || proposedY < TILE_SIZE) {
                proposedVy = 0;
                proposedY = (headRow * TILE_SIZE) + this.state.height;
                // If the Angel tries to go above the upper map limit, adjust it.
                if (proposedY < TILE_SIZE) {
                    proposedY = TILE_SIZE; // Adjusts Y position to the upper map limit
                }
                this.state.isLevitating = true;
                this.state.levitationTimer = LEVITATION_DURATION;
            }
        }

        // Updates Y velocity and position.
        if (this.state.isLevitating) {
            this.state.vy = 0;
            // Ensure Y position does not exceed upper limit during levitation
            if (this.state.y < TILE_SIZE) {
                this.state.y = TILE_SIZE;
            }
        } else {
            this.state.vy = proposedVy;
            this.state.y = proposedY;
        }

        // Collision with canvas boundaries on Y
        if (this.state.y < 0) {
            this.state.y = 0;
            this.state.vy = 0;
            this.state.isLevitating = true;
            this.state.levitationTimer = LEVITATION_DURATION;
        } else if (this.state.y + this.state.height > CANVAS_HEIGHT) {
            this.state.y = CANVAS_HEIGHT - this.state.height;
            this.state.vy = 0;
            this.state.isOnGround = true;
        }
    }

    computeAnimation() {
        let newAnimation;

        if (this.state.isDead) {
            newAnimation = 'death';
        } else if (this.state.isAttacking) {
            newAnimation = 'attack';
        } else if (!this.state.isOnGround) {
            newAnimation = 'jump';
        } else if (Math.abs(this.state.vx) > 0) {
            newAnimation = 'run';
        } else if (this.state.isCrouching) {
            newAnimation = 'crouch';
        } else if (this.state.isSitting) {
            newAnimation = 'sit';
        } else {
            newAnimation = 'idle';
        }

        // If animation has changed, reset frame and timer
        if (newAnimation !== this.state.animation) {
            this.state.currentFrame = 0;
            this.state.frameTimer = 0;
        }
        this.state.animation = newAnimation;

        // Determines the direction the character is facing.
        if (this.state.vx < 0) {
            this.state.facingLeft = true;
        } else if (this.state.vx > 0) {
            this.state.facingLeft = false;
        }
    }

    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Assigns the contextual health bar to the Angel.
     * @param {HealthBar} healthBar - The contextual health bar instance.
     */
    setHealthBar(healthBar) {
        this.healthBar = healthBar;
    }

    

    render(ctx) {
        if (!this.isReady || !this.camera) return;

        const currentAnimation = this.animations[this.state.animation];
        if (!currentAnimation || currentAnimation.frames.length === 0) {
            // If animation frames are not defined or are empty, do not attempt to animate.
            return;
        }

        animate(
            this.state, // Pass the original state
            this.image,
            currentAnimation.frames, // Pass the actual array of frames
            currentAnimation.frameDuration, // Pass the global frame duration for Angel
            ctx,
            this.camera           // Pass the camera object
        );
    }
}

        