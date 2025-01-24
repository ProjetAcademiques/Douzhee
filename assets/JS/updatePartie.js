export function updateStatutPartie(idPartie, statut) {
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    formData.append('statut', statut);
    fetch('../Utils/updateStatutPartie.php', {
        method: 'POST',
        body: formData
    });
}

export function updateScoreTotalPartie(idPartie, scoreTot) {
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    formData.append('scoreTot', scoreTot);
    fetch('../Utils/updateScoreTotPartie.php', {
        method: 'POST',
        body: formData
    });
}