<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDClassement.php");

    if ($_SERVER ["REQUEST_METHOD"] === "POST") {

        $data = file_get_contents("php://input");
        $json_request = json_decode($data, true);

        if(gettype($data) == "boolean" || $json_request == "") {
            echo json_encode(["erreur"=>"no request"]);

        } else if (isset($json_request["for"]) && $json_request["for"] == "LeaderBoard") { 

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