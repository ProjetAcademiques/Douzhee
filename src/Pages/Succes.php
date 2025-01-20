<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../CRUD/CRUDSucces.php");
    require_once("../CRUD/CRUDSuccesJoueur.php");

    $allsucces = readAllSucces();
?>
    <link rel="stylesheet" href="../../assets/css/Theme.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleSucces.css">
<?php
    require_once("../Utils/headerBody.php");
   
?>        
</head>
<body>
    <div class="Succes">
        <h2>Liste des Succès  :</h2>
        <?php
            foreach ($allsucces as $succes) {
                echo '<img src="../../assets/images/imageSucces/Succes_verrouille.png" alt="Image du succès" id="'.$succes['id'].'" class="clickable themeItem7">';
            }
        ?>

    </div>
    <div id="fenModalSucces">
        <div class="contentSucces">
            <h2>Voici comment obtenir ce skin !</h2>
            <img src="" id="modalImage">
            <h2 id="nomSucces"></h2>
            <h2 id="conditionSucces"></h2>
        </div>
    </div>

    <script src="../../assets/JS/scriptSucces.js"></script>
</body>
</html>