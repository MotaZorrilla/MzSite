/**
 * @file AudioManager.js
 * @brief Audio Manager for loading and playing sounds and music.
 * Utilizes the Web Audio API for precise audio control.
 */

class AudioManager {
    /**
     * Initializes the AudioContext and master volume control.
     */
    constructor() {
        this.audioContext = null;
        this.masterGain = null;
        this.isSupported = true; // Assumes compatibility until proven otherwise

        // Compatibility with older browsers
        try {
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.masterGain = this.audioContext.createGain();
            this.masterGain.connect(this.audioContext.destination);
            
        } catch (e) {
            
            this.isSupported = false;
        }
        

        this.audioBuffers = {}; // Stores decoded audio buffers
        this.musicSource = null; // Reference to the current music source
        this.isReady = false; // Flag to indicate if sounds are loaded

        if (this.isSupported) {
            this.setVolume(0.5); // Default volume at 50%
        }
    }

    /**
     * Loads a list of audio files.
     * @param {Object.<string, string>} soundList - An object where the key is the sound name and the value is the path.
     * @returns {Promise<void>} A promise that resolves when all sounds have been loaded.
     */
    async loadSounds(soundList) {
        const soundPromises = [];

        for (const name in soundList) {
            const path = soundList[name];
            soundPromises.push(
                fetch(path)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status} for ${path}`);
                        }
                        return response.arrayBuffer();
                    })
                    .then(arrayBuffer => this.audioContext.decodeAudioData(arrayBuffer))
                    .then(decodedData => {
                        this.audioBuffers[name] = decodedData;
                    })
                    .catch(error => {
                        
                    })
            );
        }

        await Promise.all(soundPromises);
        this.isReady = true;
        
    }

    /**
     * Plays a sound effect by its name.
     * @param {string} name - The name of the sound to play.
     */
    playSound(name) {
        if (!this.isReady || !this.audioBuffers[name]) {
            
            return;
        }

        const source = this.audioContext.createBufferSource();
        source.buffer = this.audioBuffers[name];
        source.connect(this.masterGain);
        source.start(0);
    }

    /**
     * Plays a music track in a loop.
     * If music is already playing, it stops it first.
     * @param {string} name - The name of the music track to play.
     */
    playMusic(name) {
        if (this.musicSource) {
            this.stopMusic();
        }

        if (!this.isReady || !this.audioBuffers[name]) {
            
            return;
        }

        this.musicSource = this.audioContext.createBufferSource();
        this.musicSource.buffer = this.audioBuffers[name];
        this.musicSource.loop = true;
        this.musicSource.connect(this.masterGain);
        this.musicSource.start(0);
    }

    /**
     * Stops the current music playback.
     */
    stopMusic() {
        if (this.musicSource) {
            this.musicSource.stop();
            this.musicSource.disconnect();
            this.musicSource = null;
        }
    }

    /**
     * Sets the global game volume.
     * @param {number} volume - A value between 0 (mute) and 1 (maximum).
     */
    setVolume(volume) {
        if (!this.isSupported) return;
        if (this.masterGain) {
            this.masterGain.gain.setValueAtTime(volume, this.audioContext.currentTime);
        }
    }
}

export default AudioManager;