/**
 * GlobalHealthBar Class - Represents a global health bar for a character,
 * always visible at the top of the screen.
 */
export default class GlobalHealthBar {
    /**
     * @param {object} character - The character this health bar belongs to.
     * @param {string} name - The name to display for the character.
     * @param {number} x - X position on the canvas for the global bar.
     * @param {number} y - Y position on the canvas for the global bar.
     */
    constructor(character, name, x, y) {
        this.character = character;
        this.name = name;
        this.x = x;
        this.y = y;
        this.width = 75;  // Width of the global health bar.
        this.height = 8;  // Height of the global health bar.
        this.fontSize = 10; // Font size for name and health.
        this.visible = true; // Bar is visible by default.
    }

    /**
     * Global health bars do not have complex update logic.
     * @param {number} dt - Delta time.
     */
    update(dt) {
        // No complex update logic needed for global bars.
    }

    /**
     * Changes the character this global health bar is associated with.
     * @param {object} newCharacter - The new target character.
     */
    setTarget(newCharacter) {
        this.character = newCharacter;
    }

    /**
     * Draws the global health bar on the canvas.
     * @param {CanvasRenderingContext2D} ctx 
     */
    render(ctx) {
        // Do not render if not visible, character does not exist, or is dead.
        if (!this.visible || !this.character || this.character.state.isDead) return;

        const charState = this.character.state;

        // --- BAR BACKGROUND DRAWING (RED) ---
        ctx.fillStyle = 'red';
        ctx.fillRect(this.x, this.y, this.width, this.height);

        // --- CURRENT HEALTH DRAWING (GREEN) ---
        const healthPercentage = charState.health / charState.maxHealth;
        const currentHealthWidth = this.width * healthPercentage;
        ctx.fillStyle = 'lime';
        ctx.fillRect(this.x, this.y, currentHealthWidth, this.height);

        // --- BORDER DRAWING ---
        ctx.strokeStyle = 'black';
        ctx.lineWidth = 1;
        ctx.strokeRect(this.x, this.y, this.width, this.height);

        // --- NAME AND HEALTH DRAWING ---
        ctx.font = `${this.fontSize}px Arial`;
        ctx.fillStyle = 'white';
        ctx.textAlign = 'left';
        ctx.textBaseline = 'top';
        ctx.fillText(`${this.name}: ${charState.health}`, this.x, this.y - this.fontSize - 2);
    }
}