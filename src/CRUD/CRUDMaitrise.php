<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Maitrise.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";

    function createMaitrise(int $idJ, int $idD){
        $connection = ConnexionSingleton::getInstance();
        $insertQuery = "INSERT INTO maitrise (idJoueur, idDefis) VALUES (:idJ, :idM)";
        $statement = $connection->prepare($insertQuery);
        $statement->bindParam(":idJ", $idJ);
        $statement->bindParam(":idM", $idD);
        return $statement->execute();

    }
    function readMaitrise(){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT * FROM maitrise";
        $statement = $connection->prepare($readQuery);
        return $statement->execute();
    }
    function readDefisReussiByUser(int $idJ){
        $connection = ConnexionSingleton::getInstance();
        $readQuery = "SELECT df.idDefis as id FROM maitrise m 
        join defisreussis df
        on df.id = m.idDefis  
        WHERE idJoueur = :idJ";
        $statement = $connection->prepare($readQuery);
        $statement->bindParam(":idJ", $idJ);
       $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
?>