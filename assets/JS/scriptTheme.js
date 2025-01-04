var body = document.querySelector('body');
var themeItem1 = document.querySelectorAll('.themeItem1');
var themeItem2 = document.querySelectorAll('.themeItem2');

var formData = new FormData();
formData.append('testdesecurité', true);

fetch('../Utils/theme.php', {
    method: 'POST',
    body: formData
})
    .then(response => response.json())
    .then(data => {
        switch(data.theme){
            case 'purple':
                console.log('purple');
                body.classList.add('purpleBody');
                themeItem1.forEach(element => {
                    element.classList.add('purpleItem1');
                });
                themeItem2.forEach(element => {
                    element.classList.add('purpleItem2');
                });
                break;
        }
    })
    .catch(error => {
        console.error('Erreur lors de la récupération du thème:', error);
    });