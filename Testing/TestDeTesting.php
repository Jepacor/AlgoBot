<?php
ini_set('display_errors', 1);
require_once ("MyPDO.php");
require_once ("TestVerif.php");
//Le test mis dans la BDD correspond à multiplier avec comme entrée 2 pour le premier test et 8 pour le second
$entree = 2;
$resultat = $entree * 2;
$TestResult = TestVerif::verif(1, $resultat);//Car le test a l'id 1, comment rendre ça plus intuitif ? Y a t'il besoin que ça soit plus clean ?
TestVerif::boolToString($TestResult);
echo "Test niveau entier : <br>";
$resultats[0] = $entree * 2;
$resultats[1] = $entree * 1;
$TestResults = TestVerif::verif_Niveau(0, $resultats);
foreach ($TestResults as $testResult) {
    TestVerif::boolToString($testResult);
}
echo "Test avec fonction : <br>";
function doublage(int $entree) : int {
    return $entree * 2;
}
$doublage = "doublage";
$testFunction = TestVerif::verif_function($doublage, 3, 1);
TestVerif::boolToString($testFunction);
TestVerif::getTestsNiveau(1);
phpinfo();



