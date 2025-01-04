var tempsRestant = document.querySelector('#tempsRestant');
var delet = false;

function getTimeUntilNextSundayMidnight() {
    var now = new Date();
    var nextSunday = new Date();

    nextSunday.setDate(now.getDate() + (7 - now.getDay()) % 7);
    nextSunday.setHours(24, 0, 0, 0);

    var diff = nextSunday - now;

    var days = Math.floor(diff / (1000 * 60 * 60 * 24));
    diff -= days * (1000 * 60 * 60 * 24);

    var hours = Math.floor(diff / (1000 * 60 * 60));
    diff -= hours * (1000 * 60 * 60);

    var minutes = Math.floor(diff / (1000 * 60));
    diff -= minutes * (1000 * 60);

    var seconds = Math.floor(diff / 1000);
    
    if (days == 0 && hours == 0 && minutes == 0 && seconds == 0) {
        delet = true;
    }

    return `${days}j ${hours}h ${minutes}m ${seconds}s`;
}

function updateTimer() {
    tempsRestant.textContent = getTimeUntilNextSundayMidnight();
}

function checkAndDeleteDefis() {
    if (delet) {
        console.log("Deleting defis");
        fetch('../../src/Utils/defisDelete.php')
            .then(response => response.json())
            .catch(error => console.error('Error:', error));
        delet = false;
        location.reload();
    }
}

var form = document.getElementById('defisForm');

form.addEventListener('submit', function(event) {
    event.preventDefault(); // Empêcher l'envoi du formulaire par défaut sinon la page sera rechargée et donc zikete

    var nomDefis = document.getElementById('nomDefis').value.trim();
    var descriptionDefis = document.getElementById('descriptionDefis').value.trim();
    var gainDefis = document.getElementById('gainDefis').value.trim();

    var formData = new FormData(); // Plus pratique pour envoyer des fichiers
    formData.append('nomDefis', nomDefis);
    formData.append('descriptionDefis', descriptionDefis);
    formData.append('gainDefis', gainDefis);
    formData.append('testdesecurité', true); // Pour éviter les attaques CSRF meme si le fait qu'on envoie la methode POST suffit

    fetch('../../src/Utils/defisCreate.php', {
        method: 'POST', // Envoi de données par la méthode POST
        body: formData // Les données à envoyer
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert('Défi créé avec succès.');
            location.reload(); // Recharger la page pour afficher le nouveau défi ?
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});

setInterval(checkAndDeleteDefis, 1000);
setInterval(updateTimer, 1000);

checkAndDeleteDefis();
updateTimer();