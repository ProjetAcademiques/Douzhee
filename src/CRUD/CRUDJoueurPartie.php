<?php
    require_once "../Classes/JoueurPartie.php";
    require_once "../Utils/connectionSingleton.php";

    function createJoueurPartie(string $idJoueur, string $idPartie, int $positionPartie): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "INSERT INTO JoueurPartie (idJoueur, idPartie, positionPartie) VALUES (:idJoueur, :idPartie, :positionPartie)";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':positionPartie', $positionPartie);    

        return $statement->execute();
    }

    function readJoueurPartie(string $idJoueur, string $idPartie): ?JoueurPartie {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie WHERE idJoueur = :idJoueur AND idPartie = :idPartie";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);
        $statement->bindParam(':idPartie', $idPartie);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if(gettype($results) != "boolean") {
            return new JoueurPartie($results['idJoueur'], $results['idPartie'], $results['positionPartie'], $results['score'], $results['estGagant']);
        }
        return null;
    }

    function readPartieEnCours(string $idJoueur): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie JOIN Partie ON JoueurPartie.idPartie = Partie.idPartie WHERE JoueurPartie.idJoueur = :idJoueur AND Partie.statut = 1";
        

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            return true;
        }
        return false;
    }

    function readPartieEnCommencement(string $idJoueur): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie JOIN Partie ON JoueurPartie.idPartie = Partie.idPartie WHERE JoueurPartie.idJoueur = :idJoueur AND Partie.statut = 0";
        

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJoueur', $idJoueur);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            return true;
        }
        return false;
    }

    function readPositionIsUsed(string $idPartie, int $positionPartie): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie WHERE idPartie = :idPartie AND positionPartie = :positionPartie";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':positionPartie', $positionPartie);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        if ($results) {
            return true;
        }
        return false;
    }

    function readConnectedPlayers(string $idPartie): int {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT COUNT(*) FROM JoueurPartie WHERE idPartie = :idPartie";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idPartie', $idPartie);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        return $results['COUNT(*)'];
    }

    function readAllUsersByIdPartie(string $idPartie): ?array {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie JOIN Joueur ON JoueurPartie.idJoueur = Joueur.idJoueur WHERE JoueurPartie.idPartie = :idPartie";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idPartie', $idPartie);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(gettype($results) != "boolean") {
            return $results;
        }
        return null;
    }

    function readIdPartieEnCour(string $idJ): string {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT idPartie FROM JoueurPartie WHERE idJoueur = :idJ AND idPartie IN (SELECT idPartie FROM Partie WHERE statut = 1)";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJ', $idJ);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        return $results['idPartie'];
    }

    function readEstGagnant(string $idJ, string $idP): bool {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT estGagnant FROM JoueurPartie WHERE idPartie = :idP AND idJoueur = :idJ";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idP', $idP);
        $statement->bindParam(':idJ', $idJ);

        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);

        return $results['estGagnant'];
    }

    function readHistorique(string $idJ): ?array {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie JOIN Partie ON JoueurPartie.idPartie = Partie.idPartie WHERE JoueurPartie.idJoueur = :idJ AND Partie.statut = 2";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idJ', $idJ);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(gettype($results) != "boolean") {
            return $results;
        }
        return null;
    }

    function readInfoAdversaires(string $idP, string $idJ): ?array {
        $connexion = ConnexionSingleton::getInstance();

        $query = "SELECT * FROM JoueurPartie JOIN Joueur ON JoueurPartie.idJoueur = Joueur.idJoueur WHERE JoueurPartie.idPartie = :idP AND JoueurPartie.idJoueur != :idJ";

        $statement = $connexion->prepare($query);

        $statement->bindParam(':idP', $idP);
        $statement->bindParam(':idJ', $idJ);

        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        if(gettype($results) != "boolean") {
            return $results;
        }
        return null;
    }

    function updateScore(string $idJ, string $idP, int $score): bool {
        $connexion = ConnexionSingleton::getInstance();
    
        $UpdateQuery = "UPDATE JoueurPartie SET score = :score WHERE idPartie = :idP AND idJoueur = :idJ";
        $statement = $connexion->prepare($UpdateQuery);
        $statement->bindParam(":score", $score, PDO::PARAM_INT);
        $statement->bindParam(":idP", $idP, PDO::PARAM_STR);
        $statement->bindParam(":idJ", $idJ, PDO::PARAM_STR);
    
        if ($statement->execute()) {
            echo "Mise à jour réussie pour Joueur $idJ\n";
            return true;
        } else {
            echo "Erreur SQL : ";
            print_r($statement->errorInfo());
            return false;
        }
    }    
    
    function updateEstGagnant(string $idJ, string $idP): bool {
        $connexion = ConnexionSingleton::getInstance();
    
        $UpdateQuery = "UPDATE JoueurPartie SET estGagnant = 1 WHERE idPartie = :idP AND idJoueur = :idJ";
        $statement = $connexion->prepare($UpdateQuery);
        $statement->bindParam(":idP", $idP, PDO::PARAM_STR);
        $statement->bindParam(":idJ", $idJ, PDO::PARAM_STR);
    
        $result = $statement->execute();
        if ($result) {
            error_log("Update estGagnant successfully for user $idJ in game $idP");
        } else {
            $errorInfo = $statement->errorInfo();
            error_log("Failed to update estGagnant for user $idJ in game $idP. Error: " . print_r($errorInfo, true));
        }
    
        return $result;
    }
    
    function deletePartieEnCour(string $idJ): bool {
        $connexion = ConnexionSingleton::getInstance();
    
        $DeleteQuery = "DELETE FROM JoueurPartie WHERE idJoueur = :idJ AND idPartie IN (SELECT idPartie FROM Partie WHERE statut = 1)";
        $statement = $connexion->prepare($DeleteQuery);
        $statement->bindParam(":idJ", $idJ, PDO::PARAM_STR);
    
        return $statement->execute();
    }
?>