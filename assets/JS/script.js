const speechBubble = document.getElementById('bulle');
const speechText = document.getElementById('Texte');
const flèche = document.getElementById('flèche');
const Valider = document.getElementById('Valider');
const Refuser = document.getElementById('Refuser');
const audio = document.getElementById('audio');
const messages = [ 'But du jeu : Obtenir le maximum de points en réalisant des combinaisons spécifiques avec 5 dés.','Nombre de joueurs : Le jeu peut être joué seul ou avec plusieurs joueurs','Déroulement d un tour :Chaque joueur a droit à 3 lancers de dés par touAprès chaque lancer, le joueur peut choisir de garder certains dés et de relancer les autres pour essayer dobtenir une meilleure combinaison.Au bout des 3 lancers  (ou moins si le joueur est satisfait de sa combinaison), il note son score sur la feuille','Combinaisons et points :Les combinaisons sont similaires au poker : paires, brelans (trois dés identiques), carrés (quatre dés identiques), full (trois dés identiques et deux autres identiques), petite suite (quatre dés consécutifs), grande suite (cinq dés consécutifs), et Douzhee (cinq dés identiques).Chaque combinaison a une valeur de points spécifique.','Fin de la partie : La partie se termine lorsque toutes les cases de la feuille de score sont remplies.','Gagnant : Le joueur avec le total de points le plus élevé gagne la partie.']
let index = 1;

function changeText(newText) {
    speechText.innerText = newText;
}
function showarrow(){
    flèche.style.display = "block";
}
function hideButton(button){
    button.style.display ="none";
}
function showButton(button){
    button.style.display ="block";
}
function hidearrow(){
    flèche.style.display = "none";
}


function move(){
    const firstMascotte = document.getElementById('FirstMascotte');
    firstMascotte.style.position = 'fixed';
    firstMascotte.style.right = '-100%'; // Commence hors de l'écran à droite

anime({
    targets: firstMascotte,
    right: '20%', // Déplace vers la gauche jusqu'à 10% du bord droit
    top: '50%', // Centre verticalement
    translateY: '-50%', // Ajuste pour un centrage parfait
    scale: [1.5, 1], // Effet de zoom qui réduit pour créer une transition stylée
    duration: 1200, // Durée de l'animation en millisecondes
    easing: 'easeOutExpo', // Effet de sortie douce
});
}
function showSecondMascotte() {
    const secondMascotte = document.getElementById('SecondMascotte');
    const firstMascotte = document.getElementById('FirstMascotte');
    const rect = firstMascotte.getBoundingClientRect();
    firstMascotte.style.display = "none"; // Masquer la première mascotte
    secondMascotte.style.position = "fixes";
    secondMascotte.style.display = "block"; // Afficher la deuxième mascotte
    secondMascotte.style.right = `${window.innerWidth - rect.right}px`;
    secondMascotte.style.top = `${rect.top}px`;
    anime({
        targets: secondMascotte,
        opacity: [0, 1],
        duration: 500,
        easing: 'easeInOutQuad'
    });
}
    


    document.addEventListener('DOMContentLoaded',move);

    Valider.addEventListener('click',() =>{
        hideButton(Refuser);
        hideButton(Valider);
        changeText(messages[0]);
        showarrow();
        showSecondMascotte();
        flèche.addEventListener('click',()=>{ 
            changeText(messages[index]);
            index++;
            if (index >= messages.length){
                changeText("Vous avez fini le tutoriel pour les règles");
                Valider.innerText = "Terminer";
                showButton(Valider);
                hidearrow();
                Valider.addEventListener('click',() =>{
                        window.location.href="http://localhost:63342/DOUZHEE/index.php?_ijt=v1ppdtli2cq1rp8vpr9rsjg3b7&_ij_reload=RELOAD_ON_SAVE"
                        index = 0;
                });
            
               }
        });
       
    });
    if (Refuser.addEventListener('click',() =>{
        changeText("RICK ROLLED");
        audio.play();
    }));
