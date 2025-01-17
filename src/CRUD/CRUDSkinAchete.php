<?php
require_once("../CRUD/CRUDEffectueAchat.php");

function createSkinAchete(int $idSkin,int $idJoueur, string $typeSkin, string $date) {
    $connection = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO skinacheter (idJoueur, idSkin, typeSkin, dateAchat) VALUES (:idJoueur, :idSkin, :typeSkin, :dateInsc)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam(":idJoueur", $idJoueur);
    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":typeSkin", $typeSkin);
    $statement->bindParam(":dateInsc", $date);
    $statement->execute();
}

function readSkinAchete(int $idSkin, int $idJoueur ): ?SkinAchete {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM SkinAchete WHERE idSkin = :idSkin AND idJoueur  = :idJoueur ";

    $statement = $connexion->prepare($SelectQuery);
    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":idJoueur ", $idJoueur );

    $success = $statement->execute();

    if (gettype($success) != "boolean") {

            $results = $statement->fetch(PDO::FETCH_ASSOC);
        if(gettype($results) == "boolean") {
            $idJoueur_ = $results ["idJoueur"];
            $idSkin_ = $results ["idSkin"];
            $date = $results ["dateAchat"];
            $typeSkin = $results ["typeSkin"];
    
            return new SkinAchete($idJoueur_, $idSkin_, $date, $typeSkin);
        } else {
            return null;
        }
    } else {
        return null;
    }

}

/**
 * @author Cédric
 * @brief retourne une collection associative des achats de l'utilisateur userId
 * @param int $userId
 * @return array
 */
function readAllAchatByUser(int $userId): array{
 
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "SELECT * FROM skinacheter WHERE idJoueur = :idUser";

    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $userId);
    $statement->execute();
    return  $statement->fetchAll(PDO::FETCH_ASSOC);
}


function readAllThemeByUser(int $userId): array {
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "SELECT * FROM skinacheter WHERE idJoueur = :idUser AND typeSkin = 'Theme'";

    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $userId);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function readAllMusicByUser(int $userId): array {
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "SELECT * FROM skinacheter WHERE idJoueur = :idUser AND typeSkin = 'Musique'";

    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $userId);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}