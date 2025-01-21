export function getIdPartieEnCours() {
    var formData = new FormData();
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