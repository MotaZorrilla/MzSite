import animate from "../core/animate.js";
import { applyAcceleration, applyDeceleration, applyMovement } from "../core/motion.js";
import {MAP, TILE_SIZE, PLUMBER_MAX_VELOCITY, PLUMBER_ACCELERATION, PLUMBER_FRICTION, GRAVITY, PLUMBER_JUMP_FORCE, CANVAS_WIDTH, CANVAS_HEIGHT, MAP_WIDTH, MAP_HEIGHT, GROUND_EPSILON, PLUMBER_AUTO_JUMP_DISTANCE, PLUMBER_AUTO_JUMP_DELAY, PLUMBER_ATTACK_DELAY, PLUMBER_MAX_BURST_SHOTS, PLUMBER_BURST_COOLDOWN_DURATION} from "./config.js";
import { FIREBALL_WIDTH, FIREBALL_HEIGHT } from "./Projectile.js";

/**
 * Class representing the Plumber character.
 */
export default class Plumber {
    /**
     * @param {number} x - Initial X position.
     * @param {number} y - Initial Y position.
     * @param {function} createProjectileCallback - Callback to create projectiles.
     */
    constructor(x, y, createProjectileCallback, audioManager) {
        this.createProjectile = createProjectileCallback;
        this.audioManager = audioManager; // Injects the audio manager
        
        this.attackCooldown = 0; // Attack cooldown.

        // The `state` object encapsulates all dynamic properties of the Plumber.
        this.state = {
            x,                          // X position.
            y,                          // Y position.
            direction: 0,               // Keyboard input direction (-1: left, 1: right, 0: idle).
            vx: 0,                      // Current X velocity.
            vy: 0,                      // Current Y velocity.
            height: TILE_SIZE,          // Sprite height.
            width: TILE_SIZE,           // Sprite width.
            isOnGround: false,          // Is it touching the ground?
            isAttacking: false,         // Is it in the process of attacking?
            animation: 'idle',          // Name of the current animation.
            facingLeft: true,           // Direction the sprite is facing.
            health: 100,                // Current health.
            maxHealth: 100,             // Maximum health.
            isDead: false,              // Is it dead?
            isPlayerControlled: true, // By default, player controls it
            playerFiredSignal: false,   // Flag to notify the other character's AI that the player has fired,
            
            aiAttackDelayTimer: 0,      // Timer for Plumber's AI attack delay.
            plumberAutoJumpTimer: 0,    // Timer for Plumber's AI auto-jump.
            playerIdleTimer: 0,         // Timer for player-controlled Plumber's inactivity.
            plumberIdleTimer: 0,        // New timer for Plumber's inactivity (for Angel's AI)
            shotsFiredCount: 0,         // Number of shots fired in the current burst.
            burstCooldownTimer: 0,      // Timer for the burst cooldown.
            currentFrame: 0,            // Index of the current animation frame.
            frameTimer: 0,              // Timer to control animation speed.
        }

        // Defines frames for each animation from the spritesheet.
        this.animations = {
            idle: [{ x: 1, y: 16, width: TILE_SIZE, height: TILE_SIZE }],
            run:[
                { x: 73, y: 16, width: TILE_SIZE, height: TILE_SIZE },
                { x: 1, y: 16, width: TILE_SIZE, height: TILE_SIZE },
                { x: 55, y: 16, width: TILE_SIZE, height: TILE_SIZE },
            ],
            jump: [{ x: 37, y: 16, width: TILE_SIZE, height: TILE_SIZE }]
        }

        this.frameDuration = 70; // Duration of each frame in milliseconds.

        // Loads the character spritesheet.
        this.image = new Image();
        this.image.src = './assets/plumber3.png';
        this.isReady = false;
        this.image.onload = () => { this.isReady = true; }

        // Assigns keyboard event listeners.
        document.addEventListener('keydown', this.onKeyDown.bind(this));
        document.addEventListener('keyup', this.onKeyUp.bind(this));
    }

    /**
     * Reduces the Plumber's health and manages its death state.
     * @param {number} amount - The amount of damage to inflict.
     */
    takeDamage(amount) {
        if (this.state.isDead) return; // Cannot take damage if already dead.
        this.state.health -= amount;

        if (this.state.health <= 0) {
            this.state.health = 0;
            this.state.isDead = true;
            // Additional game over logic could be added here.
        }

        // Displays the contextual health bar when taking damage.
        if (this.healthBar) {
            this.healthBar.show();
        }
    }

