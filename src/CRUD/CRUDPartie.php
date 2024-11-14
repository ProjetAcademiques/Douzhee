<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Partie.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";

    //FONCTIONS CREATE

    /**
     * @brief Création d'une partie avec $nbJoueurs joueurs
     * @author Nathan
     * @param int $nbJoueurs nombre de joueurs
     * @return void
     */
    function createPartie(int $nbJoueurs): void{
        $connection = connection();

        $date = date("j:n:g:i:s");
        $statut = 'En commencement';
        $scoreTotal = 0;

        $insertPartie = 'INSERT INTO partie VALUES (datePartie, statut, scoreTotalPartie, nbJoueurs)';

        $statement = $connection->prepare($insertPartie);
        $statement->bindParam('datePartie', $date, PDO::PARAM_STR);
        $statement->bindParam('statut', $statut, PDO::PARAM_STR);
        $statement->bindParam('scoreTotalPartie', $scoreTotal, PDO::PARAM_INT);
        $statement->bindParam('nbJoueurs', $nbJoueurs, PDO::PARAM_INT);
        $statement->execute();
    }


    //FONCTIONS READ

    /**
     * @brief Récupère toutes les parties
     * @author Nathan
     * @return array
     */
    function readAllPartie(): array{
        $connection = connection();

        $readParties = 'SELECT * FROM partie ORDER BY date DESC';

        $statement = $connection->prepare($readParties);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère une partie donnée
     * @author Nathan
     * @param int $id
     * @return Partie
     */
    function readPartieById(int $id): Partie{
        $connection = connection();

        $readPartie = 'SELECT * FROM partie WHERE id = id';

        $statement = $connection->prepare($readPartie);
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return new Partie($results['id'], $results['date'], $results['score'], $results['scoreTotalPartie'], $results['nbJoueurs']);
    }

    /**
     * @brief Récupère toutes les parties avec le statut donné
     * @author Nathan
     * @param string $statut
     * @return array
     */
    function readPartieByStatut(String $statut): array{
        $connection = connection();

        $readParties = 'SELECT * FROM partie WHERE statut = statut ORDER BY date DESC';

        $statement = $connection->prepare($readParties);
        $statement->bindParam('statut', $statut, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    //FONCTIONS UPDATE

    /**
     * @brief Met à jour le statut d'une partie donnée
     * @author Nathan
     * @param string $statut
     * @param int $id 
     * @return void
     */
    function updateStatut(String $statut, int $id): void{
        $connection = connection();

        $updateStatut = 'UPDATE partie SET statut = statut WHERE id = id';

        $statement = $connection->prepare($updateStatut);
        $statement->bindParam('statut', $statut, PDO::PARAM_STR);
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @brief Met à jour une partie lors de sa fin
     * @author Nathan
     * @param int $scoreTotal
     * @param int $id
     * @return void
     */
    function updateEndOfGame(int $scoreTotal, int $id): void{
        $connection = connection();

        $updatePartie = 'UPDATE partie SET scoreTotalPartie = scoreTotal WHERE id = id';

        $statement = $connection->prepare($updatePartie);
        $statement->bindParam('scoreTotal', $scoreTotal, PDO::PARAM_INT);
        $statement->bindParam('id', $id, PDO::PARAM_INT);
        $statement->execute();
    }