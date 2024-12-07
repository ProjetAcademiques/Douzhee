<?php

/**
 * @brief Créé une nouvelle occurence de SeTrouve dans la table se trouve avec les paramètres
 * @param int $idJ id d'un joueur
 * @param int $idC id du classement
 * @return bool
 */
function createSeTrouve(int $idJ, int $idC) : bool {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "INSERT INTO setrouve (idJoueur, idClassement) VALUES (:idJ, :idC)";

    $statement = $connexion->prepare($SelectQuery);

    $statement->bindParam(":idJ", $idJ);
    $statement->bindParam(":idC", $idC);

    return $statement->execute();
}

/**
 * @brief retourne un objet SeTrouve selon les paramètres passés
 * @param int $idJ id d'un joueur
 * @param int $idC id du classement
 * @return SeTrouve|null
 */
function readSeTrouve(int $idJ, int $idC): ?SeTrouve {
    $connexion = ConnexionSingleton::getInstance();

    $InsertQuery = "SELECT * FROM setrouve WHERE idJoueur = :idJ AND idClassement = :idC";
   
    $statement = $connexion->prepare($InsertQuery);

    $statement->bindParam("idJ", $idJ);
    $statement->bindParam("idC", $idC);

    if ($statement->execute()) {
        
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if (gettype($results) == "boolean") {
            $idJ_ = $results ["idJoueur"];
            $idC_ = $results ["idClassement"];
        
            return new SeTrouve($idJ_,$idC_);
        } else {
            return null;
        }

    } else { 
        return null;
    }
}