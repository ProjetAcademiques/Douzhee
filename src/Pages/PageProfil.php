<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleProfil.css">
    <link rel="stylesheet" href="../../assets/css/styleheader.css"> 
</head>
<?php
    require_once("../Utils/headerBody.php");

    // On vérifie si les variables de session sont définies
    if (!isset($_SESSION['bio'])){
        $_SESSION['bio'] = getBioById($_SESSION['user_id']); // Pour éviter de faire des requêtes inutiles
    }
?>
    <div class="PageProfil">
        <img src="/imgheader/photodefault.jpg" alt="Avatar" width="100" height="100" id="avatar">
        <h2 id="Pseudo"><?php echo $_SESSION['pseudo']; ?></h2>
        <p id="bio"><?php echo $_SESSION['bio']; ?></p>
        <div class="buttons">
            <button onclick="location.href='PageStates.php'">Statistiques</button>
            <button onclick="location.href='PagePersonnalisation.php'">Personnalisation</button>
            <button onclick="location.href='salutatous.php'">Succès</button>
        </div>
    </div>
</body>
</html>