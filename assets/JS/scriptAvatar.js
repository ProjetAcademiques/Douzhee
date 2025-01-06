document.addEventListener('DOMContentLoaded', function () {
    var formData = new FormData();
    formData.append('testdesecurité', true);

    fetch('../Utils/isSetUserID.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                fetch('../Utils/getAvatar.php', {
                    method: 'POST',
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            const img = document.getElementById("profil");
                            img.style.backgroundImage = 'url("' + data.avatarUrl + '")';
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération de l\'avatar:', error);
                    });
            }
        })
        .catch(error => {
            console.error('Erreur lors de la récupération de la connexion:', error);
        });
});