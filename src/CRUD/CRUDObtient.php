<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Classes/Obtient.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Utils/connectionSingleton.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/CRUD/CRUDStatistiques.php";

    //FONCTIONS CREATE

    /**
     * @brief Crée un lien entre un succès et un joueur pour indiquer qu'il a validé le succès
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @param int $idSucces identifiant du succès obtenu
     * @return void
     */
    function createObtient(int $idUser, int $idSucces){
        $connection = ConnexionSingleton::getInstance();

        $insertObtient = 'INSERT INTO obtient VALUES (:idUser, :idSucces)';

        $statement = $connection->prepare($insertObtient);
        $statement->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $statement->bindValue('idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        updateNbSucces($idUser);
    }


    //FONCTIONS READ

    /**
     * @brief Vérifie si un joueur donné à obtenu un succès donné
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @param int $idSucces identifiant du succès
     * @return bool True si le joueur a obtenu le succès, False sinon
     */
    function verifSuccesUser(int $idUser, int $idSucces): bool{
        $connection = ConnexionSingleton::getInstance();

        $readSuccesUser = 'SELECT 1 FROM obtient WHERE idJoueur = :idUser AND idSucces = :idSucces';
        $statement = $connection->prepare($readSuccesUser);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->bindParam(':idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC) !== false;
    }

    /**
     * @brief Récupère la liaison entre un joueur et ses succès
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return array tableau contenant tous les succès d'un joueur
     */
    function readAllSuccesOfAnUser(int $idUser): array{
        $connection = ConnexionSingleton::getInstance();

        $readAllSucces = 'SELECT * FROM obtient WHERE idJoueur = idUser';

        $statement = $connection->prepare($readAllSucces);
        $statement->bindValue('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère la liaison entre un succès et les joueurs qui l'ont obtenu
     * @author Nathan
     * @param int $idSucces identifiant du succès
     * @return array tableau contenant tous les utilisateurs ayant le succès
     */
    function readAllUserWinTheSuccesId(int $idSucces): array{
        $connection = ConnexionSingleton::getInstance();

        $readAllUserSucces = 'SELECT * FROM obtient WHERE idSucces = idSucces';
        $statement = $connection->prepare($readAllUserSucces);
        $statement->bindValue('idSucces', $idSucces, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }