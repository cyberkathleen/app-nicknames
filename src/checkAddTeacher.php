<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 26.10.23
 * Description : Page de vérification pour le formulaire d'ajout d'un enseignant
 */

include('Database.php');

session_start();

// Création d'une instance de la classe Database
$db = new Database();

// Récupère les donnnées et ajoute un nouvel enseignant dans la BD et affiche la page d'accueil, sinon retourne sur la page du formulaire d'ajout pour afficher les erreurs
if (isset($_SESSION["incorrect"]) && $_SESSION["incorrect"] !== "") {
  header("Location: addTeacher.php");
} else {
  $db->insertTeacher($_SESSION["firstName"], $_SESSION["lastName"], $_SESSION["gender"], $_SESSION["nickname"], $_SESSION["origin"], $_SESSION["section"]);

  header("Location: index.php");
}
?>