<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");

    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
?>
    <link rel="stylesheet" href="../../assets/CSS/Theme.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">     
    <link rel="stylesheet" href="../../assets/CSS/Classement.css">
</head>

<html>
<body>
    <?php require_once("../Utils/headerBody.php"); ?>

    <div>
        <span class = "title">Modes de classement : </span>
        <button type = "button" id = "leaderBoardPJ">parties jouées</button>
        <button type = "button" id = "leaderBoardDouzhee">Douzhee</button>
        <button type = "button" id = "leaderBoardSucces">Succès</button>
        <button type = "button" id = "leaderBoardRatio">par victoires</button>
    </div>

    <span id = "leaderBoard">
            <div id = "header" class = "LeaderBoardRoom">
                <span>Classement</span>
                <span>Joueur</span>
                <span id = "leaderBoardMode">Critère de Classement</span>
            </div>
    </span>

    <span id = "toFill"></span>

    <script src = "../../assets/JS/scriptClassement.js" type = "text/javascript"></script>
</body>
</html>