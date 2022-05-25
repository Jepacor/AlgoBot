<?php
require_once ("../Testing/MyPDO.php");
var_dump($_POST);
if (!isset($_POST["code"])){
    echo "Error: No code received";
    return;
}
session_start();
$code = $_POST["code"];
$code = str_replace("\n", " ", $code);
if (empty($_SESSION['id'])){
    $userId = 1; //id "guest" quand pas login
}
else{
    $userId = $_SESSION['id'];
}
$niveau_id = $_POST["niveau"];
$niveau_id = intval($niveau_id);
$requete = "INSERT INTO Code (code, Id_Utilisateurs,Id_Resultats) VALUES (:code, :user_id, :niveau_id)";
MyPDO::requeteStandard($requete,
        array(
            ":code" => $code,
            ":user_id" => $userId,
            ":niveau_id" => $niveau_id,
        ));


