<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Classes/Joueur.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Utils/connectionSingleton.php";


/**
 * @brief insère un nouveau joueur dans la table Joueur selon les paramètres spécifiés. tout les paramètres sont obligatoires.
 * @return bool false si la requête a échoué true sinon
 */
function createJoueur(string $pseudo, string $mdp, int $douzCoin, string $email, string $bio, string $dateInsc) :bool {
    $connection = ConnexionSingleton::getInstance();
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $InsertQuery = "INSERT INTO Joueur (Pseudonyme, Mdp, DouzCoin, Email, Biographie, DateInscription) VALUES (:pseudo, :mdp, 0, :email, 'Douzhee est un jeu conçu par des passionees dans le but de divertir les gens', CURRENT_DATE)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam("pseudo", $pseudo);
    $statement->bindParam("mdp", $hashedPassword);
    $statement->bindParam("email", $email);
    $statement->bindParam("bio", $bio);

    return $statement->execute();
}


/**
 * @brief met à jour un enregistrement de la table joueur. les valeurs par défaut à null permettent de spécifier uniquement 
 * les champs qu'on veut mettre à jour en utilisant les flags (fonction(flag : valeur))
 * @deprecated peut être utilisé si on veut mettre à jour plusieurs champs à la fois sans qu'il soit précis
 * @return bool false si échec, true si succès
 */
function updateJoueur(int $id, string $pseudo = null, string $mdp = null, int $douzCoin = null, string $email = null, string $bio = null, int $idPartie = null): bool {
    
    $old_user = readJoueur($id);

    $oldPseudo = $old_user->getPseudo();
    $oldEmail = $old_user->getEmail();
    $oldMdp = $old_user->getMDP();
    $oldDouzCoin = $old_user->getDouzCoin();
    $oldBio = $old_user->getBio();
    $oldIdPartie = $old_user->getIdPartie();
    

    $connection = ConnexionSingleton::getInstance();
    $UpdateQuery = "UPDATE Joueur SET Pseudonyme = :pseudo, Mdp = :mdp, DouzCoin = :douzCoin, Email = :email, Biographie = :bio, DateInscription = :dateInsc, idPartie = :idPartie WHERE id = $id";

    $statement = $connection->prepare($UpdateQuery);

    if(isNull($pseudo))
        $statement->bindParam("pseudo", $pseudo);
    else $statement->bindParam("pseudo", $oldPseudo);

    if(isNull($mdp))
        $statement->bindParam("mdp", $mpd);
    else $statement->bindParam("mdp", $oldMdp);

    if(isNull($email))
        $statement->bindParam("email", $email);
    else $statement->bindParam("email", $oldEmail);

    if(isNull($bio))
        $statement->bindParam("bio", $bio);
    else $statement->bindParam("bio", $oldBio);

    if(isNull($douzCoin))
        $statement->bindParam("douzCoin", $douzCoin);
    else $statement->bindParam("douzCoin", $oldDouzCoin);

    if(isNull($idPartie))
        $statement->bindParam("idPartie", $idPartie);
    else $statement->bindParam("idPartie", $oldIdPartie);

    return $statement->execute();
}

/**
 * @author Mael
 * @param int $id
 * @param string $pseudo
 * @return bool true si la requête marche, false sinon
 */
function updatePseudoJoueur(int $id, string $pseudo): bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET pseudonyme = :pseudo WHERE id = :id";

    $statement = $connection->prepare($updateQuery);

    $statement->bindParam("pseudo", $pseudo);
    $statement->bindParam("id", $id);

    return $statement->execute();
}

/**
 * @author Mael
 * @param int $id
 * @param string $douzCoin
 * @return bool true si la requête marche, false sinon
 */
function updateDouzCoin(int $id, string $douzCoin): bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET douzCoin = :douzCoin WHERE id = :id";

    $statement = $connection->prepare($updateQuery);

    $statement->bindParam("douzCoin", $douzCoin);
    $statement->bindParam("id", $id);

    return $statement->execute();
}


/**
 * @author Mael
 * @param int $id id du joueur
 * @param string $mdp nouveau mot de passe à mettre
 * @return bool true si la requête marche, false sinon
 */
function updateMDP(int $id, string $mdp): bool {
    $connection = ConnexionSingleton::getInstance();
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $updateQuery = "UPDATE Joueur SET Mdp = :mdp WHERE id = :id";

    $statement = $connection->prepare($updateQuery);

    $statement->bindParam("mdp", $hashedPassword);
    $statement->bindParam("id", $id);

    return $statement->execute();
}

/**
 * @author Mael
 * @param int $id
 * @param string $email
 * @param string $mdp
 * @return bool
 */
