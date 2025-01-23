function checkPlayers() {
    if (connectedPlayers == requiredPlayers) {
        window.location.href = './game.php';
    }
}

// Rejoindre la salle de chat pour la partie spécifique
socket.emit('player joined', gameId);

socket.on('player joined', function(connectedPlayersCount) {
    document.getElementById('connected-players').innerText = connectedPlayersCount;
    connectedPlayers = connectedPlayersCount;
    checkPlayers();
});
