<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Succes.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";

    //FONCTIONS READ

    /**
     * Récupère tous les succès
     * @author Nathan
     * @return array
     */
    function readAllSucces(): array{
        $connection = connection();

        $readSucces = 'SELECT * FROM succes';

        $statement = $connection->prepare($readSucces);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un succès en fonction de son id
     * @author Nathan
     * @param int $id
     * @return Succes
     */
    function readSuccesById(int $id): Succes{
        $connection = connection();

        $readSucces = 'SELECT * FROM succes WHERE id = :id';
        $statement = $connection->prepare($readSucces);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();

        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return new Succes($results['id'], $results['name'], $results['condition'], $results['type']);
    }