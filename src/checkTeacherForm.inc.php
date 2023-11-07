<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 10.10.23
 * Description : Page de vérification pour le formulaire d'ajout ou de modification d'un enseignant
 */

session_start();

// Est-ce que le formulaire a été bien rempli
$_SESSION["incorrect"] = "";

// Vérifie qu'un genre a été sélectionné
if (!isset($_POST["gender"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez sélectionner un genre !</p>";
}
 
// Vérifie que le nom est bien renseigné
if (!isset($_POST["lastName"]) || empty($_POST["lastName"]) || !preg_match("/^[a-zA-ZÀ-ÿ\s-]*$/", $_POST["lastName"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez renseigner un nom !</p>";
}

// Vérifie que le prénom est bien renseigné
if (!isset($_POST["firstName"]) || empty($_POST["firstName"]) || !preg_match("/^[a-zA-ZÀ-ÿ\s-]*$/", $_POST["firstName"])) {
    $_SESSION["incorrect"] .= "<p>Vous devez renseigner un prénom !</p>";
}

// Vérifie que le surnom est bien renseigné
if (!isset($_POST["nickname"]) || empty($_POST["nickname"])) {
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

// Récupère les données de l'enseignant
if (isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["gender"]) && isset($_POST["nickname"]) && isset($_POST["origin"]) && isset($_POST["section"])) {
    $_SESSION["firstName"] = $_POST["firstName"];
    $_SESSION["lastName"] = $_POST["lastName"];
    $_SESSION["gender"] = $_POST["gender"];
    $_SESSION["nickname"] = $_POST["nickname"];
    $_SESSION["origin"] = $_POST["origin"];
    $_SESSION["section"] = $_POST["section"];
}

header("Location: check" . ucfirst($_SESSION["currentPage"]));

?>