<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 04.10.23
 * Description : Page d'index du site
 */

include('Database.php');

// Création d'une instance de la classe Database
$db = new Database();

// Récupère la liste de tous les enseignants
$teachers = $db->getAllTeachers();

/* echo "<pre>";
var_dump($teachers);
echo "</pre>"; */

?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="./css/style.css" rel="stylesheet">
        <title>Surnom des enseignants | Accueil</title>
    </head>

    <body>
        <header>
            <div class="container-header">
                <div class="titre-header">
                    <h1>Surnom des enseignants</h1>
                </div>
                <div class="login-container">
                    <form action="login.php" method="post">
                        <label for="username"></label>
                        <input type="text" name="username" id="username" placeholder="Login">
                        <label for="password"></label>
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
            <h3>Liste des enseignants</h3>
            <form action="#" method="post">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Surnom</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // html pour afficher tous les enseignants
                        $html = "";

                        // Parcoure le tableau des enseignants pour générer le html pour chaque enseignant
                        foreach ($teachers as $teacher) {
                            $html .= "<tr>";

                            // Affiche le nom
                            $html .= "<td>" . $teacher["teaName"] . " " . $teacher["teaFirstname"] . "</td>";

                            // Affiche le surnom
                            $html .= "<td>" . $teacher["teaNickname"] . "</td>";

                            // Affiche les icones d'options
                            $html .= "
                            <td class='containerOptions'>
                                <a href='updateTeacher.php?idTeacher=" . $teacher["idTeacher"] . "'>
                                    <img height='20em' src='img/edit.png' alt='edit'>
                                </a>
                                <a href='javascript:confirmDelete(" . $teacher["idTeacher"] . ")'>
                                    <img height='20em' src='img/delete.png' alt='delete'>
                                </a>
                                <a href='detailTeacher.php?idTeacher=" . $teacher["idTeacher"] . "'>
                                    <img height='20em' src='img/detail.png' alt='detail'>
                                </a>
                            </td>";

                            $html .= "</tr>";
                        }

                        // Affiche le html généré
                        echo $html;
                        ?>
                    </tbody>
                </table>
            </form>
            <script src="js/script.js"></script>
        </div>

        <?php
        include('parts/footer.inc.php');
        ?>
    </body>
</html>