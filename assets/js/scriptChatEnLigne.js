document.addEventListener('DOMContentLoaded', function() {
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

    socket.on('player disconnected', function(connectedPlayersCount) {
        document.getElementById('connected-players').innerText = connectedPlayersCount;
        connectedPlayers = connectedPlayersCount;
        checkPlayers();
    });

    // Fonction pour envoyer un message
    function sendMessage() {
        var input = document.getElementById('chat-input'); // Récupérer l'input
        var message = input.value;
        input.value = ''; // Réinitialiser l'input
        let cc = "cc"
        socket.emit('chat message game', { gameId: gameId, message: message, userName: pseudoid }); // Envoyer le message au serveur
    }

    socket.on('chat message game', function(data) {
        
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
});