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
        $ids = 0; // id pour les inputs

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
    <div class="score">
        <table class="Upper">
            <thead>
                <tr>
                    <th class="head-score"></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="head-joueur">J<?PHP echo $value ?></th>
                    <?PHP endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de1.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Un</p>
                                <p class="info-score">Somme des 1</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de2.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Deux</p>
                                <p class="info-score">Somme des 2</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de3.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Trois</p>
                                <p class="info-score">Somme des 3</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de4.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Quatre</p>
                                <p class="info-score">Somme des 4</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de5.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Cinq</p>
                                <p class="info-score">Somme des 5</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de6.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Six</p>
                                <p class="info-score">Somme des 6</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="tite-score-spé">
                                <p class="score-dé">Bonus</p>
                                <p class="info-score">35 points si Upper</p>
                                <p class="info-score">supérieur à 62</p>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input type="button" placeholder="" class="bonus"></td>
                    <?PHP endforeach; ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="foot-score"><p>UPPER</p></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="foot-joueur"></th>
                    <?PHP endforeach; ?>
                </tr>
            </tfoot>
        </table>
        <table class="Lower">
            <thead>
                <tr>
                    <th class="head-score"></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="head-joueur">J<?PHP echo $value+1 ?></th>
                    <?PHP endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <div clas="img-dé">
                                <img src="../../assets/Images/imgGames/de3X.png" alt="icon">
                            </div>
                            <div class="tite-score">
                                <p class="score-dé">Brelan</p>
                                <p class="info-score">Somme des dés</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de4X.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Carré</p>
                                <p class="info-score">Somme des dés</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/deFH.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Full</p>
                                <p class="info-score">25 points</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/deSM.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé" id="gt1">Petite suite</p>
                                <p class="info-score">30 points</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/deLG.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé" id="gt2">Grande suite</p>
                                <p class="info-score">40 points</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/de5X.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Douzhee</p>
                                <p class="info-score" id="gt3">50 points (25/extra)</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
                <tr>
                    <td class="col-score">
                        <div class="rect-score">
                            <img src="../../assets/Images/imgGames/deCH.png" alt="icon">
                            <div class="tite-score">
                                <p class="score-dé">Chance</p>
                                <p class="info-score">Somme des dés</p>
                            </div>
                        </div>
                    </td>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <td class="col-joueur"><input id="<?php echo $ids++; ?>" type="button" placeholder="" class="combinaison"></td>
                    <?PHP endforeach; ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="foot-score"><p>LOWER</p></th>
                    <?PHP foreach (range(1, $requiredPlayers) as $value): ?>
                        <th class="foot-joueur"></t>
                    <?PHP endforeach; ?>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="dé-table">
        <div class="table">
            <div class="des libre" id="dé1"></div>
            <div class="des libre" id="dé2"></div>
            <div class="des libre" id="dé3"></div>
            <div class="des libre" id="dé4"></div>
            <div class="des libre" id="dé5"></div>
        </div>
        <button id="roll"><p>Roll</p></button>
    </div>

    <div class="versus">
        <div class="ligne1">
            <div class="joueur-avatar">
            <div class="img-joueur"><img src="../../assets/Images/imgGames/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 1</p>
            </div>
            <div class="joueur-avatar">
            <div class="img-joueur"><img src="../../assets/Images/imgGames/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 2</p>
            </div>
        </div>

        <span class="ligne2">VS</span>

        <div class="ligne3">
            <div class="joueur-avatar">
                <div class="img-joueur"><img src="../../assets/Images/imgGames/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 3</p>
            </div>
            <div class="joueur-avatar">
            <div class="img-joueur"><img src="../../assets/Images/imgGames/pdp.png" alt="icon"></div>
                <p class="joueur-nom">Joueur 4</p>
            </div>
        </div>
    </div>

    <div class="chat-container">
        <div class="chat-messages" id="chat-messages"></div>
        <div class="chat-input">
            <input type="text" id="chat-input" placeholder="Tapez votre message..." />
            <button id="sendMessage">Envoyer</button>
        </div>
    </div>
    <button id="chat-toggle">💬</button>
    
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <script>
        let playerId = <?= json_encode($_SESSION["userId"]); ?>; // Récupérer l'ID du joueur
        let position = <?= json_encode($_SESSION["position"]); ?>; // Récupérer la position du joueur
        let nbPlayers = <?= json_encode($requiredPlayers); ?>; // Récupérer le nombre de joueurs

        let socket = io('http://localhost:8080'); // Initialiser le socket client pour se connecter au serveur socket.io sur le même domaine 
        // let socket = io('https://douzhee.fr'); // Sur le VPS

        let gameId = <?= json_encode($_SESSION['idPartie']); ?>; // Récupérer l'ID de la partie
        let pseudo = <?= json_encode($_SESSION['pseudo']); ?>; // Récupérer le pseudo du joueur

        let requiredPlayers = <?= json_encode($requiredPlayers); ?>; // Récupérer le nombre de joueurs requis pour commencer la partie
        let connectedPlayers = <?= json_encode($connectedPlayers); ?>; // Récupérer le nombre de joueurs connectés
    </script>
    <script src="../../assets/JS/scriptPageJeu.js" type="module"></script>
    <script src="../../assets/JS/scriptChatEnLigne.js"></script>
    <script src="../../assets/JS/scriptPageAttente.js"></script>
</body>
</html>