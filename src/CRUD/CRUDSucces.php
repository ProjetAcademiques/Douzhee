<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Classes/Succes.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/douzhee/src/Utils/connectionSingleton.php";

    //FONCTIONS READ

    /**
     * @brief Récupère tous les succès
     * @author Nathan
     * @return array
     */
    function readAllSucces(): array{
        $connection = ConnexionSingleton::getInstance();

        $readSucces = 'SELECT * FROM succes';

        $statement = $connection->prepare($readSucces);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère un succès en fonction de son id
     * @author Nathan
     * @param int $id identifiant du succès
     * @return Succes instance de Succes
     */
    function readSuccesById(int $id): Succes{
        $connection = ConnexionSingleton::getInstance();

        $readSucces = 'SELECT * FROM succes WHERE id = :id';
        $statement = $connection->prepare($readSucces);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $results = $statement->fetch(PDO::FETCH_ASSOC);
        return new Succes($results['id'], $results['nomSucces'], $results['Condition'], $results['typeSucces']);
    }
