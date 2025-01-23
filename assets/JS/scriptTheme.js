export function changeTheme(idTheme) {
    var body = document.querySelector('body');
    var themeItem1 = document.querySelectorAll('.themeItem1');
    var themeItem2 = document.querySelectorAll('.themeItem2');
    var themeItem3 = document.querySelectorAll('.themeItem3');
    var themeItem4 = document.querySelectorAll('.themeItem4');
    var themeItem5 = document.querySelectorAll('.themeItem5');
    var themeItem6 = document.querySelectorAll('.themeItem6');
    var themeItem7 = document.querySelectorAll('.themeItem7');
    var themeItem8 = document.querySelectorAll('.themeItem8');
    var themeItem9 = document.querySelectorAll('.themeItem9');
    var themeItem10 = document.querySelectorAll('.themeItem10');
    var themeItem11 = document.querySelectorAll('.themeItem11');

    // Supprimez les classes de thème existantes
    body.classList.remove('purpleBody', 'greenBody', 'redBody', 'blueBody');
    themeItem1.forEach(element => {
        element.classList.remove('purpleItem1', 'greenItem1', 'redItem1', 'blueItem1');
    });
    themeItem2.forEach(element => {
        element.classList.remove('purpleItem2', 'greenItem2', 'redItem2', 'blueItem2');
    });
    themeItem3.forEach(element => {
        element.classList.remove('purpleItem3', 'greenItem3', 'redItem3', 'blueItem3');
    });
    themeItem4.forEach(element => {
        element.classList.remove('purpleItem4', 'greenItem4', 'redItem4', 'blueItem4');
    });
    themeItem5.forEach(element => {
        element.classList.remove('purpleItem5', 'greenItem5', 'redItem5', 'blueItem5');
    });
    themeItem6.forEach(element => {
        element.classList.remove('purpleItem6', 'greenItem6', 'redItem6', 'blueItem6');
    });
    themeItem7.forEach(element => {
        element.classList.remove('purpleItem7', 'greenItem7', 'redItem7', 'blueItem7');
    });
    themeItem8.forEach(element => {
        element.classList.remove('purpleItem8', 'greenItem8', 'redItem8', 'blueItem8');
    });
    themeItem9.forEach(element => {
        element.classList.remove('purpleItem9', 'greenItem9', 'redItem9', 'blueItem9');
    });
    themeItem10.forEach(element => {
        element.classList.remove('purpleItem10', 'greenItem10', 'redItem10', 'blueItem10');
    });
    themeItem11.forEach(element => {
        element.classList.remove('purpleItem11', 'greenItem11', 'redItem11', 'blueItem11');
    });

    switch(idTheme) {
        case '1':
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
            themeItem5.forEach(element => {
                element.classList.add('purpleItem5');
            });
            themeItem6.forEach(element => {
                element.classList.add('purpleItem6');
            });
            themeItem7.forEach(element => {
                element.classList.add('purpleItem7');
            });
            themeItem8.forEach(element => {
                element.classList.add('purpleItem8');
            });
            themeItem9.forEach(element => {
                element.classList.add('purpleItem9');
            });
            themeItem10.forEach(element => {
                element.classList.add('purpleItem10');
            });
            themeItem11.forEach(element => {
                element.classList.add('purpleItem11');
            });
            break;

        case '2':
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
            themeItem5.forEach(element => {
                element.classList.add('greenItem5');
            });
            themeItem6.forEach(element => {
                element.classList.add('greenItem6');
            });
            themeItem7.forEach(element => {
                element.classList.add('greenItem7');
            });
            themeItem8.forEach(element => {
                element.classList.add('greenItem8');
            });
            themeItem9.forEach(element => {
                element.classList.add('greenItem9');
            });
            themeItem10.forEach(element => {
                element.classList.add('greenItem10');
            });
            themeItem11.forEach(element => {
                element.classList.add('greenItem11');
            });
            break;

        case '3':
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
            themeItem5.forEach(element => {
                element.classList.add('redItem5');
            });
            themeItem6.forEach(element => {
                element.classList.add('redItem6');
            });
            themeItem7.forEach(element => {
                element.classList.add('redItem7');
            });
            themeItem8.forEach(element => {
                element.classList.add('redItem8');
            });
            themeItem9.forEach(element => {
                element.classList.add('redItem9');
            });
            themeItem10.forEach(element => {
                element.classList.add('redItem10');
            });
            themeItem11.forEach(element => {
                element.classList.add('redItem11');
            });
            break;

        case '4':
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
            themeItem5.forEach(element => {
                element.classList.add('blueItem5');
            });
            themeItem6.forEach(element => {
                element.classList.add('blueItem6');
            });
            themeItem7.forEach(element => {
                element.classList.add('blueItem7');
            });
            themeItem8.forEach(element => {
                element.classList.add('blueItem8');
            });
            themeItem9.forEach(element => {
                element.classList.add('blueItem9');
            });
            themeItem10.forEach(element => {
                element.classList.add('blueItem10');
            });
            themeItem11.forEach(element => {
                element.classList.add('blueItem11');
            });
            break;

        default:
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
            themeItem5.forEach(element => {
                element.classList.add('purpleItem5');
            });
            themeItem6.forEach(element => {
                element.classList.add('purpleItem6');
            });
            themeItem7.forEach(element => {
                element.classList.add('purpleItem7');
            });
            themeItem8.forEach(element => {
                element.classList.add('purpleItem8');
            });
            themeItem9.forEach(element => {
                element.classList.add('purpleItem9');
            });
            themeItem10.forEach(element => {
                element.classList.add('purpleItem10');
            });
            themeItem11.forEach(element => {
                element.classList.add('purpleItem11');
            });
            break;
    }
}

document.addEventListener('DOMContentLoaded', function() {
    var formData = new FormData();
    formData.append('testdesecurité', true);

    fetch('../Utils/theme.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        changeTheme(data.theme + '');
    })
    .catch(error => {
        console.error('Erreur lors de la récupération du thème:', error);
    });
});