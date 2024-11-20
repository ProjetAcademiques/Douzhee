<?php

function createSkinAchete(int $idSkin, int $idAchat, string $etatSkin, string $typeSkin, string $date): bool {
    $connection = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO SkinAchete (idSkin, idAchat, etatSkin, typeSkin, dateAchat) VALUES (:idSkin, :idAchat, :etatSkin, :typeSkin, :bio, :dateInsc)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":idAchat", $idAchat);
    $statement->bindParam(":etatSkin", $etatSkin);
    $statement->bindParam(":typeSkin", $typeSkin);
    $statement->bindParam(":date", $date);

    return $statement->execute();
}

function readSkinAchete(int $idSkin, int $idAchat): ?SkinAchete {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM SkinAchete WHERE idSkin = :idSkin AND idAchat = :idAchat";

    $statement = $connexion->prepare($SelectQuery);
    $statement->bindParam(":idSkin", $idSkin);
    $statement->bindParam(":idAchat", $idAchat);

    $success = $statement->execute();

    if (gettype($success) == "boolean") {
        $results = $statement->fetch(PDO::FETCH_ASSOC);

        $idAchat_ = $results ["idAchat"];
        $idSkin_ = $results ["idSkin"];
        $etatSkin = $results ["etatSkin"];
        $date = $results ["dateAchat"];
        $typeSkin = $results ["typeSkin"];

        return new SkinAchete($idAchat_, $idSkin_, $date, $etatSkin, $typeSkin);
    } else {
        return null;
    }

}