<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Joueur.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";


/**
 * @brief insère un nouveau joueur dans la table Joueur selon les paramètres spécifiés. tout les paramètres sont obligatoires.
 * @return bool false si la requête a échoué true sinon
 */
function createJoueur(string $pseudo, string $mdp, string $email, int $douzCoin = 0, string $bio = "") :bool {
    $connection = ConnexionSingleton::getInstance();
    $hashedPassword = password_hash($mdp, PASSWORD_DEFAULT);
    $InsertQuery = "INSERT INTO Joueur (pseudonyme, mdp, douzCoin, email, biographie, dateInscription) VALUES (:pseudo, :mdp, :douzCoin, :email, :bio, CURRENT_TIMESTAMP)";

    $statement = $connection->prepare($InsertQuery);

    $statement->bindParam("pseudo", $pseudo);
    $statement->bindParam("mdp", $hashedPassword);
    $statement->bindParam("douzCoin", $douzCoin);
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
    $UpdateQuery = "UPDATE Joueur SET pseudonyme = :pseudo, mdp = :mdp, douzCoin = :douzCoin, email = :email, biographie = :bio, idPartie = :idPartie WHERE id = $id";

    $statement = $connection->prepare($UpdateQuery);

    if(isNull($pseudo))
        $statement->bindParam(":pseudo", $pseudo);
    else $statement->bindParam(":pseudo", $oldPseudo);

    if(isNull($mdp))
        $statement->bindParam(":mdp", $mpd);
    else $statement->bindParam(":mdp", $oldMdp);

    if(isNull($email))
        $statement->bindParam(":email", $email);
    else $statement->bindParam(":email", $oldEmail);

    if(isNull($bio))
        $statement->bindParam(":bio", $bio);
    else $statement->bindParam(":bio", $oldBio);

    if(isNull($douzCoin))
        $statement->bindParam(":douzCoin", $douzCoin);
    else $statement->bindParam(":douzCoin", $oldDouzCoin);

    if(isNull($idPartie))
        $statement->bindParam(":idPartie", $idPartie);
    else $statement->bindParam(":idPartie", $oldIdPartie);

    return $statement->execute();
}

/**
 * @author Mael
 * @param int $id
 * @param string $pseudo
 * @return bool true si la requête marche, false sinon
 */
