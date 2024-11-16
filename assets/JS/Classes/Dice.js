/**
 * @brief Classe qui permet de créer un lancé de dé (un chiffre entre 1 et 6)
 * @author Nathan
 */
export class Dice{
    
    #face; //Résultat du lancé

    constructor(){
        this.#face = Math.floor(Math.random() * 6) + 1;
    }

    getFace(){
        return this.#face;
    }
}