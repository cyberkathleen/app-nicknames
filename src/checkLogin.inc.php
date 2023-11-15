<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 05.11.23
 * Description : Permet de vérifier le login d'un utilisateur
 */

include('Database.php');

session_start();

// Création d'une instance de la classe Database
$db = new Database();

// Récupère la liste des utilisateurs correspondants au login donné
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $users = $db->getLoggedInUser($_POST["username"], $_POST["password"]);
}

// Si le tableau 'users' n'est pas vide, cela signifie que l'utilisateur a bien été trouvé en BD
if ($users) {
    $_SESSION["isConnected"] = true;
    $_SESSION["user"] = $users[0];

    
} else {
    $_SESSION["isConnected"] = false;
}

header("Location: index.php");

?>