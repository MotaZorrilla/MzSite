/**
 * HealthBar Class - Represents a health bar for a character.
 * It is responsible for drawing the health bar above the character, reflecting its current health.
 */
export default class HealthBar {
    /**
     * @param {object} character - The character this health bar belongs to.
     */
    constructor(character) {
        this.character = character;
        this.width = 30;
        this.height = 4;
        this.offsetY = -5;
        this.displayDuration = 2; // Duration in seconds the bar is shown after taking damage.
        this.displayTimer = 0;    // Timer to control visibility.
    }

    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Changes the character this health bar is associated with.
     * @param {object} newCharacter - The new target character.
     */
    setTarget(newCharacter) {
        this.character = newCharacter;
    }

    /**
     * Updates the health bar's visibility timer.
     * @param {number} dt - Delta time.
     */
    update(dt) {
        if (this.displayTimer > 0) {
            this.displayTimer -= dt;
        }
    }

    /**
     * Activates the health bar's visibility for a short period.
     */
    show() {
        this.displayTimer = this.displayDuration;
    }

    /**
     * Draws the health bar on the canvas.
     * @param {CanvasRenderingContext2D} ctx 
     */
    render(ctx) {
        // Do not render if character does not exist, camera is not assigned, character is dead, or timer is not active.
        if (!this.character || !this.camera || this.character.state.isDead || this.displayTimer <= 0) return;
        if (!this.character || !this.camera || this.character.state.isDead || this.displayTimer <= 0) return;

        const charState = this.character.state;

        // --- POSITION CALCULATION ---
        const barX = charState.x - this.camera.x + (charState.width / 2) - (this.width / 2);
        const barY = charState.y + this.offsetY;

        // --- BAR DRAWING ---
        ctx.fillStyle = 'red';
        ctx.fillRect(barX, barY, this.width, this.height);

        const healthPercentage = charState.health / charState.maxHealth;
        const currentHealthWidth = this.width * healthPercentage;
        ctx.fillStyle = 'lime';
        ctx.fillRect(barX, barY, currentHealthWidth, this.height);

        ctx.strokeStyle = 'black';
        ctx.lineWidth = 1;
        ctx.strokeRect(barX, barY, this.width, this.height);
    }
}
