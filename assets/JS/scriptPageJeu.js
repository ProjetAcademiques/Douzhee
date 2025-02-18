import { updateScoreJouerPartie, updateEstGagnantJouerPartie } from "./updateJouerPartie.js";
import { checkSuccess } from "./checkSucces.js";
import { updateEndOfGame } from "./updateFinDePartie.js";
import { updateNbDouzhee } from "./updateFinDePartie.js";
import { setPartieEnCours } from "./scriptIdPartieEnCours.js";
import { updateStatutPartie, updateScoreTotalPartie} from "./updatePartie.js";
/**
 * @author Nathan
 */

//const URL = "http://localhost:8080/";

let donneesJoueurSingleton = undefined;
/**
 * @brief Retourne les données du localstorage du joueur
 * @returns données du joueur sous forme d'objet
 */
function getDonneesJoueur() {
    if (donneesJoueurSingleton === undefined) {
        donneesJoueurSingleton = JSON.parse(localStorage.getItem('donneesJoueur'));
    }
    return donneesJoueurSingleton;
}

let inputs = document.querySelectorAll('.combinaison'); //les inputs contenant les points des combinaisons
//ajout d'un event listener à tous les input qui permet de gérer les affectations des dés
inputs.forEach(input => {
    input.addEventListener('click', (event) => {
        const donneesJoueur = getDonneesJoueur(); //Récupération des données du joueur
        if(verifInputOwner(donneesJoueur.position, event.target.id)){ //Vérification de l'appartenance de l'input
            if(event.target.value !== ""){
                //Envoie au serveur l'information de l'input séléctionné et des points obtenus
                socket.emit('inputValue', { value: event.target.value, idInput: event.target.id, gameId: gameId, playerId: playerId});
            }
        } else{
            window.alert('Petit coquin va');
        }
    })
})

let des = document.querySelectorAll('.des'); //emplacement des dés du joueur
//ajout d'un event listener à tous les dés pour permettre de les garder ou non
document.querySelector('.table').addEventListener('click', (event) => {
    const donneesJoueur = getDonneesJoueur(); //Récupération des données du joueur
    const deClique = event.target.closest('.des');
    
    if(donneesJoueur.nbRoll < 3 && donneesJoueur.nbRoll > -1){ //Vérifie si c'est au tour du joueur
        if(donneesJoueur.listeDes[3] !== undefined){ //Vérifie si les dés sont ceux du joueur
            deClique.classList.toggle('libre');
            deClique.classList.toggle('selected');
            verifDesTousGardes();
        } else{
            window.alert('Petit coquin va');
        }
    }
});


let button = document.getElementById('roll'); //bouton permettant de lancer les dés
//ajout d'un event listener au bouton de lancés qui permet de lancer les dés
button.addEventListener('click', actionRoll);

//Permet d'initialiser la partie avec le stockage en local
document.addEventListener('DOMContentLoaded', async () => {
    let donneesJoueur = getDonneesJoueur(); //Récupération des données du joueur
    if (!donneesJoueur){ //Vérifie si le joueur a déjà des données stockées sinon initialise le stockage
        donneesJoueur = {
            listeDes: [],
            listeDesGardes: [],
            listePointsCombi: [],
            listePointsObt: [],
            scoreSecSup: 0,
            bonusSecSup: false,
            scoreSecInf: 0,
            scoreTot: 0,
            nbRoll: -1,
            nbDouzhee: 0,
            position: position
        };
        //Stocke l'objet donneesJoueur en local
        localStorage.setItem('donneesJoueur', JSON.stringify(donneesJoueur));
        //Permet d'utiliser le design patern singleton
        donneesJoueurSingleton = donneesJoueur;

        if(position === 1){ //Vérifie si le joueur est premier
            updateStatutPartie(gameId, 1); //Change le statut de la partie (en cours)
            //Simule la fin de tour du dernier joueur pour faire commencer le premier
            socket.emit('finDeTour', {gameId: gameId, position: nbPlayers, nbJoueurs: nbPlayers});
        }
    } else{
        //S'il y a des données déjà stockées alors la page a étée reload
        socket.emit('reloadPage', {gameId: gameId, playerId: playerId});
    }
});

