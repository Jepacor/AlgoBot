<?php
require_once ("../Testing/TestVerif.php");
var_dump($_POST);
if (!isset($_POST["niveau"])){
    echo "Error: No code received";
    return;
}
$niveau = $_POST["niveau"];
TestVerif::getTestsNiveau($niveau);

