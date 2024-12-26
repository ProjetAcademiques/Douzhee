const socket = io("http://localhost:8080", {
    withCredentials: true,
}); // Initialiser le socket client pour se connecter au serveur socket.io sur le même domaine 
// let socket = io('https://douzhee.fr'); // Sur le VPS