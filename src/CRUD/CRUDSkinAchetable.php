<?php
   require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
/**
 * @author Mael
 * @brief ne nécessite pas d'autres opération qu'un read
 */



 /**
  * @author Mael
  * @brief retourne le skinAchetable ayant l'id id ou null si aucun existe avec cet id
  * @return SkinAchetable | null
  */
 function readSkinAchetable(int $id): ?SkinAchetable {
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM SkinAchetable WHERE id = $id";

    $statement = $connection->prepare($SelectQuery);
    
    if($statement->execute()) {

      $results = $statement->fetch(PDO::FETCH_ASSOC);

      if(gettype($results) != "boolean") {
         $idSkin = $results["idSkin"];
         $nomSkin = $results["nomSkin"];
         $prixSkin = $results["prixSkin"];
             
         return new SkinAchetable($idSkin, $nomSkin, $prixSkin);  
      } else {
         return null;
      }
      
    } else {
      return null;
    }
 }

/**
 * @author Mael
 * @brief retourne tout les thèmes, null sinon
 * @return array|null
 */
function readAllThemes(): ?array {
   $connexion = ConnexionSingleton::getInstance();

   $query = "SELECT * FROM SkinAchetable WHERE typeSkin = Theme";

   $statement = $connexion->prepare($query);

   $statement->execute();

   $results = $statement->fetchAll(PDO::FETCH_ASSOC);

   if(gettype($results) != "boolean") {
      return $results;
   }
   return null;
}

/**
 * @author Mael
 * @brief retourne toutes les musiques, null sinon
 * @return array|null
 */
function readAllMusics(): ?array {
   $connexion = ConnexionSingleton::getInstance();

   $query = "SELECT * FROM SkinAchetable WHERE typeSkin = Music";

   $statement = $connexion->prepare($query);

   $statement->execute();

   $results = $statement->fetchAll(PDO::FETCH_ASSOC);

   if(gettype($results) != "boolean") {
      return $results;
   }
   return null;
}

 
function readPriceById($id){
   $connection = ConnexionSingleton::getInstance();
   $SelectQuery = "SELECT prixSkin FROM skinachetable WHERE id = :id";
   $statement = $connection->prepare($SelectQuery);
   $statement->bindParam(":id", $id);
   $statement->execute();
   $results = $statement->fetch(PDO::FETCH_ASSOC);
   return $results["prixSkin"];

}