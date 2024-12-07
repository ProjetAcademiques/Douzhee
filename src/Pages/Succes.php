<?php
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDClassement.php");
    require_once("../CRUD/CRUDSucces.php");
    require_once("../CRUD/CRUDObtient.php");
?>
    <link rel="stylesheet" href="../../assets/css/styleHeader.css"> 
    <link rel="stylesheet" href="../../assets/css/styleSucces.css"> 
<?php
    require_once("../Utils/headerBody.php");
   
?>        
</head>
<body>
    <div class="Succes">
        <h2>Succès :</h2>
        <?php
            for ($i = 1; $i < 34; $i++) {
                echo '<img src="../../assets/images/imageSucces/Succes_verrouille.png" alt="Image du succès" id="'. $i .'">';
            }
        ?>

    </div>
</body>
</html>
 <?php
    for ($i= 1; $i < 34; $i++) {
        $allsucces = readAllUserWinTheSuccesId($i);
        if (is_array($allsucces)) {
            foreach ($allsucces as $succes) {
                if ($_SESSION['userId'] == $succes['idJoueur']) {  
                    ?>
                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const img = document.getElementById('<?php echo $i; ?>');
                            img.src = '../../assets/images/imageSucces/<?php echo $i; ?>.png';
                        });
                    </script>
                    <?php
                    break;  


    }
}
    }
}
 ?>
