class AuthManager { 
    
    static instance = null;

    constructor() {
        if (AuthManager.instance){
            return AuthManager.instance
        }
        AuthManager.instance = this;
    }

    static getInstance() {
        if (!AuthManager.instance) {
            AuthManager.instance = new AuthManager();
        
    }
    return AuthManager.instance;
}

    /**
     * @author Mael
     * @param {*} email email sous forme valide (zikette@domaine.tld)
     * @param {*} password un mot de passe HASHÉ, qui idéalement existe dans la BdD
     * Une fonction qui vérifie si un utilisateur existe dans la base de données. Si oui, le conencte.
     */
   async ConnectExistingUser (email, pwdHash) {
    try {
        const response = await fetch("http://localhost/douzhee/src/Controllers/AuthController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                "for": "connection",
                "action": "READ",
                "object": "Joueur",
                "params": { email, pwdHash }
            })
        });

        const data = await response.json();
        if (data.success) {
            window.location.href = "Index.php"; 
        } else {
            console.error("Erreur:", data.message);
        }
    } catch (error) {
        console.error("Erreur de connexion:", error);
    }
}
    /**
     * 
     * @param {*} username nom d'utilisateur du nouvel utilisateur
     * @param {*} pwd mot de passe (en clair) du nouvel utilisateur
     * @param {*} email email sous forme valide (zikette@domaine.tld)
     */
    async SignUpNewUser(username, pwd, email) {
        try {
            const response = await fetch("http://localhost/douzhee/src/Controllers/AuthController.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    "for": "signup",
                    "action": "CREATE",
                    "object": "Joueur",
                    "params": { username, pwd, email }
                })
            });

            const data = await response.json();
            if (data.success) {
                window.location.href = "index.php"; // Redirection après inscription réussie
            } else {
                console.error("Erreur:", data.message);
            }
        } catch (error) {
            console.error("Erreur d'inscription:", error);
        }
    }
}

const  Manager = new AuthManager.getInstance(); 
Manager.ConnectExistingUser("test@gmail.com", "$2y$10$aDgMydsudCBz48nuAjslKu13sUj/cygPJ7LmQA5NGBW87d5kwWzuq");
Manager.SignUpNewUser("cosmos2", "mon_mot_de_passe", "cosmos2@gmail.com");