/*

FONCTIONS LIEES A REDIS

async function joinPartie(){
    try{
        const response = await fetch(`${URL}start-game`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                gameId,
                playerId,
                position
            }),
            mode: 'cors'
        });

        if(response.ok){
            const result = await response.json();
            console.log('Partie démarrée :', result);
        } else {
            throw new Error(`Erreur ${response.status}: ${response.statusText}`);
        }
    } catch(error){
        console.error('Erreur réseau :', error);
    }
}

async function getNbJoueurs(){
    try {
        const response = await fetch(`${URL}game-player-count?gameId=${gameId}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
            mode: 'cors'
        });
        const data = await response.json();
        console.log('Nombre de joueurs :', data);
        return data;
    } catch (error) {
        console.error('Erreur réseau :', error);
    }
}

async function getInfo(info){
    try{
        const response = await fetch(`${URL}get-player-info?gameId=${gameId}&playerId=${playerId}&info=${info}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
            mode: 'cors'
        });
        const data = await response.json();
        return data;
    } catch(error){
        console.error('Erreur réseau :', error);
    }
}

async function updateInfo(info){
    let action = {};
    if (info.listeDes) {
        action = { ...action, listeDes: info.listeDes };
    }
    if (info.decrementRoll) {
        action = { ...action, decrementRoll: true };
    }
    if (info.scoreSecSup) {
        action = { ...action, scoreSecSup: info.scoreSecSup };
    }
    if (info.scoreSecInf) {
        action = { ...action, scoreSecInf: info.scoreSecInf };
    }    

    try{
        const response = fetch(`${URL}update-player`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                gameId: gameId,
                playerId: playerId,
                action: action
            }),
            mode: 'cors'
        })

        if(response.ok){
            const data = await response.json();
            console.log(data);
        } else{
            throw new Error(`Erreur ${response.status}: ${response.statusText}`);
        }
    } catch(error){
        console.error('Erreur réseau :', error);
    }
}

*/

/**
 * @brief Permet de mettre à jour une donnée en local storage
 * @param {Object} info Objet contenant la valeur à modifier
 */
function updateInfo(info) {
    const donneesJoueur = getDonneesJoueur(); //Récupération des données
    if (!donneesJoueur) {
        console.error("Les données du joueur sont introuvables.");
        return;
    }

    //Vérification de toutes les données possiblement changées
    if(info.listeDes && !info.reset){
        donneesJoueur.listeDes = setListeDes(Array.isArray(donneesJoueur.listeDesGardes) ? donneesJoueur.listeDesGardes : []);
    } else if(info.reset && info.listeDes){
        donneesJoueur.listeDes = info.listeDes;
    } else if(info.decrementRoll !== undefined){
        donneesJoueur.nbRoll -= 1;
    } else if(info.listeDesGardes !== undefined){
        donneesJoueur.listeDesGardes = Array.isArray(info.listeDesGardes) ? info.listeDesGardes : [];
    } else if(info.listePointsCombi !== undefined){
        donneesJoueur.listePointsCombi = Array.isArray(info.listePointsCombi) ? info.listePointsCombi : [];
    } else if(info.listePointsObt !== undefined){
        const inputId = parseInt(info.index);
        const pointsIndex = Math.floor(inputId / nbPlayers);
        donneesJoueur.listePointsObt[pointsIndex] = info.listePointsObt;
    } else if(info.scoreSecSup !== undefined){
        donneesJoueur.scoreSecSup += info.scoreSecSup;
        donneesJoueur.scoreTot += info.scoreSecSup;
    } else if(info.scoreSecInf !== undefined){
        donneesJoueur.scoreSecInf += info.scoreSecInf;
        donneesJoueur.scoreTot += info.scoreSecInf;
    } else if(info.nbDouzhee !== undefined){
        donneesJoueur.nbDouzhee += 1;
        if(donneesJoueur.nbDouzhee > 1){
            donneesJoueur.listePointsObt[11] = parseInt(donneesJoueur.listePointsObt[11]) + 25;
        }
    } else if(info.bonusSecSup){
        donneesJoueur.bonusSecSup = true;
    } else if(info.nbRoll !== undefined){
        donneesJoueur.nbRoll = info.nbRoll;
    }

    localStorage.setItem('donneesJoueur', JSON.stringify(donneesJoueur));
}

