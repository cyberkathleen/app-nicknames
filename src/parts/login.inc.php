<div class="login-container">
    <!-- Affiche le login d'un utilisateur qui est connecté -->
    <?php if ($_SESSION["isConnected"]): ?>
        <form action="logout.php" method="post">
            <p><?= $_SESSION["user"]["useLogin"] . " (" . $_SESSION["userStatus"] . ")" ;?></p>
            <button type="submit" class="btn btn-logout">Se déconnecter</button>
        </form>
    <!-- Affiche le login d'un utilisateur qui n'est pas connecté -->
    <?php else: ?>
        <form action="checkLogin.inc.php" method="post">
            <label for="username"></label>
            <input type="text" name="username" id="username" placeholder="Login">
            <label for="password"></label>
            <input type="password" name="password" id="password" placeholder="Mot de passe">
            <button type="submit" class="btn btn-login">Se connecter</button>
        </form>
    <?php endif; ?>
</div>