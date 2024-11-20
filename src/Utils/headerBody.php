<?php
require_once("../CRUD/CRUDJoueur.php");
?>
<body>
    <header>
        <img src="../../assets/images/imgheader/logo.png" alt="Logo du jeu" width="67" height="69" id="logo">
        <?php if (isset($_SESSION['user_id'])):
            // On vérifie si les variables de session sont définies
            if (!isset($_SESSION['douzeCoin'])){
                $_SESSION['douzeCoin'] = getMoneyById($_SESSION['user_id']); // Pour éviter de faire des requêtes inutiles
            }
            if (!isset($_SESSION['pseudo'])){
                $_SESSION['pseudo'] = getPseudoById($_SESSION['user_id']);
            }
        ?>
            <div class="selection_droite">
            <span id="money"><?php echo $_SESSION['douzeCoin']; ?></span>
                <img src="../../assets/Images/imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                <span id="pseudo"><?php echo $_SESSION['pseudo']; ?></span>
                <form action="PageProfil.php" method="GET">
                    <input id="profil" type="submit" value="">
                </form>
                <form method="POST" action="../Utils/logout.php">
                    <button type="submit">Déconnexion</button>
                </form>
            </div>
        <?php else: ?>
            <div class="selection_droite">
                <form method="POST" action="Page_Connexion.php">
                    <button type="submit">Connexion</button>
                </form>
            </div>
        <?php endif; ?>
     </header>
