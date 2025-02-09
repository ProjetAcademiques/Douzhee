/**
 * @brief Permet de mettre à jour le score total du joueur sur une partie donnée
 * @author Nathan
 * @param {int} idPartie id de la partie à mettre à jour
 * @param {int} score score total de la partie
 */
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