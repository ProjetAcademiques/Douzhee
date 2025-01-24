
<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../Utils/headerBody.php");

    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
?>

    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleGlobal.css">     
    <link rel="stylesheet" href="../../assets/css/Classement.css">
</head>

<html>
    <body>
        <div id = "ldFlexContainer">
        <table id = "leaderBoard">
            <tbody>
                <tr>
                    <th></th>
                    <th>Joueur</th>
                    <th id = "leaderBoardMode"></th>
                </tr>
                <tr>
                    <td>#1</td>
                    <td id = "nom0">--</td>
                    <td id = "stat0">--</td>
                </tr>
                <tr>
                    <td>#2</td>
                    <td id = "nom1">--</td>
                    <td id = "stat1">--</td>
                </tr>
                <tr>
                    <td>#3</td>
                    <td id = "nom2">--</td>
                    <td id = "stat2">--</td>
                </tr>
            </tbody>
        </table>


        <button type = "button" id = "leaderBoardScore">Leaderboard par score</button>
        <button type = "button" id = "leaderBoardDouzhee">Leaderboard par monnaie</button>
        <button type = "button" id = "leaderBoardSucces">Leaderboard par succes</button>

        <script src = "../../assets/JS/scriptClassement.js" type = "text/javascript"></script>
    </body>
</html>