<?php
require_once("../CRUD/CRUDEffectueAchat.php");

function createSkinAchete(int $idSkin,int $idJoueur, string $etatSkin, string $typeSkin, string $date) {
    $connection = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO skinacheter (idSkin, etatSkin, typeSkin, dateAchat) VALUES (:idSkin,  :etatSkin, :typeSkin, :dateInsc)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":etatSkin", $etatSkin);
    $statement->bindParam(":typeSkin", $typeSkin);
    $statement->bindParam(":dateInsc", $date);
    $statement->execute();
    $idAchat = $connection->lastInsertId();
    createEffectueAchat($idJoueur,$idAchat);
}

function readSkinAchete(int $idSkin, int $idAchat): ?SkinAchete {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM SkinAchete WHERE idSkin = :idSkin AND idAchat = :idAchat";

    $statement = $connexion->prepare($SelectQuery);
    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":idAchat", $idAchat);

    $success = $statement->execute();

    if (gettype($success) != "boolean") {

            $results = $statement->fetch(PDO::FETCH_ASSOC);
        if(gettype($results) == "boolean") {
            $idAchat_ = $results ["idAchat"];
            $idSkin_ = $results ["idSkin"];
            $etatSkin = $results ["etatSkin"];
            $date = $results ["dateAchat"];
            $typeSkin = $results ["typeSkin"];
    
            return new SkinAchete($idAchat_, $idSkin_, $date, $etatSkin, $typeSkin);
        } else {
            return null;
        }
    } else {
        return null;
    }

}

/**
 * @author Milan
 * @brief retourne une collection associative des achats de l'utilisateur userId
 * @param int $userId
 * @return array
 */
function readAllAchatByUser(int $userId): array{
 
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "Select sa.idSkin, sa.typeSkin, sa.etatSkin
                    from skinacheter sa 
                    join effectueachat eff 
                    on eff.idAchat = sa.id
                    where eff.idJoueur = :idUser";

    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $userId);
    $statement->execute();
    return  $statement->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @author Milan
 * @param int $idSkin
 * @param int $etatSkin
 * @param int $idUser
 * @return void
 */
function updateEtatSkin(int $idSkin, int $etatSkin, int $idUser){
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "Select eff.idAchat from effectueachat eff join skinacheter sk on sk.id = eff.idAchat  where idJoueur = :idUser and idSkin = :idSkin";
    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $idUser);
    $statement->bindParam(":idSkin",$idSkin);
    $statement->execute();

    if ($statement->rowCount() > 0) {
        $idAchat = $statement->fetchColumn();
        $updateQuery = "UPDATE skinacheter SET etatSkin = :etat WHERE idSkin = :idSkin AND id = :idAchat";
        $statement = $connection->prepare($updateQuery);
        $statement->bindParam(":etat", $etatSkin);
        $statement->bindParam(":idSkin", $idSkin);
        $statement->bindParam(":idAchat", $idAchat);
        $statement->execute();

    }
}

function readAllThemesAchetes(int $userId): array {
    $connection = ConnexionSingleton::getInstance();
    $query = "SELECT * FROM skinacheter WHERE typeSkin = 'theme'";
    $statement = $connection->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function readAllMusiquesAchetes(): array {
    $connection = ConnexionSingleton::getInstance();
    $query = "SELECT * FROM skinacheter WHERE typeSkin = 'musique'";
    $statement = $connection->prepare($query);
    $statement->execute();
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

