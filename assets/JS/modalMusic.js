document.addEventListener('DOMContentLoaded', function() {
    const modalMusic = document.getElementById("fenModalMusic");
    const inputsMusic = document.querySelectorAll(".clickableMusic");
    const validerMusic = document.getElementById("validerMusic");
    const refuserMusic = document.getElementById("refuserMusic");
    const modalAudio = document.getElementById("audioMusic");
    const priceMusic = document.getElementById("priceMusic");

    var idMusic = null;
    var prixMusic = 0;

    inputsMusic.forEach(input => {
        input.addEventListener('click', () => {
            idMusic = input.id;
            modalAudio.src = "../../assets/images/musiqueBoutique/MusicAccueil" + idMusic;

            var formData = new FormData();
            formData.append('idSkin', idMusic);
            formData.append('testdesecurité', true);

            fetch('../Utils/processusGetPrixSkin.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    priceMusic.textContent = `Cela vous coutera ${data.resultat} douzcoin`;
                    prixMusic = data.resultat;
                } else {
                    console.error("Erreur : " + data.error);
                }
            })
            .catch(error => {
                console.error("Erreur lors de la requête : ", error);
            });
            modalMusic.style.display = "block";
        });
    });

    refuserMusic.onclick = () => {
        modalAudio.pause();
        modalAudio.currentTime = 0;
        modalMusic.style.display = "none";
    };

    window.onclick = (event) => {
        if (event.target === modalMusic) {
            modalMusic.style.display = "none";
        }
    };

    validerMusic.addEventListener('click', () => {
        var formData2 = new FormData();
        formData2.append('testdesecurité', true);
        formData2.append('idSkin', idMusic);
        formData2.append('cost', prixMusic);

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