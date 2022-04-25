<?php
require_once("MyPDO.php");
class TestVerif
{
    function verif(int $id_sortie, string $result_donne): boolean {
        $pdo = MyPDO::getInstance();
        $req = $pdo->prepare("SELECT * FROM sortie WHERE id_sortie = :id_sortie");
        $req->bindParam(":id_sortie", $id_sortie);
        $req->execute();
        $sortie = $req->fetch();
        if ($sortie["result_donne"] == $result_donne) {
            return true;
        }
        return false;
    }

}