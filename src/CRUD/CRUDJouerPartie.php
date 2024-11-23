<?php

function readJouerPartie(int $idJoueurJoue, int $idPartieJoue): ?JouerPartie {
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM JouerPartie WHERE idJoueurJoue = :idJoueurJoue AND idPartieJoue = :idPartieJoue";

    $statement = $connection->prepare($SelectQuery);

    $statement->bindParam("idJoueurJoue", $idJoueurJoue);
    $statement->bindParam("idPartieJoue", $idPartieJoue);

    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);

    $scoreJoueur = $results["scoreJoueur"];
    $positionJoueur = $results["positionJoueur"];
    $dateParticipation = $results["dateParticipation"];
    $estGagnant = $results["estGagnant"];

    return new JouerPartie($idJoueurJoue, $idPartieJoue, $scoreJoueur, $positionJoueur, $dateParticipation, $estGagnant);
}
/**
 * @param int $idJJ
 * @param int $idPJ
 * @param int $position
 * @return bool|null
 */
function readPositionIsUsed(int $idPJ, int $position) : int {
    $connexion = ConnexionSingleton::getInstance();

    $existenceQuery = "SELECT COUNT(idPartie) AS C FROM table WHERE idPartie = :idPJ";
    $existStatement = $connexion->prepare($existenceQuery);
    $existStatement->bindParam("idPJ", $idPJ);

    $existRqSuccess = $existStatement->execute();
    $existResults = $existStatement->fetch(PDO::FETCH_ASSOC);

    if($existResults["C"] > 0 && $existRqSuccess) {

        $SelectQuery = "SELECT positionJoueur FROM JouerPartie WHERE idPartieJouee = :idPJ";

        $statement = $connexion->prepare($SelectQuery);

        $statement->bindParam("idPJ", $idPJ);
        
        $Rqsuccess = $statement->execute();

        if($Rqsuccess) {
            
            $results = $statement->fetch(PDO::FETCH_ASSOC);
            
            if(gettype($results) == "boolean") {
                return -1;
            }

            $fetchedPos = $results["positionJoueur"];

            if ($fetchedPos != $position) {
                return 0;
            } else {
                return 1;
            }

        } else {
            return -1; // on part du principe que si la requête échoue COMPLETEMENT, on agit comme dans le pire des cas : ça existe pas
        }
    } else {
        return -1; // idPartie n'est pas dans la base de données
    }
}

function createJouerPartie(int $idJoueurJoue, int $idPartieJoue, int $positionJoueur): bool {
    $connection = ConnexionSingleton::getInstance();

    $dateParticipation = date("j:n:g:i:s");
    $estGagnant = false;
    $scoreJoueur = 0;

    $InsertQuery = "INSERT INTO JouerPartie (idJoueurJouee, idPartieJouee, scoreJoueur, positionJoueur, dateParticipation, estGagnant) 
    VALUES (:idJoueurJoue, :idPartieJoue, :scoreJoueur, :positionJoueur, :dateParticipation, :estGagnant)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam("idJoueurJoue", $idJoueurJoue);
    $statement->bindParam("idPartieJoue", $idPartieJoue);
    $statement->bindParam("scoreJoueur", $scoreJoueur);
    $statement->bindParam("positionJoueur", $positionJoueur);
    $statement->bindParam("dateParticipation", $dateParticipation);
    $statement->bindParam("estGagnant", $estGagnant);

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

    $statement->bindParam("idJJ", $idJJ);

    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);
    
    if(!gettype($results) == "boolean") {
        return (int)$results["Count"];
    } 

    return -1;
}

/**
 * @brief donne une liste des Joueurs classé par leurs position à partir du param idPartie
 * @param $idP id de la Partie d'où on sélectionne les joueurs
 * @return ?array une collection d'instances de Joueurs, 
 */
function readAllUsersByIdPartie (int $idP): ?array {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT pseudo FROM Joueur J 
    JOIN JouerPartie JP 
    ON J.id = JP.idJoueurJouee AND JP.idPartie = :idP ORDER BY JP.positionJoueur ASC";

    $statement = $connexion->prepare($SelectQuery);

    $statement->bindParam("idP", $idP);

    $success = $statement->execute();

    if($success) {
        
        $resultsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        $returnedArray = [];

        if (gettype($resultsArray) == "boolean") {

            foreach($resultsArray as $results) {
                array_push($returnedArray, $results["pseudonyme"]);
            }

            return $resultsArray;
        } else {
            return null;
        }

    } else {
        return null;
    } 
}