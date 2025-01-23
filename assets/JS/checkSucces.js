export function checkSuccess(idSucces) {
    var formData = new FormData();
    formData.append('testdesecurité', true);
    fetch('../Utils/isSetUserID.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success") {
            var idUser = data.id;
            var formData = new FormData();
            formData.append('testdesecurité', true);
            formData.append('idJoueur', idUser); // Assurez-vous que la clé est 'idJoueur'
            formData.append('idSucces', idSucces);
            fetch('../Utils/haveSucces.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.status === "success") {
                    $(function() {
                        toastr.options = {
                            "positionClass": "toast-bottom-right"
                        };
                        toastr.success('Succès obtenu : ' + data.nomSucces);
                        
                    });
                }
            })
        }
    })
}