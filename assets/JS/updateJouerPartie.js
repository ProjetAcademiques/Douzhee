export function updateScoreJouerPartie(idPartie, score) {
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    formData.append('score', score);
    fetch('../Utils/updateScoreJouerPartie.php', {
        method: 'POST',
        body: formData
    });
}

export function updateEstGagnantJouerPartie(idPartie){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    fetch('../Utils/updateEstGagnant.php', {
        method: 'POST',
        body: formData
    });
}