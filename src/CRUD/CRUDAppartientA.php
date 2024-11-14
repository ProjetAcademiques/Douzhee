<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/AppartientA.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";

    //FONCTIONS CREATE

    /**
     * Crée une liaison entre une partie et un joueur
     * @author Nathan
     * @param int $idPartie
     * @param int $idPartieJoue
     * @param int $idJoueurJoue
     * @return void
     */
    function createAppartientA(int $idPartie, int $idPartieJoue, int $idJoueurJoue): void{
        $connection = connection();

        $insertAppartientA = 'INSERT INTO appartientA VALUES (idPartie, idPartieJoue, idJoueurJoue)';

        $statement = $connection->prepare($insertAppartientA);
        $statement->bindParam('idPartie', $idPartie, PDO::PARAM_INT);
        $statement->bindParam('idPartieJoue', $idPartieJoue, PDO::PARAM_INT);
        $statement->bindParam('idJoueurJoue',$idJoueurJoue, PDO::PARAM_INT);
        $statement->execute();
    }


    //FONCTIONS READ

    /**
     * Récupère toutes les liaisons entre les parties et joueurs
     * @author Nathan
     * @return array
     */
    function readAllAppartientA(): array{
        $connection = connection();

        $readAll = 'SELECT * FROM appartientA';

        $statement = $connection->prepare($readAll);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère toutes les liaisons entre un joueur donné et ses parties
     * @author Nathan
     * @param int $idUser
     * @return array
     */
    function readAppartientAByIdUser(int $idUser): array{
        $connection = connection();

        $readLiaisons = 'SELECT * FROM appartientA WHERE idJoueurJoue = idUser';

        $statement = $connection->prepare($readLiaisons);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère toutes les liaisons entre une partie donnée et ses joueurs
     * @author Nathan
     * @param int $idPartie
     * @return array
     */
    function readAppartientAByIdPartie(int $idPartie): array{
        $connection = connection();

        $readLiaisons = 'SELECT * FROM appartientA WHERE idPartieJoue = idPartie';

        $statement = $connection->prepare($readLiaisons);
        $statement->bindParam('idPartieJoue', $idPartie, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }