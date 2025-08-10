import { TILE_SIZE, MAP, PROJECTILE_SPEED } from "./config.js";

// Constants for fireball sprite
export const FIREBALL_WIDTH = 8;
export const FIREBALL_HEIGHT = 8;
export const FIREBALL_SPRITE_X = 172;
export const FIREBALL_SPRITE_Y = 77;
export const FIREBALL_FRAME_COUNT = 4;
export const FIREBALL_SPRITE_SPACING = 2;

// Constants for explosion sprite
export const EXPLOSION_WIDTH = 16;
export const EXPLOSION_HEIGHT = 16;
export const EXPLOSION_SPRITE_X = 172;
export const EXPLOSION_SPRITE_Y = 88;
export const EXPLOSION_FRAME_COUNT = 3;
export const EXPLOSION_SPRITE_SPACING = 2;

/**
 * Projectile Class - Represents a magical fireball.
 * Manages its movement, animation, collisions, and lifecycle.
 */
export default class Projectile {
    constructor(x, y, direction, vy = 0) {
        this.state = {
            x,
            y,
            direction,
            width: FIREBALL_WIDTH,
            height: FIREBALL_HEIGHT,
            vx: PROJECTILE_SPEED * direction,
            vy: vy, // Vertical velocity
            shouldBeRemoved: false,
            isExploding: false,
            currentFrame: 0,
            frameTimer: 0,
            frameDuration: 0.1, // Fireball animation is fast.
        };

        this.image = new Image();
        this.image.src = './assets/images/plumber/fireball.png';

        this.isReady = false;
        this.image.onload = () => { this.isReady = true; };
    }

    /**
     * Updates the projectile's state.
     * @param {number} dt - Delta time.
     * @param {Plumber} plumber
     * @param {Angel} angel
     * @param {Boss} boss
     */
    update(dt, plumber, angel, boss, finalBoss) {
        if (this.state.isExploding) {
            this.updateExplosion(dt);
            return;
        }

        this.move(dt);
        this.updateAnimation(dt);
        this.checkCollisions(plumber, angel, boss, finalBoss);
    }

    /**
     * Updates the explosion animation and marks the projectile for removal.
     * @param {number} dt 
     */
    updateExplosion(dt) {
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= this.state.frameDuration) {
            this.state.currentFrame++;
            this.state.frameTimer = 0;
            if (this.state.currentFrame >= EXPLOSION_FRAME_COUNT) {
                this.state.shouldBeRemoved = true;
            }
        }
    }

    /**
     * Moves the projectile.
     * @param {number} dt 
     */
    move(dt) {
        this.state.x += this.state.vx * dt;
        this.state.y += this.state.vy * dt;
    }

    /**
     * Updates the fireball animation frame.
     * @param {number} dt 
     */
    updateAnimation(dt) {
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= this.state.frameDuration) {
            this.state.currentFrame = (this.state.currentFrame + 1) % FIREBALL_FRAME_COUNT;
            this.state.frameTimer = 0;
        }
    }

    /**
     * Checks for collisions with the map and characters.
     */
    checkCollisions(plumber, angel, boss, finalBoss) {
        // Collision with the map.
        const tileX = Math.floor(this.state.x / TILE_SIZE);
        const tileY = Math.floor(this.state.y / TILE_SIZE);
        if (MAP[tileY] && MAP[tileY][tileX] === 1) {
            this.startExplosion();
            return;
        }

        // Collision with characters.
        this.checkCharacterCollision(plumber);
        this.checkCharacterCollision(angel);
        this.checkCharacterCollision(boss);
        this.checkCharacterCollision(finalBoss);
    }

    /**
     * Initiates the explosion animation.
     */
    startExplosion() {
        this.state.isExploding = true;
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        this.state.frameDuration = 0.2; // Explosion is slower.
        this.state.width = EXPLOSION_WIDTH;
        this.state.height = EXPLOSION_HEIGHT;
        this.state.x -= (EXPLOSION_WIDTH - FIREBALL_WIDTH) / 2;
        this.state.y -= (EXPLOSION_HEIGHT - FIREBALL_HEIGHT) / 2;
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
            this.startExplosion();
            if (character.takeDamage) {
                character.takeDamage(10); // Inflicts 10 damage.
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
            sx = EXPLOSION_SPRITE_X + (this.state.currentFrame * (EXPLOSION_WIDTH + EXPLOSION_SPRITE_SPACING));
            sy = EXPLOSION_SPRITE_Y;
            sWidth = EXPLOSION_WIDTH;
            sHeight = EXPLOSION_HEIGHT;
        } else {
            sx = FIREBALL_SPRITE_X + (this.state.currentFrame * (FIREBALL_WIDTH + FIREBALL_SPRITE_SPACING));
            sy = FIREBALL_SPRITE_Y;
            sWidth = FIREBALL_WIDTH;
            sHeight = FIREBALL_HEIGHT;
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