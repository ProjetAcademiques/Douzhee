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
                if (theme) {
                    switch (themeId) {
                        case 2:
                            theme.src = "../../assets/images/imageBoutique/Theme2Acheter.png";
                            theme.style.pointerEvents = "none";
                            break;
                        case 3:
                            theme.src = "../../assets/images/imageBoutique/Theme3Acheter.png";
                            theme.style.pointerEvents = "none";
                            break;
                        case 4:
                            theme.src = "../../assets/images/imageBoutique/Theme4Acheter.png";
                            theme.style.pointerEvents = "none";
                            break;
                        case 5:
                        case 6:
                        case 7:
                        case 8:
                            theme.src = "../../assets/images/imageBoutique/imgMusiqueAcheter.png";
                            theme.style.pointerEvents = "none";
                            break;
                        default:
                            break;
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