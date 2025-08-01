import { TILE_SIZE, MAP, PROJECTILE_SPEED } from "./config.js";

// --- TORCH CONSTANTS ---

// In-flight torch animation.
export const TORCH_WIDTH = 32;
export const TORCH_HEIGHT = 32;
export const TORCH_SPRITE_X = 5;
export const TORCH_SPRITE_Y = 334;
export const TORCH_FRAME_COUNT = 8;
export const TORCH_SPRITE_SPACING = 2;

// Torch impact animation.
export const TORCH_IMPACT_WIDTH = 32;
export const TORCH_IMPACT_HEIGHT = 32;
export const TORCH_IMPACT_SPRITE_X = 5;
export const TORCH_IMPACT_SPRITE_Y = 368;
export const TORCH_IMPACT_FRAME_COUNT = 6;
export const TORCH_IMPACT_SPRITE_SPACING = 2;

/**
 * Torch Class - Represents the torch projectile launched by the boss.
 */
export default class Torch {
    constructor(x, y, direction, audioManager, vy = 0) {
        this.audioManager = audioManager;
        this.state = {
            x,
            y,
            direction,
            width: TORCH_WIDTH,
            height: TORCH_HEIGHT,
            vx: PROJECTILE_SPEED * direction,
            vy: vy, // Store vertical velocity
            shouldBeRemoved: false,
            isExploding: false,
            currentFrame: 0,
            frameTimer: 0,
            frameDuration: 0.2,
            shouldBeRemoved: false,
            isExploding: false,
            currentFrame: 0,
            frameTimer: 0,
            frameDuration: 0.2,
        };

        this.image = new Image();
        this.image.src = './assets/boss.png'; // Uses the boss spritesheet.

        this.isReady = false;
        this.image.onload = () => { this.isReady = true; };
    }

    /**
     * Updates the torch's state.
     * @param {number} dt - Delta time.
     * @param {Plumber} plumber
     * @param {Angel} angel
     */
    update(dt, plumber, angel) {
        if (this.state.isExploding) {
            this.updateImpact(dt);
            return;
        }

        this.move(dt);
        this.updateAnimation(dt);
        this.checkCollisions(plumber, angel);
    }

    /**
     * Updates the impact animation and marks the torch for removal.
     * @param {number} dt 
     */
    updateImpact(dt) {
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= this.state.frameDuration) {
            this.state.currentFrame++;
            this.state.frameTimer = 0;
            if (this.state.currentFrame >= TORCH_IMPACT_FRAME_COUNT) {
                this.state.shouldBeRemoved = true;
            }
        }
    }

    /**
     * Moves the torch.
     * @param {number} dt 
     */
    move(dt) {
        this.state.x += this.state.vx * dt;
        this.state.y += this.state.vy * dt; // Apply vertical movement
    }

    /**
     * Updates the torch animation frame.
     * @param {number} dt 
     */
    updateAnimation(dt) {
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= this.state.frameDuration) {
            this.state.currentFrame = (this.state.currentFrame + 1) % TORCH_FRAME_COUNT;
            this.state.frameTimer = 0;
        }
    }

    /**
     * Checks for collisions with the map and characters.
     */
    checkCollisions(plumber, angel) {
        const tileX = Math.floor(this.state.x / TILE_SIZE);
        const tileY = Math.floor(this.state.y / TILE_SIZE);

        if (MAP[tileY] && MAP[tileY][tileX] === 1) {
            this.startImpact();
            return;
        }

        this.checkCharacterCollision(plumber);
        this.checkCharacterCollision(angel);
    }

    /**
     * Initiates the impact animation.
     */
    startImpact() {
        this.state.isExploding = true;
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        this.state.frameDuration = 0.2;
        this.state.width = TORCH_IMPACT_WIDTH;
        this.state.height = TORCH_IMPACT_HEIGHT;
        this.state.x -= (TORCH_IMPACT_WIDTH - TORCH_WIDTH) / 2;
        this.state.y -= (TORCH_IMPACT_HEIGHT - TORCH_HEIGHT) / 2;
        this.audioManager.playSound('torch-explosion'); // Torch explosion sound
    }

    /**
     * Checks collision with a specific character.
     * @param {object} character - The character to check.
     */
    checkCharacterCollision(character) {
        if (!character || this.state.isExploding) return;

        const proj = this.state;
        const char = character.state;

        if (
            proj.x < char.x + char.width &&
            proj.x + proj.width > char.x &&
            proj.y < char.y + char.height &&
            proj.y + proj.height > char.y
        ) {
            this.startImpact();
            if (character.takeDamage) {
                character.takeDamage(20); // The torch inflicts more damage.
            }
        }
    }

    setCamera(camera) {
        this.camera = camera;
    }

    render(ctx) {
        if (!this.isReady || !this.camera) return;

        let sx, sy, sWidth, sHeight;

        if (this.state.isExploding) {
            sx = TORCH_IMPACT_SPRITE_X + (this.state.currentFrame * (TORCH_IMPACT_WIDTH + TORCH_IMPACT_SPRITE_SPACING));
            sy = TORCH_IMPACT_SPRITE_Y;
            sWidth = TORCH_IMPACT_WIDTH;
            sHeight = TORCH_IMPACT_HEIGHT;
        } else {
            sx = TORCH_SPRITE_X + (this.state.currentFrame * (TORCH_WIDTH + TORCH_SPRITE_SPACING));
            sy = TORCH_SPRITE_Y;
            sWidth = TORCH_WIDTH;
            sHeight = TORCH_HEIGHT;
        }

        ctx.drawImage(
            this.image,
            sx, sy, sWidth, sHeight,
            this.state.x - this.camera.x,
            this.state.y,
            this.state.width,
            this.state.height
        );
    }
}
