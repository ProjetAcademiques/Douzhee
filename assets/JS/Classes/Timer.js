

class Timer {
    /**
     * @param {int} offset la durée du timer 
     */
    constructor(offset) {
        this.offset = offset
        interval = setInterval(offset, () => {
            this.offset--
        })
    }
}