export async function updateScoreJouerPartie(idPartie, score) {
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    formData.append('score', score);

    const response = await fetch('../Utils/updateScoreJouerPartie.php', {
        method: 'POST',
        body: formData
    });

    return response.ok;
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