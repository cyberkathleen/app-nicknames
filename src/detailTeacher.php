<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 10.10.23
 * Description : Page de détail d'un enseignant
 */

include('Database.php');

// Récupère l'id de l'enseignant
$idTeacher = $_GET["idTeacher"];

// Création d'une instance de la classe Database
$db = new Database();

// Récupère l'enseignant sélectionné
$teacher = $db->getOneTeacher($idTeacher);

// Récupère la bonne image pour afficher le genre de l'enseignant
if ($teacher["teaGender"] === 'w') {
    $gender = 'src="./img/female.png" alt="female symbole"';
} elseif ($teacher["teaGender"] ==='m') {
    $gender ='src="./img/male.png" alt="male symbole"';
} elseif ($teacher["teaGender"] === 'o') {
    $gender ='src="./img/other.png" alt="other symbole"';
}

// Récupère la section de l'enseignant
$section = $db->getOneSection($teacher["fkSection"]);
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/style.css" rel="stylesheet">
        <title>Surnom des enseignants | Détails</title>
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
            <div class="user-head">
                <h3>Détail : <?=$teacher["teaFirstname"] . " " . $teacher["teaName"];?>
                    <img style="margin-left: 1vw;" height="20em" <?=$gender;?>>
                </h3>
                <p><?=$section;?></p>
                <div class="actions">
                    <a href="updateTeacher.php?idTeacher=<?=$teacher["idTeacher"];?>">
                        <img height="20em" src="./img/edit.png" alt="edit icon">
                    </a>
                    <a href="javascript:confirmDelete(<?=$teacher["idTeacher"];?>)">
                        <img height="20em" src="./img/delete.png" alt="delete icon">
                    </a>
                </div>
            </div>
            <div class="user-body">
                <div class="left">
                    <p>Surnom : <?=$teacher["teaNickname"];?></p>
                    <p><?=$teacher["teaOrigine"];?></p>
                </div>
            </div>
            <div class="user-footer">
                <a href="index.php">Retour à la page d'accueil</a>
            </div>
        </div>

        <?php
        include('parts/footer.inc.php');
        ?>

        <script src="js/script.js"></script>
    </body>
</html>