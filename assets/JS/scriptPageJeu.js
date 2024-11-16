import { Player } from "./Classes/Player.js";
import { GameDataManager } from "./Classes/GameDataManager.js";

/**
 * @author Nathan
 */

let inputs = document.querySelectorAll('.combinaison'); //les inputs contenant les points des combinaisons
let button = document.getElementById('roll'); //bouton permettant de lancer les dés
let des = document.querySelectorAll('.des'); //emplacement des dés du joueur

let joueur1 = new Player(1);
let game = new GameDataManager(1);

let nbRoll = 3; //nombre de lancés possible

//ajout d'un event listener à tous les input qui permet de gérer les affectations des dés
inputs.forEach(input => {
    input.addEventListener('click', (event) => {
        event.target.value = event.target.placeholder;
        event.target.placeholder = "-1";
        event.target.disabled = true;

        ajoutScore(event);
        resetManche();
    })
})

//ajout d'un event listener à tous les dés pour permettre de les garder ou non
des.forEach(de => {
    de.addEventListener("click", (event) => {
        if(event.target.classList.contains("libre")){
            event.target.classList.replace("libre" ,"selected");
        } else{
            event.target.classList.replace("selected" ,"libre");
        }

        verifDesTousGardes();
    })
})

//ajout d'un event listener au bouton de lancés qui permet de lancer les dés
button.addEventListener('click', () => {
    let desGardes = gardeDes();

    activeInput();

    joueur1.setListeDes(desGardes);

    afficheDes(desGardes);

    affichePointsCombinaisons();

    decrementRoll();
});

/**
 * @brief Permet d'afficher les dés du joueur en vérifiant si un dé est sélectionné ou non
 * @param {array Dice} desGardes liste des dés gardés par le joueur
 */
function afficheDes(desGardes){
    let listeDes = joueur1.getListeDes();

    des.forEach((de, i) => {
        if (i < desGardes.length) {
            de.innerHTML = desGardes[i];
            de.classList.replace("libre", "selected");
        } else {
            de.innerHTML = listeDes[i];
            de.classList.replace("selected", "libre");
        }
    });
}

/**
 * @brief Permet d'afficher les points disponibles des combinaisons
 * @param {bool} reset true = vide l'affichage / false = affiche normalement les points
 */
function affichePointsCombinaisons(reset = false){
    let pointsCombinaisons = GameDataManager.checkCombinaisons(joueur1.getListeDes());

    if(pointsCombinaisons[12] == 50 && inputs[12].value == 50){
        inputs[12].value += 25;
        joueur1.ajoutSectionInferieure(25);
    }

    for(let i = 0 ; i<13 ; i++){
        if(inputs[i].disabled != true){
            if(!reset){
                inputs[i].placeholder = pointsCombinaisons[i];
                inputs[i].value = pointsCombinaisons[i];
            } else{
                inputs[i].value = '';
            }
        }
    }
}

/**
 * Permet de réduire de 1 le nombre de lancés
 */
function decrementRoll(){
    nbRoll--;
    if(nbRoll == 0){
        button.disabled = true;
    }
}

/**
 * @brief Permet de stocker les dés gardés par le joueur
 * @returns array[Dice] liste des dés gardés par le joueur
 */
function gardeDes(){
    let desGardes = [];

    des.forEach(de => {
        if(de.classList.contains("selected")){
            desGardes.push(parseInt(de.textContent));
        }
    })

    return desGardes;
}

/**
 * @brief Permet de vérifier si le joueur garde tous les dés pour désactiver le bouton de lancés
 */
function verifDesTousGardes(){
    let nbDesGardes = 0;
    des.forEach(de => {
        if(de.classList.contains("selected")){
            nbDesGardes++;
        }
    })
    if(nbDesGardes == 5){
        button.disabled = true;
    } else if(nbRoll != 0){
        button.disabled = false;
    }
}

/**
 * @brief Permet d'activer tous les input qui n'ont pas encore été remplis
 */
function activeInput(){
    inputs.forEach(input => {
        if(input.placeholder != "-1"){
            input.disabled = false;
        }
    });
}

/**
 * @brief Désactive tous les input
 */
function desactiveInput(){
    inputs.forEach(input => {
        input.disabled = true;
    })
}

/**
 * rénitialise le nombre de lancés et active le bouton de lancés
 */
function activeRoll(){
    nbRoll = 3;
    button.disabled = false;
}

/**
 * @brief Met à jour le score du joueur en fonction de la section sélectionnée
 * @param {event} event input sélectionné pour être rempli
 */
function ajoutScore(event){
    if(event.target.name == 'section-superieure'){
        joueur1.ajoutSectionSuperieure(parseInt(event.target.value));

        if(joueur1.getSectionSuperieure() > 62){
            joueur1.ajoutSectionSuperieure(25);
        }
    } else{
        joueur1.ajoutSectionInferieure(parseInt(event.target.value));
    }
}

/**
 * @brief Permet de rénitialiser la manche
 */
function resetManche(){
    joueur1.resetTab()

    //libère tous les dés
    des.forEach(de => {
        de.classList.replace("selected", "libre");
        de.innerHTML = '';
    })

    affichePointsCombinaisons(true);

    activeRoll();

    desactiveInput();
}