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

// Récupère l'utilisateur correspondant au nom d'utilisateur donné
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $user = $db->getOneUser($_POST["username"]);
}

// Si le tableau 'user' n'est pas vide, cela signifie que l'utilisateur a bien été trouvé en BD. Si son mdp est correct, il sera connecté.
if ($user && password_verify($_POST["password"], $user["usePassword"])) {
    $_SESSION["isConnected"] = true;
    $_SESSION["user"] = $user;
} else {
    $_SESSION["isConnected"] = false;
}

header("Location: index.php");

?>