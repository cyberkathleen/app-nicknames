<nav>
    <h2>Zone pour le menu</h2>
    <a href="index.php">Accueil</a>
    <?php if ($_SESSION["isConnected"] && $_SESSION["user"]["useAdministrator"]): ?>
    <a href="addTeacher.php">Ajouter un enseignant</a>
    <?php endif; ?>
</nav>