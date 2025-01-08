document.addEventListener('DOMContentLoaded', function() {
    var body = document.querySelector('body');
    var themeItem1 = document.querySelectorAll('.themeItem1');
    var themeItem2 = document.querySelectorAll('.themeItem2');
    var themeItem3 = document.querySelectorAll('.themeItem3');
    var themeItem4 = document.querySelectorAll('.themeItem4');

    console.table(themeItem3);

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
                body.classList.add('purpleBody');
                themeItem1.forEach(element => {
                    element.classList.add('purpleItem1');
                });
                themeItem2.forEach(element => {
                    element.classList.add('purpleItem2');
                });
                themeItem3.forEach(element => {
                    element.classList.add('purpleItem3');
                });
                themeItem4.forEach(element => {
                    element.classList.add('purpleItem4');
                });
                break;

            case 'green':
                body.classList.add('greenBody');
                themeItem1.forEach(element => {
                    element.classList.add('greenItem1');
                });
                themeItem2.forEach(element => {
                    element.classList.add('greenItem2');
                });
                themeItem3.forEach(element => {
                    element.classList.add('greenItem3');
                });
                themeItem4.forEach(element => {
                    element.classList.add('greenItem4');
                });
                break;


            case 'red':
                body.classList.add('redBody');
                themeItem1.forEach(element => {
                    element.classList.add('redItem1');
                });
                themeItem2.forEach(element => {
                    element.classList.add('redItem2');
                });
                themeItem3.forEach(element => {
                    element.classList.add('redItem3');
                });
                themeItem4.forEach(element => {
                    element.classList.add('redItem4');
                });
                break;

            case 'blue':
                body.classList.add('blueBody');
                themeItem1.forEach(element => {
                    element.classList.add('blueItem1');
                });
                themeItem2.forEach(element => {
                    element.classList.add('blueItem2');
                });
                themeItem3.forEach(element => {
                    element.classList.add('blueItem3');
                });
                themeItem4.forEach(element => {
                    element.classList.add('blueItem4');
                });
                break;

            default:
                console.log('error');
                console.log(data.test);
        }
    })
    .catch(error => {
        console.error('Erreur lors de la récupération du thème:', error);
    });
});