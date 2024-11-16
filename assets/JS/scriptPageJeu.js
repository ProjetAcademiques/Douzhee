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
        event.target.disabled = true;
    })
})

let i =0;
des.forEach(de => {
    de.addEventListener("click", (event) => {
        event.target.classList.replace("libre" ,"selected");
        console.log(event.target.classList);
    })
})

button.addEventListener('click', () => {
    let des = document.querySelectorAll('.des');
    let desGardes = [];

    des.forEach(de => {
        if(de.classList.contains("selected")){
            desGardes.push(parseInt(de.textContent));
        }
    })

    joueur1.setListeDes(desGardes);
    afficheDes();

    affichePointsCombinaisons();

    nbRoll--;
    if(nbRoll == 0){
        button.disabled = true;
    }
});

function afficheDes(){
    let listeDes = joueur1.getListeDes();
    let i = 0;

    des.forEach(de => {
        de.innerHTML = listeDes[i];
        i++;
    })
}

function affichePointsCombinaisons(){
    let pointsCombinaisons = GameDataManager.checkCombinaisons(joueur1.getListeDes());

    pointsCombinaisons.forEach(pointsCombinaison => {
        inputs.forEach(input => {
            input.placeholder = pointsCombinaison;
            console.log(input.placeholder);
        })
    })
}