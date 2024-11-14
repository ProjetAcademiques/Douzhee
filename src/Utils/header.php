<?php
require_once("pdo.php");
?>
<!DOCTYPE html>
<html lang ="fr">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleheader.css"> 
    </head>
    <body>
    <header>
        <img src="imgheader/logo.png" alt="Logo du jeu" width="67" height="69" id="logo">
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="selection_droite">
            <span id="money"><?php echo getMoneyById($_SESSION['user_id']); ?></span>
                <img src="imgheader/coin_dollar_finance_icon_125510 1.png" alt="Money du Jeu" width="27" height="27" id="coin">
                <span id="pseudo"><?php echo getPseudoById($_SESSION['user_id']); ?></span>
                <form action="PageProfil.php" method="GET">
                <input id="profil" type="submit" value="">
                </form>
                <form method="POST" action="logout.php">
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
    </body>
</html>    
