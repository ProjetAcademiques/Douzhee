document.addEventListener('DOMContentLoaded', function() {
    const containers = document.querySelectorAll('.store');
    const navUp = document.querySelector('#navUp');
    const navDown = document.querySelector('#navDown');
    const navLeft = document.querySelector('#navLeft');
    const navRight = document.querySelector('#navRight');

    var indexSelected = 0;
    var indexSelectedRow = 0;
    var oldIndex = 0;
    var oldIndexRow = 0;

    function allInvisible() {
        containers.forEach(function(container) {
            container.classList.add('notSelected');
        });
    }

    function selectContainer(index) {
        var containerRow = containers[index].querySelectorAll('.border');
        containers[index].classList.remove('notSelected');
        for (var i = 0; i < containerRow.length; i++) {
            if (i === indexSelectedRow) {
                containerRow[i].classList.remove('invisible');
            } else {
                containerRow[i].classList.add('invisible');
            }
        }
    }

    function selectContainerRow(index, containerRow) {
        containerRow[index].classList.remove('invisible');
    }

    function toggleNav(index) {
        if (index === 0) {
            navUp.classList.add('invisible');
            navDown.classList.remove('invisible');
        }
        else if (index === containers.length - 1) {
            navUp.classList.remove('invisible');
            navDown.classList.add('invisible');
        }
        else {
            navUp.classList.remove('invisible');
            navDown.classList.remove('invisible');
        }
    }

    
    function toggleNavRow(load, containerRow, index) {
        if (!load) {
            navRight.classList.add('animateFadeZoomOut');
            navRight.addEventListener('animationend', function() {
                if (containerRow.length <= 1) {
                    navRight.classList.add('invisible');
                } else {
                    if (index === 0) {
                        navRight.classList.remove('invisible');
                        navRight.classList.add('animateFadeZoomIn');
                    }
                    else if (index === containerRow.length - 1) {
                        navRight.classList.add('invisible');
                    }
                    else {
                        navRight.classList.remove('invisible');
                        navRight.classList.add('animateFadeZoomIn');
                    }
                }
                navRight.classList.remove(('animateFadeZoomOut'));
            }, { once: true });

            navLeft.classList.add('animateFadeZoomOut');
            navLeft.addEventListener('animationend', function() {
                if (containerRow.length <= 1) {
                    navLeft.classList.add('invisible');
                } else {
                    if (index === 0) {
                        navLeft.classList.add('invisible');
                        navLeft.classList.add('animateFadeZoomIn');
                    }
                    else if (index === containerRow.length - 1) {
                        navLeft.classList.remove('invisible');
                    }
                    else {
                        navLeft.classList.remove('invisible');
                        navLeft.classList.add('animateFadeZoomIn');
                    }
                }
                navLeft.classList.remove('animateFadeZoomOut');
            }, { once: true });
        } else {
            if (containerRow.length <= 1) {
                navRight.classList.add('invisible');
                navLeft.classList.add('invisible');
            } else {
                if (index === 0) {
                    navRight.classList.remove('invisible');
                    navLeft.classList.add('invisible');
                }
                else if (index === containerRow.length - 1) {
                    navRight.classList.add('invisible');
                    navLeft.classList.remove('invisible');
                }
                else {
                    navRight.classList.remove('invisible');
                    navLeft.classList.remove('invisible');
                }
            }
        }
    }
    
    function moveDown() {
        navUp.classList.add('animateFadeZoomOut');
        navDown.classList.add('animateFadeZoomOut');

        oldIndex = indexSelected;
        containers[indexSelected].classList.add('animateFadeOutUp');

        var containerRow = containers[oldIndex + 1].querySelectorAll('.border');
        indexSelectedRow = 0;
        toggleNavRow(false, containerRow, indexSelectedRow);
        containers[oldIndex].addEventListener('animationend', function() {
            containers[oldIndex].classList.remove('animateFadeOutUp');
            containers[oldIndex].classList.add('notSelected');
        }); {once : true} 

        indexSelected++;
        
        selectContainer(indexSelected);
        containers[indexSelected].classList.add('animateFadeInUp');
        containers[indexSelected].addEventListener('animationend', function() {
            containers[indexSelected].classList.remove('animateFadeInUp');
            
            navUp.classList.remove('animateFadeZoomOut');
            navDown.classList.remove('animateFadeZoomOut');

            navUp.classList.add('animateFadeZoomIn');
            navDown.classList.add('animateFadeZoomIn');

            toggleNav(indexSelected);
        }); {once : true}
    }

    function moveUp() {
        navUp.classList.add('animateFadeZoomOut');
        navDown.classList.add('animateFadeZoomOut');

        oldIndex = indexSelected;
        indexSelectedRow = 0;
        containers[indexSelected].classList.add('animateFadeOutDown');

        var containerRow = containers[oldIndex - 1].querySelectorAll('.border');
        toggleNavRow(false, containerRow, indexSelectedRow);
        containers[oldIndex].addEventListener('animationend', function() {
            containers[oldIndex].classList.remove('animateFadeOutDown');
            containers[oldIndex].classList.add('notSelected');
        }); {once : true}

        indexSelected--;

        selectContainer(indexSelected);
        containers[indexSelected].classList.add('animateFadeInDown');
        containers[indexSelected].addEventListener('animationend', function() {
            containers[indexSelected].classList.remove('animateFadeInDown');

            navUp.classList.remove('animateFadeZoomOut');
            navDown.classList.remove('animateFadeZoomOut');

            navUp.classList.add('animateFadeZoomIn');
            navDown.classList.add('animateFadeZoomIn');

            toggleNav(indexSelected);
        }); {once : true}
    }

    function moveRight() {
        var containerRow = containers[indexSelected].querySelectorAll('.border')

        navLeft.classList.add('animateFadeZoomOut');
        navRight.classList.add('animateFadeZoomOut');
        navUp.classList.add('disabledButton');
        navDown.classList.add('disabledButton');

        oldIndexRow = indexSelectedRow;
        containerRow[indexSelectedRow].classList.add('animateFadeOutLeft');
        containerRow[oldIndexRow].addEventListener('animationend', function() {
            containerRow[oldIndexRow].classList.remove('animateFadeOutLeft');
            containerRow[oldIndexRow].classList.add('invisible');
        }); {once : true}

        indexSelectedRow++;
        selectContainerRow(indexSelectedRow, containerRow);
        containerRow[indexSelectedRow].classList.add('animateFadeInRight');
        containerRow[indexSelectedRow].addEventListener('animationend', function() {
            containerRow[indexSelectedRow].classList.remove('animateFadeInRight');

            navLeft.classList.remove('animateFadeZoomOut');
            navRight.classList.remove('animateFadeZoomOut');

            navLeft.classList.add('animateFadeZoomIn');
            navRight.classList.add('animateFadeZoomIn');

            navUp.classList.remove('disabledButton');
            navDown.classList.remove('disabledButton');

            toggleNavRow(true, containerRow, indexSelectedRow);
        }); {once : true}
    }

    function moveLeft() {
        var containerRow = containers[indexSelected].querySelectorAll('.border')

        navLeft.classList.add('animateFadeZoomOut');
        navRight.classList.add('animateFadeZoomOut');
        navUp.classList.add('disabledButton');
        navDown.classList.add('disabledButton');

        oldIndexRow = indexSelectedRow;
        containerRow[indexSelectedRow].classList.add('animateFadeOutRight');
        containerRow[oldIndexRow].addEventListener('animationend', function() {
            containerRow[oldIndexRow].classList.remove('animateFadeOutRight');
            containerRow[oldIndexRow].classList.add('invisible');
        }); {once : true}

        indexSelectedRow--;
        selectContainerRow(indexSelectedRow, containerRow);
        containerRow[indexSelectedRow].classList.add('animateFadeInLeft');
        containerRow[indexSelectedRow].addEventListener('animationend', function() {
            containerRow[indexSelectedRow].classList.remove('animateFadeInLeft');

            navLeft.classList.remove('animateFadeZoomOut');
            navRight.classList.remove('animateFadeZoomOut');

            navLeft.classList.add('animateFadeZoomIn');
            navRight.classList.add('animateFadeZoomIn');

            navUp.classList.remove('disabledButton');
            navDown.classList.remove('disabledButton');

            toggleNavRow(true, containerRow, indexSelectedRow);
        }); {once : true}
    }


    navDown.addEventListener('click', moveDown);
    navUp.addEventListener('click', moveUp);
    navRight.addEventListener('click', moveRight);
    navLeft.addEventListener('click', moveLeft);

    document.addEventListener('keydown', function(event) {
        if (event.key === 'ArrowDown') {
            moveDown();
        } else if (event.key === 'ArrowUp') {
            moveUp();
        }
    });

    allInvisible();
    selectContainer(indexSelected);
    toggleNav(indexSelected);
    toggleNavRow(true, containers[indexSelected].querySelectorAll('.border'), 0);
});