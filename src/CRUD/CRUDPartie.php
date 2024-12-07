<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Partie.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";

    //FONCTIONS CREATE

    /**
     * @brief Création d'une partie avec $nbJoueurs joueurs
     * @author Nathan
     * @param int $nbJoueurs nombre de joueurs
     * @param string $lienPartie lien d'invitation de la partie
     * @return int identifiant de la partie créée
     */
    function createPartie(int $nbJoueurs, String $lienPartie): int{
        $liens = readAllLiens();
        if(in_array($lienPartie, $liens)){
            return -1;
        }

        $connection = ConnexionSingleton::getInstance();

        $insertPartie = 'INSERT INTO partie VALUES (NULL, CURRENT_TIMESTAMP, "En commencement", 0, :nbJoueurs, :lienPartie)';

        $statement = $connection->prepare($insertPartie);
        $statement->bindParam(':nbJoueurs', $nbJoueurs, PDO::PARAM_INT);
        $statement->bindParam(':lienPartie', $lienPartie, PDO::PARAM_STR);
        $statement->execute();

        $idPartie = $connection->lastInsertId();
        return $idPartie;
    }


    //FONCTIONS READ

    /**
     * @brief Récupère toutes les parties
     * @author Nathan
     * @return array
     */
    function readAllPartie(): array{
        $connection = ConnexionSingleton::getInstance();

        $readParties = 'SELECT * FROM partie ORDER BY date DESC';

        $statement = $connection->prepare($readParties);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère tous les liens des parties
     * @author Nathan
     * @return array tableau contenant tous les liens des parties
     */
    function readAllLiens(): array{
        $connection = ConnexionSingleton::getInstance();

        $readLiens = 'SELECT lienPartie FROM partie';
        $statement = $connection->prepare($readLiens);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère une partie en fonction de son lien
     * @author Nathan
     * @param string $lienPartie lien de la partie
     * @return Partie instance de Partie contenant toutes les informations récupérées
     */
    function readPartieByLien(String $lienPartie): Partie{
        $connection = ConnexionSingleton::getInstance();

        $readPartie = 'SELECT * FROM partie WHERE lienPartie = :lienPartie';
        $statement = $connection->prepare($readPartie);
        $statement->bindParam(':lienPartie', $lienPartie, PDO::PARAM_STR);
        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return new Partie($results['id'], $results['datePartie'], $results['statut'], $results['scoreTotalPartie'], $results['nbJoueurs'], $results['lienPartie']);
    }

    /**
     * @brief Récupère une partie donnée
     * @author Nathan
     * @param int $id identifiant de la partie
     * @return Partie instance de Partie
     */
    function readPartieById(int $id): Partie{
        $connection = ConnexionSingleton::getInstance();

        $readPartie = 'SELECT * FROM partie WHERE id = :id';

        $statement = $connection->prepare($readPartie);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return new Partie($results['id'], $results['datePartie'], $results['statut'], $results['scoreTotalPartie'], $results['nbJoueurs'], $results['lienPartie']);
    }

    /**
     * @brief Récupère toutes les parties avec le statut donné
     * @author Nathan
     * @param string $statut statut des parties recherchées
     * @return array
     */
    function readPartieByStatut(String $statut): array{
        $connection = ConnexionSingleton::getInstance();

        $readParties = 'SELECT * FROM partie WHERE statut = :statut ORDER BY date DESC';

        $statement = $connection->prepare($readParties);
        $statement->bindParam(':statut', $statut, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    //FONCTIONS UPDATE

    /**
     * @brief Met à jour le statut d'une partie donnée
     * @author Nathan
     * @param string $statut nouveau statut de la partie
     * @param int $id identifiant de la partie
     * @return void
     */
    function updateStatut(String $statut, int $id): void{
        $connection = ConnexionSingleton::getInstance();

        $updateStatut = 'UPDATE partie SET statut = :statut WHERE id = :id';

        $statement = $connection->prepare($updateStatut);
        $statement->bindParam(':statut', $statut, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * @brief Met à jour une partie lors de sa fin
     * @author Nathan
     * @param int $scoreTotal score total de la partie
     * @param int $id identifiant de la partie
     * @return void
     */
    function updateEndOfGame(int $scoreTotal, int $id): void{
        $connection = ConnexionSingleton::getInstance();

        $updatePartie = 'UPDATE partie SET scoreTotalPartie = :scoreTotal WHERE id = :id';

        $statement = $connection->prepare($updatePartie);
        $statement->bindParam(':scoreTotal', $scoreTotal, PDO::PARAM_INT);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }
