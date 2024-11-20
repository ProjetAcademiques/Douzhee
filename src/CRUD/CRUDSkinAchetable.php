<?php

/**
 * @author Mael
 * @brief ne nécessite pas d'autres opération qu'un read
 */



 /**
  * @brief retourne le skinAchetable ayant l'id id ou null si aucun existe avec cet id
  * @return SkinAchetable | null
  */
 function readSkinAchetable(int $id): ?SkinAchetable {
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM SkinAchetable WHERE id = $id";

    $statement = $connection->prepare($SelectQuery);
    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);
    	
    $idSkin = $results["idSkin"];
    $nomSkin = $results["nomSkin"];
    $prixSkin = $results["prixSkin"];
        
    return new SkinAchetable($idSkin, $nomSkin, $prixSkin);
 }