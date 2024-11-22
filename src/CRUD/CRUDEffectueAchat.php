<?php

function createEffectueAchat(int $idJ, int $idA) : int {
    $connexion = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO EffectueAchat (idJoueur, idAchat) VALUES (:idJ, :idA)";

    $statement = $connexion->prepare($InsertQuery);
    $statement->bindParam("idJ", $idJ);
    $statement->bindParam("idA", $idA);

    return $statement->execute();
}

function readEffectueAchat(int $idA, int $idJ) : ?EffectueAchat {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM EffectueAchat WHERE idAchat = :idA AND idJoueur = :idJ";

    $statement = $connexion->prepare($SelectQuery);

    $statement->bindParam("idA", $idA);
    $statement->bindParam("idJ", $idJ);

    $success = $statement->execute();

    if($success) {
        $results = $statement->fetch(PDO::FETCH_ASSOC);

        $idA_ = $results["idAchat"];
        $idJ_ = $results["idJoueur"];
    
        return new EffectueAchat($idJ_, $idA_);
    } else {
        return null;
    }
}