<?php
    require_once("../Utils/headerInit.php");
    require_once("../Utils/headerBody.php");
    require_once("../CRUD/CRUDJoueur.php");
    require_once("../CRUD/CRUDSkinAchete.php");
    $allAchats = readAllAchatByUser($_SESSION['userId']);
    $prixSkin = $_SESSION['prixSkin'] ?? 0;
?>
    <link rel="stylesheet" href="../../assets/CSS/styleGlobal.css">
    <link rel="stylesheet" href="../../assets/CSS/styleHeader.css">
</head>
    <div class="Boutique">
        <h2>Bienvenue sur notre boutique !</h2>
        <div class="Theme">
            <h2>Voici tous les thèmes disponibles : </h2>
            <img src="../../assets/images/imagePersonnalisation/Theme2.png" id="2"  class="clickable" >
            <img src="../../assets/images/imagePersonnalisation/Theme3.png" id="3"  class="clickable" >
            <img src="../../assets/images/imagePersonnalisation/Theme4.png" id="4"  class="clickable">
        </div>
        <div class="Musique">
            <h2>Voici tous les musiques disponibles : </h2>
            <img src="../../assets/images/imageBoutique/imgMusique.png" id="5" class="clickableMusic">
            <img src="../../assets/images/imageBoutique/imgMusique.png" id="6" class="clickableMusic">
            <img src="../../assets/images/imageBoutique/imgMusique.png" id="7" class="clickableMusic">
            <img src="../../assets/images/imageBoutique/imgMusique.png" id="8" class="clickableMusic">
            
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
    <div id="fenModalMusic">
        <div class="contentMusic">
            <h2>Voulez-vous acheter cette musique?</h2>
            <audio src="" id="audioMusic" controls></audio>
            <h2 id="priceMusic">Cela vous coutera ... douzCoin</h2>
            <button id="refuserMusic">Refuser</button>
            <button id="validerMusic">Valider</button>
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
                        }if(themeId === 4){
                            theme.src = "../../assets/images/imageBoutique/Theme4Acheter.png";
                            theme.style.pointerEvents = "none";
                        }if (themeId === 5){
                            theme.src = "../../assets/images/imageBoutique/imgMusiqueAcheter.png";
                            theme.style.pointerEvents = "none";
                        }
                        if (themeId === 6){
                            theme.src = "../../assets/images/imageBoutique/imgMusiqueAcheter.png";
                            theme.style.pointerEvents = "none";
                        }
                        if (themeId === 7){
                            theme.src = "../../assets/images/imageBoutique/imgMusiqueAcheter.png";
                            theme.style.pointerEvents = "none";

                        }if (themeId === 8){
                            theme.src = "../../assets/images/imageBoutique/imgMusiqueAcheter.png";
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
        var prixSkin = 0;

           
     inputs.forEach(input => {
        input.addEventListener('click', () =>{
            selectedSkin = input.src;
            idSkin = input.id;
            modalImage.src = selectedSkin;
            fetch('../Utils/processusGetPrixSkin.php',{
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    idSkin: idSkin
                })
            })
            .then(response => response.json())
            .then(data => {
                price.textContent = `Cela vous coutera ${data.resultat} douzcoin`;
                prixSkin = data.resultat;

            })
            .catch(error => {
                console.error("Erreur lors de la requête : ", error);
            });
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
        const userMoney = <?php echo getMoneyById($_SESSION['userId']);?>;
        if (userMoney >= prixSkin){
            alert("Achat réussi !");
            modal.style.display = "none";
            fetch("../Utils/processusAchat.php", {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    userId: <?php echo json_encode($_SESSION['userId']); ?>, 
                    idSkin: idSkin, 
                    cost: prixSkin
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
            })
            .finally(()=>{
                 window.location.href="http://localhost/douzhee/src/Pages/Index.php?_ijt=v1ppdtli2cq1rp8vpr9rsjg3b7&_ij_reload=RELOAD_ON_SAVE";
            });
        }else{
            alert("Vous êtes trop pauvres !");
            modal.style.display = "none";
        }
      
       });
 </script>
 <script>
    const modalMusic = document.getElementById("fenModalMusic");
    const inputsMusic = document.querySelectorAll(".clickableMusic")
    const validerMusic = document.getElementById("validerMusic");
    const refuserMusic = document.getElementById("refuserMusic");
    const modalAudio = document.getElementById("audioMusic");
    const priceMusic = document.getElementById("priceMusic");
    var idMusic = null;
    var prixMusic = 0;
    inputsMusic.forEach(input => {
        input.addEventListener('click', () =>{
            idMusic = input.id;
            modalAudio.src = "../../assets/images/musiqueBoutique/MusicAccueil"+idMusic;
            fetch('../Utils/processusGetPrixSkin.php',{
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    idSkin: idMusic
                })
            })
            .then(response => response.json())
            .then(data => {
                priceMusic.textContent = `Cela vous coutera ${data.resultat} douzcoin`;
                prixMusic = data.resultat;
            })
            .catch(error => {
                console.error("Erreur lors de la requête : ", error);
            });
            modalMusic.style.display = "block";
        });
    });
        refuserMusic.onclick = () =>{
            modalAudio.pause();
            modalAudio.currentTime = 0;
            modalMusic.style.display = "none";
        };
        window.onclick = (event) =>{
            if (event.target === modalMusic){
                modalMusic.style.display = "none";
            }
        };
        validerMusic.addEventListener('click', () =>{
            const userMoney = <?php echo getMoneyById($_SESSION['userId']); ?>;
            if (userMoney >= prixMusic){
                alert("Achat réussi !");
                modalMusic.style.display = "none";

                fetch("../Utils/processusAchat.php", {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        userId: <?php echo json_encode($_SESSION['userId']); ?>, 
                        idSkin: idMusic, 
                        cost: prixMusic
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
                })
                .finally(() =>{
                      window.location.href="http://localhost/douzhee/src/Pages/Index.php?_ijt=v1ppdtli2cq1rp8vpr9rsjg3b7&_ij_reload=RELOAD_ON_SAVE"
                });
            }else{
                alert("Vous êtes trop pauvres !");
                modal.style.display = "none";
            }
          
        });

 </script>  
