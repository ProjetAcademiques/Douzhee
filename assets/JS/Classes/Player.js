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

    setListeDes(listeDesGardes){
        this.#listeDes = [];
        let listeNvDes = [];
        for(let i = 5 ; i > listeDesGardes.length ; i--){
            let des = new Dice();
            listeNvDes.push(des.getFace());
        }
        this.#listeDes.push(...listeDesGardes, ...listeNvDes);
    }
}