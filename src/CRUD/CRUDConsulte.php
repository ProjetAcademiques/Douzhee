<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Classes/Consulte.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Utils/connectionSingleton.php";

    //FONCTIONS CREATE

    /**
     * @brief Crée une liaison entre un joueur et ses statistiques
     * @author Nathan
     * @param int $idStats identifiant des statistiques liées au joueur
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function createConsulte(int $idStats, int $idUser): void{
        $connection = ConnexionSingleton::getInstance();

        $insertConsulte = 'INSERT INTO consulte VALUES (idStats, idUser)';

        $statement = $connection->prepare($insertConsulte);
        $statement->bindParam('idStats', $idStats, PDO::PARAM_INT);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();
    }


    //FONCTIONS READ

    /**
     * @brief Récupère la liaison statistiques/joueur d'un joueur donné
     * @author Nathan
     * @param int $idUser identifiant du joueur
     * @return Consulte instance de Consulte
     */
    function readConsulteByIdUser(int $idUser): Consulte{
        $connection = ConnexionSingleton::getInstance();

        $readConsulte = 'SELECT * FROM consulte WHERE idJoueur = idUser';
        
        $statement = $connection->prepare($readConsulte);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Consulte($result['idStatistiques'], $result['idJoueur']);
    }

    /**
     * @brief Récupère la liaison statistiques/joueur de statistiques données
     * @author Nathan
     * @param int $idStats identifiant des statistiques liées au joueur
     * @return Consulte instance de Consulte
     */
    function readConsulteByIdStats(int $idStats): Consulte{
        $connection = ConnexionSingleton::getInstance();

        $readConsulte = 'SELECT * FROM consulte WHERE idStatistiques = idStats';

        $statement = $connection->prepare($readConsulte);
        $statement->bindParam('idStats', $idStats, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Consulte($result['idStatistiques'], $result['idJoueur']);
    }