<?php
require_once ('../Testing/MyPDO.php');
ini_set('display_errors', 1);
if(isset($_SESSION)){ //Pourquoi il veut s'inscrire si il est déjà connecté ?
    header('Location: /Blockly/Blockly_Test.php');
}
else if(empty($_POST['username']) || empty($_POST['password']) || empty($_POST['password2'])){
    header('Location: Register.html'); //Si il n'a pas rempli tous les champs, il est redirigé vers la page d'inscription
}
else if($_POST['password'] != $_POST['password2']){
    header('Location: Register.html'); //Si les mots de passe ne sont pas identiques, il est redirigé vers la page d'inscription
}
else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $date = date("Y-m-d");
    $password = $date.$password; //La date est utilisée comme sel
    $password = hash('sha3-256', $password);
    $insert = "INSERT INTO Utilisateurs (Username, Password, Date_Inscription) VALUES (:username, :password, :date)";
    try {
        MyPDO::requeteStandard($insert, array(':username' => $username, ':password' => $password, ':date' => $date));
    } catch (Exception $e) {
        header('Location: Register.html'); //Si le nom d'utilisateur est déjà pris, il est redirigé vers la page d'inscription
    }
    echo "Vous êtes inscrit !<br>";
}