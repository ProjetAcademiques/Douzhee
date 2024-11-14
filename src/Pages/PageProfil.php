<?php
require_once ("header.php");
require_once ("pdo.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Profil</title>
    <link rel="stylesheet" href="styleProfil.css">
</head>
<body>
    <div class="PageProfil">
        <img src="imgheader/photodefault.jpg" alt="Avatar" width="100" height="100" id="avatar">
        <h2 id="Pseudo"><?php echo getPseudoById($_SESSION['user_id']); ?></h2>
        <p id="bio"><?php echo getBioById($_SESSION['user_id']); ?></p>
        <div class="buttons">
            <button  onclick="location.href='states.php'">Statistiques</button>
            <button onclick="location.href='perso.php'">Personnalisation</button>
            <button onclick="location.href='succes.php'">Succès</button>
        </div>
    </div>
</body>
</html>