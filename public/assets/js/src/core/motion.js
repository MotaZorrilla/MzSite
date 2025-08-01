/**
 * @file Contains pure functions for physics calculations.
 * These functions form the basis of the game's movement system, allowing
 * predictable physics management decoupled from entity logic.
 */

/**
 * Calculates the new velocity after applying constant acceleration over a time interval.
 * Limits the velocity to a maximum to prevent exceeding it.
 * @param {number} v - The current velocity (e.g., `state.vx`).
 * @param {number} a - The acceleration rate (units per second squared).
 * @param {number} dt - The delta time (in seconds).
 * @param {number} [dir=1] - The direction of acceleration (-1 or 1).
 * @param {number} [maxSpeed=Infinity] - The maximum allowed speed.
 * @returns {number} The calculated new velocity.
 */
export function applyAcceleration(v, a, dt, dir = 1, maxSpeed = Infinity) {
    const newV = v + a * dir * dt;
    // Limits velocity between -maxSpeed and +maxSpeed.
    return Math.max(Math.min(newV, maxSpeed), -maxSpeed);
}

/**
 * Calculates the new velocity after applying deceleration (friction).
 * Reduces the current velocity towards zero, without overshooting.
 * @param {number} v - The current velocity.
 * @param {number} a - The deceleration rate (friction).
 * @param {number} dt - The delta time (in seconds).
 * @returns {number} The new velocity, closer to zero.
 */
export function applyDeceleration(v, a, dt) {
    // If velocity is positive, reduces it towards 0. If negative, increases it towards 0.
    return v > 0
        ?   Math.max(0, v - a * dt) // Does not allow velocity to become negative.
        :   Math.min(0, v + a * dt); // Does not allow velocity to become positive.
}

/**
 * Calculates the new position of an object based on its current velocity (Euler Integration).
 * @param {number} p - The current position (e.g., `state.x`).
 * @param {number} v - The current velocity (e.g., `state.vx`).
 * @param {number} dt - The delta time (in seconds).
 * @returns {number} The calculated new position.
 */
export function applyMovement(p, v, dt) {
    return p + v * dt;
}