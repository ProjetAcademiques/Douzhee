import { getIdPartieEnCours, setIdPartieEnCours } from "./scriptIdPartieEnCours.js";

document.addEventListener('DOMContentLoaded', () => {
    const decoButton = document.querySelector("#decoButton");

    if(decoButton !== null){
        decoButton.addEventListener('click', async (event) => {
            const idPartie = await getIdPartieEnCours();
            let deconnexionValid = false;
            if(idPartie > 0){
                if(window.confirm('Souhaitez-vous vraiment abandonner votre partie en cours ?')){
                    localStorage.removeItem('donneesJoueur');
                    setIdPartieEnCours(0);
                    deconnexionValid = true;
                } else{
                    event.preventDefault();
                }
            }
            if(deconnexionValid || idPartie <= 0){
                let formData = new FormData();
                formData.append('testdesecurité', true);
                await fetch('../Utils/logout.php', {
                    method: 'POST',
                    body: formData
                });
                window.location.href = '../../src/Pages/index.php';
            }
        });
    }
});