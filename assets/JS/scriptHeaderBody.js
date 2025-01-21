import { getIdPartieEnCours, setIdPartieEnCours } from "./scriptIdPartieEnCours";

document.addEventListener('DOMContentLoaded', () => {
    const decoButton = document.querySelector("#decoButton");

    if(decoButton !== null){
        decoButton.addEventListener('click', (event) => {
            if(getIdPartieEnCours() > 0){
                if(window.confirm('Souhaitez-vous vraiment abandonner votre partie en cours ?')){
                    localStorage.removeItem('donneesJoueur');
                    setIdPartieEnCours(0);
                } else{
                    event.preventDefault();
                }
            }
        });
    }
});