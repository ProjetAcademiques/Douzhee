<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDPartie.php");
    require_once("../CRUD/CRUDJouerPartie.php");
    require_once("../CRUD/CRUDAppartientA.php");
    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
    
    $_SESSION['user_id'] = 1;
    $joueurTemp = readJoueur($_SESSION['user_id']);


    $joueurTemp = readJoueur($_SESSION['userId']);

    if(isset($_POST['nombre_joueur'])) {
        $nombre_joueur = $_POST['nombre_joueur'];
        $idJoueur = $_SESSION['userId'];
        $lienPartie = bin2hex(random_bytes(10)); // Génère un lien de 20 caractères
        $_SESSION['lienPartie'] = $lienPartie;
        $idPartie = createPartie($nombre_joueur, $_SESSION['lienPartie']);
        if ($idPartie == -1){
            echo '<script type="text/javascript"> window.onload = function () { alert("Lien déjà utilisé"); }</script>';
        }
        $_SESSION['idPartie'] = $idPartie;
        $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 1);
        $_SESSION["position"] = 1;
        header("Location: ./game.php");
        exit();
    }

    if(isset($_POST['lien_partie'])) {
        $lienPartie = $_POST['lien_partie'];
        $partie = readPartieByLien($lienPartie);
        $idPartie = $partie->getId();
        if ($idPartie == -1){
            echo '<script type="text/javascript"> window.onload = function () { alert("Lien invalide"); }</script>';
            exit();
        }
        $_SESSION['idPartie'] = $idPartie;
        $_SESSION['lienPartie'] = $lienPartie;
        $idJoueur = $_SESSION['userId'];
        $nbJoueurs = $partie->getNbJoueurs();

        if (readPositionIsUsed($idPartie, 2) == 0 && $nbJoueurs >= 2) {
            $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 2);
            $_SESSION["position"] = 2;
            header("Location: ./game.php");
            exit();
        } elseif (readPositionIsUsed($idPartie, 3) == 0 && $nbJoueurs >= 3) {
            $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 3);
            $_SESSION["position"] = 3;
            header("Location: ./game.php");
            exit();
        } elseif (readPositionIsUsed($idPartie, 4) == 0 && $nbJoueurs >= 4) {
            $idJouerPartie = createJouerPartie($idJoueur, $idPartie, 4);
            $_SESSION["position"] = 4;
            header("Location: ./game.php");
            exit();
        } else {
            echo '<script type="text/javascript"> window.onload = function () { alert("Partie pleine"); }</script>';
        }
    }

?>
    <link rel="stylesheet" href="../../assets/CSS/CreaRej.css">   
</head>
<body>
    <div class="section-haute">
        <a href="./index.php" id="retour">
            <img src="../../assets/Images/arrow-back.svg" alt="retour">
            <p>Retour</p>
        </a>
    </div>
    <div class="section-basse">
        <div class="zone">
            <div class="rejoindre">
                <h1>Rejoindre une partie</h1>
                <form action="Crearej.php" method="POST">
                    <div class="input-container">
                        <img src="../../assets/Images/icon-mail.png" class="input-icon" alt="icon">
                        <input type="text" placeholder="Lien de la partie" name="lien_partie" required>
                    </div>
                    <button>Rejoindre</button>
                </form>
            </div>
        </div>
        <div class="separator-vertical">
            
        </div>
        <div class="zone">
            <div class="creer">
                <h1>Créer une partie</h1>
                <form action="CreaRej.php" method="POST">
                    <div class="radio-container">
                        <label>Nombre de joueur :</label>
                        <label for="joueur2"><input type="radio" id="joueur2" name="nombre_joueur" value="2" required> 2</label>
                        <label for="joueur3"><input type="radio" id="joueur3" name="nombre_joueur" value="3" required> 3</label>
                        <label for="joueur4"><input type="radio" id="joueur4" name="nombre_joueur" value="4" required> 4</label>
                    </div>
                    <button>Créer</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>