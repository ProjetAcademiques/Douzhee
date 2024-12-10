<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    $allAchats = readAllAchatByUser($_SESSION['userId']);
?>
    <link rel="stylesheet" href="../../assets/CSS/styleBoutique.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
</head>
    <div class="Boutique">
        <h2>Bienvenue sur notre boutique !</h2>
        <div class="Theme">
            <h2>Voici tous les thèmes disponibles : </h2>
            <img src="../../assets/images/imagePersonnalisation/Theme2.png" id="2"  class="clickable" >
            <img src="../../assets/images/imagePersonnalisation/Theme3.png" id="3"  class="clickable" >
        </div>
        <div class="Dés">
            <h2>Voici tous les skin de dés disponibles : </h2>
            <img src="../../assets/images/imagePersonnalisation/dés_1.png">
            <img src="../../assets/images/imagePersonnalisation/dés_2.png">
        </div>
    </div>
    <div id="fenModal">
        <div class="content">
            <h2>Voulez-vous acheter ce skin?</h2>
            <img src="" id="modalImage">
            <h2 id="price"> Cela vous coutera 350 douzcoin</h2>
            <button id="refuser">Refuser</button>
            <button id="valider">Valider</button>
        </div>
    </div>
</body>
</html>
<?php
    if (is_array($allAchats)){
        $themeId = null;
        foreach($allAchats as $achats){
            $themeId = $achats['idSkin'];
            if ($themeId !=null){
            ?>
                <script>
                    document.addEventListener('DOMContentLoaded', () =>{
                        const themeId = parseInt("<?php echo $themeId; ?>", 10);
                        const theme = document.getElementById(`${themeId}`);
                        if (themeId === 2){
                            theme.src = "../../assets/images/imageBoutique/Theme2Acheter.png";
                            theme.style.pointerEvents = "none";
                        }if(themeId === 3){
                            theme.src = "../../assets/images/imageBoutique/Theme3Acheter.png";
                            theme.style.pointerEvents = "none";
                        }
                    

                    });
                </script>
        <?php
        }
    }
}
?>
<script>
        const modal = document.getElementById("fenModal");
        const inputs = document.querySelectorAll(".clickable")
        const valider = document.getElementById("valider");
        const refuser = document.getElementById("refuser");
        const modalImage = document.getElementById("modalImage");
        const price = document.getElementById("price");

        var selectedSkin = null;
        var idSkin = null;

           
     inputs.forEach(input => {
        input.addEventListener('click', () =>{
            selectedSkin = input.src;
            idSkin = input.id;
            modalImage.src = selectedSkin;
            modal.style.display = "block";
        });
     });
      
       refuser.onclick = () =>{
            modal.style.display = "none";
        };
        window.onclick = (event) =>{
            if (event.target === modal){
                modal.style.display = "none";
            }
        };

       valider.addEventListener('click', () =>{
        const userMoney = <?php echo json_encode(getMoneyById($_SESSION['userId'])); ?>;
        if (userMoney >= 350){
            alert("Achat réussi !");
            modal.style.display = "none";
            fetch("../Utils/processusAchat.php", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    userId: <?php echo json_encode($_SESSION['userId']); ?>, 
                    idSkin: idSkin, 
                    cost: 350
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Votre achat a été enregistré !");
                } else {
                    alert("Erreur : " + data.error);
                }
            })
            .catch(error => {
                console.error("Erreur lors de la requête : ", error);
            });
        }else{
            alert("Vous êtes trop pauvres !");
            modal.style.display = "none";
        }
        window.location.href="http://localhost/douzhee/src/Pages/Index.php?_ijt=v1ppdtli2cq1rp8vpr9rsjg3b7&_ij_reload=RELOAD_ON_SAVE"
       });
 </script>