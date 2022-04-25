<?php
require_once("MyPDO.php");
class TestVerif
{
    public static function verif(int $id_result, string $result_donne): bool
    {
        $pdo = MyPDO::getInstance();
        $req = $pdo->prepare("SELECT Sortie FROM Sorties WHERE Id_Resultats = :id_result");
        $req->bindParam(":id_result", $id_result);
        $req->execute();
        $sortie = $req->fetch();
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
}