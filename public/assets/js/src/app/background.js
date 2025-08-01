import { CANVAS_WIDTH, CANVAS_HEIGHT, FINAL_BOSS_BACKGROUND_START_X } from "./config.js";

/**
 * @class Background
 * @brief Manages the rendering of game backgrounds, including parallax effects
 * and specific animations for the final boss area.
 */
export default class Background {
    constructor() {
        // Loads the main background image with a parallax effect.
        this.image = new Image();
        this.image.src = './assets/BackgroundMountains.png';
        this.isReady = false;
        this.image.onload = () => { this.isReady = true; };

        // Loads the boss area background image, which includes animated elements.
        this.bossImage = new Image();
        this.bossImage.src = './assets/bossBg.png';
        this.isBossImageReady = false;
        this.bossImage.onload = () => {
            this.isBossImageReady = true;
            this.bossImageWidth = this.bossImage.naturalWidth;
            this.bossImageHeight = this.bossImage.naturalHeight;
        };

        this.camera = null;
        this.offsetX = 0;
        this.offsetY = -25;

        // Offset adjustments for the rendering position of the full boss background image.
        this.bossImageOffsetX = -11;
        this.bossImageOffsetY = -134;

        // Configuration of the torch animation parameters within the boss background.
        this.animation = {
            startX: 26,
            startY: 372,
            frameWidth: 215,
            frameHeight: 95,
            frameGapX: 9, // Horizontal spacing between frames in the spritesheet.
            frameGapY: 6, // Vertical spacing between rows of frames in the spritesheet.
            framesPerRow: 4, // Number of frames per row in the spritesheet.
            renderOffsetX: 80,
            renderOffsetY: 165,
            totalFrames: 8,
            frameDuration: .1,
            currentFrame: 0,
            frameTimer: 0
        };
    }

    /**
     * Assigns the camera instance for parallax calculation and visibility.
     * @param {Camera} camera - Game camera instance.
     */
    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Updates the background animation state.
     * @param {number} dt - Delta time (time elapsed since last frame) in seconds.
     */
    update(dt) {
        // Updates the animation frame timer.
        this.animation.frameTimer += dt;
        if (this.animation.frameTimer >= this.animation.frameDuration) {
            this.animation.frameTimer = 0;
            // Advances to the next frame and resets if the end of the sequence is reached.
            this.animation.currentFrame = (this.animation.currentFrame + 1) % this.animation.totalFrames;
        }
    }

    /**
     * Renders the background on the canvas context.
     * @param {CanvasRenderingContext2D} ctx - 2D rendering context of the canvas.
     */
    render(ctx) {
        if (!this.camera) {
            return; // Does not render if no camera is assigned.
        }

        // 1. Draws the main background with a parallax effect.
        if (this.isReady) {
            const parallaxFactor = 0.5;
            const backgroundX = -this.camera.x * parallaxFactor + this.offsetX;
            const backgroundY = -this.camera.y * parallaxFactor + this.offsetY;
            const startX = backgroundX % this.image.width;
            ctx.drawImage(this.image, startX, backgroundY, this.image.width, this.image.height);
            // Draws a second image to ensure continuous scrolling if necessary.
            if (startX + this.image.width < CANVAS_WIDTH) {
                ctx.drawImage(this.image, startX + this.image.width, backgroundY, this.image.width, this.image.height);
            }
        }

        // 2. Draws the final boss area background (full static image).
        if (this.isBossImageReady) {
            const worldX = FINAL_BOSS_BACKGROUND_START_X;
            const drawX = worldX - this.camera.x + this.bossImageOffsetX;
            const drawY = this.bossImageOffsetY;

            // Only draws if the boss image is within the visible canvas limits.
            if (drawX < CANVAS_WIDTH && drawX + this.bossImageWidth > 0) {
                ctx.drawImage(this.bossImage, drawX, drawY, this.bossImageWidth, this.bossImageHeight);

                // 3. Draws the torch animation overlaid on the boss background.
                const anim = this.animation;
                const frameX = anim.currentFrame % anim.framesPerRow;
                const frameY = Math.floor(anim.currentFrame / anim.framesPerRow);

                let sx = anim.startX + frameX * (anim.frameWidth + anim.frameGapX);
                const sy = anim.startY + frameY * (anim.frameHeight + anim.frameGapY);

                // 1px adjustment for specific frames to correct spritesheet alignment.
                if (anim.currentFrame === 3 || anim.currentFrame === 7) {
                    sx -= 1;
                }

                // Calculates the animation rendering position relative to the boss background.
                const renderX = drawX + anim.renderOffsetX;
                const renderY = drawY + anim.renderOffsetY;

                ctx.drawImage(
                    this.bossImage,     // Image source (spritesheet).
                    sx, sy, anim.frameWidth, anim.frameHeight, // Frame coordinates and dimensions in the spritesheet.
                    renderX, renderY, anim.frameWidth, anim.frameHeight // Drawing coordinates and dimensions on the canvas.
                );
            }
        }
    }
};
