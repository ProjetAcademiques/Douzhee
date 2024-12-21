import { Player } from "./Classes/Player.js";
import { GameDataManager } from "./Classes/GameDataManager.js";

/**
 * @author Nathan
 */

let inputs = document.querySelectorAll('.combinaison'); //les inputs contenant les points des combinaisons
let button = document.getElementById('roll'); //bouton permettant de lancer les dés
let des = document.querySelectorAll('.des'); //emplacement des dés du joueur

let joueur = new Player(playerId, position);
let game = new GameDataManager(nbPlayers);

let nbRoll = 3; //nombre de lancés possible
let nbDouzhee = 0; //nombre de Douzhee effectués

//ajout d'un event listener à tous les input qui permet de gérer les affectations des dés
inputs.forEach(input => {
    input.addEventListener('click', (event) => {
        if(event.target.value != ""){
            socket.emit('inputValue', { value: event.target.value, idInput: event.target.id, gameId: gameId });
        }
    })
})

socket.on('inputValue', (data) => {
    let inputElements = document.getElementById(data.idInput);
    inputElements.placeholder = "-1";
    inputElements.disabled = true;

    //ajoutScore({ target: inputElements });
    resetManche();
});

//ajout d'un event listener à tous les dés pour permettre de les garder ou non
document.querySelector('.table').addEventListener('click', (event) => {
    if (event.target.classList.contains('des')) {
        event.target.classList.toggle('libre');
        event.target.classList.toggle('selected');
        verifDesTousGardes();
    }
});


//ajout d'un event listener au bouton de lancés qui permet de lancer les dés
button.addEventListener('click', () => {
    let desAGarder = gardeDes();

    activeInput();

    joueur.setListeDes(desAGarder);

    socket.emit('afficheDes', { desGardes: desAGarder, listeDes: joueur.getListeDes(), gameId: gameId});

    socket.emit('calculCombinaisons', { listeDes: joueur.getListeDes(), joueur: joueur, position: joueur.getPostion(), reset: false, gameId: gameId});

    decrementRoll();
});

/**
 * @brief Permet d'afficher les dés du joueur en vérifiant si un dé est sélectionné ou non
 * @param {Object} data liste des dés du joueur avec les dés qu'il faut garder
 */
socket.on('afficheDes', (data) => {
    let listeDes = data.listeDes;
    let desGardes = data.desGardes;

    des.forEach((de, i) => {
        if (i < desGardes.length) {
            de.innerHTML = desGardes[i];
            de.classList.replace("libre", "selected");
        } else {
            de.innerHTML = listeDes[i];
            de.classList.replace("selected", "libre");
        }
    });
})

/**
 * @brief Permet d'afficher les points disponibles des combinaisons
 * @param {Object} data
 */
socket.on('affichePointsCombinaisons', (result) => {
    const pointsCombinaisons = result.pointsCombinaisons;

    if (pointsCombinaisons[12] !== 0) {
        nbDouzhee++;
        if (pointsCombinaisons[12] === 50 && inputs[12].value == 50) {
            inputs[12].value = parseInt(inputs[12].value) + 25; // Ajout de 25 points
            if (result.joueur === joueur) {
                joueur.ajoutSectionInferieure(25);

                if (nbRoll === 3) {
                    // Succès pour le premier coup
                }
                if (nbDouzhee === 3) {
                    // Succès pour 3 Douzhee
                }
            }
        }
    }

    for (let i = 0; i < 13; i++) {
        const y = result.position + (game.getNbJoueurs() * i) - 1;
        if (inputs[y].placeholder !== "-1" || result.position !== joueur.getPostion()) {
            if (!result.reset) {
                inputs[y].value = pointsCombinaisons[i];
            } else {
                inputs[y].value = '';
            }
        }
    }
});


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
        joueur.ajoutSectionSuperieure(parseInt(event.target.value));

        if(joueur.getSectionSuperieure() > 62){
            joueur.ajoutSectionSuperieure(25);
        }
    } else{
        joueur.ajoutSectionInferieure(parseInt(event.target.value));
    }

    if(joueur.getScore() >= 300){
        //zikette pour ajouter un succès
    }
}

/**
 * @brief Permet de rénitialiser la manche
 */
function resetManche(){
    joueur.resetTab()

    //libère tous les dés
    des.forEach(de => {
        de.classList.replace("selected", "libre");
        de.innerHTML = '';
    })

    socket.emit('calculCombinaisons', { listeDes: joueur.getListeDes(), joueur: joueur, position: joueur.getPostion(), reset: true, gameId: gameId});

    activeRoll();

    desactiveInput();
}