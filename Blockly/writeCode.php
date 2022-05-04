<?php
require_once ("../Testing/TestVerif.php");
var_dump($_POST);
if (!isset($_POST["code"])){
    echo "Error: No code received";
    return;
}
$code = $_POST["code"];
$code = str_replace("\n", " ", $code);
$userId = 1; //hardcodé pour le moment car pas de login
$niveau_id = $_POST["niveau"];
$niveau_id = intval($niveau_id);
$requete = "INSERT INTO Code (code, Id_Utilisateurs,Id_Resultats) VALUES (:code, :user_id, :niveau_id)";
TestVerif::requeteStandard($requete,
        array(
            ":code" => $code,
            ":user_id" => $userId,
            ":niveau_id" => $niveau_id,
        ));


