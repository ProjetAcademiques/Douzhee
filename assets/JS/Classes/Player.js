import {Dice} from "./Dice.js";

/**
 * @brief Classe qui permet de gérer un joueur, avec ses dés et son score
 * @author Nathan
 */
export class Player{

    #id; //identifiant du joueur
    #sectionSuperieure; //score de la section supérieure (chiffres)
    #sectionInferieure; //score de la section inférieure (combinaison)
    #listeDes; //liste d'instance de Dice, correspond aux dés du joueur

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

    /**
     * @brief permet d'additionner la section supérieure et l'inférieure pour avoir le total
     * @returns score total du joueur
     */
    getScore(){
        return this.#sectionSuperieure + this.#sectionInferieure;
    }

    /**
     * @brief Permet de faire un nouveau tableau de dés avec ceux gardés par le joueur et des nouveaux
     * @param {array Dice} listeDesGardes liste des dés gardés par le joueur
     */
    setListeDes(listeDesGardes) {
        this.#listeDes = [...listeDesGardes];
    
        while (this.#listeDes.length < 5) {
            let de = new Dice();
            this.#listeDes.push(de.getFace());
        }
    }
    
    /**
     * @brief Permet de rénitialiser le tableau de dés
     */
    resetTab(){
        this.#listeDes = [];
    }

    /**
     * @brief Permet d'ajouter un score à la section inférieure
     * @param {int} score score ajouté à la section inférieure
     */
    ajoutSectionInferieure(score){
        this.#sectionInferieure += score;
    }

    /**
     * @brief Permet d'ajouter un score à la section supérieure
     * @param {int} score score ajouté à la section supérieure
     */
    ajoutSectionSuperieure(score){
        this.#sectionSuperieure += score;
    }
}