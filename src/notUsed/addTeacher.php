<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 10.10.23
 * Description : Page pour ajouter un enseignant
 */

include('Database.php');

session_start();

// Création d'une instance de la classe Database
$db = new Database();

// Récupère la liste des sections de la BD
$sections = $db->getAllSections();

echo "<pre>";
var_dump($sections);
echo "</pre>";

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
            <nav>
                <h2>Zone pour le menu</h2>
                <a href="index.php">Accueil</a>
                <a href="addTeacher.php">Ajouter un enseignant</a>
            </nav>
        </header>

        <div class="container">
            <div class="user-body">
                <form action="checkAddTeacher.php" method="post" id="form">
                    <h3>Ajout d'un enseignant</h3>
                    <p>
                        <input type="radio" id="gender1" name="gender" value="m" checked>
                        <label for="gender1">Homme</label>
                        <input type="radio" id="gender2" name="gender" value="w">
                        <label for="gender2">Femme</label>
                        <input type="radio" id="gender3" name="gender" value="o">
                        <label for="gender3">Autre</label>
                    </p>
                    <p>
                        <label for="lastName">Nom :</label>
                        <input type="text" name="lastName" id="lastName" value="">
                    </p>
                    <p>
                        <label for="firstName">Prénom :</label>
                        <input type="text" name="firstName" id="firstName" value="">
                    </p>
                    <p>
                        <label for="nickName">Surnom :</label>
                        <input type="text" name="nickName" id="nickName" value="">
                    </p>
                    <p>
                        <label for="origin">Origine :</label>
                        <textarea name="origin" id="origin" rows="5" cols="35"></textarea>
                    </p>
                    <p>
                        <label style="display: none" for="section"></label>
                        <select name="section" id="section">
                            <option value="">Section</option>
                            <?php
                            // html pour afficher toutes sections
                            $html ="";

                            // Parcoure le tableau des sections pour générer le html pour chaque section
                            foreach ($sections as $section) {
                                $html .= '<option value="' . $section["idSection"] . '">' . $section["secName"] . '</option>';
                            }

                            echo $html;
                            ?>
                        </select>
                    </p>
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

        <footer>
            <p>Copyright Kathleen - 2023</p>
        </footer>
    </body>
</html>