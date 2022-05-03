<?php
require_once("MyPDO.php");
class TestVerif
{
    public static function requeteStandard(string $requete, array $parametres) : array
    {
        $pdo = MyPDO::getInstance();
        $stmt = $pdo->prepare($requete);
        $stmt->execute($parametres);
        return $stmt->fetchAll();
    }

    public static function getTestsNiveau($niveau) : void
    {
        $entrees = new ArrayObject();
        $sorties = new ArrayObject();
        $resultrequete = self::requeteStandard("SELECT Id_Resultats FROM Resultats WHERE Niveau = :niveau",
            array(":niveau" => $niveau));
        foreach ($resultrequete as $ligne){
            $resultsortie = self::requeteStandard("SELECT Sortie FROM Sorties WHERE Id_Resultats = :id_result",
                array(":id_result" => $ligne['Id_Resultats']));
            foreach ($resultsortie as $sortie){
                $sorties->append($sortie["Sortie"]);
            }
            $resultentree = self::requeteStandard("SELECT Entree FROM Entrees WHERE Id_Resultats = :id_result",
                array(":id_result" => $ligne['Id_Resultats']));
            foreach ($resultentree as $entree){
                $entrees->append($entree["Entree"]);
            }
        }
        echo json_encode(array("entrees" => $entrees, "sorties" => $sorties));
    }

    public static function verif(int $id_result, string $result_donne): bool
    {
        $sortie = self::requeteStandard("SELECT Sortie FROM Sorties WHERE Id_Resultats = :id_result",
            array(":id_result" => $id_result));
        echo "résultat donné : " . $result_donne . "<br>";
        echo "résultat attendu : " . $sortie[0]["Sortie"] . "<br>";
        if ($sortie[0]["Sortie"] == $result_donne) {
            return true;
        }
        return false;
    }
    public static function verif_Niveau (int $id_niveau, array $resultats) : array
    {
        $resultats_niveau = self::requeteStandard("SELECT Id_Resultats FROM Resultats WHERE Niveau = :id_niveau",
            array(":id_niveau" => $id_niveau));
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