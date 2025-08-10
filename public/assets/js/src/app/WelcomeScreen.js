/**
 * @file Defines the WelcomeScreen class, which now functions as a selection menu.
 * It is responsible for rendering the start screen and managing player selection.
 */

import { CANVAS_WIDTH, CANVAS_HEIGHT } from "./config.js";

export default class WelcomeScreen {
    constructor() {
        this.image = new Image();
        this.image.src = '/assets/images/plumber/PlumberBattleJS.png';

        this.isReady = false;
        this.image.onload = () => {
            this.isReady = true;
        }

        // Menu options
        this.options = [
            { id: 'plumber', text: 'Plumber' },
            { id: 'angel', text: 'Angel' },
        ];
        this.selectedOptionIndex = 0;

        // Font properties
        this.font = '16px Arial';
        this.selectedColor = 'yellow';
        this.defaultColor = 'white';
    }

    // No `update` needed for now, blinking logic is removed.
    update(dt) {}

    /**
     * Moves the menu selection up.
     */
    moveSelectionUp() {
        this.selectedOptionIndex = (this.selectedOptionIndex - 1 + this.options.length) % this.options.length;
    }

    /**
     * Moves the menu selection down.
     */
    moveSelectionDown() {
        this.selectedOptionIndex = (this.selectedOptionIndex + 1) % this.options.length;
    }

    /**
     * Returns the ID of the currently selected option.
     * @returns {string} - 'plumber' or 'angel'.
     */
    getSelection() {
        return this.options[this.selectedOptionIndex].id;
    }

    render(ctx) {
        if (!this.isReady) return;

        // 1. Draws the white background
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);

        // 2. Draws the welcome image aligned at the top
        const aspectRatio = this.image.width / this.image.height;
        let drawWidth = CANVAS_WIDTH;
        let drawHeight = drawWidth / aspectRatio;
        if (drawHeight > CANVAS_HEIGHT * 0.7) { // Limits height to leave space for the menu
            drawHeight = CANVAS_HEIGHT * 0.7;
            drawWidth = drawHeight * aspectRatio;
        }
        const x = (CANVAS_WIDTH - drawWidth) / 2;
        // Draws the welcome image aligned a bit lower
        const yImage = 30; // Top margin for the image
        ctx.drawImage(this.image, x, yImage, drawWidth, drawHeight);

        // 3. Draws the menu options
        ctx.textAlign = 'center';
        ctx.font = this.font;

        this.options.forEach((option, index) => {
            const isSelected = (index === this.selectedOptionIndex);
            ctx.fillStyle = isSelected ? this.selectedColor : this.defaultColor;
            ctx.strokeStyle = 'black';
            ctx.lineWidth = 3;

            // Adjusts Y position to lower the menu
            const yPos = CANVAS_HEIGHT - 80 + (index * 25);
            const textToDraw = (isSelected ? '> ' : '') + option.text + (isSelected ? ' <' : '');

            ctx.strokeText(textToDraw, CANVAS_WIDTH / 2, yPos);
            ctx.fillText(textToDraw, CANVAS_WIDTH / 2, yPos);
        });

        // 4. Draws the signature
        ctx.fillStyle = 'green';
        ctx.font = '12px Arial';
        ctx.textAlign = 'right';
        ctx.fillText('@MotaZorrilla', CANVAS_WIDTH - 10, CANVAS_HEIGHT - 10);
    }
}