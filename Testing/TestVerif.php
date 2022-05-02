<?php
require_once("MyPDO.php");
//Probablement besoin de refactor tout ça...
class TestVerif
{
    public static function getTestsNiveau($niveau) : void
    {
        $entrees = new ArrayObject();
        $sorties = new ArrayObject();
        $pdo = MyPDO::getInstance();
        $req = $pdo->prepare("SELECT Id_Resultats FROM Resultats WHERE Niveau = :niveau");
        $req->bindParam(":niveau", $niveau);
        $req->execute();
        $resultrequete = $req->fetchAll();
//        var_dump($resultrequete);
        foreach ($resultrequete as $ligne){
            $req = $pdo->prepare("SELECT Sortie FROM Sorties WHERE Id_Resultats = :id_result");
            $req->bindParam(":id_result", $ligne['Id_Resultats']);
            $req->execute();
            $resultsortie = $req->fetchAll();
            foreach ($resultsortie as $sortie){
                $sorties->append($sortie["Sortie"]);
            }
            $req = $pdo->prepare("SELECT Entree FROM Entrees WHERE Id_Resultats = :id_result");
            $req->bindParam(":id_result", $ligne['Id_Resultats']);
            $req->execute();
            $resultentree = $req->fetchAll();
            foreach ($resultentree as $entree){
                $entrees->append($entree["Entree"]);
            }
        }
//        echo "<br>";
        echo json_encode(array("entrees" => $entrees, "sorties" => $sorties));
    }

    public static function verif(int $id_result, string $result_donne): bool
    {
        $pdo = MyPDO::getInstance();
        $req = $pdo->prepare("SELECT Sortie FROM Sorties WHERE Id_Resultats = :id_result");
        $req->bindParam(":id_result", $id_result);
        $req->execute();
        $sortie = $req->fetch();
        echo "résultat donné : " . $result_donne . "<br>";
        echo "résultat attendu : " . $sortie["Sortie"] . "<br>";
        if ($sortie["Sortie"] == $result_donne) {
            return true;
        }
        return false;
    }
    public static function verif_Niveau (int $id_niveau, array $resultats) : array
    {
        $pdo = MyPDO::getInstance();
        $req = $pdo->prepare("SELECT Id_Resultats FROM Resultats WHERE Niveau = :id_niveau");
        $req->bindParam(":id_niveau", $id_niveau);
        $req->execute();
        $resultats_niveau = $req->fetchAll();
        $resultats_niveau_verif = [];
        $i = 0;
        foreach ($resultats_niveau as $id_result) {
            $resultats_niveau_verif[$i] = self::verif($id_result["Id_Resultats"], $resultats[$i]);
            $i++;
        }
        return $resultats_niveau_verif;
    }

    public static function verif_function ($function, string $entree, int $id_resultat) : bool{
        $sortie = $function($entree);
        return self::verif($id_resultat, $sortie);
    }

    public static function boolToString(bool $bool) : void {
        if ($bool) {
            echo "True<br>";
        } else {
            echo "False<br>";
        }
    }
}