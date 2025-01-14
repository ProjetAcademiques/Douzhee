<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");

    $joueur = readJoueur($_SESSION['userId']);
    $allSkinAchete = readAllAchatByUser($_SESSION['userId']);
?>
    <link rel="stylesheet" href="../../assets/css/Theme.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/stylePersonnalisation.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
</head>
<body>
    <?php
        require_once("../Utils/headerBody.php");
    ?>

    <div class="container">
        <h1>Personnalisation</h1>
        <div id="nameContainer">
            <h2>pseudo</h2>
            <input type="text" id="pseudoInput" value="<?php echo $joueur->getPseudo() ?>">
        </div>

        <div id="descriptionContainer">
            <h2>Description</h2>
            <textarea id="descriptionInput" rows="4" cols="50"><?php echo $joueur->getBio() ?></textarea>
        </div>

        <div id="skinContainer">

        </div>

        <div id="musiqueContainer">
            
        </div>
    </div>
</body>
</html>