/**
 * @brief Permet de mettre à jour la base de données lors de la fin d'une partie
 * @author Nathan
 * @param {int} idPartie id de la partie terminée
 */
export function updateEndOfGame(idPartie){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    fetch('../Utils/updateEndOfGame.php', {
        method: 'POST',
        body: formData
    })
    .catch(error => console.error('Erreur:', error));
}

/**
 * @brief Permet de mettre à jour le nombre de Douzhee du joueur
 * @author Nathan
 * @param {int} nbDouzhee Nombre de Douzhee à ajouter
 */
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