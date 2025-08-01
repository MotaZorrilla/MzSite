import { CANVAS_WIDTH, CANVAS_HEIGHT, MAP_WIDTH, MAP_HEIGHT } from "./config.js";

/**
 * Camera Class - Manages the camera view in the game.
 * The camera follows a "target" object to keep it centered on the screen.
 */
export default class Camera {
    constructor() {
        this.x = 0;
        this.y = 0; // Added: Camera Y position
        this.target = null; // Object to follow (can be Plumber or Angel)
    }

    /**
     * Sets the object that the camera should follow.
     * @param {object} target - The character instance to follow.
     */
    setTarget(target) {
        this.target = target;
    }

    /**
     * Updates the camera's position to follow the target.
     */
    update() {
        if (!this.target) {
            
            return; // Do nothing if there is no target
        }

        // Calculates the new X position of the camera to center the target.
        let newX = this.target.state.x - CANVAS_WIDTH / 3;
        // Calculates the new Y position of the camera to center the target.
        let newY = this.target.state.y - CANVAS_HEIGHT / 2; // Center vertically

        
        

        // Limits the camera so it does not go out of the map boundaries.
        newX = Math.max(0, newX);
        newX = Math.min(newX, MAP_WIDTH - CANVAS_WIDTH);

        newY = Math.max(0, newY);
        newY = Math.min(newY, MAP_HEIGHT - CANVAS_HEIGHT); // Limit vertically

        

        this.x = newX;
        this.y = newY; // Update camera Y position
        
    }
}