/**
 * @file OnScreenControls.js
 * @brief Implements on-screen controls for touch devices.
 * This class manages events from HTML UI buttons
 * and simulates keyboard events to interact with existing game logic.
 */
export default class OnScreenControls {
    /**
     * Constructor for the OnScreenControls class.
     * Initializes button mapping and sets up event listeners.
     */
    constructor() {
        /**
         * @property {object} buttonMapping - Mapping of HTML button IDs to the keys they will simulate.
         * Allows a single on-screen button to simulate one or more key presses.
         */
        this.buttonMapping = {
            'btn-up': 'ArrowUp',
            'btn-down': 'ArrowDown',
            'btn-left': 'ArrowLeft',
            'btn-right': 'ArrowRight',
            'btn-b': ['Control', 'f'], // Action button (Fire: Plumber: Control, Angel: f).
            'btn-a': 'Enter'        // Jump/interaction button.
        };

        /**
         * @property {object} activeTouches - Object to track active touch presses.
         * Stores the `identifier` of each touch to manage multiple simultaneous touches.
         */
        this.activeTouches = {};

        this.addListeners();
    }

    /**
     * Adds event listeners to all buttons defined in `buttonMapping`.
     * Configures both mouse events (`mousedown`, `mouseup`, `mouseleave`) and touch events (`touchstart`, `touchend`, `touchcancel`).
     */
    addListeners() {
        for (const buttonId in this.buttonMapping) {
            const element = document.getElementById(buttonId);
            if (element) {
                // Mouse events for click interaction.
                element.addEventListener('mousedown', (e) => this.handlePress(e, buttonId));
                element.addEventListener('mouseup', (e) => this.handleRelease(e, buttonId));
                element.addEventListener('mouseleave', (e) => this.handleRelease(e, buttonId));

                // Touch events for touch interaction.
                element.addEventListener('touchstart', (e) => this.handlePress(e, buttonId), { passive: false });
                element.addEventListener('touchend', (e) => this.handleRelease(e, buttonId), { passive: false });
                element.addEventListener('touchcancel', (e) => this.handleRelease(e, buttonId), { passive: false });
            }
        }
    }

    /**
     * Handles the "press" event (mousedown or touchstart) on a button.
     * Adds the 'pressed' class to the button and simulates a keydown event.
     * @param {Event} event - The DOM event object (MouseEvent or TouchEvent).
     * @param {string} buttonId - The ID of the HTML button that was pressed.
     */
    handlePress(event, buttonId) {
        event.preventDefault(); // Prevents default browser behavior (e.g., scroll).
        const key = this.buttonMapping[buttonId];
        const element = document.getElementById(buttonId);

        // Prevents processing multiple "press" events if the button is already marked as pressed.
        if (element.classList.contains('pressed')) return;

        element.classList.add('pressed'); // Visually marks the button as pressed.
        this.simulateKeyEvent('keydown', key); // Simulates the associated key press.

        // If it's a touch event, registers the touch ID for accurate tracking.
        if (event.changedTouches) {
            const touchId = event.changedTouches[0].identifier;
            this.activeTouches[touchId] = buttonId;
        }
    }

    /**
     * Handles the "release" event (mouseup, mouseleave, touchend, or touchcancel) on a button.
     * Removes the 'pressed' class from the button and simulates a keyup event.
     * @param {Event} event - The DOM event object (MouseEvent or TouchEvent).
     * @param {string} buttonId - The ID of the HTML button that was released.
     */
    handleRelease(event, buttonId) {
        event.preventDefault(); // Prevents default browser behavior.
        const key = this.buttonMapping[buttonId];
        const element = document.getElementById(buttonId);

        // Prevents processing "release" events if the button is not marked as pressed.
        if (!element.classList.contains('pressed')) return;

        // For touch events, verifies that the released touch corresponds to the active button.
        if (event.changedTouches) {
            const touchId = event.changedTouches[0].identifier;
            if (this.activeTouches[touchId] !== buttonId) {
                return;
            }
            delete this.activeTouches[touchId]; // Removes the active touch.
        }

        element.classList.remove('pressed'); // Removes the visual pressed mark.
        this.simulateKeyEvent('keyup', key); // Simulates the associated key release.
    }

    /**
     * Simulates a keyboard event (keydown or keyup) and dispatches it on the document.
     * Allows the game's input logic, which listens for keyboard events, to react to on-screen controls.
     * @param {string} type - The type of keyboard event to simulate ('keydown' or 'keyup').
     * @param {string|Array<string>} keys - The key(s) to simulate. Can be a string or an array of strings.
     */
    simulateKeyEvent(type, keys) {
        // Ensures `keys` is an array to iterate over it.
        const keysArray = Array.isArray(keys) ? keys : [keys];
        keysArray.forEach(key => {
            const event = new KeyboardEvent(type, {
                'key': key,
                'code': key, // 'code' is useful for identifying the physical key.
                'bubbles': true, // The event "bubbles" through the DOM.
                'cancelable': true // The event can be canceled.
            });
            document.dispatchEvent(event); // Dispatches the event on the document.
        });
    }
}
