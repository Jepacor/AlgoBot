<form action="Traitement_Formulaire.php" method="POST">
    <h1>Premier Test !</h1>
    <p>L'objectif : multiplier l'entrée par 2 !</p>
    <p>Exemple : entrée : 5 : résultat : 10</p>

    <label><b>Nom d'utilisateur</b></label>
    <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>
    <br>
    <label><b>Mot de passe</b></label>
    <input type="password" placeholder="Entrer le mot de passe" name="password" required>
    <br>
    <input type="submit" id='submit' value='Connexion' >