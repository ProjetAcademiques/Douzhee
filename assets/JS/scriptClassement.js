
document.addEventListener("DOMContentLoaded", (DOMevent) => {

    let scoreBT = document.querySelector("#leaderBoardScore");
    let douzheeBT = document.querySelector("#leaderBoardDouzhee");
    let succesBT = document.querySelector("#leaderBoardSucces");

    const buttons = [];
    buttons.push(scoreBT, douzheeBT, succesBT);
    buttons.forEach((element, index) => {
        element.addEventListener("click", () => loadTable());
    })

    const leaderBoardMode = document.querySelector("#leaderBoardMode");
    var tableData = null // une chaîne JSON qui représente les données d'une table.


    /**
     * @async 
     * @param {*} tableMode une chaîne de caractère qui indique quelle données on récup
     */
    async function getTableData(tableMode) { // ACH, RK, CRC
        const response = await fetch("../../src/Controllers/LeaderBoardController.php", {
            mode: "cors",
            method: "POST",
            body: JSON.stringify({
                "for": "LeaderBoard",
                "mode": tableMode
            })
        });
        const data = await response.json();
        tableData = Array.from(data); // Ensure tableData is populated after fetch
    }


    async function loadTable() {

        console.log(event.target);
        let isScoreBT = event.target == scoreBT;
        let isDouzheeBT = event.target == douzheeBT;
        let isSuccesBT = event.target == succesBT;

        if (isScoreBT) {
            await getTableData("RK");
            leaderBoardMode.textContent = "Score";
        } else if (isDouzheeBT) {
            await getTableData("CRC");
            leaderBoardMode.textContent = "DouzCoins";
        } else {
            await getTableData("ACH");
            leaderBoardMode.textContent = "Succes";
        }

        let tableRows = document.querySelectorAll("tr:not(tbody:first-child)");
        tableRows = Array.from(tableRows);
        for(let i = 1; i < tableRows.length; i++) {
            tableRows[i].querySelector("#nom" + i).textContent = tableData[i].pseudonyme;
            if (isScoreBT) { 
                console.log(tableRows[i].querySelector("#stat" + i));
                tableRows[i].querySelector("#stat" + i).textContent = tableData[i].score; 
                console.log("score");
            }
            else if (isDouzheeBT) { 
                console.log(tableRows[i].querySelector("#stat" + i));
                tableRows[i].querySelector("#stat" + i).textContent = tableData[i].nbDouzhee;
                console.log("piece");
            }
            else if (isSuccesBT) {
                console.log(tableRows[i].querySelector("#stat" + i)); 
                tableRows[i].querySelector("#stat" + i).textContent = tableData[i].nbSucces; 
                console.log("stat");
            }
        }
    }
}); // fin de DOMContentLoaded - callback