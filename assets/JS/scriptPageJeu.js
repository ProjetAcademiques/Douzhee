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
    let i = 0;

    des.forEach(de => {
        if(listeDes.length != 0){
            de.innerHTML = listeDes[i];

            if(i < desGardes.length){
                de.classList.replace("libre" ,"selected");
            }
            i++;
        } else{
            de.innerHTML = [];
        }
    })
}

function affichePointsCombinaisons(){
    let pointsCombinaisons = GameDataManager.checkCombinaisons(joueur1.getListeDes());

    for(let i = 0 ; i<13 ; i++){
        console.log(inputs[i].disabled);
        if(inputs[i].disabled != true){
            inputs[i].placeholder = pointsCombinaisons[i];
            inputs[i].value = pointsCombinaisons[i];
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

function resetJeu(){
    joueur1.resetTab()

    afficheDes([0, 0, 0, 0, 0, 0]);

    activeRoll();

    desactiveInput();
}