function updatePseudoJoueur(int $id, string $pseudonyme ): bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET pseudonyme  = :pseudonyme  WHERE id = :id";

    $statement = $connection->prepare($updateQuery);

    $statement->bindParam("pseudonyme", $pseudonyme );
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

    $statement->bindParam(":douzCoin", $douzCoin);
    $statement->bindParam(":id", $id);

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

    $statement->bindParam(":mdp", $hashedPassword);
    $statement->bindParam(":id", $id);

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

    $statement->bindParam(":mdp", $mdp);
    $statement->bindParam(":email", $email);
    $statement->bindParam(":id", $id);

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
    $statement->bindParam(":bio", $bio);
    $statement->bindParam(":id", $id);

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
    $statement->bindParam(":idPartie", $idPartie);
    $statement->bindParam(":id", $id);

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

    if($statement->execute()) {
        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if(gettype($results) != "boolean") {
            $pseudo = $results ["pseudonyme"];
            $mdp = $results ["mdp"];
            $douzCoin = $results ["douzCoin"];
            $email = $results ["email"];
            $bio = $results ["biographie"];
            $dateInsc = $results ["dateInscription"];
            $idPartieEnCours = $results ["idPartieEnCours"];
            $idTheme = $results["idTheme"];
            $avatarChemin = $results["avatarChemin"];
            $musiqueChemin = $results["musiqueChemin"];
            
            return new Joueur ($pseudo, $mdp, $douzCoin, $email, $bio, $dateInsc, $idPartieEnCours, $idTheme, $avatarChemin, $musiqueChemin);
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function readJoueurByEmail(string $email): ?Joueur {
    $connection = ConnexionSingleton::getInstance();

    $request = "SELECT * FROM Joueur WHERE email = :email";

    $statement = $connection->prepare($request);

    $statement->bindParam("email", $email);

    $statement->execute();

    $results = $statement->fetch(PDO::FETCH_ASSOC);

    if(gettype($results) != "boolean") {
        $pseudo = $results ["pseudonyme"];
        $mdp = $results ["mdp"];
        $douzCoin = $results ["douzCoin"];
        $email = $results ["email"];
        $bio = $results ["biographie"];
        $dateInsc = $results ["dateInscription"];
        $idPartieEnCours = $results ["idPartieEnCours"];
        $idTheme = $results["idTheme"];
        $avatarChemin = $results["avatarChemin"];
        $musiqueChemin = $results["musiqueChemin"];
        
        return new Joueur ($pseudo, $mdp, $douzCoin, $email, $bio, $dateInsc, $idPartieEnCours, $idTheme, $avatarChemin, $musiqueChemin);
    } else {
        return null;
    }
}

/**
 * @brief retourne l'id de partie du joueur à l'id $id
 * @param int $id id du joueur dont on cherche l'id partie
 * @return int -1 si le joueur n'existe pas, l'id Partie correspondant à au param id du joueur sinon
 */
function readIdPartieJoueur(int $id): int {
    return (readJoueur($id) != null) ? readJoueur($id)->getIdPartie() : -1;
}

/**
 * @brief retourne l'id du thème du joueur à l'id $id
 * @param int $id id du joueur dont on cherche l'id thème
 * @return int -1 si le joueur n'existe pas, l'id Thème correspondant à au param id du joueur sinon
 */
function readIdThemeJoueur(int $id): int {
    return (readJoueur($id) != null) ? readJoueur($id)->getIdTheme() : -1;
}

/**
 * @brief retourne le chemin de l'avatar du joueur à l'id $id
 * @param int $id id du joueur dont on cherche l'avatar
 * @return string|null null si le joueur n'existe pas, le chemin de l'avatar correspondant à au param id du joueur sinon
 */
function readAvatarJoueur(int $id): ?string {
    return (readJoueur($id) != null) ? readJoueur($id)->getAvatarChemin() : null;
}

/**
 * @brief retourne le chemin de la musique du joueur à l'id $id
 * @param int $id id du joueur dont on cherche la musique
 * @return string|null null si le joueur n'existe pas, le chemin de la musique correspondant à au param id du joueur sinon
 */
function readMusiqueJoueur(int $id): ?string {
    return (readJoueur($id) != null) ? readJoueur($id)->getMusiqueChemin() : null;
}

/**
 * @brief met à jour l'id du thème du joueur
 * @param int $id id du joueur
 * @param int $idTheme nouvel id du thème à mettre
 * @return bool true si la requête marche, false sinon
 */
function updateJoueurIdTheme(int $id, int $idTheme): bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET idTheme = :idTheme WHERE id = :id";

    $statement = $connection->prepare($updateQuery);
    $statement->bindParam("idTheme", $idTheme);
    $statement->bindParam("id", $id);

    return $statement->execute();
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
 * Retourne une liste d'instances de SkinAchete qui reflète les skins achetés par le joueur ayant l'idJ, null si aucun skin ou aucun joueur ayant idJ
 * @param int $idJ id du Joueur dont on souhaite obtenir les skins achetés
 * @return array|null
 * @deprecated fonction implémentée suite à un malentendu sur des besoins. peut-être utile malgré tout
 */
function readBoughtSkinsById(int $idJ) : ?array {
    $connexion = ConnexionSingleton::getInstance();

    $Records = "SELECT * FROM EffectueAchat WHERE idJoueur = :idJoueur";

    $statement = $connexion->prepare($Records);

    $statement->bindParam("idJ", $idJ);

    $success = $statement->execute();

    if ($success) {
        $resultsFromEffAchat = $statement->fetchAll(PDO::FETCH_DEFAULT);
        $idAchats = [];
    
        foreach($resultsFromEffAchat as $record) {
            array_push($idAchats,  $record["idAchat"]);
        }

        $arrayOfSkins = []; // collection de skins achetés

        for ($idAchat = 0; $idAchat < count($idAchats); $idAchat++ ) {
            $SelectQuery = "SELECT * FROM SkinAchetable WHERE idAchat = :idAchat";

            $statement = $connexion->prepare($SelectQuery);

            $statement->bindParam("idAchat", $idAchat);

            $success_ = $statement->execute();

            if($success_) {
                $results = $statement->fetch(PDO::FETCH_ASSOC);

                $idAchat = $results["idAchat"];
                $idSkin = $results["idSkin"];
                $dateAchat = $results["dateAchat"];
                $etatSkin = $results["etatSkin"];
                $typeSkin = $results["typeSkin"];
    
                array_push($arrayOfSkins, new SkinAchete($idAchat, $idSkin, $dateAchat, $typeSkin));
            } else {
                return null;
            }
        }
        
        return $arrayOfSkins;
    } else {
        return null;
    }
}


/**
 * @author Mael
 * @brief renvoie une liste des joueurs possédent le skin idSkin
 * @param $idSkin l'id du skin que les joueurs dans la liste retournée possèdent
 * @return array|null une collection de joueurs si des joueurs possèdent le skin, null sinon
 */
function readJoueursThatHaveSkins(int $idSkin): ?array {
    $connexion = ConnexionSingleton::getInstance();

    return null;
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
function verifUser(String $email, String $mdp) {  
    $connexion = ConnexionSingleton::getInstance();
    $sql = "SELECT email, mdp FROM joueur WHERE email = :email";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam('email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC); 
    return $user && password_verify($mdp,$user['mdp']);
}
/**
 * @author Mael
 * @brief renvoie le pseudonyme en fonction de l'identifiant
 * @param $id l'id du joueur
 * @return array le pseudo du joueur
 */
function getPseudoById(int $id){
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select pseudonyme from joueur where id =?";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();
    $pseudo = $stmt->fetch(PDO::FETCH_ASSOC);
    return $pseudo;
}
/**
 * @author Mael
 * @brief renvoie le nombre de douzcoin en fonction de l'identifiant
 * @param $id l'id du joueur
 * @return array le nombre de douzcoin
 */
function getMoneyById(int $id): int{
    $connexion = ConnexionSingleton::getInstance();
    $sql = "Select douzCoin from joueur where id = :id";
    $stmt = $connexion->prepare($sql);
    $stmt->bindParam(":id",$id);
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
    return $bio;
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
function readAvatarById(int $idUser): string{
    
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "Select avatarChemin from Joueur  WHERE id = :idUser";
    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idUser", $idUser);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['avatarChemin'];
}


function updateAvatar(String $path, int $idUser) {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET avatarChemin = :chemin WHERE id = :id";

    $statement = $connection->prepare($updateQuery);
    $statement->bindParam(":chemin", $path);
    $statement->bindParam(":id", $idUser);

    return $statement->execute();

}
function cryptage($data,$key){
    $iv = random_bytes(16); //Génération d'une valeur aléatoire de 16 octets
    $chiffrement = openssl_encrypt($data,'aes-256-cbc',$key,0,$iv); //chiffrement de la donnée en utilisant l'algo de chiffrage AES, la clé et la valeur aléatoire 
    return base64_encode($iv.$chiffrement); //concaténation de la valeur aléatoire au chiffrement
}
function decryptage($data,$key){
    if ($data != null){
        $data = base64_decode($data); //décryptage des données pour séparer la valeur random et le texte chiffré
        $iv = substr($data,0,16); //Récupère la valeur aléatoire ( 16 premiers octets)
        $chiffre = substr($data,16); // Extraction du texte chiffré (le reste après la valeur aléatoire)
        return openssl_decrypt($chiffre,'aes-256-cbc',$key,0,$iv); //Déchiffrement des données en utilisant la clé et la valeur aléatoire
    }else{
        return null;
    }
}

function readMusicPath($idJ) {
    $connection = ConnexionSingleton::getInstance();
    $selectedQuery = "SELECT musiqueChemin FROM Joueur WHERE id = :idJ";
    $statement = $connection->prepare($selectedQuery);
    $statement->bindParam(":idJ", $idJ);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result['musiqueChemin'];
}

function updateMusicPath($idJ,$newpath){
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET musiqueChemin = :newpath WHERE id = :id";
    $statement = $connection->prepare($updateQuery);
    $statement->bindParam(":newpath", $newpath);
    $statement->bindParam(":id", $idJ);
    return $statement->execute();
}

function readIdPartieJoueurById(int $id): int {
    return (readJoueur($id) != null) ? readJoueur($id)->getIdPartieEnCours() : -1;
}

function updateIdPartieJoueurById(int $id, int $idPartie): bool {
    $connection = ConnexionSingleton::getInstance();
    $updateQuery = "UPDATE Joueur SET idPartieEnCours = :idPartie WHERE id = :id";

    $statement = $connection->prepare($updateQuery);
    $statement->bindParam(":idPartie", $idPartie);
    $statement->bindParam(":id", $id);

    return $statement->execute();
}
