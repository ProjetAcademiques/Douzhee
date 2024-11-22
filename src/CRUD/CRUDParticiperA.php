<?php


/**
 * Permet de créer un enregistrement de type ParticiperA dans la base de données avec les paramètres donnés
 * @param int $idJoueur
 * @param int $idJoueurJoue
 * @param int $idPartieJoue
 * @return bool true si la requête est exécutée avec succès, false sinon
 */
function createParticiperA(int $idJoueur, int $idJoueurJoue, int $idPartieJoue) : bool {
    $connexion = ConnexionSingleton::getInstance();

    $InsertQuery = "INSERT INTO ParticiperA (idJoueur, idJoueurJoue, idPartieJoue) VALUES (:idJoueur, :idJoueurJoue, :idPartieJoue)";
    
    $statement = $connexion->prepare($InsertQuery);

    $statement->bindParam("idJoueur", $idJoueur);
    $statement->bindParam("idJoueurJoue", $idJoueurJoue);
    $statement->bindParam("idPartieJoue", $idPartieJoue);

    return $statement->execute();
}


/**
 * @brief retourne un objet ParticiperA si un enregistrement correspondant aux params est trouvé, null sinon
 * @param int $idJoueur
 * @param int $idJoueurJoue
 * @param int $idPartieJoue
 * @return ParticiperA|null
 */
function readParticiperA(int $idJoueur, int $idJoueurJoue, int $idPartieJoue): ?ParticiperA {
    $connexion = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM ParticiperA WHERE idjoueur = :idJoueur AND idJoueurJoue = :idJoueurJoue AND idPartieJoue = :idPartieJoue";

    $statement = $connexion->prepare($SelectQuery);

    $statement->bindParam("idJoueur", $idJoueur);
    $statement->bindParam("idJoueurJoue", $idJoueurJoue);
    $statement->bindParam("idPartieJoue", $idPartieJoue);

    if (!$statement->execute()) {
        return null;
    }

    $results = $statement->fetch(PDO::FETCH_ASSOC);

    if(gettype($results) != "boolean") {
        $idJJ = $results ["idJoueurJoue"];
        $idJ = $results  ["idJoueur"];
        $idPJ = $results ["idPartieJoue"];
    
        return new ParticiperA($idJJ, $idPJ, $idJ);

    } else {
        return null;
    }
}
