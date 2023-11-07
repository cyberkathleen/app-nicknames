<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 26.10.23
 * Description : Page pour supprimer un enseignant de la BD
 */

include('Database.php');

// Crée une instance de la classe Database
$db = new Database();

// Vérifie si l'ID est envoyé via POST
if (isset($_GET['idTeacher'])) {
  // Récupère l'ID
  $idTeacher = $_GET['idTeacher'];

  // Supprime l'enseignant de la BD
  $db->deleteTeacher($idTeacher);

  // Affiche la page d'accueil
  header("Location: index.php");
}

?>