<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 24.10.23
 * Description : Page pour modifier les informations d'un enseignant
 */

include('Database.php');

session_start();

// Création d'une instance de la classe Database
$db = new Database();

// Récupère la page actuelle
$_SESSION["currentPage"] = "updateTeacher.php";

// Récupère l'id de l'enseignant
if (isset($_GET["idTeacher"])) {
    $idTeacher = $_GET["idTeacher"];
    $_SESSION["idTeacher"] = $idTeacher;
}

// Récupère l'enseignant sélectionné
$teacher = $db->getOneTeacher($_SESSION["idTeacher"]);

// Récupère la liste des sections de la BD
$sections = $db->getAllSections();

// Récupère les informations de l'enseignant pour pouvoir les afficher dans le formulaire
$userData = array(
    "firstName" => $teacher["teaFirstname"],
    "lastName" => $teacher["teaName"],
    "gender" => $teacher["teaGender"],
    "nickname" => $teacher["teaNickname"],
    "origin" => $teacher["teaOrigine"],
    "idSection" => $teacher["fkSection"]
);

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/style.css" rel="stylesheet">
        <title>Surnom des enseignants | Modification</title>
    </head>

    <body>
        <header>
            <div class="container-header">
                <div class="titre-header">
                    <h1>Surnom des enseignants</h1>
                </div>
                <div class="login-container">
                    <form action="#" method="post">
                        <label for="user"> </label>
                        <input type="text" name="user" id="user" placeholder="Login">
                        <label for="password"> </label>
                        <input type="password" name="password" id="password" placeholder="Mot de passe">
                        <button type="submit" class="btn btn-login">Se connecter</button>
                    </form>
                </div>
            </div>
            <?php
            include('parts/menu.inc.php');
            ?>
        </header>

        <div class="container">
            <div class="user-body">
                <form action="checkTeacherForm.inc.php" method="post" id="form">
                    <h3>Modification d'un enseignant</h3>
                    <?php
                    // Formulaire pour modifier les informations de l'enseignant
                    include("parts/teacherForm.inc.php");
                    ?>                    
                    <p>
                        <input type="submit" value="Modifier">
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