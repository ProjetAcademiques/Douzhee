// Fonction pour vérifier le nombre de joueurs connectés et afficher/masquer les éléments en conséquence
function checkPlayers() {
    if (connectedPlayers < requiredPlayers) {
        document.querySelector('.waiting-room').style.display = 'flex';
        document.querySelector('.score').style.display = 'none';
        document.querySelector('.dé-table').style.display = 'none';
        document.querySelector('.versus').style.display = 'none';
        document.querySelector('.chat-container').style.display = 'none';
        document.querySelector('#chat-toggle').style.display = 'none';
    } else {
        document.querySelector('.waiting-room').style.display = 'none';
        document.querySelector('.score').style.display = 'flex';
        document.querySelector('.dé-table').style.display = 'flex';
        document.querySelector('.versus').style.display = 'flex';
        if (window.matchMedia("(min-width: 520px)").matches) {
            document.querySelector('.chat-container').style.display = 'flex';
        }
    }
}

// Appeler la fonction au chargement de la page
window.onload = checkPlayers;