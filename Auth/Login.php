<?php
require_once ("../Testing/MyPDO.php");
if(empty($_POST['username']) || empty($_POST['password'])){
    header('Location: LogForm.php?error=1');
}
$requete = "SELECT * FROM Utilisateurs WHERE Username = :username";
$reponse = MyPDO::requeteStandard($requete, array(':username' => $_POST['username']));
var_dump($reponse);
if($reponse == null){
    //Utilisateur non trouvé
    header('Location: LogForm.php?error=2');
}
else{
    $dateInscription = $reponse[0]['Date_Inscription'];
    $passwordTrue = $reponse[0]['Password'];
    $passwordUser = $dateInscription.$_POST['password'];
    $passwordUser = hash('sha3-256', $passwordUser);
//    var_dump($passwordUser);
//    var_dump($passwordTrue);
    if($passwordUser == $passwordTrue){
        //Utilisateur trouvé
        session_start();
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['id'] = $reponse[0]['Id_Utilisateurs'];
        if ($reponse[0]['Admin'] == true){
            $_SESSION['isAdmin'] = 1;
        }
        else{
            $_SESSION['isAdmin'] = 0;
        }
        echo "Vous êtes connecté ! Vous pouvez recharger la page.t <br>";
    }
    else{
        //Mauvais mot de passe
        header('Location: LogForm.php?error=2');
    }
}
