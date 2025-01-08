document.addEventListener('DOMContentLoaded', function() {
    const allItems = document.querySelectorAll('.item');

    const windowAchat = document.querySelector('#achatContainer');
    const windowAchatImg = document.querySelector('#achatContainer img');
    const windowAchatcost = document.querySelector('#achatContainer p');
    const windowAchatButton = document.querySelector('#btnAchat');
    const audio = document.querySelector('.audioAchat');
    const windowAchatClose = document.querySelector('#achatContainer i');

    windowAchat.classList.add('disabled');

    allItems.forEach(function(item) {
        item.addEventListener('click', function() {
            windowAchat.classList.remove('disabled');
            windowAchat.classList.add('actived');

            if (item.classList.contains('itemTheme')) {
                audio.classList.add('notSelected');
            }

            console.log(item.id);
            audio.src = '../../assets/audio/MusicAccueil' + item.id + '.mp3';
            console.log(audio.src);

            windowAchatImg.src = item.querySelector('img').src;
            windowAchatImg.id = item.id;

            if (item.classList.contains('sold')) {
                windowAchatcost.textContent = 'Vous avez déjà acheté cet item';
                windowAchatButton.classList.add('disabled');
            } else {
                windowAchatButton.classList.remove('disabled');
                var formData = new FormData();
                formData.append('id', item.id);
                formData.append('testdesecurité', true);

                fetch('../Utils/getItemCost.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        windowAchatcost.textContent = `Cela vous coûtera ${data.resultat} douzcoin`;
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
        formData.append('testdesecurité', true);    

        fetch('../Utils/buyItem.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                console.log("Achat effectué avec succès");
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