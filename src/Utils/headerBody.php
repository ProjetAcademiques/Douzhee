<?php
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDSkinAchete.php");
if (isset($_SESSION['userId'])){
    $allAchats = readAllAchatByUser($_SESSION['userId']);
}

?>
<body>
    <header>
        <a href="Index.php">
            <input id="Logo" type="submit" value=""> 
        </a>
        
        <?php if (isset($_SESSION['userId'])):
            // On vérifie si les variables de session sont définies
            if (!isset($_SESSION['douzeCoin'])){
                $_SESSION['douzeCoin'] = getMoneyById($_SESSION['userId']); // Pour éviter de faire des requêtes inutiles
            }
            if (!isset($_SESSION['pseudo'])){
                $_SESSION['pseudo'] = getPseudoById($_SESSION['userId']);
            }
        ?>
            <div class="selection_droite">
            <span id="money"><?php echo getMoneyById($_SESSION['userId'])['douzCoin']; ?></span>
                <img src="../../assets/images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                <span id="pseudo"><?php echo getPseudoById($_SESSION['userId'])['pseudonyme']; ?></span>
                <form action="Profil.php" method="GET">
                    <input id="profil" type="submit" value="">
                </form>
                <form action="Boutique.php" method="POST">
                    <button type="submit">Boutique</button>
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
     <?php if (isset($_SESSION['userId'])): ?>
     <script>
        const img = document.getElementById("profil")
        img.style.backgroundImage = 'url("<?php echo readAvatarById($_SESSION['userId']); ?>")'
    </script>
    <?php endif; ?>
    <?php
        if (isset($allAchats) && is_array($allAchats)  ){
            foreach($allAchats as $achats){
                $themeId = $achats['idSkin'];
                $etatSkin = $achats['etatSkin'];
                $typeSkin = $achats['typeSkin'];
                if ($typeSkin == "Theme" && $etatSkin == 1){
                    switch($themeId){
                        case 1:
                            ?>
                            <script>
                                document.body.style.background = "linear-gradient(to bottom, #642581 0%, #421956 52%, #421956 70%, #421956 79%, #391549 88%, #341343 95%, #341343 96%, #351444 100%, #15081B 100% )";
                                document.querySelector("header").style.backgroundColor = "#401753";
                            </script>
                            <?php
                            break;
                        case 2:
                            ?>
                            <script>
                                document.body.style.background = "linear-gradient(to bottom, #2a7d2e 0%,  #1e5d1c 52%,  #1e5d1c 70%,  #1e5d1c 79%,  #164017 88%,  #133514 95%,  #133514 96%, #143516 100%, #0d1f0f 100%)";
                                document.querySelector("header").style.backgroundColor = "#195426";
                            </script>
                            <?php
                            break;
                        case 3:
                            ?>
                            <script>
                            document.body.style.background = "linear-gradient(to bottom, #A52A2A 0%, #6F4F4F 100%)";
                            document.querySelector("header").style.backgroundColor = "#6f4b4d";
                        </script>
                        <?php
                        break;
                    }
                }
                
            }
        }
        ?>
