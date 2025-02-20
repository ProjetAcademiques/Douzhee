document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

    // Connexion utilisateur
    if (loginForm) {
        loginForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("E-mail").value;
            let password = document.getElementById("Password").value;
            let rememberMe = document.getElementById("check").checked;

            let response = await fetch("../Controllers/AuthController.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                credentials: "include",
                body: JSON.stringify({
                    object: "Joueur",
                    action: "READ",
                    params: { email: email, pwdHash: password ,rememberMe: rememberMe}
                })
            });

            let result = await response.json();

            if (response.ok) {
                window.location.href = "Index.php";
            } else {
                alert(result.error);
            }
        });
    }

    // Inscription utilisateur
    if (signupForm) {
        signupForm.addEventListener("submit", async function (event) {
            event.preventDefault();

            let email = document.getElementById("signupEmail").value;
            let username = document.getElementById("signupPseudo").value;
            let password = document.getElementById("signupPassword").value;

            let response = await fetch("../Controllers/AuthController.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    object: "Joueur",
                    action: "CREATE",
                    params: { username: username, pwd: password, email: email }
                })
            });

            let result = await response.json();

            if (response.ok) {
                alert("Inscription réussie ! Redirection...");
                window.location.href = "Index.php";
            } else {
                alert(result.error);
            }
        });
    }
});
