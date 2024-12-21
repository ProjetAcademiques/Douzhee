const express = require('express'); // Importer le module Express.js
const http = require('http'); // Importer le module HTTP de Node.js
const socketIo = require('socket.io'); // Importer le module Socket.IO
const path = require('path'); // Importer le module Path de Node.js
const cors = require('cors'); // Importer le module CORS
const { GameDataManager } = require('../assets/JS/Classes/GameDataManager');

const app = express(); // Créer une application Express
const server = http.createServer(app); // Créer un serveur HTTP en utilisant l'application Express
const io = socketIo(server, {
    cors: {
        origin: "http://localhost", // Autoriser les requêtes depuis http://localhost
        methods: ["GET", "POST"]
    }
}); // Créer un serveur Socket.IO en utilisant le serveur HTTP
app.use(cors()); // Utiliser le middleware CORS

/* a changer sur le VPS :
const express = require('express'); // Importer le module Express.js
const https = require('https'); // Importer le module HTTPS de Node.js
const fs = require('fs'); // Importer le module File System de Node.js
const socketIo = require('socket.io'); // Importer le module Socket.IO
const path = require('path'); // Importer le module Path de Node.js
const cors = require('cors'); // Importer le module CORS

const app = express(); // Créer une application Express

// Charger les certificats SSL
const options = {
    key: fs.readFileSync('/path/to/your/privkey.pem'),
    cert: fs.readFileSync('/path/to/your/fullchain.pem')
};

const server = https.createServer(options, app); // Créer un serveur HTTPS en utilisant l'application Express
const io = socketIo(server, {
    cors: {
        origin: "https://douzhee.fr", // Autoriser les requêtes depuis https://douzhee.fr
        methods: ["GET", "POST"]
    }
}); // Créer un serveur Socket.IO en utilisant le serveur HTTPS */

app.use(express.static(path.join(__dirname))); // Servir les fichiers statiques dans le dossier public 

// Afficher le fichier index.html lorsqu'un client accède à la racine du serveur
app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

// Afficher le fichier game.php lorsqu'un client accède à /game.php
app.get('/game.php', (req, res) => { 
    res.sendFile(__dirname + '../src/Pages/game.php'); // Envoi du fichier game.php
});

// Suivre les connexions des joueurs
const connectedPlayers = {};

// Événements Socket.IO
io.on('connection', (socket) => {
    // Gestion de la connexion d'un client
    console.log('a user connected');

    socket.on('test', () => {
        console.log('test event received');
    });

    socket.on('inputValue', (data) => {
        io.to(data.gameId).emit('inputValue', data);
    });

    // Gestion de la déconnexion d'un client
    socket.on('disconnect', () => { 
        console.log('user disconnected to the server');

        // Retirer le joueur de la liste des joueurs connectés
        for (let gameId in connectedPlayers) {  // Parcourir toutes les salles de jeu
            let index = connectedPlayers[gameId].indexOf(socket.id);  // Trouver l'index du joueur dans la liste des joueurs connectés
            if (index !== -1) { // Si le joueur est trouvé
                console.log(`Removing socket.id: ${socket.id} from gameId: ${gameId}`);
                console.log('Before removal:', connectedPlayers[gameId]);
                connectedPlayers[gameId].splice(index, 1); // Retirer le joueur de la liste des joueurs connectés
                console.log('After removal:', connectedPlayers[gameId]);
                console.log(connectedPlayers[gameId].length);
                io.to(gameId).emit('player disconnected', connectedPlayers[gameId].length); // Notifier les autres clients dans la salle que le nombre de joueurs a changé
                break;
            }
        }
    });

    // Gestion des messages de chat pour index.html
    socket.on('chat message index', (msg) => {
        io.emit('chat message index', msg); // Diffuser le message à tous les clients pour index.html
    });

    socket.on('player joined', (gameId) => {
        socket.join(gameId);
        console.log(`User joined game: ${gameId}`);

        // Ajouter le joueur à la liste des joueurs connectés
        if (!connectedPlayers[gameId]) {
            connectedPlayers[gameId] = [];
        }
        connectedPlayers[gameId].push(socket.id); // Ajouter le joueur à la liste des joueurs connectés
        console.log(`Added socket.id: ${socket.id} to gameId: ${gameId}`);
        console.log(connectedPlayers[gameId]);

        // Notifier les autres clients dans la salle que le nombre de joueurs a changé
        io.to(gameId).emit('player joined', connectedPlayers[gameId].length);
    });

    // Gestion des messages de chat pour une partie spécifique
    socket.on('chat message game', (data) => {
        console.log(`Message received for game ${data.gameId} de ${data.userName}: ${data.message}`);
        io.to(data.gameId).emit('chat message game', data); // Diffuser le message à tous les clients dans la salle spécifique
    });

    socket.on('afficheDes', (data) => {
        io.to(data.gameId).emit('afficheDes', data);
    });

    socket.on('calculCombinaisons', (data) => {
        let pointsCombi = [];
        if(!data.reset){
            pointsCombi = GameDataManager.checkCombinaisons(data.listeDes);
        }

        const results = {
            pointsCombinaisons: pointsCombi,
            joueur: data.joueur,
            position: data.position,
            reset: data.reset
        }

        io.to(data.gameId).emit('affichePointsCombinaisons', results);
    })
});

// Écouter sur le port 8080
server.listen(8080, () => {
    console.log('listening on *:8080');
});