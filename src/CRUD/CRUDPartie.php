<?php
    require_once "../Classes/Partie.php";
    require_once "../Utils/connectionSingleton.php";
    
    function createPartie(string $idPartie, string $datePartie, int $nbJoueur): ?string {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "INSERT INTO Partie (idPartie, datePartie, nbJoueur) VALUES (:idPartie, :datePartie, :nbJoueur)";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':datePartie', $datePartie);
        $statement->bindParam(':nbJoueur', $nbJoueur);
        
        if ($statement->execute()) {
            return $idPartie;
        }
    }

    function readPartie(string $idPartie): ?Partie {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "SELECT * FROM Partie WHERE idPartie = :idPartie";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':idPartie', $idPartie);
        
        $statement->execute();
        
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        
        if(gettype($results) != "boolean") {
            return new Partie($results['idPartie'], $results['datePartie'], $results['statut'], $results['scoreTotalPartie'], $results['nbJoueur']);
        }
        return null;
    }

    function readPartieByLien(string $lienPartie): ?Partie {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "SELECT * FROM Partie WHERE idPartie = :lienPartie";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':lienPartie', $lienPartie);
        
        $statement->execute();
        
        $results = $statement->fetch(PDO::FETCH_ASSOC);
        
        if(gettype($results) != "boolean") {
            return new Partie($results['idPartie'], $results['datePartie'], $results['statut'], $results['scoreTotalPartie'], $results['nbJoueur']);
        }
        return null;
    }

    function updateStatutPartie(string $idPartie, int $statut): bool {
        $connexion = ConnexionSingleton::getInstance();
        
        $query = "UPDATE Partie SET statut = :statut WHERE idPartie = :idPartie";
        
        $statement = $connexion->prepare($query);
        
        $statement->bindParam(':idPartie', $idPartie);
        $statement->bindParam(':statut', $statut);
        
        return $statement->execute();
    }

    /**
     * @brief Met à jour le score total d'une partie
     * @author Nathan
     * @param int $scoreTotal score total de la partie
     * @param int $id identifiant de la partie
     * @return void
     */
    function updateScoreTot(int $scoreTotal, string $id): void{
        $connection = ConnexionSingleton::getInstance();

        $updatePartie = 'UPDATE partie SET scoreTotalPartie = :scoreTotal WHERE idPartie = :id';

        $statement = $connection->prepare($updatePartie);
        $statement->bindParam(':scoreTotal', $scoreTotal, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_STR);
        $statement->execute();
    }

?>