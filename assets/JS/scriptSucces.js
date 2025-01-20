document.addEventListener('DOMContentLoaded', () => {
    const inputs = document.querySelectorAll(".clickable");
    const modal = document.getElementById("fenModalSucces");
    const modalImage = document.getElementById("modalImage");
    const nom = document.getElementById("nomSucces");
    const condition = document.getElementById("conditionSucces");
    var selectedSkin = null;
    var selectedId = null;
    
    inputs.forEach(input => {
       input.addEventListener('click', () =>{
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
                if (data && data.nom && data.condition) {
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

    var formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/getSuccesJoueur.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            data.AllSucces.forEach(succes => {
                var img = document.getElementById(succes['idSucces']);
                img.src = "../../assets/images/imageSucces/" + succes['idSucces'] + ".png";
            });
        } else {
            console.error("Erreur : " + data.message);
        }
    })
});