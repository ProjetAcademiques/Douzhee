class AuthManager { 
    
    static instance = null;
    name = "";

    constructor(name) {
        this.name = name;
    }

    static getInstance() {
        if (AuthManager.instance === null) {
            AuthManager.instance = new AuthManager(name);
        } else {
            return AuthManager.instance;
        }
    }

    /**
     * @author Mael
     * @param {*} email email sous forme valide (zikette@domaine.tld)
     * @param {*} password un mot de passe HASHÉ, qui idéalement existe dans la BdD
     * Une fonction qui vérifie si un utilisateur existe dans la base de données. Si oui, le conencte.
     */
    ConnectExistingUser (email, pwdHash) {
        fetch("../../src/Controllers/AuthController.php", {
            method : "POST",
            mode : "cors",
            headers: {
                "Content-Type" : "application/json"
            },
            body : JSON.stringify ({
                "for" : "connection",
                "action" : "READ",
                "object" : "Joueur",
                "params" : {email, pwdHash}
            })
        })

        .then(rq => rq.text())
        
        .then(data => console.log(data))

        .catch(error => console.error(error))
    }

    /**
     * 
     * @param {*} username nom d'utilisateur du nouvel utilisateur
     * @param {*} pwd mot de passe (en clair) du nouvel utilisateur
     * @param {*} email email sous forme valide (zikette@domaine.tld)
     */
    SignUpNewUser(username, pwd, email) {
        fetch("../../src/Controllers/AuthController.php", {
            method: "POST",
            mode: "cors",
            headers: {
                "Content-Type" : "application/json"
            },
            body: JSON.stringify({
                "for" : "signup",
                "action" : "CREATE",
                "object" : "Joueur",
                "params" : {username, pwd, email}
            })
        })

        .then (rq => rq.text())

        .then (data => console.log(data))

        .catch(error => console.error(error))
    }
}

Manager = new AuthManager(); // singleton pas encore respecté
Manager.ConnectExistingUser("test@gmail.com", "$2y$10$aDgMydsudCBz48nuAjslKu13sUj/cygPJ7LmQA5NGBW87d5kwWzuq");
Manager.SignUpNewUser("cosmos2", "mon_mot_de_passe", "cosmos2@gmail.com");