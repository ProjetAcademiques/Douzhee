/**
 * @brief Permet de mettre à jour le score total du joueur sur une partie donnée
 * @author Nathan
 * @param {int} idPartie id de la partie à mettre à jour
 * @param {int} score score total de la partie
 */
export async function updateScoreJouerPartie(idPartie, idJoueur, score) {
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    formData.append('idJoueur', idJoueur);
    formData.append('score', score);

    return fetch('../Utils/updateScoreJouerPartie.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(text => console.log("Réponse PHP :", text));
}

/**
 * @biref Permet de définir le joueur en tant que gagnant de la partie désignée
 * @author Nathan
 * @param {int} idPartie id de la partie concernée
 */
export function updateEstGagnantJouerPartie(idPartie){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    fetch('../Utils/updateEstGagnant.php', {
        method: 'POST',
        body: formData
    });
}