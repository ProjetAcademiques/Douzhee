<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../Utils/headerBody.php");
    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
    $data = readClassementByScore();
    $i = 1;
    $secondClass = readClassemnetBynbDouzhee();
    $j = 1;
    $thirdClass = readClassemnetBySucces();
    $k = 1;
    
?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleGlobal.css">     
</head>
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
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
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
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
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
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
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
                        $place = $i;
                        echo '<tr>';
                        echo '<th scope="row">'.htmlspecialchars($place).'</th>';
                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($score). '</td>';
                    }
                }
                ?>
                
            </tbody>
        </table>
        <button id="SecondClassButton">Passer au classement en fonction du nombre de Douzhee</button>
        <button id="ThirdClassButton">Passer au classement en fonction du nombre de succès</button>
    </div>
    <div class="SecondClassement">
    <table>
            <thead>
                <tr>
                    <th scope="col"><img src="../../assets/images/imageClassement/classement.png"></th>
                    <th scope="col">Joueur</th>
                    <th scope="col">nbDouzhee</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_premier.png"></th>
                    <?php
                    if (!empty($secondClass[$j ]) && is_array($secondClass)){
                        $row = $secondClass[$j];
                        $pseudo = $row['pseudonyme'];
                        $nbDouzhee = $row['nbDouzhee'];
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
                        echo '<td>'.htmlspecialchars($nbDouzhee). '</td>';
                        $j++;
                    } 
                ?>
                </tr>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_deuxieme.png"></th>
                    <?php
                    if (!empty($secondClass[$j]) && is_array($secondClass)){
                        $row = $secondClass[$j];
                        $pseudo = $row['pseudonyme'];
                        $nbDouzhee = $row['nbDouzhee'];
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
                        echo '<td>'.htmlspecialchars($nbDouzhee). '</td>';
                        $j++;
                    } 
                ?>
                </tr>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_trois.png"></th>
                    <?php
                    if (!empty($secondClass[$j]) && is_array($secondClass)){
                        $row = $secondClass[$j];
                        $pseudo = $row['pseudonyme'];
                        $nbDouzhee = $row['nbDouzhee'];
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
                        echo '<td>'.htmlspecialchars($nbDouzhee). '</td>';
                        $j++;
                    } 
                ?>
                </tr>
                <?php
                if (!empty($secondClass[$j]) && is_array($secondClass)){
                    
                    for($j; $j < count($secondClass) && $j < 10; $j++){
                        $row = $secondClass[$j];
                         $pseudo = $row['pseudonyme']; 
                         $nbDouzhee = $row['nbDouzhee'];
                         $place = $j;
                        echo '<tr>';
                        echo '<th scope="row">'.htmlspecialchars($place).'</th>';
                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($nbDouzhee). '</td>';
                    }
                }
                ?>
                
            </tbody>
        </table>
        <button id="ThirdClassButton">Passer au classement en fonction du nombre de succès</button>
        <button id="FirstClassButton">Passer au classement en fonction du score</button>
    </div>
    <div class="ThirdClassement">
    <table>
            <thead>
                <tr>
                    <th scope="col"><img src="../../assets/images/imageClassement/classement.png"></th>
                    <th scope="col">Joueur</th>
                    <th scope="col">nbSucces</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_premier.png"></th>
                    <?php
                    if (!empty($thirdClass[$k]) && is_array($thirdClass)){
                        $row = $thirdClass[$k];
                        $pseudo = $row['pseudonyme'];
                        $nbSucces = $row['nbSucces'];
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
                        echo '<td>'.htmlspecialchars($nbSucces). '</td>';
                        $k++;
                    } 
                ?>
                </tr>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_deuxieme.png"></th>
                    <?php
                    if (!empty($thirdClass[$k]) && is_array($thirdClass)){
                        $row = $thirdClass[$k];
                        $pseudo = $row['pseudonyme'];
                        $nbSucces = $row['nbSucces'];
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
                        echo '<td>'.htmlspecialchars($nbSucces). '</td>';
                        $k++;
                    } 
                ?>
                </tr>
                <tr>
                    <th scope="row"><img src="../../assets/images/imageClassement/classement_trois.png"></th>
                    <?php
                    if (!empty($thirdClass[$k]) && is_array($thirdClass)){
                        $row = $thirdClass[$k];
                        $pseudo = $row['pseudonyme'];
                        $nbSucces = $row['nbSucces'];
                        $id = $row['id'];

                        echo '<td><a href="Visualisation.php?id='.urlencode($id).'">'.htmlspecialchars($pseudo). '</a></td>';
                        echo '<td>'.htmlspecialchars($nbSucces). '</td>';
                        $k++;
                    } 
                ?>
                </tr>
                <?php
                    if (!empty($thirdClass[$k]) && is_array($thirdClass)){
                        for($k; $k < count($thirdClass) && $k < 10; $k++){
                        $row = $thirdClass[$k];
                        $place = $k;
                        $pseudo = $row['pseudonyme'];
                        $nbSucces = $row['nbSucces'];
                        echo '<tr>';
                        echo '<th scope="row">'.htmlspecialchars($place). '</td>';
                        echo '<td>'.htmlspecialchars($pseudo). '</td>';
                        echo '<td>'.htmlspecialchars($nbSucces). '</td>';
                    } 
                }
                ?>
                
            </tbody>
        </table>
        <button id="FirstClassButton">Passer au classement en fonction du score</button>
        <button id="SecondClassButton">Passer au classement en fonction du nombre de Douzhee</button>
    </div>
</body>
</html>
<script>
    const FirstClassButton = document.querySelectorAll("#FirstClassButton");
    const SecondClassButton =document.querySelectorAll("#SecondClassButton");
    const ThirdClassButton =document.querySelectorAll("#ThirdClassButton");
    const FirstDiv = document.querySelector(".Classement");
    const SecondDiv =document.querySelector(".SecondClassement");
    const ThirdDiv =document.querySelector(".ThirdClassement");

    FirstClassButton.forEach((button) =>{
        button.addEventListener('click',() =>{
            FirstDiv.style.display = "block";
            SecondDiv.style.display = "none";
            ThirdDiv.style.display = "none";
        });
    })
    SecondClassButton.forEach((button) =>{
        button.addEventListener('click',() =>{
            FirstDiv.style.display = "none";
            SecondDiv.style.display = "block";
            ThirdDiv.style.display = "none";
        });
    })

    ThirdClassButton.forEach((button) =>{
        button.addEventListener('click',() =>{
            FirstDiv.style.display = "none";
            SecondDiv.style.display = "none";
            ThirdDiv.style.display = "block";
        });
    })
 
  
   
</script>
