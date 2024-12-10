<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    if (!isset($_SESSION['userId'])){
        require_once("../Utils/redirection.php");
    }
?>
        <link rel="stylesheet" href="../../assets/css/styleRegles.css">
        <link rel="stylesheet" href="../../assets/css/styleHeader.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    </head>
         <div class="container">
            <div class="bulle" id="bulle">
                <p id="Texte">Première fois ici? Voulez-vous que je vous explique les règles?</p>
                <div class="Bouton">
                    <button type="button" id="Valider">Oui</button>
                    <button type="button" id="Refuser">Non</button>
                    <img src="../../assets/images/imageAnimation/fleche.png" alt="fleche" id="flèche" width="60" height="30 ">
                </div>
            </div>
            <img src="../../assets/images/imageAnimation/mascotte1.png" alt="Personnage" id="FirstMascotte" width="200" height="300">
            <img src="../../assets/images/imageAnimation/mascotte2.png" alt="Personnage" id="SecondMascotte" width="200" height="300"> 
            <img src="../../assets/images/imageAnimation/mascotte3.png" alt="Personnage" id="ThirdMascotte" width="200" height="300"> 
        </div>
        <script src="../../assets/JS/scriptAnimation.js"></script>
    </body>
</html>