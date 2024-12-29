/**
 * @author Nathan
 */

//const URL = "http://localhost:8080/";

let inputs = document.querySelectorAll('.combinaison'); //les inputs contenant les points des combinaisons
//ajout d'un event listener à tous les input qui permet de gérer les affectations des dés
inputs.forEach(input => {
    input.addEventListener('click', (event) => {
        if(event.target.value != ""){
            socket.emit('inputValue', { value: event.target.value, idInput: event.target.id, gameId: gameId, playerId: playerId});
        }
    })
})

let des = document.querySelectorAll('.des'); //emplacement des dés du joueur
//ajout d'un event listener à tous les dés pour permettre de les garder ou non
document.querySelector('.table').addEventListener('click', (event) => {
    if (event.target.classList.contains('des')) {
        event.target.classList.toggle('libre');
        event.target.classList.toggle('selected');
        verifDesTousGardes();
    }
});

let button = document.getElementById('roll'); //bouton permettant de lancer les dés
//ajout d'un event listener au bouton de lancés qui permet de lancer les dés
button.addEventListener('click', actionRoll);

document.addEventListener('DOMContentLoaded', async () => {
    const donnees = localStorage.getItem('donneesJoueur');
    if(donnees){
        socket.emit('reloadPage', gameId);
    } else{
       const donneesJoueur = {
            listeDes: [],
            listeDesGardes: [],
            listePointsCombi: [],
            listePointsObt: [],
            scoreSecSup: 0,
            scoreSecInf: 0,
            scoreTot: 0,
            nbRoll: 0,
            nbDouzhee: 0,
            position: position
        }
        localStorage.setItem('donneesJoueur', donneesJoueur);
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

function updateInfo(info){
    const donneesJoueur = localStorage.getItem('donneesJoueur');
    if(info.listeDes){
        donneesJoueur.listeDes = setListeDes(donneesJoueur.listeDesGardes);
    } else if(info.decrementRoll){
        donneesJoueur.nbRoll -= 1;
    } else if(info.listeDesGardes){
        donneesJoueur.listeDesGardes = info.listeDesGardes;
    } else if(info.listePointsCombi){
        donneesJoueur.listePointsCombi = info.listePointsCombi;
    } else if(info.listePointsObt){
        donneesJoueur.listePointsObt[info.index] = info.listePointsObt;
    } else if(info.scoreSecSup){
        donneesJoueur.scoreSecSup = info.scoreSecSup;
    } else if(info.scoreSecInf){
        donneesJoueur.scoreSecInf = info.scoreSecInf;
    }

    localStorage.setItem('donnneesJoueur', donneesJoueur);
}

socket.on('reloadPage', () => {
    const donneesJoueur = localStorage.getItem('donneesJoueur');

    if(donneesJoueur.listePointsObt.length !== 0 || donneesJoueur.listePointsCombi.length !== 0){
        socket.emit('transmitionPoints', {gameId: gameId, listePointsCombi: donneesJoueur.listePointsCombi, listePointsObt: donneesJoueur.listePointsObt, position: donneesJoueur.position});
    }

    if(donneesJoueur.listeDes.length !== 0){
        socket.emit('transmitionDes', {gameId: gameId, listeDes: donneesJoueur.listeDes});
    }
});

socket.on('transmitionPoints', (data) => {
    let valueSrc;
    if(data.listePointsObt[0] !== 0){
        valueSrc = data.listePointsObt[0];
    } else{
        valueSrc = data.listePointsCombi[0];
    }

    const id = `${data.position - 1}`;
    const inputElements = document.getElementById(id);

    if(inputElements.value !== valueSrc){
        affichePoints({listePointsObt: data.listePointsObt, listePointsCombi: data.listePointsCombi, position: data.position});
    }
});

socket.on('transmitionDes', (data) => {
    if(data.listeDes[0] !== parseInt(des[0].textContent)){
        for(let i = 0; i < 5; i++){
            des[i].textContent = data.listeDes[i];
        }
    }
});

socket.on('inputValue', (data) => {
    if(data.playerId === playerId){
        updateInfo({listePointsObt: data.value, index: data.index});
    }

    let inputElements = document.getElementById(data.idInput);
    inputElements.placeholder = "-1";
    inputElements.disabled = true;

    //ajoutScore({ target: inputElements });
    resetManche();
});

/**
 * @brief Permet d'afficher les dés du joueur en vérifiant si un dé est sélectionné ou non
 * @param {Object} data liste des dés du joueur avec les dés qu'il faut garder
 */
socket.on('afficheDes', (data) => {
    afficheListeDes({ listeDes: data.listeDes, desGardes: data.desGardes });
});

/**
 * @brief Permet d'afficher les points disponibles des combinaisons
 * @param {Object} data
 */
socket.on('affichePointsCombinaisons', (result) => {
    const donneesJoueur = localStorage.getItem('donneesJoueur');
    const pointsCombinaisons = result.pointsCombinaisons;

    if(data.playerId === playerId){
        updateInfo({listePointsCombi: pointsCombinaisons});
    }

    if (pointsCombinaisons[12] !== 0) {
        nbDouzhee++;
        if (pointsCombinaisons[12] === 50 && inputs[12].value == 50) {
            inputs[12].value = parseInt(inputs[12].value) + 25; // Ajout de 25 points
            if (result.playerId === playerId) {
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
        const nbJoueurs = nbPlayers;
        const y = result.position + (nbJoueurs * i) - 1;

        if (inputs[y].placeholder !== "-1" || result.position !== donneesJoueur.position) {
            if (!result.reset) {
                inputs[y].value = pointsCombinaisons[i];
            } else {
                inputs[y].value = '';
            }
        }
    }
});

function setListeDes(desGardes){
    let listeDes = [...desGardes];
        
    while (listeDes.length < 5) {
        let de = new Dice();
        listeDes.push(de.getFace());
    }

    return listeDes;
}

function afficheListeDes(data){
    const listeDes = data.listeDes;
    const desGardes = data.desGardes;

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

function affichePoints(data){
    data.listePointsObt.forEach((pointsObt, index) => {
        const id = `${data.position + (nbPlayers * index) - 1}`;
        const inputElements = document.getElementById(id);

        let value;
        if(pointsObt !== 0){
            inputElements.placeholder = "-1";
            inputElements.disabled = true;
            value = pointsObt;
        } else{
            value = data.listePointsCombi[index];
        }
        inputElements.value = value;
    })
}

function actionRoll(){
    verifDesTousGardes()
    if(!button.disabled){
        const desAGarder = gardeDes(); // constante représentant les dés gardés par le joueur
        updateInfo({listeDesGardes: desAGarder}); // stocke la liste des dés gardés par le joueur
        updateInfo({listeDes: true}); // stocke la liste des dés du joueur

        const donneesJoueur = localStorage.getItem('donneesJoueur');
    
        // affiche les dés du joueur à tout le monde
        socket.emit('afficheDes', { desGardes: desAGarder, listeDes: donneesJoueur.listeDes, gameId: gameId});
    
        activeInput(); // active tous les input afin que le joueur marque ses points
    
        // calcule toutes les combinaisons possibles avec les dés du joueur et les affiche
        socket.emit('calculCombinaisons', { listeDes: donneesJoueur.listeDes, playerId: playerId, position: position, reset: false, gameId: gameId});
    
        updateInfo({decrementRoll: true}); // décrémente le nombre de roll du joueur
        verifRoll();
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
            if(!isNaN(de.textContent)) {
                desGardes.push(parseInt(de.textContent));
            }
            
        }
    })

    return desGardes;
}

/**
 * @brief Permet de vérifier si le joueur garde tous les dés pour désactiver le bouton de lancés
 */
function verifDesTousGardes(){
    const donneesJoueur = localStorage.getItem('donneesJoueur');
    let nbDesGardes = 0;
    const nbRoll = donneesJoueur.nbRoll;
    des.forEach(de => {
        if(de.classList.contains("selected")){
            nbDesGardes++;
        }
    })
    if(nbDesGardes == 5){
        desactiveButtonRoll();
    } else if(nbRoll != 0){
        button.disabled = false;
    }
}

function verifRoll(){
    const donneesJoueur = localStorage.getItem('donneesJoueur');
    const nbRoll = donneesJoueur.nbRoll;
    if(nbRoll === 0){
        desactiveButtonRoll();
    }
}

function desactiveButtonRoll(){
    button.disabled = true;
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
        updateInfo({scoreSecSup: parseInt(event.target.value)});

        if(getInfo('scoreSecSup') > 62){
            updateInfo({scoreSecSup: 25});
        }
    } else{
        updateInfo({scoreSecInf: parseInt(event.target.value)});
    }

    const donneesJoueur = localStorage.getItem('donneesJoueur');
    if(donneesJoueur.scoreTot >= 300){
        //zikette pour ajouter un succès
    }
}

/**
 * @brief Permet de rénitialiser la manche
 */
function resetManche(){
    updateInfo({listeDes: []});

    //libère tous les dés
    des.forEach(de => {
        if (de.classList.contains('selected')) {
            de.classList.replace('selected', 'libre');
        }        
        de.innerHTML = '';
    })

    const donneesJoueur = localStorage.getItem('donneesJoueur');
    socket.emit('calculCombinaisons', { listeDes: donneesJoueur.listeDes, playerId: playerId, position: position, reset: true, gameId: gameId});

    activeRoll();

    desactiveInput();
}