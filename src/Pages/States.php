<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");
    require_once("../Utils/headerBody.php");      
    $statsUser = readStatistiquesByIdUser($_SESSION['userId']);
?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleGlobal.css">
</head>
<body>
    <div class="States">
        <div class="State">
            <h2>Parties Jouées :</h2>
            <?php echo $statsUser->getnbPartieJoues() ?>
        </div>
        <div class="State">
            <h2>Parties Gagnées <img src="../../assets/images/imageStates/nbPartiesGagnes.png"></img> :</h2>
            <?php echo $statsUser->getNbPartiesGagnees()?>
        </div>
        <div class="State">
            <h2>Ratio Victoire :</h2>
            <?php echo $statsUser->getRatioVictoire() ?>
        </div>
        <div class="State">
            <h2>Succès <img src="../../assets/images/imageStates/succes.png"></img> :</h2>
            <?php echo $statsUser->getNbSucces() ?>
        </div>
        <div class="State">
            <h2>Score <img src="../../assets/images/imageStates/scoremax.png"></img> :</h2>
            <?php echo $statsUser->getScoreMaximal() ?>
        </div>
        <div class="State">
            <h2>Douzhee <img src="../../assets/images/imageStates/nbDouzhee.png"></img> :</h2>
        <?php echo $statsUser->getNbDouzhee()?>
        </div>
        <div class="State">
            <h2>Temps de jeu <img src="../../assets/images/imageStates/tempsjeu.png"></img> :</h2>
            <?php echo $statsUser->getTempsJeu() ?>
        </div>
    </div>
</body>
</html>