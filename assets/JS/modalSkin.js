document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("fenModal");
    const inputs = document.querySelectorAll(".clickable");
    const valider = document.getElementById("valider");
    const refuser = document.getElementById("refuser");
    const modalImage = document.getElementById("modalImage");
    const price = document.getElementById("price");

    var selectedSkin = null;
    var idSkin = null;
    var prixSkin = -1;

    inputs.forEach(input => {
        input.addEventListener('click', () => {
            selectedSkin = input.src;
            idSkin = input.id;
            modalImage.src = selectedSkin;

            var formData = new FormData();
            formData.append('idSkin', idSkin);
            formData.append('testdesecurité', true);

            fetch('../Utils/processusGetPrixSkin.php', {
                method: 'POST',
                body: formData
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

    refuser.onclick = () => {
        modal.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };

    valider.addEventListener('click', () => {
        var formData2 = new FormData();
        formData2.append('testdesecurité', true);
        formData2.append('idSkin', idSkin);
        formData2.append('cost', prixSkin);

        fetch("../Utils/processusAchat.php", {
            method: 'POST',
            body: formData2
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                location.reload(); // Recharger la page
            } else {
                alert("Erreur : " + data.error);
            }
        })
        .catch(error => {
            console.error("Erreur lors de la requête : ", error);
        });
    });
});