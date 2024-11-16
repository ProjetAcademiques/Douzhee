import { Player } from "./Classes/Player.js";
import { GameDataManager } from "./Classes/GameDataManager.js";

let inputs = document.querySelectorAll('.combinaison');
let button = document.getElementById('roll');
let des = document.querySelectorAll('.des');

let joueur1 = new Player(1);
let game = new GameDataManager(1);

let nbRoll = 3;

inputs.forEach(input => {
    input.addEventListener('click', (event) => {
        event.target.value = event.target.placeholder;
        event.target.placeholder = "-1";
        event.target.disabled = true;

        ajoutScore(event);
        resetJeu();
    })
})

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

button.addEventListener('click', () => {
    let desGardes = gardeDes();

    activeInput();

    joueur1.setListeDes(desGardes);

    afficheDes(desGardes);

    affichePointsCombinaisons();

    decrementRoll();
});

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


function affichePointsCombinaisons(vide = false){
    let pointsCombinaisons = GameDataManager.checkCombinaisons(joueur1.getListeDes());

    for(let i = 0 ; i<13 ; i++){
        if(inputs[i].disabled != true){
            if(!vide){
                inputs[i].placeholder = pointsCombinaisons[i];
                inputs[i].value = pointsCombinaisons[i];
            } else{
                inputs[i].value = '';
            }
        }
    }
}

function decrementRoll(){
    nbRoll--;
    if(nbRoll == 0){
        button.disabled = true;
    }
}

function gardeDes(){
    let desGardes = [];

    des.forEach(de => {
        if(de.classList.contains("selected")){
            desGardes.push(parseInt(de.textContent));
        }
    })

    return desGardes;
}

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

function activeInput(){
    inputs.forEach(input => {
        if(input.placeholder != "-1"){
            input.disabled = false;
        }
    });
}

function desactiveInput(){
    inputs.forEach(input => {
        input.disabled = true;
    })
}

function activeRoll(){
    nbRoll = 3;
    button.disabled = false;
}

function ajoutScore(event){
    if(event.target.name == 'section-superieure'){
        joueur1.ajoutSectionSuperieure(parseInt(event.target.value));
    } else{
        joueur1.ajoutSectionInferieure(parseInt(event.target.value));
    }
}

function resetJeu(){
    joueur1.resetTab()

    des.forEach(de => {
        de.classList.replace("selected", "libre");
        de.innerHTML = '';
    })

    affichePointsCombinaisons(true);

    activeRoll();

    desactiveInput();
}