<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Statistiques.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/CRUD/CRUDConsulte.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/CRUD/CRUDClassement.php";

    //FONCTIONS CREATE

    //Fonction à modifier selon les choix d'implémentations
    function createStatistiques(int $nbPartiesGagnees, int $scoreMaximal, String $tempsJeu, float $ratioVictoire, int $nbSucces, int $idUser): void {
        $connection = connection();

        $insertStatsQuery = 
        "INSERT INTO statistiques VALUES (nbPartiesGagnees, scoreMaximal, tempsJeu, ratioVictoire, nbSucces)";

        $statement = $connection->prepare($insertStatsQuery);
        $statement->bindParam("nbPartiesGagnees", $nbPartiesGagnees, PDO::PARAM_INT);
        $statement->bindParam("scoreMaximal", $scoreMaximal, PDO::PARAM_INT);
        $statement->bindParam("tempsJeu", $tempsJeu, PDO::PARAM_STR);
        $statement->bindParam("ratioVictoire", $ratioVictoire);
        $statement->bindParam("nbSucces", $nbSucces, PDO::PARAM_INT);
        $statement->execute();

        $stats = readStatistiquesByIdUser($idUser);
        createConsulte($stats->getId(), $idUser);
    }


    //FONCTIONS READ

    /**
     * Récupère toutes les statistiques d'un utilisateur donné
     * @author Nathan
     * @param int $idUser
     * @return Statistiques
     */
    function readStatistiquesByIdUser(int $idUser): Statistiques {
        $connection = connection();

        $readStatsQuery = 
        "SELECT * FROM statistiques 
        WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)";
        
        $statement = $connection->prepare($readStatsQuery);
        $statement->bindParam("idUser", $idUser, PDO::PARAM_INT);
        $statement->execute();

        $data = $statement->fetch(PDO::FETCH_ASSOC);

        $statsUser = new Statistiques($data['id'], $data['nbPartiesGagnees'], $data['scoreMaximal'], $data['tempsJeu'], $data['ratioVictoire'], $data['nbSucces']);
        return $statsUser;
    }


    //FONCTIONS UPDATE

    /**
     * Met à jour toutes les statistiques d'un joueur donné à la fin d'une partie donnée
     * @author Nathan
     * @param int $idUser
     * @param int $idGame
     * @return void
     */
    function updateEndOfGame(int $idUser, int $idGame): void{
        $connection = connection();
        $stats = readStatistiquesByIdUser($idUser);

        if(readVictory($connection, $idUser, $idGame)){ //Fonction qui devra etre codée dans CRUDJouerPartie.php
            $updateVictory = 
            'UPDATE FROM statistiques SET nbPartiesGagnees = nbPartiesGagnees + 1 
            WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
            
            $statement = $connection->prepare($updateVictory);
            $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
            $statement->execute();

            updateClassement($idUser, $stats->getNbPartiesGagnees() + 1);
        }

        $updateRatio = 
        'UPDATE FROM statistiques SET ratioVictoire = nbPartieGagnees / 
        (SELECT COUNT(*) FROM participeA WHERE idJoueur = idUser)';
        
        $statement = $connection->prepare($updateRatio);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $partie = readPartieByIdUserAndIdGame($idUser, $idGame); //Fonction qui devra etre codée dans CRUDJouerPartie.php
        if($partie->getScoreJoueur() > $stats->getScoreMaximal()){
            $updateBestScore = 
            'UPDATE FROM statistiques SET scoreMaximal = newScore 
            WHERE id = (SELECT idStatistiques FROM consulte WHERE idJoueur = idUser)';
            
            $statement = $connection->prepare($updateBestScore);
            $statement->bindParam('newScore', $partie->getScoreJoueur(), PDO::PARAM_INT);
            $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
            $statement->execute();
        }
    }

    /**
     * Incrémente de 1 le nombre de succès d'un joueur donné
     * @author Nathan
     * @param int $idUser
     * @return void
     */
    function updateNbSucces(int $idUser){
        $connection = connection();

        $updateSucces = 'UPDATE FROM statistiques SET nbSucces = nbSucces + 1 WHERE id = idUser';
        $statement = $connection->prepare($updateSucces);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();
    }