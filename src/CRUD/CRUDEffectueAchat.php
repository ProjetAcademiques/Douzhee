<?php

/**
 * @brief créé une instance d'EffectueAchat et l'ajoute dans la table correspondance
 * @param int $idJ id du joueur
 * @param int $idA id de l'achat
 * @return bool true si la requête échoue, false sinon 
 */
function createEffectueAchat(int $idJ, int $idA) : bool {
    $connexion = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO effectueachat (idJoueur, idAchat) VALUES (:idJ, :idA)";

    $statement = $connexion->prepare($InsertQuery);
    $statement->bindParam("idJ", $idJ);
    $statement->bindParam("idA", $idA);

    return $statement->execute();
}

/**
 * @brief retourne une instance d'EffectueAchat si l'enregistrement correspondant aux paramètres existe
 * @param int $idA
 * @param int $idJ
 * @return EffectueAchat|null null si EffectueAchat(idA, idJ) n'existe pas dans la BdD
 */
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

function readEffecuteAchatById(int $idJ){
    $connexion = ConnexionSingleton::getInstance();
    $SelectQuery = 'SELECT sk.etatSkin, sk.idSkin from skinacheter sk
                    join effectueachat eff on eff.idAchat = sk.id
                    where eff.idJoueur = :idUser';

    $statement = $connexion->prepare($SelectQuery);
    $statement->bindParam(":idUser", $idJ);
    $statement->execute();
    return $statement->fetchAll();

}