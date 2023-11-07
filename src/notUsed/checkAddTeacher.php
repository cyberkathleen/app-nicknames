<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 10.10.23
 * Description : Page de vérification pour le formulaire d'ajout d'un enseignant
 */

include('Database.php');

session_start();

// Création d'une instance de la classe Database
$db = new Database();

// Est-ce que le formulaire a été bien rempli
$_SESSION["incorrect"] = "";

// Vérifie qu'un genre a été sélectionné
if (!isset($_POST["gender"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez sélectionner un genre !</p>";
}
 
// Vérifie que le nom est bien renseigné
if (!isset($_POST["lastName"]) || empty($_POST["lastName"]) || !preg_match("/^[a-zA-Z\s-]*$/", $_POST["lastName"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez renseigner un nom !</p>";
}

// Vérifie que le prénom est bien renseigné
if (!isset($_POST["firstName"]) || empty($_POST["firstName"]) || !preg_match("/^[a-zA-Z\s-]*$/", $_POST["firstName"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez renseigner un prénom !</p>";
}

// Vérifie que le surnom est bien renseigné
if (!isset($_POST["nickName"]) || empty($_POST["nickName"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez renseigner un surnom !</p>";
}

// Vérifie que l'origine est bien renseignée
if (!isset($_POST["origin"]) || empty($_POST["origin"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez renseigner l'origine du surnom !</p>";
}

// Vérifie qu'une section a été sélectionnée
if (!isset($_POST["section"]) || $_POST["section"] == "") {
    $_SESSION["incorrect"] .= "<p>Vous devez sélectionner une section !</p>";
}

// Si aucune erreur, récupère les donnnées et ajoute un nouvel enseignant dans la BD et affiche la page d'accueil, sinon, affiche les erreurs
if ($_SESSION["incorrect"] === "") {
    $db->insertTeacher($_POST["firstName"], $_POST["lastName"], $_POST["gender"], $_POST["nickName"], $_POST["origin"], $_POST["section"]);
    
    header("Location: index.php");
} else {
    header("Location: addTeacher.php");
}

?>