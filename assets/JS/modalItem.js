document.addEventListener('DOMContentLoaded', function() {
    const allItems = document.querySelectorAll('.item');

    const windowAchat = document.querySelector('#achatContainer');
    const windowAchatImg = document.querySelector('#achatContainer img');
    const windowAchatcost = document.querySelector('#achatContainer p');
    const windowAchatButton = document.querySelector('#btnAchat');
    const audio = document.querySelector('.audioAchat');
    const windowAchatClose = document.querySelector('#achatContainer i');

    windowAchat.classList.add('disabled');

    var type;

    allItems.forEach(function(item) {
        item.addEventListener('click', function() {
            windowAchat.classList.remove('disabled');
            windowAchat.classList.add('actived');
            
            windowAchatImg.src = item.querySelector('img').src;
            windowAchatImg.id = item.id.match(/\d+/)[0];

            if (item.classList.contains('sold')) {
                windowAchatcost.textContent = 'Vous avez déjà acheté cet item';
                windowAchatButton.classList.add('disabled');
                audio.classList.add('notSelected');
            } else {
                var formData = new FormData();
                windowAchatButton.classList.remove('disabled');
                if (item.classList.contains('itemTheme')) {
                    audio.classList.add('notSelected');
                    formData.append('type', 'Theme');
                    type = 'Theme';
                }else{
                    formData.append('type', 'Music');
                    type = 'Music';
                }
                formData.append('id', item.id.match(/\d+/)[0]);
                formData.append('testdesecurité', true);

                fetch('../Utils/getItemInfo.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        windowAchatcost.textContent = `Cela vous coûtera ${data.resultat} douzcoin`;
                        if (data.chemin != null) {
                            audio.src = data.chemin;
                        }
                    } else {
                        windowAchatcost.textContent = 'Erreur lors de la récupération du coût';
                        console.error("Erreur : " + data.message);
                    }
                })
                .catch(error => {
                    console.error("Erreur lors de la requête : ", error);
                    windowAchatcost.textContent = 'Erreur lors de la récupération du coût';
                });
            }
        });
    });

    windowAchatButton.addEventListener('click', function() {
        var formData = new FormData();
        formData.append('id', windowAchatImg.id);
        formData.append('cost', windowAchatcost.textContent.match(/\d+/)[0]); // Extraire le coût du texte
        formData.append('type', type)
        formData.append('testdesecurité', true);

        fetch('../Utils/buyItem.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                windowAchat.classList.remove('actived');
                windowAchat.classList.add('disabled');
                location.reload();
            } else {
                console.error("Erreur : " + data.error);
            }
        })
        .catch(error => {
            console.error("Erreur lors de la requête : ", error);
        });
    });

    windowAchat.addEventListener('click', function(event) {
        if (event.target === windowAchat) {
            windowAchat.classList.remove('actived');
            windowAchat.classList.add('disabled');
            audio.classList.remove('notSelected');
        }
    });

    windowAchatClose.addEventListener('click', function() {
        windowAchat.classList.remove('actived');
        windowAchat.classList.add('disabled');
        audio.classList.remove('notSelected');
    });
});