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
                        theme.classList.add('sold');
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