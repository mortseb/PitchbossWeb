<?php
session_start();
// Vérifie si un message a été défini
// Vérifie si un message a été passé en paramètre GET


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Votre Site Web</title>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="images/logo.png" alt="logo">
        </div>
    </header>
<?php if (isset($_GET['message'])) {
    // Affiche le message
    echo '<div class="message">' . htmlspecialchars($_GET['message']) . '</div>';
}?>
    <div class="body-content">


    <div class="form-container">
   
    <div class="switch-container">
        <span>Connexion</span>
        <label class="switch">
            <input type="checkbox" id="form-switch">
            <span class="slider"></span>
        </label>
        <span>Inscription</span>
    </div>

    <form id="login-form" action="../controller/connection.php" method="post">
        <input type="text" name="username" placeholder="Pseudo">
        <input type="password" name="password" placeholder="Mot de passe">
        <button type="submit">Envoyer</button>
    </form>

    <form id="register-form" action="../controller/inscription.php" method="post" style="display: none;">
        <input type="text" name="username" placeholder="Pseudo">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Mot de passe">
        <input type="password" name="password2" placeholder="Confirmation du mot de passe">
        <input type="text" name="team" placeholder="Nom de l'équipe">
        <button type="submit">Envoyer</button>
    </form>
</div>
</div>

    <script src="switchform.js"></script>
</body>
</html>
