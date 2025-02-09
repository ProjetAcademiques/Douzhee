/**
 * @brief Permet de récupérer l'id de la partie en cours du joueur donné
 * @author Nathan
 * @returns Retourne l'id de la partie en cours
 */
export async function getPartieEnCours() {
    let formData = new FormData();
    formData.append('testdesecurité', true);

    const response = await fetch('../Utils/getIdPartieEnCours.php', {
        method: 'POST',
        body: formData
    });
    const data = await response.json();

    return data.idPartieEnCours;
}

/**
 * @brief Permet de supprimer l'id partie en cours du joueur
 * @author Nathan
 */
export function setPartieEnCours(){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/setIdPartieEnCours.php', {
        method: 'POST',
        body: formData
    });
}