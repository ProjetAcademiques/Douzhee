<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
?>
    <link rel="stylesheet" href="../../assets/css/Theme.css">
    <link rel="stylesheet" href="../../assets/css/styleGlobal.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
</head>
<body>
    <?php require_once("../Utils/headerBody.php"); ?>
    <div class="PageProfil themeItem2">
        <img src="<?php echo readAvatarById($_SESSION['userId'])?>" alt="Avatar" width="90" height="90" id="avatar">
        <h2 id="Pseudo"><?php echo getPseudoById($_SESSION['userId'])['pseudonyme']; ?></h2>
        <p id="bio"><?php echo getBioById($_SESSION['userId'])['biographie']; ?></p>
        <div class="buttons">
            <button onclick="location.href='States.php'">Statistiques</button>
            <button onclick="location.href='Personnalisation.php'">Personnalisation</button>
            <button onclick="location.href='Succes.php'">Succès</button>
            <button type="submit" id="decoButton" class="deco-button">Déconnexion</button>
        </div>
    </div>
    <script type="module" src="../../assets/JS/scriptHeaderBody.js"></script>
</body>
</html>
<script>
    const header =document.querySelector('header');
    const div =document.querySelector('.PageProfil');
    div.style.backgroundColor = header.style.backgroundColor;
</script>