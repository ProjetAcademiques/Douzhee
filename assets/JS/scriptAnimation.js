const speechBubble = document.getElementById('bulle');
const speechText = document.getElementById('Texte');
const flèche = document.getElementById('flèche');
const Valider = document.getElementById('Valider');
const Refuser = document.getElementById('Refuser');
const messages = [ 
    'But du jeu : Obtenir le maximum de points en réalisant des combinaisons spécifiques avec 5 dés.',
    'Nombre de joueurs : Le jeu peut être joué seul ou avec vos amis.',
    'Déroulement pour un tour : Chaque joueur a droit à 3 lancers de dés par tour. Après chaque lancer, le joueur peut choisir de garder certains dés et de relancer les autres pour essayer d obtenir une meilleure combinaison. Au bout des 3 lancers  (ou moins si le joueur est satisfait de sa combinaison), il note son score sur la grille virtuelle.',
    'Combinaisons et points : Les combinaisons sont similaires au poker : paires, brelans (trois dés identiques), carrés (quatre dés identiques), full (trois dés identiques et deux autres identiques), petite suite (quatre dés consécutifs), grande suite (cinq dés consécutifs), et Douzhee (cinq dés identiques).Chaque combinaison a une valeur de points spécifique.',
    'Fin de la partie : La partie se termine lorsque toutes les cases de la feuille de score sont remplies.',
    'Gagnant : Le joueur avec le total de points le plus élevé gagne la partie.',
    'Classement : Plusieurs classements existent qui vous classe dans certains critères(Score,Nombre de parties gagnées...).',
    'Pour terminer, de nombreux succès sont disponible pour vous encourager à jouer.']

let index = 1;


function changeText(newText) {
    speechText.innerText = newText;
    
}
function changeStyleText(){
    speechText.style.textAlign = "justify";
    speechText.style.fontFamily = "Georgia, serif"; 
    speechText.style.fontSize = "18px"; 

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
    firstMascotte.style.right = '-100%'; 

anime({
    targets: firstMascotte,
    right: '20%', 
    top: '50%', 
    translateY: '-50%', 
    scale: [1.5, 1], 
    duration: 1200, 
    easing: 'easeOutExpo', 
});
}
function moveMascotte3(){
    const thirdMascotte = document.getElementById('ThirdMascotte');
    thirdMascotte.style.position = 'fixed';
    thirdMascotte.style.left = '-100%'; 

    anime({
        targets: thirdMascotte,
        left: '20%', 
        top: '50%', 
        translateY: '-50%', 
        scale: [1.5, 1], 
        duration: 1200, 
        easing: 'easeOutExpo',
    });
}

function showSecondMascotte() {
    const secondMascotte = document.getElementById('SecondMascotte');
    const firstMascotte = document.getElementById('FirstMascotte');
    const rect = firstMascotte.getBoundingClientRect();
    firstMascotte.style.display = "none"; 
    secondMascotte.style.position = "fixed";
    secondMascotte.style.display = "block"; 
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
    document.addEventListener('DOMContentLoaded',moveMascotte3);
    document.addEventListener('DOMContentLoaded',changeStyleText);
    Valider.addEventListener('click',() =>{
        hideButton(Refuser);
        hideButton(Valider);
        changeText(messages[0]);
        showarrow();
        showSecondMascotte();
        flèche.addEventListener('click',()=>{ 
            changeText(messages[index]);
            index++;
            if (index > messages.length){
                changeText("Vous avez fini le tutoriel pour les règles. Amuser-vous bien !");
                Valider.innerText = "Terminer";
                showButton(Valider);
                hidearrow();
                Valider.addEventListener('click',() =>{
                        window.location.href="http://localhost/douzhee/src/Pages/Index.php?_ijt=v1ppdtli2cq1rp8vpr9rsjg3b7&_ij_reload=RELOAD_ON_SAVE"
                        index = 0;
                });
            
               }
        });
       
    });
    if (Refuser.addEventListener('click',() =>{
        window.location.href="http://localhost/douzhee/src/Pages/Index.php?_ijt=v1ppdtli2cq1rp8vpr9rsjg3b7&_ij_reload=RELOAD_ON_SAVE"
    }));
