<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<h1>Connexion</h1>
<?php
if (isset($_GET['error'])) {
    if($_GET['error'] == '1') {
        echo "<p style='color: firebrick'>Veuillez remplir tous les champs</p>";
    }
    elseif ($_GET['error'] == '2') {
        echo "<p style='color: firebrick'>Identifiants ou mot de passe incorrect</p>";
    }
}
?>
<form action="Login.php" method="post">
    <label for="username">Nom d'utilisateur</label>
    <input type="text" name="username" id="username">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="Se connecter">
</form>
<!--Pas de mot de passe oublié puisqu'on ne garde pas l'email -> à changer ? -->
</body>
</html>