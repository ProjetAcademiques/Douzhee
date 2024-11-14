<?PHP 
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Classes/Classement.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/Douzhee/src/Utils/headerConnection.php";

    //FONCTIONS CREATE

    //Fonction à modifier selon les choix d'implémentations
    function createClassement(int $placeClassement, int $score, String $pseudo): void{
        $connection = connection();

        $insertClassement = 'INSERT INTO classement VALUES (placeClassement, score, pseudo)';

        $statement = $connection->prepare($insertClassement);
        $statement->bindParam('placeClassement', $placeClassement, PDO::PARAM_INT);
        $statement->bindParam('score', $score, PDO::PARAM_INT);
        $statement->bindParam('pseudo', $pseudo, PDO::PARAM_STR);
        $statement->execute();
    }


    //FONCTIONS READ

    /**
     * Récupère le classement entier par ordre croissant de position
     * @author Nathan
     * @return array
     */
    function readAllClassement(): array{
        $connection = connection();

        $readAllClassement = 'SELECT * FROM classement ORDER BY placeClassement ASC';

        $statement = $connection->prepare($readAllClassement);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère le classement d'un joueur donné
     * @author Nathan
     * @param int $idUser
     * @return Classement
     */
    function readClassementByIdUser(int $idUser): Classement{
        $connection = connection();

        $readClassement = 'SELECT * FROM classement WHERE id = (SELECT idClassement FROM seTrouve WHERE idJoueur = idUser)';

        $statement = $connection->prepare($readClassement);
        $statement->bindParam('idUser', $idUser, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return new Classement($result['id'], $result['placeClassement'], $result['score'], $result['pseudo']);
    }


    //FONCTIONS UPDATE

    /**
     * Met à jour le classment d'un joueur et le change de place si possible
     * @author Nathan
     * @param int $idUser
     * @param int $newScore
     * @return void
     */
    function updateClassement(int $idUser, int $newScore): void {
        $connection = connection();

        $getClassementId = "SELECT idClassement FROM seTrouve WHERE idJoueur = idUser";
        $stmt = $connection->prepare($getClassementId);
        $stmt->bindParam('idUser', $idUser, PDO::PARAM_INT);
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