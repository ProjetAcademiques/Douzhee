<?php
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDSkinAchete.php");
if (isset($_SESSION['userId'])){
    $allAchats = readAllAchatByUser($_SESSION['userId']);
}

?>
<body>
    <header>
        <form method="POST" action="Index.php">
            <input id="Logo" type="submit" value=""> 
        </form>
        
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
            <span id="money"><?php echo getMoneyById($_SESSION['userId']); ?></span>
                <img src="../../assets/Images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                <span id="pseudo"><?php echo getPseudoById($_SESSION['userId']); ?></span>
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
                                document.body.style.backgroundColor = "#c2adcc";
                                document.querySelector("header").style.backgroundColor = "#401753";
                            </script>
                            <?php
                            break;
                        case 2:
                            ?>
                            <script>
                                document.body.style.backgroundColor = "#95ca97";
                                document.querySelector("header").style.backgroundColor = "#195426";
                            </script>
                            <?php
                            break;
                        case 3:
                            ?>
                            <script>
                            document.body.style.backgroundColor = "#927272";
                            document.querySelector("header").style.backgroundColor = "#6f4b4d";
                        </script>
                        <?php
                        break;
                    }
                }
                
            }
        }
        ?>
