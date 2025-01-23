<?php

/**
 * @brief retourne une instance de JouerPartie si une ligne dans la BD correspond aux param
 * @param int $idJoueurJoue 
 * @param int $idPartieJoue
 * @return JouerPartie|null retourne null si aucune ligne ne correspond aux paramètres
 */
function readJouerPartie(int $idJoueurJoue, int $idPartieJoue): ?JouerPartie {
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM JouerPartie WHERE idJoueurJoue = :idJoueurJoue AND idPartieJoue = :idPartieJoue";

    $statement = $connection->prepare($SelectQuery);

    $statement->bindParam("idJoueurJoue", $idJoueurJoue);
    $statement->bindParam("idPartieJoue", $idPartieJoue);

    $success = $statement->execute();

    if($success) {

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if(gettype($results) == "boolean") {

            $scoreJoueur = $results["scoreJoueur"];
            $positionJoueur = $results["positionJoueur"];
            $dateParticipation = $results["dateParticipation"];
            $estGagnant = $results["estGagnant"];
        
            return new JouerPartie($idJoueurJoue, $idPartieJoue, $scoreJoueur, $positionJoueur, $dateParticipation, $estGagnant);
        }

    } else {
        return null;
    }
}

/**
 * @brief ??
 * @author ??
 * @return mixed
 */
function readConnectedPlayers(): mixed {
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT COUNT(*) FROM JouerPartie WHERE idPartieJouee  = :idPartie";

    $statement = $connection->prepare($SelectQuery);
    $statement->execute(['idPartie' => $_SESSION['idPartie']]);

    return $statement->fetchColumn();
}

/**
 * @author Mael 
 * @param int $idPJ id Partie Jouée
 * @param int $position position à tester
 * @return int retourne 0 si la position est libre et existante, 1 si la position n'est pas libre mais existante, -1 si la position n'existe pas
 */
function readPositionIsUsed(int $idPJ, int $position) : int {
    $connexion = ConnexionSingleton::getInstance();

    $existenceQuery = "SELECT COUNT(idPartieJouee) AS C FROM `JouerPartie` WHERE idPartieJouee = :idPJ";
    $existStatement = $connexion->prepare($existenceQuery);
    $existStatement->bindParam("idPJ", $idPJ);

    $existRqSuccess = $existStatement->execute();
    $existResults = $existStatement->fetch(PDO::FETCH_ASSOC);

    if($existResults["C"] > 0 && $existRqSuccess) {

        $SelectQuery = "SELECT positionJoueur FROM `JouerPartie` WHERE idPartieJouee = :idPJ";

        $statement = $connexion->prepare($SelectQuery);

        $statement->bindParam("idPJ", $idPJ);
        
        $Rqsuccess = $statement->execute();

        if($Rqsuccess) {
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
            
            if(count($results) == 0) {
                return -1;
            }

            foreach ($results as $row) {
                if ($row["positionJoueur"] == $position) {
                    return 1;
                }
            }
            return 0;
        }
    }
    return -1;
}


/**
 * @brief Créé un eneregistrement dans la table JouerPartie
 * @param int $idJoueurJoue
 * @param int $idPartieJoue
 * @param int $positionJoueur
 * @return bool true si la requête fonctionne, false sinon
 */
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

/**
 * @author Mael
 * @param int $idJoueurJoue
 * @param int $idPartieJoue
 * @return int|null la position en entier, null si un problème dans readJouerPartie
 */
function readPositionJoueur(int $idJoueurJoue, int $idPartieJoue): int|null{
    return (readJouerPartie($idJoueurJoue, $idPartieJoue) != null) ? 
    readJouerPartie($idJoueurJoue, $idPartieJoue)->getPositionJoueur() : null;
}

/**
 * @author Mael
 * @param int $idJoueurJoue
 * @param int $idPartieJoue
 * @return string une chaîne de caractère qui représente la date de participation
 */
function readDateParticipation(int $idJoueurJoue, int $idPartieJoue): string {
    return (readJouerPartie($idJoueurJoue, $idPartieJoue) != null) ? 
    (readJouerPartie($idJoueurJoue, $idPartieJoue))->getDateParticipation() : null;
}

/**
 * @author Mael
 * @brief renvoie si le joueur décrit par les paramètre est gagnant ou perdant
 * @param int $idJoueurJoue
 * @param int $idPartieJoue
 * @return bool renvoie si le joueur décrit par les paramètre est gagnant (true) ou perdant (false)
 */
function readEstGagnant(int $idJoueurJoue, int $idPartieJoue): bool {
    return (readJouerPartie($idJoueurJoue, $idPartieJoue) != null) ? 
    (readJouerPartie($idJoueurJoue, $idPartieJoue))->isEstGagnant() : null;
}


/**
 * @author Mael
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
    
    if(gettype($results) == "boolean") {
        return (int)$results["Count"];
    }

    return -1;
}

/**
 * @brief donne une liste des Joueurs classé par leurs position à partir du param idPartie
 * @param $idP id de la Partie d'où on sélectionne les joueurs
 * @return ?array une collection d'instances de Joueurs, 
 */
function readAllUsersByIdPartie(int $idP): ?array {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT pseudonyme FROM Joueur J 
    JOIN JouerPartie JP 
    ON J.id = JP.idJoueurJouee WHERE JP.idPartieJouee = :idP ORDER BY JP.positionJoueur ASC";

    $statement = $connexion->prepare($SelectQuery);

    $statement->bindParam("idP", $idP);

    $success = $statement->execute();

    if($success) {
        $resultsArray = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($resultsArray)) {
            $returnedArray = [];

            foreach($resultsArray as $results) {
                array_push($returnedArray, $results["pseudonyme"]);
            }

            return $returnedArray;
        } else {
            return null;
        }
    } else {
        return null;
    } 
}

function updateScore(int $idJ, int $idP, int $score){
    $connexion = ConnexionSingleton::getInstance();

    $UpdateQuery = "UPDATE jouerpartie SET scoreJoueur = :score where idPartieJouee = :idP AND idJoueurJouee = :idJ";
    $statement = $connection->prepare($UpdateQuery);
    $statement->bindParam(":score", $score);
    $statement->bindParam(":idP", $idP);
    $statement->bindParam(":idJ", $idJ);

    return $statement->execute();
}

function updateEstGagnant(int $idJ, int $idP){
    $connexion = ConnexionSingleton::getInstance();

    $UpdateQuery = "UPDATE jouerpartie SET estGagnant = 1 where idPartieJouee = :idP AND idJoueurJouee = :idJ";
    $statement = $connection->prepare($UpdateQuery);
    $statement->bindParam(":idP", $idP);
    $statement->bindParam(":idJ", $idJ);

    return $statement->execute();
}