// Permet d'initialiser le tour du joueur
socket.on('debutNvTour', (positionNvJoueur) => {
    if(positionNvJoueur === position){ // Vérifie si le joueur est bien le prochain à jouer
        // Vérifie si le joueur à rempli toutes les combinaisons, si c'est le cas on finit la partie, sinon on initialise son tour
        if(!verifCombiRemplies()){ 
            button.disabled = false; // Activation du bouton de lancés
            updateInfo({nbRoll: 3}); // Permet 3 lancés au joueur
        } else{
            socket.emit('finDePartie', {gameId: gameId});
        }
    }
});

// Permet de mettre fin à la partie en transmettant son score à tous les joueurs
socket.on('finDePartie', () => {
    const donneesJoueur = getDonneesJoueur();

    socket.emit('transmitionScoreTot', {gameId: gameId, position: position, scoreTot: donneesJoueur.scoreTot});
});

//Récupère le score total de tous les joueurs et lorsque c'est fait, déclenche la fin de partie
let tabScoresJoueurs = new FormData();
socket.on('transmitionScoreTot', (data) => {
    tabScoresJoueurs.append(data.position, data.scoreTot);

    // Vérifie si le FormData contient des valeurs pour toutes les positions des joueurs
    let rempli = Array.from({length: nbPlayers}, (_, i) => tabScoresJoueurs.has(String(i + 1))).every(Boolean);

    if(rempli){
        finDePartie();
    }
});

// Permet de procéder à la récupération des données perdues lors de rechargement de page
socket.on('reloadPage', (playerId) => {
    const donneesJoueur = getDonneesJoueur();

    const nbRoll = donneesJoueur.nbRoll;
    // Si le joueur a des lancés alors cela signifie que c'est à son tour donc cela lance la reprise du tour
    if(nbRoll >= 0){
        reprisePartie(nbRoll);
    }

    //Permet de transmettre ses combinaisons si elles ne sont pas vides
    if(donneesJoueur.listePointsObt.length !== 0 || donneesJoueur.listePointsCombi.length !== 0){
        socket.emit('transmitionPoints', {playerIdDest: playerId, gameId: gameId, listePointsCombi: donneesJoueur.listePointsCombi, listePointsObt: donneesJoueur.listePointsObt, position: donneesJoueur.position});
    }

    //Permet de transmettre ses dés s'ils ne sont pas vides
    if(donneesJoueur.listeDes.length !== 0){
        socket.emit('transmitionDes', {playerIdDest: playerId, gameId: gameId, listeDes: donneesJoueur.listeDes, desGardes: donneesJoueur.listeDesGardes});
    }

    //Permet de transmettre ses scores s'ils ne sont pas vides
    if(donneesJoueur.scoreSecSup !== 0 || donneesJoueur.scoreSecInf !== 0){
        socket.emit('transmitionScore', {playerIdDest: playerId, gameId: gameId, scoreSecSup: donneesJoueur.scoreSecSup, scoreSecInf: donneesJoueur.scoreSecInf, position: donneesJoueur.position});
    }
});

//Permet d'afficher les données des combinaisons reçues des autres joueurs
socket.on('transmitionPoints', (data) => {
    if(data.playerIdDest === playerId){
        affichePoints({listePointsObt: data.listePointsObt, listePointsCombi: data.listePointsCombi, position: data.position});
    }
});

//Permet d'afficher les données des dés reçus des autres joueurs
socket.on('transmitionDes', (data) => {
    afficheListeDes(data);
});

//Permet d'afficher les données des scores reçus des autres joueurs
socket.on('transmitionScore', (data) => {
    if(data.playerIdDest === playerId){
        afficheScore(data);
    }
})

