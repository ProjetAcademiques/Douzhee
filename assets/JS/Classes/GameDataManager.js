export class GameDataManager{

    #nbJoueurs;

    constructor(nbJoueurs){
        this.#nbJoueurs = nbJoueurs;
    }

    static checkCombinaisons(listeDes){
        let points = [];
    
        let [un, deux, trois, quatre, cinq, six] = [0, 0, 0, 0, 0, 0];
        let [brelan, carre, full, petiteSuite, grandeSuite, douzhee] = [0, 0, 0, 0, 0, 0, 0];
        let chance = listeDes.reduce((acc, currentValue) => acc + currentValue, 0);
    
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
    
        let totalValeurs = listeDes.reduce((acc, currentValue) => {
            acc[currentValue] = (acc[currentValue] || 0) + 1;
            return acc;
        }, {});
        Object.entries(totalValeurs).forEach(([count]) => {
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