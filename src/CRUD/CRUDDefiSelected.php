<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/DefiSelected.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";

function createDefisSelected(int $id,String $nom, String $description, int $gain){
$connection = ConnexionSingleton::getInstance();
$InsertQuery = "INSERT INTO defiselected (id,nom,Description,gain) VALUES (:id,:nom,:description,:gain)";

$statement = $connection->prepare($InsertQuery);
$statement->bindValue(':id', $id);
$statement->bindParam(":nom", $nom);
$statement->bindParam(":description", $description);
$statement->bindParam(":gain", $gain);

return $statement->execute();
}
function readAllDefisSelected(){
    $connection = ConnexionSingleton::getInstance();
    $SelectQuery = "SELECT * FROM defiselected";
    $statement = $connection->prepare($SelectQuery);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}
function deleteAllDefisSelected(){
    $connection = ConnexionSingleton::getInstance();
    $DeleteQuery = "DELETE FROM defiselected";
    $statement = $connection->prepare($DeleteQuery);
    return $statement->execute();
}
?>