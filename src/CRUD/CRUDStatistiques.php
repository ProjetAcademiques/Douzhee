<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Statistiques.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/CRUD/CRUDConsulte.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/CRUD/CRUDClassement.php";

    //FONCTIONS CREATE

    /**
     * @brief Initialise les statistiques du joueur
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function createStatistiques(int $idUser): void {
        $connection = ConnexionSingleton::getInstance();

        $nbPartiesGagnees = 0;
        $scoreMaximal = 0;
        $tempsJeu = 0;
        $ratioVictoire = 0;
        $nbSucces = 0;
        $nbDouzhee = 0;
        $nbPartiesJoues = 0;

        $insertStatsQuery = "INSERT INTO statistiques VALUES (nbPartiesGagnees, scoreMaximal, tempsJeu, ratioVictoire, nbSucces, nbDouzhee, nbPartieJoues)";

        $statement = $connection->prepare($insertStatsQuery);
        $statement->bindParam("nbPartiesGagnees", $nbPartiesGagnees, PDO::PARAM_INT);
        $statement->bindParam("scoreMaximal", $scoreMaximal, PDO::PARAM_INT);
        $statement->bindParam("tempsJeu", $tempsJeu, PDO::PARAM_STR);
        $statement->bindParam("ratioVictoire", $ratioVictoire);
        $statement->bindParam("nbSucces", $nbSucces, PDO::PARAM_INT);
        $statement->bindParam("nbDouzhee", $nbDouzhee, PDO::PARAM_INT);
        $statement->bindParam("nbPartieJoues", $nbPartiesJoues, PDO::PARAM_INT);
        $statement->execute();

        $idStats = $connection->lastInsertId();

        createConsulte($idStats, $idUser);
    }


    //FONCTIONS READ

    /**
     * @brief Récupère toutes les statistiques d'un utilisateur donné
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return Statistiques Instance de Statistiques
     */
    function readStatistiquesByIdUser(int $idUser): Statistiques {
        $connection = ConnexionSingleton::getInstance();

        $readStatsQuery = 
        "SELECT * FROM statistiques 
        WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = :idUser)";
        
        $statement = $connection->prepare($readStatsQuery);
        $statement->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $statsUser = new Statistiques($data['id'], $data['nbPartiesGagnees'], $data['scoreMaximal'], $data['tempsJeu'], $data['ratioVictoire'], $data['nbSucces'], $data['nbDouzhee'], $data['nbPartieJoues']);
        return $statsUser;
    }


    //FONCTIONS UPDATE

    /**
     * @brief Met à jour toutes les statistiques d'un joueur donné à la fin d'une partie donnée
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @param int $idGame identifiant de la partie finie
     * @return void
     */
    function updateEndOfGame(int $idUser, int $idGame): void{
        $connection = ConnexionSingleton::getInstance();
        $stats = readStatistiquesByIdUser($idUser);

        $updateNbParties = 'UPDATE statistiques SET nbPartieJoues = nbPartieJoues + 1 WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = :idUser)';
        $statement = $connection->prepare($updateNbParties);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $updateNbParties = 'UPDATE statistiques SET nbPartiesJoues = nbPartiesJoues + 1 WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
        $statement = $connection->prepare($updateNbParties);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        if(readEstGagnant($idUser, $idGame)){
            $updateVictory = 'UPDATE statistiques SET nbPartiesGagnees = nbPartiesGagnees + 1 WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = :idUser)';
            $statement = $connection->prepare($updateVictory);
            $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $statement->execute();

            updateClassement($idUser, $stats->getNbPartiesGagnees() + 1);
        }

        $updateRatio = 'UPDATE statistiques SET ratioVictoire = nbPartieGagnees / nbPartiesJoues WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
        $statement = $connection->prepare($updateRatio);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $partie = readJouerPartie($idUser, $idGame);
        if($partie->getScoreJoueur() > $stats->getScoreMaximal()){
            $updateBestScore = 'UPDATE statistiques SET scoreMaximal = :newScore WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = :idUser)';
            $statement = $connection->prepare($updateBestScore);
            $scoreJoueur = $partie->getScoreJoueur();
            $statement->bindParam(':newScore', $scoreJoueur,  PDO::PARAM_INT);
            $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
            $statement->execute();
        } 
    }

    /**
     * @brief Incrémente de 1 le nombre de succès d'un joueur donné
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function updateNbSucces(int $idUser): void{
        $connection = ConnexionSingleton::getInstance();

        $updateSucces = 'UPDATE statistiques SET nbSucces = nbSucces + 1 WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
        $statement = $connection->prepare($updateSucces);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @brief Met à jour le nombre de Douzhee d'un joueur
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @param int $nbDouzhee nombre de Douzhee a ajouter
     * @return void
     */
    function updateNbDouzhee(int $idUser, int $nbDouzhee): void{
        $connection = ConnexionSingleton::getInstance();

        $updateNbDouzhee = 'UPDATE statistiques SET nbDouzhee = nbDouzhee + :nbDouzhee WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = :idUser)';
        $statement = $connection->prepare($updateNbDouzhee);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->bindParam(':nbDouzhee', $nbDouzhee, PDO::PARAM_INT);
        $statement->execute();
    }
    function updateTempsJeu(int $idJ, int $delai){
        $connection = ConnexionSingleton::getInstance();

        $updateNbDouzhee = 'UPDATE statistiques SET tempsJeu = tempsJeu + :temps WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = :idUser)';
        $statement = $connection->prepare($updateNbDouzhee);
        $statement->bindParam(':idUser', $idJ, PDO::PARAM_INT);
        $statement->bindParam(':temps', $delai, PDO::PARAM_INT);
        $statement->execute();
    }