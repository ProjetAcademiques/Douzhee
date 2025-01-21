import { checkSuccess } from "./checkSucces";
import { getIdPartieEnCours, setIdPartieEnCours } from "./scriptIdPartieEnCours";

document.addEventListener('DOMContentLoaded', function() {
    checkSuccess(1);
});

decoButton = document.getElementById("decoButton");

decoButton.addEventListener('click', () => {
    if(getIdPartieEnCours() > 0){
        if(window.confirm('Souhaitez-vous vraiment abandonner votre partie en cours ?')){
            localStorage.removeItem('donneesJoueur');
            setIdPartieEnCours(0);
        } else{
            preventDefault();
        }
    }
});