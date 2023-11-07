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

// Récupère l'id de l'enseignant
$idTeacher = $_GET["idTeacher"];

// Création d'une instance de la classe Database
$db = new Database();

// Récupère l'enseignant sélectionné
$teacher = $db->getOneTeacher($idTeacher);

// Récupère la section de l'enseignant
$teaSection = $db->getOneSection($teacher["fkSection"]);

// Récupère la liste des sections de la BD
$sections = $db->getAllSections();

// Rajoute une section par défaut pour l'affichage
array_unshift($sections, array("idSection" => 0, "secName" => "Section"));

echo "<pre>";
var_dump($teacher);
echo "</pre>";

echo "<pre>";
var_dump($sections);
echo "</pre>";

echo "<pre>";
var_dump($teaSection);
echo "</pre>";

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
            <nav>
                <h2>Zone pour le menu</h2>
                <a href="index.php">Accueil</a>
                <a href="addTeacher.php">Ajouter un enseignant</a>
            </nav>
        </header>

        <div class="container">
            <div class="user-body">
                <form action="checkAddTeacher.php" method="post" id="form">
                    <h3>Modification d'un enseignant</h3>
                    <p>
                    <!-- Ajout des informations dynamiquement -->
                    <?php
                    // html pour afficher les formulaire avec les informations d'un enseignant
                    $html = "";

                    // Affiche les genres en sélectionnant le bon
                    if ($teacher["teaGender"] === "m") {
                        $html .= '
                        <input type="radio" id="gender1" name="gender" value="m" checked>
                        <label for="gender1">Homme</label>
                        <input type="radio" id="gender2" name="gender" value="w">
                        <label for="gender2">Femme</label>
                        <input type="radio" id="gender3" name="gender" value="o">
                        <label for="gender3">Autre</label>';
                    } else if ($teacher["teaGender"] === "w") {
                        $html .= '
                        <input type="radio" id="gender1" name="gender" value="m">
                        <label for="gender1">Homme</label>
                        <input type="radio" id="gender2" name="gender" value="w" checked>
                        <label for="gender2">Femme</label>
                        <input type="radio" id="gender3" name="gender" value="o">
                        <label for="gender3">Autre</label>';
                    } else if ($teacher["teaGender"] === "o") {
                        $html.= '
                        <input type="radio" id="gender1" name="gender" value="m">
                        <label for="gender1">Homme</label>
                        <input type="radio" id="gender2" name="gender" value="w">
                        <label for="gender2">Femme</label>
                        <input type="radio" id="gender3" name="gender" value="o" checked>
                        <label for="gender3">Autre</label>';
                    }
                    $html .= "</p>";

                    // Affiche le nom
                    $html .= '
                    <p>
                        <label for="lastName">Nom :</label>
                        <input type="text" name="lastName" id="lastName" value="' . $teacher["teaName"] . '">
                    </p>';

                    // Affiche le prénom
                    $html .= '
                    <p>
                        <label for="firstName">Prénom :</label>
                        <input type="text" name="firstName" id="firstName" value="' . $teacher["teaFirstname"] . '">
                    </p>';

                    // Affiche le surnom
                    $html .= '
                    <p>
                        <label for="nickName">Surnom :</label>
                        <input type="text" name="nickName" id="nickName" value="' . $teacher["teaNickname"] . '">
                    </p>';

                    // Affiche l'origine
                    $html .= '
                    <p>
                        <label for="origin">Origine :</label>
                        <textarea name="origin" id="origin" rows="5" cols="35">' . $teacher["teaOrigine"] . '</textarea>
                    </p>';

                    // Affiche la liste des sections avec la bonne sélectionnée
                    $html .= '
                    <p>
                        <label style="display: none" for="section"></label>
                        <select name="section" id="section">
                            <option value="' . $teacher["fkSection"] . '" selected>' . $teaSection . '</option>';

                    foreach ($sections as $section) {
                        if ($section["idSection"] === $teacher["fkSection"]) {
                            continue;
                        } else {
                            $html .= '<option value="' . $section["idSection"] . '">' . $section["secName"] . '</option>';
                        }
                    }

                    $html .= '
                        </select>
                    </p>';

                    echo $html;
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

        <footer>
            <p>Copyright Kathleen - 2023</p>
        </footer>
    </body>
</html>