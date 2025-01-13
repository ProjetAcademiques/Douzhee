
class CommonDataManager {
    constructor(id, name) {
        /*les noms doivent être explicites pour éviter les confusions entre différents compte dans le stockage local */
        this.id = id
        this.name = name
    }


    // APPARTIENT A 
    /**
     * @author Mael
     * @param {*} idPJ idPartieJouee
     * @param {*} idJJ idJoueurJoue
     */
    CreateAppartientA(idPJ, idJJ) {
        fetch("", {
            method: "POST",
            mode: "cors",
            body: JSON.stringify({
                "for" : "CommonData",
                "action" : "CREATE",
                "object" : "AppartientA",
                "params" : {idPJ, idJJ}
            }),
        })

        .then(rq => rq.text())

        .then(data => console.log(data))
    }

    
    readAllAppartientA() {
        fetch("", {
            method: "POST",
            mode: "cors",
            body: JSON.stringify({
                "for" : "CommonData",
                "action" : "READ",
                "object" : "AppartientA",
                "params" : {}
            }),
        })

        .then(rq => rq.text())

        .then(data => console.log(data))
    }


    readAppartientA(idJJ, idPJ) {
        fetch("", {
            method: "POST",
            body: JSON.stringify({    
            
              })
        })
        .then()
        .then()
    }
}