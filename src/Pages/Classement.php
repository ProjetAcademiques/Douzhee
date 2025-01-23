<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../Utils/headerBody.php");
    // if (!isset($_SESSION['userId'])){
    //     require_once("../Utils/redirection.php");
    // }

    if ($_SERVER ["REQUEST_METHOD"] === "GET") {
        $json_request = file_get_contents("php://input");

        if(strcasecmp($json_request["for"], "leaderboard")) {} 

        else if ($json_request == "") {
            switch ($json_request["mode"]){

                case "ACH": // Achievment
                    $achievmentLeaderBoard = readClassemnetBySucces();
                    echo json_encode($achievmentLeaderBoard);
                    break;

                case "CRC": // Currency
                    $currencyLeaderBoard = readClassemnetBynbDouzhee();
                    echo json_encode($currencyLeaderBoard);
                    break;

                case "RK": // Rank
                    $rankLeaderBoard = readClassementByScore();
                    echo json_encode($rankLeaderBoard);
                    break;

                default:
                    echo json_encode(["error" => "invalid table mode"]);
                    break;
            }
        } else {
            echo json_encode(["error" => "invalid reason, redefine 'for' clause"]);
        }
    }
?>

<head>
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
                </tr>
                <tr>
                    <td>#2</td>
                </tr>
                <tr>
                    <td>#3</td>
                </tr>
            </tbody>
        </table>

        <label>
            Leaderboard par score
            <input type = "radio"  name = "leaderboard" id = "leaderBoardScore">
        </label>

        <label>
            Leaderboard par monnaie
            <input type = "radio" name = "leaderboard" id = "leaderBoardDouzhee">
        </label>

        <label>
            Leaderboard par succes
            <input type = "radio" name = "leaderboard" id = "leaderBoardSucces">
        </label>
        </div>

        <script src = "../../assets/JS/ForPages/scriptClassement.js" type = "text/javascript"></script>
    </body>
</html>