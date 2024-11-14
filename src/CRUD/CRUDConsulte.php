<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Consulte.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";

    //FONCTIONS CREATE

    /**
     * Crée une liaison entre un joueur et ses statistiques
     * @author Nathan
     * @param int $idStats
     * @param int $idUser
     * @return void
     */
    function createConsulte(int $idStats, int $idUser): void{
        $connection = connection();

        $insertConsulte = 'INSERT INTO consulte VALUES (idStats, idUser)';

        $statement = $connection->prepare($insertConsulte);
        $statement->bindParam('idStats', $idStats, PDO::PARAM_INT);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();
    }


    //FONCTIONS READ

    /**
     * récupère la liaison statistiques/joueur d'un joueur donné
     * @author Nathan
     * @param int $idUser
     * @return Consulte
     */
    function readConsulteByIdUser(int $idUser): Consulte{
        $connection = connection();

        $readConsulte = 'SELECT * FROM consulte WHERE idJoueur = idUser';
        
        $statement = $connection->prepare($readConsulte);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Consulte($result['idStatistiques'], $result['idJoueur']);
    }

    /**
     * récupère la liaison statistiques/joueur de statistiques données
     * @author Nathan
     * @param int $idStats
     * @return Consulte
     */
    function readConsulteByIdStats(int $idStats): Consulte{
        $connection = connection();

        $readConsulte = 'SELECT * FROM consulte WHERE idStatistiques = idStats';

        $statement = $connection->prepare($readConsulte);
        $statement->bindParam('idStats', $idStats, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Consulte($result['idStatistiques'], $result['idJoueur']);
    }