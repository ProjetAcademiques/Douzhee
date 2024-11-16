import {Dice} from "./Dice.js";
export class Player{

    #id;
    #sectionSuperieure;
    #sectionInferieure;
    #listeDes;

    constructor(id){
        this.#id = id;
        this.#sectionSuperieure = 0;
        this.#sectionInferieure = 0;
        this.#listeDes = [];
    }

    getId(){
        return this.#id;
    }

    getSectionSuperieure(){
        return this.#sectionSuperieure;
    }

    getSectionInferieure(){
        return this.#sectionInferieure;
    }

    getListeDes(){
        return this.#listeDes;
    }

    getListeDesAtIndex(index){
        return this.#listeDes[index];
    }


    getScore(){
        return this.#sectionSuperieure + this.#sectionInferieure;
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

    ajoutSectionInferieure(score){
        this.#sectionInferieure += score;
    }

    ajoutSectionSuperieure(score){
        this.#sectionSuperieure += score;
    }
}