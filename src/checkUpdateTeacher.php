<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 26.10.23
 * Description : Page de vérification pour le formulaire de modification d'un enseignant
 */

include('Database.php');

session_start();

// Création d'une instance de la classe Database
$db = new Database();

// Si aucune erreur, met à jour les données de l'enseignant dans la BD et affiche la page de détails de l'enseignant, sinon retourne sur la page du formulaire d'ajout pour afficher les erreurs
if ($_SESSION["incorrect"] === "") {
    $db->updateTeacher($_SESSION["idTeacher"], $_SESSION["firstName"], $_SESSION["lastName"], $_SESSION["gender"], $_SESSION["nickname"], $_SESSION["origin"], $_SESSION["section"]);
    
    header("Location: detailTeacher.php?idTeacher=" . $_SESSION["idTeacher"]);
} else {
    header("Location: updateTeacher.php");
}

?>