    /**
     * Handles key press events to control the Plumber.
     * @param {KeyboardEvent} event - The keyboard event.
     */
    onKeyDown(event) {
        if (!this.state.isPlayerControlled || this.state.isDead) return;

        const key = event.key.toLowerCase();

        switch (key) {
            case 'arrowleft':
                this.state.direction = -1; // Move left.
                this.state.playerIdleTimer = 0;
                this.state.isSitting = false;
                break;
            case 'arrowright':
                this.state.direction = 1; // Move right.
                this.state.playerIdleTimer = 0;
                this.state.isSitting = false;
                break;
            case 'arrowup':
                if (this.state.isOnGround) {
                    this.state.vy = -PLUMBER_JUMP_FORCE; // Apply jump force.
                    this.state.isOnGround = false;
                    this.state.playerIdleTimer = 0;
                    this.state.isSitting = false;
                }
                break;
            case 'control':
                if (this.attackCooldown <= 0 && this.state.burstCooldownTimer <= 0) {
                    this.state.isAttacking = true;
                    this.fireProjectile();
                    this.state.playerFiredSignal = true; // Notifies the other character's AI.
                    this.state.playerIdleTimer = 0;
                    this.state.isSitting = false;
                }
                break;
        }
    }

    /**
     * Handles the key release event.
     * @param {KeyboardEvent} event - The keyboard event.
     */
    onKeyUp(event) {
        if (!this.state.isPlayerControlled) return; // Ignores input if not player-controlled.

        const key = event.key.toLowerCase();
        if (key === 'arrowleft' || key === 'arrowright') {
            this.state.direction = 0; // Stops horizontal movement.
            this.state.playerIdleTimer = 0; // Resets inactivity timer when movement stops
            this.state.isSitting = false; // Stands up when movement stops
        } else if (key === 'control') {
            this.state.isAttacking = false;
            this.state.isFiring = false; // Reset firing flag when key is released
        }
    }

    /**
     * Creates and fires a projectile (fireball).
     */
    fireProjectile() {
        this.attackCooldown = PLUMBER_ATTACK_DELAY; // Sets cooldown using the constant.
        this.state.shotsFiredCount++;

        if (this.state.shotsFiredCount >= PLUMBER_MAX_BURST_SHOTS) {
            this.state.burstCooldownTimer = PLUMBER_BURST_COOLDOWN_DURATION;
            this.state.shotsFiredCount = 0; // Reset shots fired after burst cooldown is activated
        }

        const projectileX = this.state.facingLeft ? this.state.x - FIREBALL_WIDTH : this.state.x + this.state.width;
        const projectileY = this.state.y + (this.state.height / 2) - (FIREBALL_HEIGHT / 2);
        const direction = this.state.facingLeft ? -1 : 1;
        this.createProjectile(projectileX, projectileY, direction);
        this.audioManager.playSound('fire-ball'); // Plays the firing sound
    }

