<?php
session_start();
require_once("../CRUD/CRUDJoueur.php");
header('Content-Type: application/json');
if (isset($_SESSION['userId'])) {
    $musicPath = readMusicPath($_SESSION['userId']);
    echo json_encode(['musicPath' => $musicPath]);
    exit();
} else {
    http_response_code(403); 
    echo json_encode(['error' => 'Utilisateur non connecté']);
    exit();
}

?>