<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/DefisReussis.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
    require_once $_SERVER['DOCUMENT_ROOT']. "/douzhee/src/CRUD/CRUDMaitrise.php";

    function createDefisReussis($idUser,$idDefis, $reussi = 1, $date){
        $connection = ConnexionSingleton::getInstance();
        $InsertQuery = "INSERT INTO DefisReussis (idDefis,reussi,DateDefiReussi ) VALUES (:idDefis, :reussi, :dateDefiReussi)";
        $statement = $connection->prepare($InsertQuery);
        $statement->bindParam(":idDefis", $idDefis);
        $statement->bindParam(":reussi", $reussi);
        $statement->bindParam(":dateDefiReussi", $date);
        $statement->execute();
        $idMaitrise = $connection->lastInsertId();
        createMaitrise($idUser, $idMaitrise);

    }
    function readDefisReussi(){
        $connection = ConnexionSingleton::getInstance();
        $readDefisReussi = "SELECT * FROM DefisReussis";
        $statement = $connection->prepare($readDefisReussi);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    ?>