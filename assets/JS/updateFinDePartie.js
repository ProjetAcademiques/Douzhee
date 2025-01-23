export function updateEndOfGame(idPartie){
    console.log("je fais l'end " + idPartie);
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    fetch('../Utils/updateEndOfGame.php', {
        method: 'POST',
        body: formData
    })
    .catch(error => console.error('Erreur:', error));
}

export function updateNbDouzhee(nbDouzhee){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('nbDouzhee', nbDouzhee);
    fetch('../Utils/updateNbDouzhee.php', {
        method: 'POST',
        body: formData
    })
    .catch(error => console.error('Erreur:', error));
}