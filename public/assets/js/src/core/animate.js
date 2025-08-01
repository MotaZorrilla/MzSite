/**
 * @file Provides a generic rendering function for animated entities.
 * This function is reusable for any game object that has a spritesheet
 * and a compatible state and animation structure.
 */

/**
 * Renders a frame of an animation for a specific entity.
 * Handles frame selection, sprite orientation (left/right),
 * camera-relative rendering, and variable-sized sprite offsets.
 * @param {object} state - The entity's state (position, animation, etc.).
 * @param {HTMLImageElement} image - The spritesheet containing the frames.
 * @param {Array<object>} animationFrames - Array with frame data for the current animation.
 * @param {number} frameDuration - Duration of each frame (used for current frame calculation in entity logic).
 * @param {CanvasRenderingContext2D} ctx - The 2D canvas context.
 * @param {object} camera - The game camera for relative rendering.
 */
export default function animate(state, image, animationFrames, frameDuration, ctx, camera) {

    // Logic to handle non-looping animations, such as "death".
    // If the animation has finished, it ensures that the last frame continues to be rendered.
    let frameToRender = state.currentFrame;
    if (state.isDead && state.animation === 'death') {
        if (state.animationFinished) {
            frameToRender = animationFrames.length - 1;
        }
    }

    // Safety fallback: if there are no frames or the current frame is invalid, nothing is rendered.
    const currentFrameData = animationFrames[frameToRender];
    if (!currentFrameData) {
        return;
    }

    // Saves the context state to apply local transformations.
    ctx.save();

    // Calculates the rendering position, applying the camera offset and any
    // frame-specific offsets (useful for variable-sized sprites).
    const renderX = state.x - camera.x + (currentFrameData.xOffset || 0);
    const renderY = state.y + (currentFrameData.yOffset || 0);

    // Flips the sprite horizontally if the entity is not facing left.
    if (state.facingLeft) {
        ctx.translate(renderX, renderY);
    } else {
        // To flip, translate to the right edge of the sprite and scale with -1 on the X-axis.
        ctx.translate(renderX + currentFrameData.width, renderY);
        ctx.scale(-1, 1);
    }

    // Draws the current frame of the spritesheet on the canvas.
    ctx.drawImage(
        image,                      // The complete spritesheet.
        currentFrameData.x,         // sx: X position of the clip in the spritesheet.
        currentFrameData.y,         // sy: Y position of the clip in the spritesheet.
        currentFrameData.width,     // sWidth: Width of the clip.
        currentFrameData.height,    // sHeight: Height of the clip.
        0,                          // dx: Destination X position on the canvas (relative to translation).
        0,                          // dy: Destination Y position on the canvas (relative to translation).
        currentFrameData.width,     // dWidth: Width of the rendered image.
        currentFrameData.height     // dHeight: Height of the rendered image.
    );

    // Restores the context to the previous state, removing local transformations.
    ctx.restore();
}