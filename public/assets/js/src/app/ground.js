import {MAP, TILE_SIZE} from "./config.js";

/**
 * Ground Class - Represents the solid ground of the game.
 * It is responsible for drawing ground blocks based on the map configuration.
 */
export default class Ground {
    constructor() {
        // Creates a new image object for the ground tileset.
        this.image = new Image();
        this.image.src = './assets/Tileset.png';

        // Flag to know if the tileset image has been loaded.
        this.isReady = false;

        // When the image loads, sets the isReady flag to true.
        this.image.onload = () => {
            this.isReady = true;
        }
    }

    /**
     * Sets the reference to the camera object.
     * @param {Camera} camera - The game camera instance.
     */
    setCamera(camera) {
        this.camera = camera;
    }

    /**
     * Draws the ground on the canvas.
     * @param {CanvasRenderingContext2D} ctx - The 2D canvas context.
     */
    render(ctx) {
        // Does not draw anything if the tileset image has not been loaded yet.
        if (!this.isReady) {
            return;
        }

        // Iterates through each row of the map.
        for (let row = 0; row < MAP.length; row++) {
            // Iterates through each column of the current row.
            for (let column = 0; column < MAP[row].length; column++) {
                // If the value in the map is 1, it means there is a ground block.
                if (MAP[row][column] === 1) {
                    
                    // Draws the ground tile at the corresponding position.
                    ctx.drawImage(
                        this.image,       // The tileset image.
                        0,                // X position of the tile in the tileset.
                        16,               // Y position of the tile in the tileset.
                        TILE_SIZE,        // Width of the tile in the tileset.
                        TILE_SIZE,        // Height of the tile in the tileset.
                        (column * TILE_SIZE) - this.camera.x, // X position on the canvas, adjusted by the camera.
                        (row * TILE_SIZE) - this.camera.y,  // Y position on the canvas, adjusted by the camera.
                        TILE_SIZE,        // Width of the tile on the canvas.
                        TILE_SIZE         // Height of the tile on the canvas.
                    );
                }
            }
        }
    }
};