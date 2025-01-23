<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/CRUD/CRUDStatistiques.php";

/**
 * @author Mael
 * @param int $idJoueur
 * @param int $idSucces
 * @return bool
 */
function readSuccessJoueur(int $idJoueur, int $idSucces) : bool {
    $connexion = ConnexionSingleton::getInstance();
    $query = "SELECT * FROM SuccesJoueur WHERE $idJoueur = idJoueur AND $idSucces = idSucces";

    $statement = $connexion->prepare($query);

    $success = $statement->execute();

    if($success) {
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        if ($results == false) {
            return false;
        } return true;
    }
}

/**
 * ---
 * @author Mael
 * @param int $idJoueur
 * @param int $idSucces
 * @return bool
 */
function createSuccessJoueur(int $idJoueur, int $idSucces): bool {
    $connexion = ConnexionSingleton::getInstance();
    $query = "INSERT INTO SuccesJoueur (idJoueur, idSucces) VALUES ($idJoueur, $idSucces)";

    $statement = $connexion->exec($query);

    if($statement == 0) {
        return false;
    } else{
        return true;
    }
}

/**
 * @author Mael
 * @param int $idJoueur
 * @return array|bool
 */
function readAllWithIdJ(int $idJoueur): ?array {
    $connexion = ConnexionSingleton::getInstance();
    $query = "SELECT * FROM SuccesJoueur WHERE idJoueur = $idJoueur";

    $statement = $connexion->prepare($query);

    $success = $statement->execute();

    if($success) {
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        if ($results == false) {
            return false;
        } return $results;
    }
}