// Permet de procéder à la validation d'une combinaison choisie et d'afficher le résultat pour tous les joueurs
socket.on('inputValue', async (data) => {
    // Récupération de l'input de la combinaison choisie et changement du CSS de l'input
    const inputElements = document.getElementById(data.idInput);
    inputElements.placeholder = "-1";
    inputElements.disabled = true;
    inputElements.classList.add('obt');

    await new Promise(r => setTimeout(r, 12));

    if(data.playerId === playerId){ // Vérifie si le joueur est celui qui a validé la combinaison
        updateInfo({listePointsObt: data.value, index: data.idInput}); // Met à jour les combinaisons obtenues du joueur
        ajoutScore(inputElements); // Ajout du score de la combinaison au score total et au score de sa section
        resetManche(); // Met fin à la manche du joueur
    }
});

// Permet d'afficher les scores reçus
socket.on('affichageScore', (data) => {
    afficheScore(data);
});

/**
 * @brief Permet de reprendre la partie du joueur qui a rechargé la page
 * @param {int} nbRoll nombre de lancés du joueur
 */
function reprisePartie(nbRoll){
    if(!verifCombiRemplies()){
        // Vérifie si le joueur a déjà fait un lancé, si oui alors on active tous ses input de combinaisons non obtenues
        nbRoll === 3 ? false : activeInput();
        // De même mais cette fois-ci on active la possibilité de garder les dés
        nbRoll < 3 ? activeDes() : false;
        // Active le bouton de lancés
        button.disabled = false;
    } else{
        socket.emit('finDePartie', {gameId: gameId});
    }
}

/**
 * @brief Vérifie si toutes les combinaisons sont remplies
 * @returns Retourne true si toutes les combinaisons sont remplies, false sinon
 */
function verifCombiRemplies(){
    const donneesJoueur = getDonneesJoueur();
    if (!donneesJoueur) {
        throw new Error('donneesJoueur est null');
    }
    // Parcours de toutes les combinaisons, si l'on tombe sur une combinaison vide alors on retourne false directement
    for(let i = 0 ; i <= 12 ; i++){
        if(donneesJoueur.listePointsObt[i] === undefined || donneesJoueur.listePointsObt[i] === null){
            return false;
        }
    }
    return true;
}

/**
 * @brief Affiche le score des sections inferieures et supérieures et du bonus si obtenu
 * @param {Object} data Objet contenant la position des scores à afficher, la valeur de ces scores et le bonus si obtenu
 */
function afficheScore(data){
    if(data.scoreSecSup){ // Vérifie s'il y a un score de la section supérieure
        const idSup = 'idSup' + data.position;
        const thScoreSup = document.getElementById(idSup);
        thScoreSup.textContent = data.scoreSecSup;

        if(data.bonus === true){
            const bonus = document.querySelectorAll('.bonus');
            bonus[data.position-1].value = '35';
            bonus[data.position-1].classList.add('gagne');
        }
    } 
    if(data.scoreSecInf){ // Vérifie s'il y a un score de la section inférieure
        const idInf = 'idInf' + data.position;
        const thScoreInf = document.getElementById(idInf);
        thScoreInf.textContent = data.scoreSecInf;
    }
}

/**
 * @brief Permet d'afficher les dés du joueur en vérifiant si un dé est sélectionné ou non
 * @param {Object} data liste des dés du joueur avec les dés qu'il faut garder
 */
socket.on('afficheDes', (data) => {
    afficheListeDes({ listeDes: data.listeDes, desGardes: data.desGardes, reset: data.reset });
});

/**
 * @brief Permet d'afficher les points disponibles des combinaisons
 * @param {Object} data
 */
