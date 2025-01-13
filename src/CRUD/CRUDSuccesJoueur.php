<?php

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

    return $statement->execute();
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
    } return true;
}

/**
 * @author Mael
 * @param int $idJoueur
 * @return array|bool
 */
function readAllWithIdJ(int $idJoueur): ?array {
    $connexion = ConnexionSingleton::getInstance();

    $query = "SELECT * FROM SuccesJoueur WHERE $idJoueur";
    $statement = $connexion->prepare($query);

    if ($statement == 0) {
        return null;
    }

    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    $liste = [];

    foreach ($res as $results) {
        array_push($liste, $results);
    }

    return $liste;
}

