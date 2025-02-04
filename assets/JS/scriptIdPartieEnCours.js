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

export function setPartieEnCours(){
    let formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/setIdPartieEnCours.php', {
        method: 'POST',
        body: formData
    });
}