socket.on('affichePointsCombinaisons', (result) => {
    const donneesJoueur = getDonneesJoueur();
    const pointsCombinaisons = result.pointsCombinaisons;

    if(result.playerId === playerId){
        updateInfo({listePointsCombi: pointsCombinaisons});
    }

    if(pointsCombinaisons[11] === 50){
        const index = (11 * nbPlayers) + (result.position - 1);
        if(result.playerId === playerId){
            updateInfo({nbDouzhee: true});

            if(donneesJoueur.nbRoll === 2){
                checkSuccess(10);
            }
            if(donneesJoueur.nbDouzhee === 3){
                checkSuccess(11);
            }
        }
        if(inputs[index].value !== '' && inputs[index].value !== '0'){
            inputs[index].value = parseInt(inputs[index].value) + 25; // Ajout de 25 points
            if(result.playerId === playerId){
                updateInfo({scoreSecInf: 25});

                socket.emit('affichageScore', {gameId: gameId, position: position, scoreSecInf: donneesJoueur.scoreSecInf});
            }
        }
    }

    for(let i = 0; i < 13; i++){
        const nbJoueurs = nbPlayers;
        const y = result.position + (nbJoueurs * i) - 1;

        if(inputs[y].placeholder !== "-1"){
            if(!result.reset){
                inputs[y].value = pointsCombinaisons[i];
            } else{
                inputs[y].value = '';
            }
        }
    }
});

/**
 * @brief Vérifie l'appartenance d'un input
 * @param {int} position position du joueur ayant cliqué
 * @param {int} id id de l'input cliqué
 * @returns true si l'input appartient bien au joueur, false sinon
 */
function verifInputOwner(position, id){
    const indexJoueur = id % nbPlayers;
    if(indexJoueur+1 !== position){
        return false;
    } else{
        return true;
    }
}

/**
 * @brief Permet de faire un lancé de dés en n'enlevant pas les dés gardés par le joueur
 * @param {Array<int>} desGardes liste des dés gardés par le joueur
 * @returns Retourne la liste des dés du joueur avec les nouveaux dés
 */
function setListeDes(desGardes){
    let listeDes = [...desGardes];
        
    while (listeDes.length < 5) {
        const de = Math.floor(Math.random() * 6) + 1;
        listeDes.push(de);
    }

    return listeDes;
}

/**
 * @brief Affiche les dés d'un joueur
 * @param {Object} Object contenant la liste des dés d'un joueur gardés et non gardés
 */
function afficheListeDes(data){
    const listeDes = data.listeDes;
    const desGardes = data.desGardes;

    des.forEach((de, i) => {
        const img = de.querySelector('img');
        let nbDe;
        if(!data.reset){ //Vérifie si la manche est terminée et qu'un reset doit-être fait
            //Ajoute les bonnes classes aux dés, s'ils sont séléctionnés ou non
            if(i < desGardes.length){
                nbDe = desGardes[i];
                de.classList.replace("libre", "selected");
            } else{
                nbDe = listeDes[i];
                de.classList.replace("selected", "libre");
            }
        } else{
            de.classList.replace("selected", "libre");
        }

        //Permet d'afficher les dés sous forme d'images
        let src;
        if(nbDe !== undefined){
            img.classList.remove('hidden');
            src = '../../assets/images/imgGames/de' + nbDe + '.png';
        } else{
            img.classList.add('hidden');
        }

        img.src = src;
    });
}

/**
 * @brief Permet d'afficher les combinaisons obtenues et non obtenues d'un joueur
 * @param {Object} data Objet contenant la liste des combinaisons obtenues et non obtenues
 */
function affichePoints(data){
    for(let i = 0 ; i <= 12 ; i++){
        const pointsObt = data.listePointsObt[i];
        const pointsCombi = data.listePointsCombi[i];

        const id = `${data.position + (nbPlayers * i) - 1}`;
        const inputElements = document.getElementById(id);

        let value = '';
        if(pointsObt !== undefined && pointsObt !== null){
            inputElements.placeholder = "-1";
            inputElements.disabled = true;
            inputElements.classList.add('obt');
            value = pointsObt;
        } else if(pointsCombi !== undefined){
            value = pointsCombi;
        }
        inputElements.value = value;
    }
}

/**
 * @brief fonction gérant le lancé de dés
 */
