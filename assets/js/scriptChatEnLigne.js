let buttonSendMessage = document.getElementById('sendMessage');
let buttonToggleChat = document.getElementById('chat-toggle');
let inputChat = document.getElementById('chat-input');

buttonSendMessage.addEventListener('click', sendMessage);
buttonToggleChat.addEventListener('click', toggleChat);
inputChat.addEventListener('keypress', function(event) {
    if (event.key === 'Enter') {
        sendMessage();
    }
});

// Rejoindre la salle de chat pour la partie spécifique
socket.emit('player joined', gameId);

socket.on('player joined', function(connectedPlayersCount) {
    console.log('Player joined game: ' + connectedPlayersCount);
    document.getElementById('connected-players').innerText = connectedPlayersCount;
    connectedPlayers = connectedPlayersCount;
    checkPlayers();
});

socket.on('player disconnected', function(connectedPlayersCount) {
    console.log('Player disconnected from game: ' + gameId);
    document.getElementById('connected-players').innerText = connectedPlayersCount;
    connectedPlayers = connectedPlayersCount;
    checkPlayers();
});

// Fonction pour envoyer un message
function sendMessage() {
    var input = document.getElementById('chat-input'); // Récupérer l'input
    var message = input.value;
    input.value = ''; // Réinitialiser l'input
    socket.emit('chat message game', { gameId: gameId, message: message, userName: pseudo }); // Émettre le message
    console.log('Sending message: ' + message);
}

socket.on('chat message game', function(data) {
    console.log('Received message: ' + data);
    
    var messages = document.getElementById('chat-messages'); // Récupérer les messages
    var messageElement = document.createElement('p'); // Créer un élément div
    var nameElement = document.createElement('strong');

    nameElement.textContent = data.userName + ': '; // Ajouter le nom d'utilisateur
    var messageText = document.createTextNode(data.message); // Ajouter le message
    
    messageElement.appendChild(nameElement);
    messageElement.appendChild(messageText);

    messages.appendChild(messageElement); // Ajouter l'élément div aux messages
    messages.scrollTop = messages.scrollHeight; // Faire défiler vers le bas pour afficher le dernier message
});

function toggleChat() {
    var chatContainer = document.querySelector('.chat-container'); // Récupérer le conteneur du chat
    chatContainer.classList.toggle('active'); // Ajouter ou supprimer la classe active pour afficher ou masquer le chat
}