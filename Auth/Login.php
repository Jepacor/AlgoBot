<?php
require_once ("../Testing/MyPDO.php");
if(!isset($_POST['login']) || isset($_POST['password'])){
    header('Location: LogForm.php?error=1');
}
$requete = "SELECT * FROM Utilisateurs WHERE Username = :username";
$reponse = MyPDO::requeteStandard($requete, array(':username' => $_POST['login']));
if($reponse == null){
    //Utilisateur non trouvé
    header('Location: LogForm.php?error=2');
}
else{
    $dateInscription = $reponse[0]['date_inscription'];
    $passwordTrue = $reponse[0]['password'];
    $passwordUser = $dateInscription.$_POST['password'];
    $passwordUser = hash('sha3-256', $passwordUser);
    if($passwordUser == $passwordTrue){
        //Utilisateur trouvé
        session_start();
        $_SESSION['username'] = $_POST['login'];
        header('Location: ../Blockly/Blockly_Test.php');
    }
    else{
        //Mauvais mot de passe
        header('Location: LogForm.php?error=2');
    }
}
