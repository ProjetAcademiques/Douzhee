<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
    
?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleClassement.css">
<?php
    require_once("../Utils/headerBody.php");
?>        
<?php 
$data = readAllClassement();
$i = 0;
?>

</head>
<body>
    <div class="Classement">
        <table>
            <thead>
                <tr>
                    <th scope="col"><img src="../../assets/images/imageClassement/classement.png"></th>
                    <th scope="col">Joueur</th>
                    <th scope="col">Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_premier.png"></th>
                    <?php
                    if (!empty($data[$i]) && is_array($data)){
                        $row = $data[$i];
                        $pseudo = $row['pseudonyme'];
                        $score = $row['score'];

                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($score). '</td>';
                        $i++;
                    } 
                ?>
                </tr>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_deuxieme.png"></th>
                    <?php
                    if (!empty($data[$i]) && is_array($data)){
                        $row = $data[$i];
                        $pseudo = $row['pseudonyme'];
                        $score = $row['score'];

                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($score). '</td>';
                        $i++;
                    } 
                ?>
                </tr>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_trois.png"></th>
                    <?php
                    if (!empty($data[$i]) && is_array($data)){
                        $row = $data[$i];
                        $pseudo = $row['pseudonyme'];
                        $score = $row['score'];

                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($score). '</td>';
                        $i++;
                    } 
                ?>
                </tr>
                <?php
                if (!empty($data[$i]) && is_array($data)){
                    
                    for($i; $i < count($data) && $i < 10; $i++){
                        $row = $data[$i];
                     $pseudo = $row['pseudonyme']; 
                     $score = $row['score'];
                     $place = $row['placeClassement'];
                        echo '<tr>';
                        echo '<th scope="row">'.htmlspecialchars($place).'</th>';
                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($score). '</td>';
                    }
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>