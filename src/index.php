<?php

/**
 * 
 * ETML
 * Auteur : Kathleen Lu
 * Date : 04.10.23
 * Description : Page d'index du site
 */

include('Database.php');

session_start();
//session_destroy();

// Création d'une instance de la classe Database
$db = new Database();

// Récupère la liste de tous les enseignants
$teachers = $db->getAllTeachers();

// Au départ, aucun utilisateur n'est connecté
if (!isset($_SESSION["isConnected"])) {
    $_SESSION["isConnected"] = false;
}

// Pour afficher si l'utilisateur est "admin" ou "user"
if (isset($_SESSION["user"])) {
    if ($_SESSION["user"]["useAdministrator"] == true) {  
        $_SESSION["userStatus"] = "admin";
    } else {
        $_SESSION["userStatus"] = "user";
    }
}

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
                <?php
                include("parts/login.inc.php");
                ?>
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
                            <!-- Affiche seulement si un utilisateur est connecté -->
                            <?php if ($_SESSION["isConnected"]): ?>
                            <th>Options</th>
                            <?php endif; ?>
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

                            // Affiche les icones d'options si un utilisateur est connecté
                            if ($_SESSION["isConnected"]) {
                                $html .= "<td class='containerOptions'>";

                                // Affiche les options de modification et de suppression si l'utilisateur est un administrateur
                                if ($_SESSION["user"]["useAdministrator"]) {
                                    $html .= "
                                        <a href='updateTeacher.php?idTeacher=" . $teacher["idTeacher"] . "'>
                                            <img height='20em' src='img/edit.png' alt='edit'>
                                        </a>
                                        <a href='javascript:confirmDelete(" . $teacher["idTeacher"] . ")'>
                                            <img height='20em' src='img/delete.png' alt='delete'>
                                        </a>";
                                }

                                $html .= "
                                    <a href='detailTeacher.php?idTeacher=" . $teacher["idTeacher"] . "'>
                                        <img height='20em' src='img/detail.png' alt='detail'>
                                    </a>
                                </td>";
                            }

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