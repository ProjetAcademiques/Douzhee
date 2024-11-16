<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDStatistiques.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleheader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleStates.css">
<?php
    require_once("../Utils/headerBody.php");
?>        
<?php
    $statsUser = readStatistiquesByIdUser($_SESSION['user_id']);
?>
</head>
<body>
<div class="States">
    <div class="State">
        <h2>Parties Jouées :</h2>
        <span>12</span>
    </div>
    <div class="State">
        <h2>Parties Gagnées <img src="../../assets/images/imageStates/nbPartiesGagnes.png"></img> :</h2>
        <span>8</span>
    </div>
    <div class="State">
        <h2>Ratio Victoire :</h2>
        <span><?php $statsUser->getRatioVictoire() ?></span>
    </div>
    <div class="State">
        <h2>Succès <img src="../../assets/images/imageStates/succes.png"></img> :</h2>
        <span><?php $statsUser->getNbSucces() ?></span>
    </div>
    <div class="State">
        <h2>Score <img src="../../assets/images/imageStates/scoremax.png"></img> :</h2>
        <span><?php $statsUser->getScoreMaximal() ?></span>
    </div>
    <div class="State">
        <h2>Douzhee <img src="../../assets/images/imageStates/nbDouzhee.png"></img> :</h2>
        <span>15</span>
    </div>
    <div class="State">
        <h2>Temps de jeu <img src="../../assets/images/imageStates/tempsjeu.png"></img> :</h2>
        <span><?php $statsUser->getTempsJeu() ?></span>
    </div>
</div>
</body>
</html>