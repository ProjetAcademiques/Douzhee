<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDPartie.php");
    require_once("../CRUD/CRUDJouerPartie.php");
    require_once("../Utils/connectionSingleton.php");
?>

<link rel="stylesheet" href="../../assets/CSS/game.css">   
</head>
<body>
    <?php
        $requiredPlayers = readPartieById($_SESSION['idPartie'])->getNbJoueurs(); // nombre de joueurs requis pour commencer la partie
        $connectedPlayers = readConnectedPlayers(); // nombre de joueurs connectés

        //debugSession();
    ?>
    <div class="waiting-room">
        <h1>En attente des autres joueurs...</h1>
        <p>Nombre de joueurs connectés: <span id="connected-players"><?php echo $connectedPlayers; ?></span> / <?php echo $requiredPlayers; ?></p>
        <br>
        <h3>
            <p>Lien de la partie:</p> 
            <?php echo $_SESSION['lienPartie']; ?>
        </h2>
        <p>Veuillez patienter pendant que les autres joueurs rejoignent la partie.</p>
    </div>
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <script>
        let gameId = <?= json_encode($_SESSION['idPartie']); ?>; // Récupérer l'ID de la partie
        let requiredPlayers = <?= json_encode($requiredPlayers); ?>; // Récupérer le nombre de joueurs requis pour commencer la partie
        let connectedPlayers = <?= json_encode($connectedPlayers); ?>; // Récupérer le nombre de joueurs connectés
    </script>
    <script src="../../assets/JS/connectionWebSocket.js"></script>
    <script src="../../assets/JS/scriptPageAttente.js"></script>
</body>
</html>