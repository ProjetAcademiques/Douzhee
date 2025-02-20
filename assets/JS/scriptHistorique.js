document.addEventListener('DOMContentLoaded', function () {
    const userSelect = document.getElementById('userSelect');
    const userName = document.getElementById('userName');
    const userAvatar = document.getElementById('userAvatar');
    const containerHistorique = document.getElementById('containerHistorique');

    let formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/getHistorique.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status == 'success') {
            data.allJoueurs.forEach(joueur => {
                let option = document.createElement('option');
                option.value = joueur.idJoueur;
                option.text = joueur.pseudo;
                userSelect.appendChild(option);
            });
            userName.textContent = data.infoJoueur.pseudo;
            userAvatar.src = data.infoJoueur.avatarChemin;

            data.historique.forEach(partie => {
                let formData = new FormData();
                formData.append('idPartie', partie.idPartie);
                formData.append('idJoueur', data.infoJoueur.idJoueur);
                formData.append('testdesecurité', true);
                fetch('../Utils/getInfoAdversaires.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data2 => {
                    if (data2.status == 'success') {
                        let div = document.createElement('div');
                        div.classList.add('historiquePartie');

                        if (partie.estGagnant == 1) {
                            div.classList.add('victoire');
                        } else {
                            div.classList.add('defaite');
                        }

                        let divJoueur = document.createElement('div');
                        divJoueur.classList.add('joueur');

                        let spanName = document.createElement('span');
                        spanName.classList.add('spanName');
                        spanName.textContent = data.infoJoueur.pseudo;
                        divJoueur.appendChild(spanName);

                        let divAvatar = document.createElement('img');
                        divAvatar.classList.add('imgAvatar');
                        divAvatar.src = data.infoJoueur.avatarChemin;
                        divJoueur.appendChild(divAvatar);

                        div.appendChild(divJoueur);

                        data2.infoAdversaires.forEach(adversaire => {
                            let divAdversaire = document.createElement('div');
                            divAdversaire.classList.add('joueur');

                            let spanName = document.createElement('span');
                            spanName.classList.add('spanName');
                            spanName.textContent = adversaire.pseudo;
                            divAdversaire.appendChild(spanName);

                            let divAvatar = document.createElement('img');
                            divAvatar.classList.add('imgAvatar');
                            divAvatar.src = adversaire.avatarChemin;
                            divAdversaire.appendChild(divAvatar);

                            div.appendChild(divAdversaire);
                        });
                        
                        for (let i = 0; i < div.childElementCount; i++) {
                            if (i == 0) {
                                let span = document.createElement('span');
                                span.classList.add('spanVSRight');
                                span.textContent = 'V';
                                div.childNodes[i].appendChild(span);
                            } else if (i == div.childElementCount - 1) {
                                let span = document.createElement('span');
                                span.classList.add('spanVSLeft');
                                span.textContent = 'S';
                                div.childNodes[i].appendChild(span);
                            } else {
                                let span = document.createElement('span');
                                span.classList.add('spanVSRight');
                                span.textContent = 'V';
                                div.childNodes[i].appendChild(span);
                                
                                let span2 = document.createElement('span');
                                span2.classList.add('spanVSLeft');
                                span2.textContent = 'S';
                                div.childNodes[i].appendChild(span2);
                            }
                        }

                        containerHistorique.appendChild(div);
                    }
                })
            });
        }
    })

    userSelect.addEventListener('change', function () {
        let formData = new FormData();
        formData.append('idJoueur', userSelect.value);
        formData.append('testdesecurité', true);
        fetch('../Utils/getHistorique.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status == 'success') {
                userName.textContent = data.infoJoueur.pseudo;
                userAvatar.src = data.infoJoueur.avatarChemin;

                while (containerHistorique.firstChild) {
                    containerHistorique.removeChild(containerHistorique.firstChild);
                }

                data.historique.forEach(partie => {
                    console.log(partie);

                    let formData = new FormData();
                    formData.append('idPartie', partie.idPartie);
                    formData.append('idJoueur', data.infoJoueur.idJoueur);
                    formData.append('testdesecurité', true);
                    fetch('../Utils/getInfoAdversaires.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data2 => {
                        if (data2.status == 'success') {
                            div = document.createElement('div');
                            div.classList.add('historiquePartie');

                            if (partie.estGagnant == 1) {
                                div.classList.add('victoire');
                            } else {
                                div.classList.add('defaite');
                            }

                            let divJoueur = document.createElement('div');
                            divJoueur.classList.add('joueur');

                            let spanName = document.createElement('span');
                            spanName.classList.add('spanName');
                            spanName.textContent = data.infoJoueur.pseudo;
                            divJoueur.appendChild(spanName);

                            let divAvatar = document.createElement('img');
                            divAvatar.classList.add('imgAvatar');
                            divAvatar.src = data.infoJoueur.avatarChemin;
                            divJoueur.appendChild(divAvatar);

                            div.appendChild(divJoueur);

                            data2.infoAdversaires.forEach(adversaire => {
                                let divAdversaire = document.createElement('div');
                                divAdversaire.classList.add('joueur');

                                let spanName = document.createElement('span');
                                spanName.classList.add('spanName');
                                spanName.textContent = adversaire.pseudo;
                                divAdversaire.appendChild(spanName);

                                let divAvatar = document.createElement('img');
                                divAvatar.classList.add('imgAvatar');
                                divAvatar.src = adversaire.avatarChemin;
                                divAdversaire.appendChild(divAvatar);

                                div.appendChild(divAdversaire);
                            });

                            containerHistorique.appendChild(div);
                        }
                    })
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});