    /**
     * Main update method, called on each game frame.
     * @param {number} dt - Delta time, time elapsed since the last frame.
     */
    update(dt, angel) {
        // Manages attack cooldown.
        if (this.attackCooldown > 0) {
            this.attackCooldown -= dt;
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

        // Specific logic for AI or player control
        if (!this.state.isPlayerControlled) {
            // Handles Plumber's AI auto-jump delay timer
            if (this.state.plumberAutoJumpTimer > 0) {
                this.state.plumberAutoJumpTimer -= dt;
            }
            // Handles Plumber's AI attack delay timer
            if (this.state.aiAttackDelayTimer > 0) {
                this.state.aiAttackDelayTimer -= dt;
            }
            this.runAI(angel);
        } else { // Plumber is player-controlled
            const PLAYER_IDLE_SIT_THRESHOLD = 4; // Inactivity threshold for the player

            // Resets inactivity timer if there is movement or attack
            if (this.state.vx !== 0 || this.state.vy !== 0 || this.state.isAttacking) {
                this.state.playerIdleTimer = 0;
                this.state.isSitting = false; // Stands up if moving
            } else {
                this.state.playerIdleTimer += dt;
            }

            if (this.state.playerIdleTimer >= PLAYER_IDLE_SIT_THRESHOLD) {
                this.state.isSitting = true;
            } else {
                // If the player moves or attacks, stands up
                if (this.state.vx !== 0 || this.state.vy !== 0 || this.state.isAttacking) {
                    this.state.isSitting = false;
                }
            }
        }

        this.applyHorizontalPhysics(dt);
        this.applyVerticalPhysics(dt);

        this.computeAnimation();
        this.updateAnimationFrame(dt);

        
    }

    /**
     * Simple AI logic to follow another character.
     * @param {object} target - The character to follow (in this case, the Angel).
     */
    runAI(target) {
        if (!target) return;

        const distance = target.state.x - this.state.x;
        const followDistance = 80; // Distance to maintain (increased)

        // If the Plumber is sitting, AI does not act.
        if (this.state.isSitting) {
            this.state.direction = 0; // Ensure AI doesn't try to move if sitting
            return;
        }

        if (distance > followDistance) {
            this.state.direction = 1; // Move right
        } else if (distance < -followDistance) {
            this.state.direction = -1; // Move left
        } else {
            this.state.direction = 0; // Stop
        }

        // Auto-jump logic if target moves far away or there's an obstacle
        const autoJumpDistance = PLUMBER_AUTO_JUMP_DISTANCE; // Use the constant defined in config.js
        const obstacleAhead = this.isObstacleAhead(this.state.direction);

        if (this.state.isOnGround && this.state.plumberAutoJumpTimer <= 0 && (Math.abs(distance) > autoJumpDistance || obstacleAhead)) {
            // If there's an obstacle or Angel is too far, and Plumber is on the ground and timer allows, jump.
            this.state.vy = -PLUMBER_JUMP_FORCE;
            this.state.isOnGround = false;
            this.state.plumberAutoJumpTimer = PLUMBER_AUTO_JUMP_DELAY;
        }

        // Firing logic if Angel (player) fires and cooldown allows.
        if (target.state.playerFiredSignal && this.state.aiAttackDelayTimer <= 0) {
            this.fireProjectile();
            this.state.aiAttackDelayTimer = PLUMBER_ATTACK_DELAY;
        }
    }


    /**
     * Checks if there is a solid obstacle directly in front of the Plumber.
     * @param {number} direction - The direction to check (-1 for left, 1 for right).
     * @returns {boolean} - True if there is an obstacle, false otherwise.
     */
    isObstacleAhead(direction) {
        const checkDistance = TILE_SIZE; // Forward distance to search for obstacles
        const nextX = this.state.x + (direction * checkDistance);

        // Calculates the coordinates of the map cell to check.
        const tileX = Math.floor((nextX + (this.state.width / 2)) / TILE_SIZE);
        const tileY = Math.floor((this.state.y + this.state.height - 1) / TILE_SIZE); // Bottom part of the character

        // Ensures coordinates are within map boundaries.
        if (tileY < 0 || tileY >= MAP.length || tileX < 0 || tileX >= MAP[0].length) {
            return false; // Outside map is not an obstacle
        }

        // Checks if the map cell is a solid block.
        return MAP[tileY][tileX] === 1;
    }

    /**
     * Updates the current animation frame based on elapsed time.
     * @param {number} dt - Delta time.
     */
    updateAnimationFrame(dt) {
        this.state.frameTimer += dt;
        const currentAnimationFrames = this.animations[this.state.animation];
        if (currentAnimationFrames && currentAnimationFrames.length > 0) {
            if (this.state.frameTimer >= this.frameDuration / 1000) {
                this.state.frameTimer = 0;
                this.state.currentFrame = (this.state.currentFrame + 1) % currentAnimationFrames.length;
            }
        } else {
            this.state.currentFrame = 0; // Fallback if animation is not defined.
        }
    }

    /**
     * Manages horizontal physics: acceleration, friction, and map collisions.
     * @param {number} dt - Delta time.
     */
    applyHorizontalPhysics(dt) {
        // Calculates proposed velocity based on user input.
        let proposedVx = this.state.direction !== 0
            ? applyAcceleration(this.state.vx, PLUMBER_ACCELERATION, dt, this.state.direction, PLUMBER_MAX_VELOCITY)
            : applyDeceleration(this.state.vx, PLUMBER_FRICTION, dt);

        // Calculates the proposed horizontal position.
        let proposedX = applyMovement(this.state.x, proposedVx, dt);

        // Control points for collision detection.
        const headRow = Math.floor(this.state.y / TILE_SIZE);
        const footRow = Math.floor((this.state.y + this.state.height - 1) / TILE_SIZE);
        const leftCol = Math.floor(proposedX / TILE_SIZE);
        const rightCol = Math.floor((proposedX + this.state.width) / TILE_SIZE);

        // Right collision detection.
        if (proposedVx > 0) {
            if (MAP[headRow][rightCol] === 1 || MAP[footRow][rightCol] === 1) {
                proposedVx = 0;
                proposedX = (rightCol * TILE_SIZE) - this.state.width; // Aligns with the wall.
            }
        }

        // Left collision detection.
        if (proposedVx < 0) {
            if (MAP[headRow][leftCol] === 1 || MAP[footRow][leftCol] === 1) {
                proposedVx = 0;
                proposedX = (leftCol + 1) * TILE_SIZE; // Aligns with the wall.
            }
        }

        // Updates final velocity and position.
        this.state.vx = proposedVx;
        this.state.x = proposedX;

        // If not moving and on the ground, ensures velocity is exactly zero
        if (this.state.direction === 0 && this.state.isOnGround) {
            this.state.vx = 0;
        }

        // Limits position to map boundaries.
        if (this.state.x < 0) {
            this.state.x = 0;
            this.state.vx = 0;
        } else if (this.state.x + this.state.width > MAP_WIDTH) {
            this.state.x = MAP_WIDTH - this.state.width;
            this.state.vx = 0;
        }
    }

    /**
     * Manages vertical physics: gravity and collisions with ground and ceiling.
     * @param {number} dt - Delta time.
     */
    applyVerticalPhysics(dt) {
        // Applies gravity to vertical velocity.
        let proposedVy = applyAcceleration(this.state.vy, GRAVITY, dt);
        let proposedY = applyMovement(this.state.y, proposedVy, dt);

        // Control points for collision detection.
        const headRow = Math.floor(proposedY / TILE_SIZE);
        const footRow = Math.floor((proposedY + this.state.height) / TILE_SIZE);
        const leftCol = Math.floor(this.state.x / TILE_SIZE);
        const rightCol = Math.floor((this.state.x + this.state.width - 1) / TILE_SIZE);

        // Collision detection with the ground.
        if (proposedVy > 0) {
            if ((MAP[footRow] && MAP[footRow][leftCol] === 1) || (MAP[footRow] && MAP[footRow][rightCol] === 1)) {
                proposedVy = 0;
                proposedY = (footRow * TILE_SIZE) - this.state.height; // Aligns with the ground.
                this.state.isOnGround = true;
            } else {
                this.state.isOnGround = false;
            }
        }
        // Collision detection with the ceiling.
        else if (proposedVy < 0) {
            if ((MAP[headRow] && MAP[headRow][leftCol] === 1) || (MAP[headRow] && MAP[headRow][rightCol] === 1)) {
                proposedVy = 0;
                proposedY = (headRow + 1) * TILE_SIZE; // Aligns with the ceiling.
            }
        }

        // Updates final velocity and position.
        this.state.vy = proposedVy;
        this.state.y = proposedY;

        // Limits position to canvas boundaries (fall into void).
        if (this.state.y + this.state.height > CANVAS_HEIGHT) {
            this.state.y = CANVAS_HEIGHT - this.state.height;
            this.state.vy = 0;
            this.state.isOnGround = true;
        }
    }

    /**
     * Determines the correct animation to display based on the Plumber's current state.
     */
    computeAnimation() {
        let newAnimation = this.state.animation;

        if (!this.state.isOnGround) {
            newAnimation = 'jump';
        } else if (Math.abs(this.state.vx) > 0) {
            newAnimation = 'run';
        } else {
            newAnimation = 'idle';
        }

        // If the animation changes, the frame counter is reset to start from the beginning.
        if (newAnimation !== this.state.animation) {
            this.state.currentFrame = 0;
            this.state.frameTimer = 0;
            this.state.animation = newAnimation;
        }

        // Updates the direction the sprite is facing.
        if (this.state.vx < 0) {
            this.state.facingLeft = true;
        } else if (this.state.vx > 0) {
            this.state.facingLeft = false;
        }
    }

    /**
     * Injects the camera dependency into the Plumber.
     * @param {Camera} camera - The game camera instance.
     */
    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Assigns the contextual health bar to the Plumber.
     * @param {HealthBar} healthBar - The health bar instance.
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
     * Draws the Plumber on the canvas, calling the generic animation function.
     * @param {CanvasRenderingContext2D} ctx - The 2D canvas context.
     */
    render(ctx) {
        if (!this.isReady || !this.camera) return;

        animate(
            this.state,
            this.image,
            this.animations[this.state.animation],
            this.frameDuration,
            ctx,
            this.camera
        );
    }
};