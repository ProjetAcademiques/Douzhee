document.addEventListener("DOMContentLoaded", (DOMevent) => {

    let PJBT = document.querySelector("#leaderBoardPJ");
    let douzheeBT = document.querySelector("#leaderBoardDouzhee");
    let succesBT = document.querySelector("#leaderBoardSucces");
    let ratioBT = document.querySelector("#leaderBoardRatio");

    const leaderBoardMode = document.querySelector("#leaderBoardMode");
    const ldSpan = document.querySelector("#toFill");

    const buttons = [PJBT, douzheeBT, succesBT, ratioBT];
    buttons.forEach((element) => {
        if (element) {
            element.addEventListener("click", () => loadTable());
        }
    });

    var tableData = null // une chaîne JSON qui représente les données d'une table.

    /**
     * enlève tout les enfants d'un HTMLElement, le rendant vide
     * @author Mael
     * @param {HTMLElement} node
     */
    function removeAllChildren(node) {
        while(node.lastElementChild != null) {
            node.removeChild(node.lastElementChild);
        }
    }

    /**
     * @async 
     * @param {string} tableMode une chaîne de caractère qui indique quelle données on récupère
     * @param {number} lines le nombre de lignes qu'on souhaite afficher
     */
    async function getTableData(tableMode, lines) { // ACH, RK, CRC
        const response = await fetch("../../src/Controllers/LeaderBoardController.php", {
            mode: "cors",
            method: "POST",
            body: JSON.stringify({
                "for": "LeaderBoard",
                "mode": tableMode,
                "lines": lines
            })
        });
        const data = await response.json();
        console.log(data);
        tableData = Array.from(data); // Ensure tableData is populated after fetch
    }


    async function loadTable() {
        console.log("loadTable called");

        removeAllChildren(ldSpan);

        let isPJBT = event.target == PJBT;
        let isDouzheeBT = event.target == douzheeBT;
        let isSuccesBT = event.target == succesBT;
        let isRatioVictoireBT = event.target == ratioBT;

        if (isPJBT) {
            await getTableData("RK", 4);
            leaderBoardMode.textContent = "Score";
        } else if (isDouzheeBT) {
            await getTableData("CRC", 4);
            leaderBoardMode.textContent = "DouzCoins";
        } else if (isRatioVictoireBT) {
            await getTableData("RV", 4);
            leaderBoardMode.textContent = "Ratio de Victoires";
        } else if (isSuccesBT) {
            await getTableData("ACH", 4);
            leaderBoardMode.textContent = "Succes";
        } else {
            await getTableData("VC", 4);
            leaderBoardMode.textContent = "Victoires"
        }

        for(let i = 0; i < tableData.length; i++) {
            let leaderBoardRoom = document.createElement("div");
            leaderBoardRoom.classList.add("LeaderBoardRoom");
            let rank = document.createElement("span");
            let name = document.createElement("span");
            let stat = document.createElement("span");

            console.log (`rank : ${tableData[i].rank}; name : ${tableData[i].name}; rank: ${tableData[i].stat}`);

            rank.textContent = `${tableData[i].rank + 1}`;
            name.textContent = `${tableData[i].name}`;
            stat.textContent = `${tableData[i].stat}`;

            leaderBoardRoom.appendChild(rank);
            leaderBoardRoom.appendChild(name);
            leaderBoardRoom.appendChild(stat);
            ldSpan.appendChild(leaderBoardRoom);
        }
}
}); // fin de DOMContentLoaded - callback