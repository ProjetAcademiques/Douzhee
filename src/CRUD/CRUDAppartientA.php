<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/AppartientA.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";


    //FONCTIONS CREATE

    /**
     * @brief Crée une liaison entre une partie et un joueur
     * @author Nathan
     * @param int $idPartieJoue identifiant de la partie jouée
     * @param int $idJoueurJoue identifiant du joueur qui joue la partie jouée
     * @return void
     */
    function createAppartientA(int $idPartieJouee, int $idJoueurJouee): void{
        $connection = ConnexionSingleton::getInstance();

        $insertAppartientA = 'INSERT INTO appartientA VALUES (NULL, :idPartieJouee, :idJoueurJouee)';

        $statement = $connection->prepare($insertAppartientA);
        $statement->bindParam(':idPartieJoue', $idPartieJouee, PDO::PARAM_INT);
        $statement->bindParam(':idJoueurJoue',$idJoueurJouee, PDO::PARAM_INT);
        $statement->execute();
    }


    //FONCTIONS READ

    /**
     * @brief Récupère toutes les liaisons entre les parties et joueurs
     * @author Nathan
     * @return array
     */
    function readAllAppartientA(): array{
        $connection = ConnexionSingleton::getInstance();

        $readAll = 'SELECT * FROM appartientA';

        $statement = $connection->prepare($readAll);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère toutes les liaisons entre un joueur donné et ses parties
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return array
     */
    function readAppartientAByIdUser(int $idUser): array{
        $connection = ConnexionSingleton::getInstance();

        $readLiaisons = 'SELECT * FROM appartientA WHERE idJoueurJoue = :idUser';

        $statement = $connection->prepare($readLiaisons);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère toutes les liaisons entre une partie donnée et ses joueurs
     * @author Nathan
     * @param int $idPartie identifiant de la partie
     * @return array
     */
    function readAppartientAByIdPartie(int $idPartie): array{
        $connection = ConnexionSingleton::getInstance();

        $readLiaisons = 'SELECT * FROM appartientA WHERE idPartieJoue = :idPartie';

        $statement = $connection->prepare($readLiaisons);
        $statement->bindParam(':idPartie', $idPartie, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }