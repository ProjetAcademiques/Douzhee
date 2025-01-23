export async function getIdPartieEnCours() {
    let formData = new FormData();
    formData.append('testdesecurité', true);

    const response = await fetch('../Utils/getIdPartieEnCours.php', {
        method: 'POST',
        body: formData
    });
    const data = await response.json();

    return data.idPartieEnCours;
}

export function setIdPartieEnCours(idPartie){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    formData.append('idPartie', idPartie);
    fetch('../Utils/setIdPartieEnCours.php', {
        method: 'POST',
        body: formData
    });
}