<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 10.10.23
 * Description : Page pour ajouter un enseignant
 */

include('Database.php');
include('helper.php');

session_start();

// Vérifie si l'utilisateur a accès à cette page
IsUserAllowed();

// Création d'une instance de la classe Database
$db = new Database();

// Récupère la page actuelle
$_SESSION["currentPage"] = "addTeacher.php";

// Récupère la liste des sections de la BD
$sections = $db->getAllSections();

// Pour afficher un formulaire vide
$userData = array(
    "firstName" => "",
    "lastName" => "",
    "gender" => "m",
    "nickname" => "",
    "origin" => "",
    "idSection" => ""
);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/style.css" rel="stylesheet">
        <title>Surnom des enseignants | Ajout</title>
    </head>

    <body>
        <header>
            <div class="container-header">
                <div class="titre-header">
                    <h1>Surnom des enseignants</h1>
                </div>
                <?php
                include("parts/login.inc.php");
                ?>
            </div>
            <?php
            include('parts/menu.inc.php');
            ?>
        </header>

        <div class="container">
            <div class="user-body">
                <form action="checkTeacherForm.inc.php" method="post" id="form">
                    <h3>Ajout d'un enseignant</h3>
                    <?php
                    // Formulaire pour ajouter un enseignant
                    include("parts/teacherForm.inc.php");
                    ?>    
                    <p>
                        <input type="submit" value="Ajouter">
                        <button type="button" onclick="document.getElementById('form').reset();">Effacer</button>
                    </p>
                </form>
                <?php
                // Affiche si le formulaire a été mal rempli
                if (isset($_SESSION["incorrect"]) && $_SESSION["incorrect"] !== "") {
                    echo $_SESSION["incorrect"];
                    $_SESSION["incorrect"] = "";
                }
                ?>
            </div>
            <div class="user-footer">
                <a href="index.php">Retour à la page d'accueil</a>
            </div>
        </div>

        <?php
        include('parts/footer.inc.php');
        ?>
    </body>
</html>