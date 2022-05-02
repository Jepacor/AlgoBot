<?php
ini_set('display_errors', 1);
require_once ("../Testing/TestVerif.php");
if (!isset($_POST['code'])){
    header('Location: Blockly_Test.php');
}
else{
    try {
        function algoUser($x){
            /* Rien que cette ligne est une très bonne raison
            pour abandonner le PHP et faire l'évaluation en JS côté client */
            eval($_POST['code']);
            return $x;
        }
    }
    catch (Exception $e){
        echo "Erreur : " . $e->getMessage();
    }
    try {
        //premier test : $entree = 2;
        //deuxieme test : $entree = 8;
        $entree = 2;
        $algoUser = "algoUser";
        $resultat1 = TestVerif::verif_function($algoUser, $entree,1);
        TestVerif::boolToString($resultat1);
        $entree2 = 8;
        $resultat2 = TestVerif::verif_function($algoUser, $entree2,2);
        TestVerif::boolToString($resultat2);
        if($resultat1 && $resultat2){
            echo "<h2> Félicitations ! Vous avez réussi les tests !</h2>";
        }
        else{
            echo "<h3> Vous n'avez pas réussi les tests ! Réessayer ? </h3>";
            echo "<a href='Blockly_Test.php'>Cliquez ici</a>";
        }
    }
    catch (Exception $e){
        echo "Erreur : " . $e->getMessage();
    }
}