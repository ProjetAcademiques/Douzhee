import { updateScoreJouerPartie, updateEstGagnantJouerPartie } from "./updateJouerPartie.js";
import { checkSuccess } from "./checkSucces.js";
import { updateEndOfGame } from "./updateFinDePartie.js";
import { updateNbDouzhee } from "./updateFinDePartie.js";
import { setIdPartieEnCours } from "./scriptIdPartieEnCours.js";
import { updateStatutPartie, updateScoreTotalPartie } from "./updatePartie.js";
/**
 * @author Nathan
 */

//const URL = "http://localhost:8080/";

let donneesJoueurSingleton = undefined;
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
        const donneesJoueur = getDonneesJoueur();
        if(verifInputOwner(donneesJoueur.position, event.target.id)){
            if(event.target.value !== ""){
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
    const donneesJoueur = getDonneesJoueur();
    const deClique = event.target.closest('.des');
    
    if(donneesJoueur.nbRoll < 3 && donneesJoueur.nbRoll > -1){
        if(donneesJoueur.listeDes[3] !== undefined){
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

document.addEventListener('DOMContentLoaded', async () => {
    let donneesJoueur = getDonneesJoueur();
    if (!donneesJoueur){
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
        localStorage.setItem('donneesJoueur', JSON.stringify(donneesJoueur));
        donneesJoueurSingleton = donneesJoueur;

        if(position === 1){
            updateStatutPartie(gameId, "En cours");
            socket.emit('finDeTour', {gameId: gameId, position: nbPlayers, nbJoueurs: nbPlayers});
        }
    } else{
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

function updateInfo(info) {
    const donneesJoueur = getDonneesJoueur();
    if (!donneesJoueur) {
        console.error("Les données du joueur sont introuvables.");
        return;
    }

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
    console.log('score section inferieure youpi : ' + donneesJoueur.scoreSecInf);

    localStorage.setItem('donneesJoueur', JSON.stringify(donneesJoueur));
}

socket.on('debutNvTour', (positionNvJoueur) => {
    if(positionNvJoueur === position){
        if(!verifCombiRemplies()){
            button.disabled = false;
            updateInfo({nbRoll: 3});
        } else{
            socket.emit('finDePartie', {gameId: gameId});
        }
    }
});

socket.on('finDePartie', () => {
    const donneesJoueur = getDonneesJoueur();

    socket.emit('transmitionScoreTot', {gameId: gameId, position: position, scoreTot: donneesJoueur.scoreTot});
});

let tabScoresJoueurs = new FormData();
socket.on('transmitionScoreTot', (data) => {
    tabScoresJoueurs.append(data.position, data.scoreTot);

    // Vérifie si le FormData contient des valeurs pour toutes les positions des joueurs
    let rempli = Array.from({length: nbPlayers}, (_, i) => tabScoresJoueurs.has(String(i + 1))).every(Boolean);

    if(rempli){
        finDePartie();
    }
});

socket.on('reloadPage', (playerId) => {
    const donneesJoueur = getDonneesJoueur();

    const nbRoll = donneesJoueur.nbRoll;
    if(nbRoll >= 0){
        reprisePartie(nbRoll);
    }

    if(donneesJoueur.listePointsObt.length !== 0 || donneesJoueur.listePointsCombi.length !== 0){
        socket.emit('transmitionPoints', {playerIdDest: playerId, gameId: gameId, listePointsCombi: donneesJoueur.listePointsCombi, listePointsObt: donneesJoueur.listePointsObt, position: donneesJoueur.position});
    }

    if(donneesJoueur.listeDes.length !== 0){
        socket.emit('transmitionDes', {playerIdDest: playerId, gameId: gameId, listeDes: donneesJoueur.listeDes, desGardes: donneesJoueur.listeDesGardes});
    }

    if(donneesJoueur.scoreSecSup !== 0 || donneesJoueur.scoreSecInf !== 0){
        socket.emit('transmitionScore', {playerIdDest: playerId, gameId: gameId, scoreSecSup: donneesJoueur.scoreSecSup, scoreSecInf: donneesJoueur.scoreSecInf, position: donneesJoueur.position});
    }
});

socket.on('transmitionPoints', (data) => {
    if(data.playerIdDest === playerId){
        affichePoints({listePointsObt: data.listePointsObt, listePointsCombi: data.listePointsCombi, position: data.position});
    }
});

socket.on('transmitionDes', (data) => {
    afficheListeDes(data);
});

socket.on('transmitionScore', (data) => {
    if(data.playerIdDest === playerId){
        afficheScore(data);
    }
})

socket.on('inputValue', async (data) => {
    const inputElements = document.getElementById(data.idInput);
    inputElements.placeholder = "-1";
    inputElements.disabled = true;
    inputElements.classList.add('obt');

    await new Promise(r => setTimeout(r, 12));

    if(data.playerId === playerId){
        updateInfo({listePointsObt: data.value, index: data.idInput});
        ajoutScore(inputElements);
        resetManche();
    }
});

socket.on('affichageScore', (data) => {
    afficheScore(data);
});

function reprisePartie(nbRoll){
    if(!verifCombiRemplies()){
        nbRoll === 3 ? false : activeInput();
        nbRoll < 3 ? activeDes() : false;
        button.disabled = false;
    } else{
        socket.emit('finDePartie', {gameId: gameId});
    }
}

function verifCombiRemplies(){
    const donneesJoueur = getDonneesJoueur();
    if (!donneesJoueur) {
        throw new Error('donneesJoueur est null');
    }
    for(let i = 0 ; i <= 12 ; i++){
        if(donneesJoueur.listePointsObt[i] === undefined || donneesJoueur.listePointsObt[i] === null){
            return false;
        }
    }
    return true;
}

function afficheScore(data){
    if(data.scoreSecSup){
        const idSup = 'idSup' + data.position;
        const thScoreSup = document.getElementById(idSup);
        thScoreSup.textContent = data.scoreSecSup;

        if(data.bonus === true){
            const bonus = document.querySelectorAll('.bonus');
            bonus[data.position-1].value = '35';
            bonus[data.position-1].classList.add('gagne');
        }
    } 
    if(data.scoreSecInf){
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

function verifInputOwner(position, id){
    const indexJoueur = id % nbPlayers;
    if(indexJoueur+1 !== position){
        return false;
    } else{
        return true;
    }
}

function setListeDes(desGardes){
    let listeDes = [...desGardes];
        
    while (listeDes.length < 5) {
        const de = Math.floor(Math.random() * 6) + 1;
        listeDes.push(de);
    }

    return listeDes;
}

function afficheListeDes(data){
    const listeDes = data.listeDes;
    const desGardes = data.desGardes;

    des.forEach((de, i) => {
        const img = de.querySelector('img');
        let nbDe;
        if(!data.reset){
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

function actionRoll(){
    verifDesTousGardes();
    verifRoll();
    if(!button.disabled){
        const desAGarder = gardeDes(); // constante représentant les dés gardés par le joueur
        updateInfo({listeDesGardes: desAGarder}); // stocke la liste des dés gardés par le joueur
        updateInfo({listeDes: true}); // stocke la liste des dés du joueur

        const donneesJoueur = getDonneesJoueur();
    
        // affiche les dés du joueur à tout le monde
        socket.emit('afficheDes', { desGardes: desAGarder, listeDes: donneesJoueur.listeDes, gameId: gameId, reset: false});
    
        activeInput(); // active tous les input afin que le joueur marque ses points
        activeDes();
    
        // calcule toutes les combinaisons possibles avec les dés du joueur et les affiche
        socket.emit('calculCombinaisons', { listeDes: donneesJoueur.listeDes, playerId: playerId, position: position, reset: false, gameId: gameId});
    
        updateInfo({decrementRoll: true}); // décrémente le nombre de roll du joueur
    }
}

/**
 * @brief Permet de stocker les dés gardés par le joueur
 * @returns array[Dice] liste des dés gardés par le joueur
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

function verifRoll(){
    const donneesJoueur = getDonneesJoueur();
    const nbRoll = donneesJoueur.nbRoll;
    if(nbRoll <= 0){
        desactiveButtonRoll();
    }
}

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

function activeDes(){
    des.forEach(de => {
        de.disabled = false;
    });
}

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
    updateInfo({listeDes: [], reset: true});
    updateInfo({listeDesGardes: []});
    updateInfo({listePointsCombi: []});

    const donneesJoueur = getDonneesJoueur();
    socket.emit('afficheDes', { desGardes: donneesJoueur.listeDesGardes, listeDes: donneesJoueur.listeDes, gameId: gameId, reset: true});
    socket.emit('calculCombinaisons', { listeDes: donneesJoueur.listeDes, playerId: playerId, position: position, reset: true, gameId: gameId});

    updateInfo({nbRoll: -1});

    desactiveInput();
    desactiveDes();

    socket.emit('finDeTour', {gameId: gameId, position: position, nbJoueurs: nbPlayers});
}

function triTab() {
    let tabScoresArray = [];
    tabScoresJoueurs.forEach((value, key) => {
        tabScoresArray.push({ position: key, scoreTot: value });
    });

    return tabScoresArray.sort((a, b) => b.scoreTot - a.scoreTot);
}

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
        console.log("succes numero " + succes);
        checkSuccess(succes);
    });
}

function checkSuccesAucunZero() {
    const donneesJoueur = getDonneesJoueur();
    if (!donneesJoueur.listePointsObt.includes(0)) {
        console.log("succes 0 0");
        checkSuccess(12);
    }
}

function finDePartie() {
    //affichage du classement
    let tabScoresTries = triTab();
    let msg = 'Classement des joueurs :\n';
    let scoreTotPartie = 0;
    tabScoresTries.forEach((player, index) => {
        msg += `Position ${index + 1}: Joueur ${player.position} avec un score de ${player.scoreTot}\n`;
        scoreTotPartie += player.scoreTot;
        if(index === 0 && parseInt(player.position) === position){
            console.log('je suis premier ' + position);
            updateEstGagnantJouerPartie(gameId);
        }
    });

    //Check des succes
    checkSuccesAucunZero();
    checkSuccesScore();

    //Mise à jour de la BD
    const donneesJoueur = getDonneesJoueur();
    updateScoreJouerPartie(gameId, parseInt(donneesJoueur.scoreTot));
    updateNbDouzhee(donneesJoueur.nbDouzhee);
    updateEndOfGame(gameId);
    setIdPartieEnCours(0);
    if(position === 1){
        updateStatutPartie(gameId, "Terminée");
        updateScoreTotalPartie(gameId, scoreTotPartie);
    }

    //Procédures de fin de partie
    localStorage.removeItem('donneesJoueur');
    window.alert(msg);
    window.location.href = './index.php';
}