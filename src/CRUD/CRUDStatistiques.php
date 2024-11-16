<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Classes/Statistiques.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Utils/connectionSingleton.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/CRUD/CRUDConsulte.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/CRUD/CRUDClassement.php";

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

        $insertStatsQuery = "INSERT INTO statistiques VALUES (nbPartiesGagnees, scoreMaximal, tempsJeu, ratioVictoire, nbSucces)";

        $statement = $connection->prepare($insertStatsQuery);
        $statement->bindParam("nbPartiesGagnees", $nbPartiesGagnees, PDO::PARAM_INT);
        $statement->bindParam("scoreMaximal", $scoreMaximal, PDO::PARAM_INT);
        $statement->bindParam("tempsJeu", $tempsJeu, PDO::PARAM_STR);
        $statement->bindParam("ratioVictoire", $ratioVictoire);
        $statement->bindParam("nbSucces", $nbSucces, PDO::PARAM_INT);
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

        $statsUser = new Statistiques($data['id'], $data['nbPartiesGagnees'], $data['scoreMaximal'], $data['tempsJeu'], $data['ratioVictoire'], $data['nbSucces']);
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

        if(readVictory($connection, $idUser, $idGame)){ //Fonction qui devra etre codée dans CRUDJouerPartie.php
            $updateVictory = 'UPDATE statistiques SET nbPartiesGagnees = nbPartiesGagnees + 1 WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
            $statement = $connection->prepare($updateVictory);
            $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
            $statement->execute();

            updateClassement($idUser, $stats->getNbPartiesGagnees() + 1);
        }

        $updateRatio = 'UPDATE statistiques SET ratioVictoire = nbPartieGagnees / (SELECT COUNT(*) FROM participeA WHERE idJoueur = idUser)';
        $statement = $connection->prepare($updateRatio);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $partie = readPartieByIdUserAndIdGame($idUser, $idGame); //Fonction qui devra etre codée dans CRUDJouerPartie.php
        if($partie->getScoreJoueur() > $stats->getScoreMaximal()){
            $updateBestScore = 'UPDATE statistiques SET scoreMaximal = newScore WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
            $statement = $connection->prepare($updateBestScore);
            $statement->bindParam('newScore', $partie->getScoreJoueur(), PDO::PARAM_INT);
            $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    /**
     * @brief Incrémente de 1 le nombre de succès d'un joueur donné
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function updateNbSucces(int $idUser){
        $connection = ConnexionSingleton::getInstance();

        $updateSucces = 'UPDATE statistiques SET nbSucces = nbSucces + 1 WHERE id = idUser';
        $statement = $connection->prepare($updateSucces);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();
    }