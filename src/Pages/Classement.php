
<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");

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
    <table id = "leaderBoard">
        <tbody>
            <tr>
                <th></th>
                <th>Joueur</th>
                <th id = "leaderBoardMode"></th>
            </tr>
            <tr>
                <td>#1</td>
                <td id = "nom1">--</td>
                <td id = "stat1">--</td>
            </tr>
            <tr>
                <td>#2</td>
                <td id = "nom2">--</td>
                <td id = "stat2">--</td>
            </tr>
            <tr>
                <td>#3</td>
                <td id = "nom3">--</td>
                <td id = "stat3">--</td>
            </tr>
        </tbody>
    </table>

    <div>
        <button type = "button" id = "leaderBoardScore">Leaderboard par score</button>
        <button type = "button" id = "leaderBoardDouzhee">Leaderboard par monnaie</button>
        <button type = "button" id = "leaderBoardSucces">Leaderboard par succes</button>
    </div>
    <script src = "../../assets/JS/scriptClassement.js" type = "text/javascript"></script>
</body>
</html>