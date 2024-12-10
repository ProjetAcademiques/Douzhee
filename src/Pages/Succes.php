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
                echo '<img src="../../assets/images/imageSucces/Succes_verrouille.png" alt="Image du succès" id="'. $i .'" class="clickable">';
            }
        ?>

    </div>
    <div id="fenModal">
        <div class="content">
            <h2>Voici comment obtenir ce skin !</h2>
            <img src="" id="modalImage">
            <h2 id="nomSucces"></h2>
            <h2 id="conditionSucces"></h2>
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
     const inputs = document.querySelectorAll(".clickable");
     const modal = document.getElementById("fenModal");
     const modalImage = document.getElementById("modalImage");
     const nom = document.getElementById("nomSucces");
     const condition = document.getElementById("conditionSucces");
     var selectedSkin = null;
     var selectedId = null;
     inputs.forEach(input => {
        input.addEventListener('click', () =>{
            console.log("Skin cliqué");
            selectedSkin = input.src;
            selectedId = input.id;
            fetch("../Utils/processusCheckSkin.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({Id : selectedId})
            })
            .then(response => response.json())  
            .then(data => {
            console.log("Données reçues:", data)
            if (data && data.nom && data.condition) {
            console.log(data);
            modalImage.src = selectedSkin;     
            condition.textContent = "Condition : " + data.condition;
            nom.textContent = "Nom : " +  data.nom;
            modal.style.display = "block";
            modal.classList.add('active');
           
            }
        });
     });
    });
     window.onclick = (event) =>{
            if (event.target === modal){
                modal.style.display = "none";
            }
        };
    });
</script>
