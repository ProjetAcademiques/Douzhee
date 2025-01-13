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

