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
   async ConnectExistingUser (email, pwd, rememberMe) {
    try {
        const response = await fetch("http://localhost/douzhee/src/Controllers/AuthController.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            credentials: "include",
            body: JSON.stringify({
                "for": "connection",
                "action": "READ",
                "object": "Joueur",
                "params": { email, pwd,rememberMe }
            })
        });

        const textResponse = await response.text();  
        const data = JSON.parse(textResponse);
        if (data.error) {
            if (data.error === "Email non trouvé") {
                alert("Cet email n'existe pas. Veuillez vérifier votre adresse email.");
            } else if (data.error === "Mot de passe incorrect") {
                alert("Le mot de passe que vous avez entré est incorrect.");
            } else {
                alert(data.error);  
            }
        } else if (data.success) {
            window.location.href = "Index.php";  
        }
    } catch (error) {
        alert("Erreur de connexion, veuillez réessayer.");  
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
            if (data.error) {
                if (data.error === "L'email est déjà utilisé") {
                    alert("Cet email est déjà pris. Veuillez en choisir un autre.");
                } else {
                    alert(data.error); 
                }
            } else if (data.success) {
                window.location.href = "index.php"; 
            }
        } catch (error) {
            alert("Erreur d'inscription, veuillez réessayer.");  
        }
    }
    
}
export default AuthManager;

