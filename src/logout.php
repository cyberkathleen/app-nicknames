<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 14.11.23
 * Description : Permet de déconnecter un utilisateur
 */

session_start();

// Déconnecte l'utilisateur
session_destroy();

header("Location: index.php");

?>