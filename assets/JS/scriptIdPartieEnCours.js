export function getIdPartieEnCours() {
    let formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/getIdPartieEnCours.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        return data.idPartieEnCours;
    })
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