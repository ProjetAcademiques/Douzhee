import {Dice} from "./Dice.js";
export class Player{

    #id;
    #score;
    #listeDes;

    constructor(id){
        this.#id = id;
        this.#score = 0;
        this.#listeDes = [];
    }

    getId(){
        return this.#id;
    }

    getScore(){
        return this.#score;
    }

    getListeDes(){
        return this.#listeDes;
    }

    getListeDesAtIndex(index){
        return this.#listeDes[index];
    }

    setScore(score){
        this.#score += score;
    }

    setListeDes(listeDesGardes) {
        this.#listeDes = [...listeDesGardes];
    
        while (this.#listeDes.length < 5) {
            let de = new Dice();
            this.#listeDes.push(de.getFace());
        }
    }
    
    resetTab(){
        this.#listeDes = [];
    }
}