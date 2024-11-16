export class Dice{
    
    #face;

    constructor(){
        this.#face = Math.floor(Math.random() * 6) + 1;
    }

    getFace(){
        return this.#face;
    }
}