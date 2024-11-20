<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Classes/Classement.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/Utils/connectionSingleton.php";
  //  require_once $_SERVER['DOCUMENT_ROOT'] . "/SAE/Douzhee/src/CRUD/CRUDSeTrouve.php";

    //FONCTIONS CREATE

    /**
     * @brief Initialise le classement d'un joueur
     * @author Nathan
     * @param string $pseudo pseudo du joueur
     * @param int $idUser identifiant du joueur
     * @return void
     */
    function createClassement(String $pseudo, int $idUser): void{
        $connection = ConnexionSingleton::getInstance();

        $insertClassement = 'INSERT INTO classement VALUES (NULL, 0, 0, :pseudo)';

        $statement = $connection->prepare($insertClassement);
        $statement->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $statement->execute();

        $idClassement = $connection->lastInsertId();

        createSeTrouve($idUser, $idClassement);
    }


    //FONCTIONS READ

    /**
     * @brief Récupère le classement entier par ordre croissant de position
     * @author Nathan
     * @return array
     */
    function readAllClassement(): array{
        $connection = ConnexionSingleton::getInstance();

        $readAllClassement = 'SELECT * FROM classement ORDER BY placeClassement ASC';

        $statement = $connection->prepare($readAllClassement);
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @brief Récupère le classement d'un joueur donné
     * @author Nathan
     * @param int $idUser identifiant de l'utilisateur
     * @return Classement instance de Classement
     */
    function readClassementByIdUser(int $idUser): Classement{
        $connection = ConnexionSingleton::getInstance();

        $readClassement = 'SELECT * FROM classement WHERE id = (SELECT idClassement FROM seTrouve WHERE idJoueur = :idUser)';

        $statement = $connection->prepare($readClassement);
        $statement->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Classement($result['id'], $result['placeClassement'], $result['score'], $result['pseudo']);
    }


    //FONCTIONS UPDATE

    /**
     * @brief Met à jour le classment d'un joueur et le change de place si possible
     * @author Nathan
     * @param int $idUser identifiant de l'utilisateur
     * @param int $newScore nouveau score de l'utilisateur
     * @return void
     */
    function updateClassement(int $idUser, int $newScore): void {
        $connection = ConnexionSingleton::getInstance();

        $getClassementId = "SELECT idClassement FROM seTrouve WHERE idJoueur = :idUser";
        $stmt = $connection->prepare($getClassementId);
        $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
        $stmt->execute();
        $idClassement = $stmt->fetchColumn();
    
        $updateScore = "UPDATE Classement SET score = :newScore WHERE id = :idClassement";
        $stmt = $connection->prepare($updateScore);
        $stmt->bindParam(':newScore', $newScore, PDO::PARAM_INT);
        $stmt->bindParam(':idClassement', $idClassement, PDO::PARAM_INT);
        $stmt->execute();
    
        $getRankings = "SELECT id, score FROM Classement ORDER BY score DESC, placeClassement ASC";
        $rankings = $connection->query($getRankings)->fetchAll(PDO::FETCH_ASSOC);
    
        foreach ($rankings as $index => $player) {
            if ($player['id'] == $idClassement) {
                $currentIndex = $index;
                break;
            }
        }
    
        if (isset($currentIndex) && $currentIndex > 0) {
            $playerAbove = $rankings[$currentIndex - 1];
            
            if ($newScore > $playerAbove['score']) {
                $updatePlace = "UPDATE Classement SET placeClassement = :newPlace WHERE id = :id";

                $stmt = $connection->prepare($updatePlace);
                $stmt->execute([':newPlace' => $currentIndex, ':id' => $idClassement]);
                $stmt->execute([':newPlace' => $currentIndex + 1, ':id' => $playerAbove['id']]);
            }
        }
    }    