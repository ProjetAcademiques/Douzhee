<?php
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDSkinAchete.php");
if (isset($_SESSION['userId'])){
    $musicPath = readMusicPath($_SESSION['userId']);
}

?>
<body>
    <header>
        <audio id="audioPlayer" controls loop>
            <source id="audioSource" src="<?php echo $musicPath?>" type="audio/mpeg">
        </audio>

        <a href="index.php">
            <input id="Logo" type="submit" value=""> 
        </a>
        
        <?php if (isset($_SESSION['userId'])):
            // On vérifie si les variables de session sont définies
            if (!isset($_SESSION['douzeCoin'])){
                $_SESSION['douzeCoin'] = getMoneyById($_SESSION['userId']); // Pour éviter de faire des requêtes inutiles
            }
            if (!isset($_SESSION['pseudo'])){
                $_SESSION['pseudo'] = getPseudoById($_SESSION['userId'])['pseudonyme']; // Pour éviter de faire des requêtes inutiles;
            }
            ?>
        
            <div class="selection_droite">
                <span id="money"><?php echo getMoneyById($_SESSION['userId']); ?></span>
                <img src="../../assets/images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                
                <span id="pseudo"><?php echo getPseudoById($_SESSION['userId'])['pseudonyme']; ?></span>
                
                <form action="Profil.php" method="GET">
                    <input id="profil" type="submit" value="">
                </form>

                <form method="POST" action="../Utils/logout.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>

        <?php else: ?>
            <div class="selection_droite">
                <form method="POST" action="Connexion.php">
                    <button type="submit">Connexion</button>
                </form>
            </div>
        <?php endif; ?>
     </header>
     <script src="../../assets/JS/scriptTheme.js"></script>
     <script src="../../assets/JS/scriptAudio.js"></script>
     <script src="../../assets/JS/scriptAvatar.js"></script>
    
