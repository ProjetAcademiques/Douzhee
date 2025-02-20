<?php

header("Access-Control-Allow-Origin: http://localhost");
header("Access-Control-Allow-Headers: application/json");
header("Access-Control-Allow-Credentials: true");
require_once("../CRUD/CRUDJoueur.php");
require_once("../CRUD/CRUDPartie.php");
require_once("../CRUD/CRUDJoueurPartie.php");
require_once("../CRUD/CRUDTheme.php");
require_once("../CRUD/CRUDMusique.php");
require_once("../CRUD/CRUDAcheterTheme.php");
require_once("../CRUD/CRUDAcheterMusique.php");
require_once("../CRUD/CRUDSucces.php");
require_once("../CRUD/CRUDSuccesJoueur.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $request = json_decode(file_get_contents("php://input"), true);
    routing($request);
}

/**
 * Routeur des requêtes d'authentification
 */
function routing(mixed $request): void {
    if (!isset($request["object"]) || $request["object"] !== "Joueur") {
        sendResponse(400, ["error" => "Requête invalide"]);
    }

    switch (getAction($request)) {
        case "READ":
            connectUser($request["params"]["email"], $request["params"]["pwd"],$request["params"]["rememberMe"]);
            break;
        case "CREATE":
            createUser($request["params"]["username"], $request["params"]["pwd"], $request["params"]["email"]);
            break;
        default:
            sendResponse(400, ["error" => "Action non valide"]);
    }
}

/**
 * Vérifie l'existence d'un utilisateur et connecte si les identifiants sont valides.
 */
function connectUser(string $email, string $pwd,bool $check): void {
    $key = "this-is-a-zikette-key-for-a-pass";
    $joueur = readJoueurByEmail($email);

    if (!$joueur) {
        sendResponse(404, ["error" => "Email non trouvé"]);
    }

    if (!password_verify($pwd, $joueur->getMdp())) {
        sendResponse(401, ["error" => "Mot de passe incorrect"]);
    }else{
        $_SESSION['userId']= $joueur->getIdJoueur();
        $_SESSION['timeStart'] = microtime(true);
        if ($check){
            $emailcrypter = cryptage($email, $key);
            $passwordcrypter = cryptage($pwd, $key);

            setcookie("Email", $emailcrypter, time() + 7200, "/", "", true, true);  
            setcookie("Password", $passwordcrypter, time() + 7200, "/", "", true, true);  
        }
        sendResponse(200, ["success" => "Utilisateur connecté"]);
        
    }

    
}

/**
 * Crée un nouvel utilisateur si l'email n'est pas déjà pris.
 */
function createUser(string $username, string $pwd, string $email): void {
    if (readJoueurByEmail($email)) {
        sendResponse(409, ["error" => "Email déjà utilisé"]);
    }
    if (createJoueur($username, $pwd, $email)) {
        $joueur = readJoueurByEmail($email);
        $_SESSION['userId']= $joueur->getIdJoueur();
        $_SESSION['timeStart'] = microtime(true);
        sendResponse(201, ["success" => "Utilisateur créé"]);
    } else {
        sendResponse(500, ["error" => "Erreur lors de la création"]);
    }
}

/**
 * Récupère l'action demandée.
 */
function getAction(mixed $request): string {
    return $request["action"] ?? "ERROR";
}

/**
 * Envoie une réponse JSON propre.
 */
function sendResponse(int $statusCode, array $response): void {
    http_response_code($statusCode);
    echo json_encode($response);
    exit();
}