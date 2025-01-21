document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.rejoindre form').addEventListener('submit', function(event) {
        event.preventDefault();
        const lienPartie = document.querySelector('input[name="lien_partie"]').value;
        if (lienPartie.trim() === '') {
            alert('Veuillez entrer un lien de partie valide.');
            return;
        }

        var formData = new FormData();
        formData.append('lien_partie', lienPartie);
        formData.append('testdesecurité', true);
        fetch('../Utils/rejoindrePartie.php', {
            method: 'POST',
            body: formData
        })
    });

    document.querySelector('.creer form').addEventListener('submit', function(event) {
        event.preventDefault();
        const nombreJoueur = document.querySelector('input[name="nombre_joueur"]:checked');
        if (!nombreJoueur) {
            alert('Veuillez sélectionner le nombre de joueurs.');
            return;
        }
    });
});