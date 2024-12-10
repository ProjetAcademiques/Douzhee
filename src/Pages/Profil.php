<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");

    if (!isset($_SESSION['bio'])){
        $_SESSION['bio'] = getBioById($_SESSION['userId'])['biographie']; 
    }
?>
    <link rel="stylesheet" href="../../assets/css/styleProfil.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
    <div class="PageProfil">
        <img src="<?php echo readAvatarById($_SESSION['userId'])?>" alt="Avatar" width="100" height="100" id="avatar">
        <h2 id="Pseudo"><?php echo getPseudoById($_SESSION['userId'])['pseudonyme']; ?></h2>
        <p id="bio"><?php echo getBioById($_SESSION['userId'])['biographie']; ?></p>
        <div class="buttons">
            <button onclick="location.href='States.php'">Statistiques</button>
            <button onclick="location.href='Personnalisation.php'">Personnalisation</button>
            <button onclick="location.href='Succes.php'">Succès</button>
        </div>
    </div>
</body>
</html>