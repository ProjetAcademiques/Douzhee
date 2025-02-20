<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDMusique.php");
    require_once("../Utils/headerInit.php");
    if (isset($_SESSION['userId'])){
        $musicPath = readCheminMusique(readIdMusiqueJoueur($_SESSION['userId']));
       
    }
    if (isset($_SESSION['timeStart'])){
        $_SESSION['timeEnd'] = microtime(true);  
        $delai = round($_SESSION['timeEnd'] - $_SESSION['timeStart']);
        updateTempsJeu($_SESSION['userId'],$delai);
        $_SESSION['timeStart'] = microtime(true);
    }
?>
    <header class="themeItem1">
        <audio id="audioPlayer" controls loop>
            <source id="audioSource" src="<?php echo $musicPath?>" type="audio/mpeg">
        </audio>

        <a href="index.php">
            <input id="Logo" type="submit" value=""> 
        </a>
        
        <?php if (isset($_SESSION['userId'])): ?>
        
            <div class="selection_droite">
                <span id="money"><?php echo readDouzCoin($_SESSION['userId']); ?></span>
                <img src="../../assets/images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                
                <span id="pseudo"><?php echo readPseudo($_SESSION['userId']); ?></span>
                
                <form action="Profil.php" method="GET">
                    <input id="profil" type="submit" value="">
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
     <script type="module" src="../../assets/JS/scriptTheme.js"></script>
     <!--<script src="../../assets/JS/scriptAudio.js"></script>-->
     <script src="../../assets/JS/scriptAvatar.js"></script>
    
