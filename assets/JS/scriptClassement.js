
document.addEventListener("DOMContentLoaded", (event) => {
    let scoreRadio = document.querySelector("#leaderBoardScore");
    let douzheeRadio = document.querySelector("#leaderBoardDouzhee");
    let succesRadio = document.querySelector("#leaderBoardSucces");

    const radioButtons = [];
    radioButtons.push(scoreRadio, douzheeRadio, succesRadio);
    console.log(radioButtons)
    radioButtons.forEach((element, index) => {
        element.addEventListener("click", loadTable);
    })

    const leaderBoardMode = document.querySelector("#leaderBoardMode");
    const tableData = null // une chaîne JSON qui représente les données d'une table.


    /**
     * 
     * @param {*} tableMode une chaîne de caractère qui indique quelle données on récuo
     */
    function getTableData(tableMode) { // ACH, RK, CRC
        const data = null
        fetch("../../src/Pages/Classement.php", {
            mode: "cors",
            method: "POST",
            body: JSON.stringify({
                "for" : "LeaderBoard",
                "mode" : tableMode
            })
        })

        .then (rq => rq.json())

        .then (rq => console.log(rq))

        return data
    }


    function loadTable() {
        scoreRadio = document.querySelector("#leaderBoardScore:checked");
        douzheeRadio = document.querySelector("#leaderBoardDouzhee:checked");
        succesRadio = document.querySelector("#leaderBoardSucces:checked");

        let table = null;

        if (scoreRadio != null) {
            table = getTableData("RK");
            // != null > radio sélectionné
            leaderBoardMode.textContent = "Score";
        } else if (douzheeRadio != null) {
            table = getTableData("CRC");
            leaderBoardMode.textContent = "DouzCoins";
        } else {
            table = getTableData("ACH");
            leaderBoardMode.textContent = "Succes";
        }
    }
})