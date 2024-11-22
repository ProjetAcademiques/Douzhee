/**
 * @brief Classe qui permet la gestion du jeu avec un stockage du nombre de joueurs et la vérification des régles avec les combinaisons
 * @author Nathan
 */
export class GameDataManager{

    #nbJoueurs; //nombre de joueurs dans la partie

    constructor(nbJoueurs){
        this.#nbJoueurs = nbJoueurs;
    }

    getNbJoueurs(){
        return this.#nbJoueurs;
    }

    /**
     * @brief Permet de vérifier toutes les combinaisons validées par les dés du joueur
     * @param {array Dice} listeDes liste des dés du joueur soumis à la vérification des combinaisons
     * @returns array[int] tableau avec tous les points des combinaisons
     */
    static checkCombinaisons(listeDes){
        let points = [];
    
        //initialisation des points des combinaisons
        let [un, deux, trois, quatre, cinq, six] = [0, 0, 0, 0, 0, 0];
        let [brelan, carre, full, petiteSuite, grandeSuite, douzhee] = [0, 0, 0, 0, 0, 0, 0];
        let chance = listeDes.reduce((acc, currentValue) => acc + currentValue, 0);
    
        //permet de compter les points pour la partie supérieure
        listeDes.forEach(de => {
            switch (de) {
                case 1: un++; break;
                case 2: deux+=2; break;
                case 3: trois+=3; break;
                case 4: quatre+=4; break;
                case 5: cinq+=5; break;
                case 6: six+=6; break;
            }
        });
    
        //permet de compter le nombre d'occurences de chaque chiffre
        let totalValeurs = listeDes.reduce((acc, currentValue) => {
            acc[currentValue] = (acc[currentValue] || 0) + 1;
            return acc;
        }, {});
        //on transforme totalValeurs en tableau associatif pour procéder aux vérifications
        Object.entries(totalValeurs).forEach(([value, count]) => {
            if(count >= 3) {
                brelan = listeDes.reduce((acc, currentValue) => acc + currentValue, 0);
            }
            if(count >= 4) {
                carre = listeDes.reduce((acc, currentValue) => acc + currentValue, 0);
            }
            if(count == 5) {
                douzhee = 50;
            }

            if(Object.values(totalValeurs).includes(3) && Object.values(totalValeurs).includes(2)) {
                full = 25;
            }
        });
    
        //on supprime les doublons de dés et on trie le tableau pour vérifier les suites
        let listeDesUnique = [...new Set(listeDes)];
        listeDesUnique.sort();
    
        let suite = 1;
        for (let i = 1; i < listeDesUnique.length; i++) {
            if(listeDesUnique[i] == listeDesUnique[i - 1] + 1) {
                suite++;
                if(suite >= 4) petiteSuite = 30;
                if(suite >= 5) grandeSuite = 40;
            } else {
                suite = 1;
            }
        }
    
        points.push(un, deux, trois, quatre, cinq, six, brelan, carre, full, petiteSuite, grandeSuite, douzhee, chance);
        return points;
    }
}