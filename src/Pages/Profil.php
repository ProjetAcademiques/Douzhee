<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleProfil.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
<?php
    require_once("../Utils/headerBody.php");

    // On vérifie si les variables de session sont définies
    if (!isset($_SESSION['bio'])){
        $_SESSION['bio'] = getBioById($_SESSION['userId']); // Pour éviter de faire des requêtes inutiles
    }
?>
    <div class="PageProfil">
        <img src="<?php echo readAvatarById($_SESSION['userId'])?>" alt="Avatar" width="100" height="100" id="avatar">
        <h2 id="Pseudo"><?php echo getPseudoById($_SESSION['userId']); ?></h2>
        <p id="bio"><?php echo getBioById($_SESSION['userId']); ?></p>
        <div class="buttons">
            <button onclick="location.href='States.php'">Statistiques</button>
            <button onclick="location.href='Personnalisation.php'">Personnalisation</button>
            <button onclick="location.href='Succes.php'">Succès</button>
        </div>
    </div>
</body>
</html>