function actionRoll(){
    verifDesTousGardes(); // Vérifie si tous les dés sont gardés
    verifRoll(); // Vérifie si le joueur a des lancés disponibles
    if(!button.disabled){ //Vérifie si le bouton est désactivé
        const desAGarder = gardeDes(); // constante représentant les dés gardés par le joueur
        updateInfo({listeDesGardes: desAGarder}); // stocke la liste des dés gardés par le joueur
        updateInfo({listeDes: true}); // stocke la liste des dés du joueur

        const donneesJoueur = getDonneesJoueur();
    
        // affiche les dés du joueur à tout le monde
        socket.emit('afficheDes', { desGardes: desAGarder, listeDes: donneesJoueur.listeDes, gameId: gameId, reset: false});
    
        activeInput(); // active tous les input afin que le joueur marque ses points
        activeDes(); // active tous les dés pour pouvoir les garder
    
        // calcule toutes les combinaisons possibles avec les dés du joueur et les affiche
        socket.emit('calculCombinaisons', { listeDes: donneesJoueur.listeDes, playerId: playerId, position: position, reset: false, gameId: gameId});
    
        updateInfo({decrementRoll: true}); // décrémente le nombre de roll du joueur
    }
}

/**
 * @brief Permet de stocker les dés gardés par le joueur
 * @returns {Array<Dice>} liste des dés gardés par le joueur
 */
function gardeDes(){
    let desGardes = [];
    const donneesJoueur = getDonneesJoueur();

    des.forEach((de, index) => {
        if(de.classList.contains("selected")){
            desGardes.push(donneesJoueur.listeDes[index]);
        }
    })

    return desGardes;
}

/**
 * @brief Permet de vérifier si le joueur garde tous les dés pour désactiver le bouton de lancés
 */
function verifDesTousGardes(){
    const donneesJoueur = getDonneesJoueur();
    let nbDesGardes = 0;
    const nbRoll = donneesJoueur.nbRoll;
    des.forEach(de => {
        if(de.classList.contains("selected")){
            nbDesGardes++;
        }
    })
    if(nbDesGardes == 5){
        desactiveButtonRoll();
    } else if(nbRoll !== 0){
        button.disabled = false;
    }
}

/**
 * @brief Vérifie si le joueur a encore des lancés
 */
function verifRoll(){
    const donneesJoueur = getDonneesJoueur();
    const nbRoll = donneesJoueur.nbRoll;
    if(nbRoll <= 0){
        desactiveButtonRoll();
    }
}

/**
 * @brief Désactive le bouton de lancés
 */
function desactiveButtonRoll(){
    button.disabled = true;
}

/**
 * @brief Permet d'activer tous les input qui n'ont pas encore été remplis
 */
