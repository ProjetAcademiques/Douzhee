<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Obtient.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/CRUD/CRUDStatistiques.php";

    //FONCTIONS CREATE

    /**
     * Crée un lien entre un succès et un joueur pour indiquer qu'il a validé le succès
     * @author Nathan
     * @param int $idUser
     * @param int $idSucces
     * @return void
     */
    function createObtient(int $idUser, int $idSucces){
        $connection = connection();

        $insertObtient = 'INSERT INTO obtient VALUES (:idUser, :idSucces)';

        $statement = $connection->prepare($insertObtient);
        $statement->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $statement->bindValue('idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        updateNbSucces($idUser);
    }


    //FONCTIONS READ

    /**
     * Récupère la liaison entre un joueur et ses succès
     * @author Nathan
     * @param int $idUser
     * @return array
     */
    function readAllSuccesOfAnUser(int $idUser): array{
        $connection = connection();

        $readAllSucces = 'SELECT * FROM obtient WHERE idJoueur = idUser';

        $statement = $connection->prepare($readAllSucces);
        $statement->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère la liaison entre un succès et les joueurs qui l'ont obtenu
     * @author Nathan
     * @param int $idSucces
     * @return array
     */
    function readAllUserWinTheSuccesId(int $idSucces): array{
        $connection = connection();

        $readAllUserSucces = 'SELECT * FROM obtient WHERE idSucces = idSucces';
        $statement = $connection->prepare($readAllUserSucces);
        $statement->bindValue('idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }