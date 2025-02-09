/**
 * @brief Permet de mettre à jour le statut d'une partie en BD
 * @author Nathan
 * @param {int} idPartie id de la partie mise à jour
 * @param {int} statut statut de la partie
 */
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

/**
 * @brief Permet de mettre à jour le score total d'une partie en BD
 * @author Nathan
 * @param {int} idPartie id de la partie concernée
 * @param {int} scoreTot score total de la partie
 */
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