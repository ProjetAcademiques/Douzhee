document.addEventListener('DOMContentLoaded', function() {
    var formData = new FormData();
    formData.append('testdesecurité', true);

    fetch('../Utils/readAllAchats.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            var allAchats = data.data;

            allAchats.forEach(achat => {
                const themeId = parseInt(achat.idSkin, 10);
                const theme = document.getElementById(`${themeId}`);
                if (theme) { // Vérifiez si l'élément existe
                    const themeImg = theme.querySelector('img');
                    if (themeImg) { // Vérifiez si l'image existe
                        switch (themeId) {
                            case 2:
                                themeImg.src = "../../assets/images/imageBoutique/Theme2Acheter.png";
                                theme.classList.add('sold');
                                break;
                            case 3:
                                themeImg.src = "../../assets/images/imageBoutique/Theme3Acheter.png";
                                theme.classList.add('sold');
                                break;
                            case 4:
                                themeImg.src = "../../assets/images/imageBoutique/Theme4Acheter.png";
                                theme.classList.add('sold');
                                break;
                            case 5:
                            case 6:
                            case 7:
                            case 8:
                                themeImg.src = "../../assets/images/imageBoutique/imgMusiqueAcheter.png";
                                theme.classList.add('sold');
                                break;
                            default:
                                break;
                        }
                    }
                }
            });
        }
        else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});