function updateEmail(int $id, string $email, string $mdp) {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET Mdp = :mdp, Email = :email WHERE id = :id";

    $statement = $connection->prepare($updateQuery);

    $statement->bindParam("mdp", $mdp);
    $statement->bindParam("email", $email);
    $statement->bindParam("id", $id);

    return $statement->execute();
} 

/**
 * @author Mael
 * @param int $id
 * @param string $bio
 * @return bool true si la requête marche, false sinon
 */
function updateBio(int $id, string $bio): bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET Biographie = :bio WHERE id = :id";

    $statement = $connection->prepare($updateQuery);
    $statement->bindParam("bio", $bio);
    $statement->bindParam("id", $id);

    return $statement->execute();
}

/**
 * @brief Fonction pour MàJ le champs idPartie du joueur qui a l'id $id
 * @param int $id id du joueur
 * @param int $idPartie nouvel id de partie à mettre
 * @return bool true si la requête marche, false sinon
 */
function updateJoueurIdPartie(int $id, int $idPartie):bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET idPartie = :idPartie WHERE id = :id";

    $statement = $connection->prepare($updateQuery);
    $statement->bindParam("idPartie", $idPartie);
    $statement->bindParam("id", $id);

    return $statement->execute();
}

/**
 * @brief retourne le joueur ayant l'id id ou null si aucun existe avec cet id
 * @param int $id id du joueur à obtenir
 * @return Joueur|null le joueur à l'id id
 */
function readJoueur(int $id): ?Joueur {
    
    $connection = ConnexionSingleton::getInstance();

    $SelectQuery = "SELECT * FROM Joueur WHERE id = $id";

    $statement = $connection->prepare($SelectQuery);
    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);
    	
    $pseudo = $results ["Pseudonyme"];
    $mdp = $results ["Mdp"];
    $douzCoin = $results ["DouzCoin"];
    $email = $results ["Email"];
    $bio = $results ["Biographie"];
    $dateInsc = $results ["DateInscription"];
    $idPartie = $results ["idPartie"];
    
    return new Joueur ($pseudo, $mdp, $douzCoin, $email, $bio, $dateInsc, $idPartie);
}

/**
 * @brief retourne l'id de partie du joueur à l'id $id
 * @param int $id id du joueur dont on cherche l'id partie
 * @return int -1 si le joueur n'existe pas, l'id Partie correspondant à au param id du joueur sinon
 */
function readIdPartieJoueur(int $id): int{
    return (readJoueur($id) != null) ? readJoueur($id)->getIdPartie() : -1;
}


/**
 * @brief supprime l'utilisateur possédant l'id id
 * @param int $id
 * @return bool true si la requête marche, false sinon
 */
function deleteJoueur(int $id): bool {
    $connection = ConnexionSingleton::getInstance();
    $query = "DELETE FROM Joueur WHERE id = $id";

    return $connection->exec($query);
}



/**
 * @param mixed $argument la chose sur laquelle on veut tester la nullité
 * @return bool true si c'est null, false sinon
 */
function isNull(mixed $argument) :bool {
    return $argument == null;
}

function getIdUser($email){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select id from joueur where email = ? ";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$email);
    $stmt->execute();
    $idUser = $stmt->fetch(PDO::FETCH_ASSOC);
    return $idUser['id'];
}

/**
 * @brief vérifie si un utilisateur existe dans la base de données
 */
function verifUser($email) {
    $connexion = ConnexionSingleton::getInstance();
    $sql = "SELECT email FROM joueur WHERE email = :email";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam('email', $email);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getPseudoById($id){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select pseudonyme from joueur where id =?";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $pseudo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $pseudo['pseudonyme'];
}
function getMoneyById($id){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select douzCoin from joueur where id =?";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $money = $stmt->fetch(PDO::FETCH_ASSOC);
    return $money['douzCoin'];
}
function verifEmail($email){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select email from joueur where email = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$email);
    $stmt->execute();
    $count = $stmt->rowCount();
    return $count > 0;
}
function getBioById($id){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select biographie from joueur where id =?";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $bio = $stmt->fetch(PDO::FETCH_ASSOC);
    return $bio['biographie'];
}
function insertUser($email,$mdp,$pseudonyme){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "INSERT INTO joueur (email, pseudonyme, mdp, douzCoin, dateInscription, biographie) VALUES (?, ?, ?,0,CURRENT_DATE,'Douzhee est un jeu conçu par des passionees dans le but de divertir les gens')";
    $stmt = $connexion->prepare($sql);
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $stmt->bindParam(1, $email);
    $stmt->bindParam(2, $pseudonyme);
    $stmt->bindParam(3, $hashedPassword);
    $stmt->execute();

}
function updatePassword($mdp,$email){
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $connexion = ConnexionSingleton::getInstance();
    $id = getIdUser($email);
    $sql = "Update joueur set mdp = ?  where id = ?";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$hashedPassword);
    $stmt->bindParam(2,$id);
    $stmt->execute();
}
?>