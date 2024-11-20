<?php

function readJouerPartie(int $idJoueurJoue, int $idPartieJoue): ?JouerPartie {
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM JouerPartie WHERE idJoueurJoue = :idJoueurJoue AND idPartieJoue = :idPartieJoue";

    $statement = $connection->prepare($SelectQuery);

    $statement->bindParam(":idJoueurJoue", $idJoueurJoue);
    $statement->bindParam(":idPartieJoue", $idPartieJoue);

    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);

    $scoreJoueur = $results["scoreJoueur"];
    $positionJoueur = $results["positionJoueur"];
    $dateParticipation = $results["dateParticipation"];
    $estGagnant = $results["estGagnant"];

    return new JouerPartie($idJoueurJoue, $idPartieJoue, $scoreJoueur, $positionJoueur, $dateParticipation, $estGagnant);
}



function createJouerPartie(int $idJoueurJoue, int $idPartieJoue, int $scoreJoueur, int $positionJoueur, string $dateParticipation, bool $estGagnant): bool {
    $connection = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO JouerPartie (idJoueurJoue, idPartieJoue, scoreJoueur, positionJoueur, dateParticipation, estGagnant) 
    VALUES (:idJoueurJoue, :idPartieJoue, :scoreJoueur, :positionJoueur, :dateParticipation, :estGagnant)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam(":idJoueurJoue", $idJoueurJoue);
    $statement->bindParam(":idPartieJoue", $idPartieJoue);
    $statement->bindParam(":scoreJoueur", $scoreJoueur);
    $statement->bindParam(":positionJoueur", $positionJoueur);
    $statement->bindParam(":dateParticipation", $dateParticipation);
    $statement->bindParam(":estGagnant", $estGagnant);

    return $statement->execute();
}


function readPositionJoueur(int $idJoueurJoue, int $idPartieJoue):int {
    return (readJouerPartie($idJoueurJoue, $idPartieJoue))->getPositionJoueur();
}

function readDateParticipation(int $idJoueurJoue, int $idPartieJoue): string {
    return (readJouerPartie($idJoueurJoue, $idPartieJoue))->getDateParticipation();
}

function readEstGagnant(int $idJoueurJoue, int $idPartieJoue): bool {
    return (readJouerPartie($idJoueurJoue, $idPartieJoue))->isEstGagnant();
}


/**
 * @brief Retourne le nombre de parties jouées par le joueur possédant l'id idJ
 * @param int $idJ
 * @return int le nombre de parties jouées, -1 si une erreur est survenue
 */
function readPartieCount(int $idJJ): int {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT COUNT(idPartieJoue) AS Count FROM JouerPartie WHERE idJoueurJoue = :idJJ";

    $statement = $connexion->prepare($SelectQuery);

    $statement->bindParam(":idJJ", $idJJ);

    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);
    
    if(!gettype($results) == "boolean") {
        return (int)$results["Count"];
    } 

    return -1;
}