function activeInput() {
    inputs.forEach((input, index) => {
        const joueurIndex = index % nbPlayers;
        
        if(joueurIndex === position - 1 && input.placeholder !== "-1"){
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
    });
}

/**
 * @brief Active tous les dés pour pouvoir les garder
 */
function activeDes(){
    des.forEach(de => {
        de.disabled = false;
    });
}

/**
 * @brief Desactive tous les dés
 */
function desactiveDes(){
    des.forEach(de => {
        de.disabled = true;
    });
}

/**
 * @brief Met à jour le score du joueur en fonction de la section sélectionnée
 * @param {event} event input sélectionné pour être rempli
 */
function ajoutScore(inputElements){
    const value = parseInt(inputElements.value);
    const name = inputElements.name
    if(name === 'section-superieure'){
        updateInfo({scoreSecSup: value});
    } else{
        updateInfo({scoreSecInf: value});
    }

    const donneesJoueur = getDonneesJoueur();
    let scoreSecSup = donneesJoueur.scoreSecSup;
    let changement = false;
    if(!donneesJoueur.bonusSecSup && donneesJoueur.scoreSecSup > 62){
        updateInfo({scoreSecSup: 35});
        updateInfo({bonusSecSup: true});
        changement = true;
    }

    if(name === 'section-superieure'){
        if(changement){
            scoreSecSup += 35;
        }
        socket.emit('affichageScore', {gameId: gameId, position: position, scoreSecSup: scoreSecSup, bonus: changement});
    } else{
        socket.emit('affichageScore', {gameId: gameId, position: position, scoreSecInf: donneesJoueur.scoreSecInf});
    }
}

/**
 * @brief Permet de rénitialiser la manche
 */
function resetManche(){
    updateInfo({listeDes: [], reset: true}); // Vide la liste de dés
    updateInfo({listeDesGardes: []}); // Vide la liste de dés gardés
    updateInfo({listePointsCombi: []}); // Vide la liste des combinaisons disponibles

    const donneesJoueur = getDonneesJoueur();
    // Permet de supprimer les dés de l'affichage pour tous les joueurs
    socket.emit('afficheDes', { desGardes: donneesJoueur.listeDesGardes, listeDes: donneesJoueur.listeDes, gameId: gameId, reset: true});
    // Permet de supprimer les combinaisons disponibles pour tous les joueurs
    socket.emit('calculCombinaisons', { listeDes: donneesJoueur.listeDes, playerId: playerId, position: position, reset: true, gameId: gameId});

    // Met le nombre de lancés du joueur à -1
    updateInfo({nbRoll: -1});

    desactiveInput(); // Désactive tous les input
    desactiveDes(); // Désactive tous les dés

    // Permet de mettre fin à son tour
    socket.emit('finDeTour', {gameId: gameId, position: position, nbJoueurs: nbPlayers});
}

/**
 * @brief Permet de trier le tableau des scores afin de faire le classement de la partie
 * @returns Retourne le tableau des scores trié en fonction du podium
 */
function triTab() {
    let tabScoresArray = [];
    tabScoresJoueurs.forEach((value, key) => {
        tabScoresArray.push({ position: key, scoreTot: value });
    });

    return tabScoresArray.sort((a, b) => b.scoreTot - a.scoreTot);
}

/**
 * @brief Permet de vérifier les succés liés au score total et de les faire obtenir si le joueur à réussi à les faire
 */
function checkSuccesScore(){
    const donneesJoueur = getDonneesJoueur();

    let success = [];
    switch (true) {
        case (donneesJoueur.scoreTot >= 300):
            success = [6, 7, 8, 9];
            break;
        case (donneesJoueur.scoreTot >= 250):
            success = [6, 7, 8];
            break;
        case (donneesJoueur.scoreTot >= 200):
            success = [6, 7];
            break;
        case (donneesJoueur.scoreTot >= 150):
            success = [6];
            break;
    }

    success.forEach((succes) => {
        checkSuccess(succes);
    });
}

/**
 * @brief Permet de vérifier le succès de finir une partie sans avoir de 0 et de le faire obtenir s'il est réussi par le joueur
 */
function checkSuccesAucunZero() {
    const donneesJoueur = getDonneesJoueur();
    if (!donneesJoueur.listePointsObt.includes(0)) {
        checkSuccess(12);
    }
}

let finEffectuee = false;
/**
 * @brief Permet de faire les procédures de fin de partie
 */
async function finDePartie() {
    if(!finEffectuee){
        finEffectuee = true;
        // conception du classement
        let tabScoresTries = triTab();
        let msg = 'Classement des joueurs :\n';
        let scoreTotPartie = 0;

        const donneesJoueur = getDonneesJoueur();
        // Mise à jour des scores en base pour chaque joueur
        tabScoresTries.forEach((player, index) => {
            msg += `Position ${index + 1}: Joueur ${player.position} avec un score de ${player.scoreTot}\n`;
            scoreTotPartie += parseInt(player.scoreTot);

            // Mise à jour du gagnant
            if (index === 0 && parseInt(player.position) === position) {
                updateEstGagnantJouerPartie(gameId);
            }
        });

        // Check des succès
        checkSuccesAucunZero();
        checkSuccesScore();

        // Mise à jour du statut de la partie et du score total si le joueur actuel est le premier
        if (position === 1) {
            console.log(gameId, position, scoreTotPartie);
            updateStatutPartie(gameId, 2);
            updateScoreTotalPartie(gameId, scoreTotPartie);
        }
        await updateScoreJouerPartie(gameId, playerId, parseInt(donneesJoueur.scoreTot));

        // Suppression des données locales et affichage du classement
        localStorage.removeItem('donneesJoueur');
        window.alert(msg);
        //window.location.href = './index.php';
    }
}