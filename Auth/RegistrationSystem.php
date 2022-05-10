<?php
require_once ('Testing/MyPDO.php');
if(isset($_SESSION)){ //Pourquoi il veut s'inscrire si il est déjà connecté ?
    header('Location: /Blockly/Blockly_Test.php');
}
if(!isset($_POST['username']) || !isset($_POST['password']) || !isset($_POST['password2'])){
    header('Location: Register.php'); //Si il n'a pas rempli tous les champs, il est redirigé vers la page d'inscription
}
if($_POST['password'] != $_POST['password2']){
    header('Location: Register.php'); //Si les mots de passe ne sont pas identiques, il est redirigé vers la page d'inscription
}
else{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $date = date("Y-m-d");
    $password = $date.$password; //La date est utilisée comme sel
    $password = hash('sha3-256', $password);
    $insert = "INSERT INTO Utilisateurs (username, password, date_inscription) VALUES (:username, :password, :date)";
    MyPDO::requeteStandard($insert, array(':username' => $username, ':password' => $password, ':date' => $date));
}