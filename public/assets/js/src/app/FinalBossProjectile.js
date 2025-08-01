import { TILE_SIZE, MAP, PROJECTILE_SPEED } from "./config.js";

// --- FINAL BOSS PROJECTILE CONSTANTS ---

export const FINAL_BOSS_PROJECTILE_WIDTH = 26;
export const FINAL_BOSS_PROJECTILE_HEIGHT = 26;
export const FINAL_BOSS_PROJECTILE_SPRITE_X = 562;
export const FINAL_BOSS_PROJECTILE_SPRITE_Y = 1332;
export const FINAL_BOSS_PROJECTILE_FRAME_COUNT = 14;
export const FINAL_BOSS_PROJECTILE_SPRITE_SPACING = 4;

export const FINAL_BOSS_PROJECTILE_IMPACT_WIDTH = 44;
export const FINAL_BOSS_PROJECTILE_IMPACT_HEIGHT = 44;
export const FINAL_BOSS_PROJECTILE_IMPACT_SPRITE_X = 20;
export const FINAL_BOSS_PROJECTILE_IMPACT_SPRITE_Y = 1322;
export const FINAL_BOSS_PROJECTILE_IMPACT_FRAME_COUNT = 11;
export const FINAL_BOSS_PROJECTILE_IMPACT_SPRITE_SPACING = 4;

/**
 * FinalBossProjectile Class - Represents the final boss's projectile.
 */
export default class FinalBossProjectile {
    constructor(x, y, direction, creator, vy = 0) { // Add vy parameter with default value
        this.creator = creator; // Store the creator of the projectile
        this.state = {
            x,
            y,
            direction,
            width: FINAL_BOSS_PROJECTILE_WIDTH,
            height: FINAL_BOSS_PROJECTILE_HEIGHT,
            vx: PROJECTILE_SPEED * 1.2 * direction, // Slightly faster
            vy: vy, // Store vertical velocity
            shouldBeRemoved: false,
            isExploding: false,
            currentFrame: 0,
            frameTimer: 0,
            frameDuration: 0.08,
            shouldBeRemoved: false,
            isExploding: false,
            currentFrame: 0,
            frameTimer: 0,
            frameDuration: 0.08,
        };

        this.image = new Image();
        this.image.src = './assets/FinalBoss.png'; // Placeholder, change to FinalBoss.png

        this.isReady = false;
        this.image.onload = () => { this.isReady = true; };
    }

    update(dt, plumber, angel) {
        if (this.state.isExploding) {
            this.updateImpact(dt);
            return;
        }

        this.move(dt);
        this.updateAnimation(dt);
        this.checkCollisions(plumber, angel);
    }

    updateImpact(dt) {
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= this.state.frameDuration) {
            this.state.currentFrame++;
            this.state.frameTimer = 0;
            if (this.state.currentFrame >= FINAL_BOSS_PROJECTILE_IMPACT_FRAME_COUNT) {
                this.state.shouldBeRemoved = true;
            }
        }
    }

    move(dt) {
        this.state.x += this.state.vx * dt;
        this.state.y += this.state.vy * dt; // Apply vertical movement
    }

    updateAnimation(dt) {
        this.state.frameTimer += dt;
        if (this.state.frameTimer >= this.state.frameDuration) {
            this.state.currentFrame = (this.state.currentFrame + 1) % FINAL_BOSS_PROJECTILE_FRAME_COUNT;
            this.state.frameTimer = 0;
        }
    }

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

    startImpact() {
        this.state.isExploding = true;
        this.state.currentFrame = 0;
        this.state.frameTimer = 0;
        this.state.frameDuration = 0.05;
        this.state.width = FINAL_BOSS_PROJECTILE_IMPACT_WIDTH;
        this.state.height = FINAL_BOSS_PROJECTILE_IMPACT_HEIGHT;
        this.state.x -= (FINAL_BOSS_PROJECTILE_IMPACT_WIDTH - FINAL_BOSS_PROJECTILE_WIDTH) / 2;
        this.state.y -= (FINAL_BOSS_PROJECTILE_IMPACT_HEIGHT - FINAL_BOSS_PROJECTILE_HEIGHT) / 2;
        if (this.audioManager) { this.audioManager.playSound('diffusion-effect'); } // Projectile impact sound
    }

    checkCharacterCollision(character) {
        if (!character || this.state.isExploding) return;

        // Ignore collision with the creator of the projectile
        if (this.creator && character === this.creator) {
            return;
        }

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
                character.takeDamage(30); // Final boss projectile deals more damage
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
            sx = FINAL_BOSS_PROJECTILE_IMPACT_SPRITE_X + (this.state.currentFrame * (FINAL_BOSS_PROJECTILE_IMPACT_WIDTH + FINAL_BOSS_PROJECTILE_IMPACT_SPRITE_SPACING));
            sy = FINAL_BOSS_PROJECTILE_IMPACT_SPRITE_Y;
            sWidth = FINAL_BOSS_PROJECTILE_IMPACT_WIDTH;
            sHeight = FINAL_BOSS_PROJECTILE_IMPACT_HEIGHT;
        } else {
            sx = FINAL_BOSS_PROJECTILE_SPRITE_X + (this.state.currentFrame * (FINAL_BOSS_PROJECTILE_WIDTH + FINAL_BOSS_PROJECTILE_SPRITE_SPACING));
            sy = FINAL_BOSS_PROJECTILE_SPRITE_Y;
            sWidth = FINAL_BOSS_PROJECTILE_WIDTH;
            sHeight = FINAL_BOSS_PROJECTILE_HEIGHT;
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
