<?php
require_once ("../Testing/MyPDO.php");
ini_set('display_errors', 1);
session_start();
if ($_SESSION['isAdmin'] != 1) {
    header('Location: ../index.php');
}
?>
<form action="Check_DB.php" method="post">
    <p>Inspecter le code d'un utilisateur : </p>
    <input type="text" name="username" id="username">
    <input type="submit" value="Se connecter">
</form>
<table>
    <tr>
        <th>Utilisateur</th>
        <th>Code</th>
    </tr>
</table>
<?php
if (empty($_POST['username'])){
    $requeteA = "SELECT * FROM Utilisateurs";
    $reponseA = MyPDO::requeteStandard($requeteA);
    foreach ($reponseA as $utilisateur) {
        $Utilisateurs[$utilisateur['Id_Utilisateurs']] = $utilisateur['Username'];
    }
    $requeteB = "SELECT Code, Id_Utilisateurs FROM Code";
    $reponseB = MyPDO::requeteStandard($requeteB);
    foreach ($reponseB as $ligneCode){
        echo "<tr>";
        echo "<td>".$Utilisateurs[$ligneCode['Id_Utilisateurs']]."</td>";
        echo "<td>".$ligneCode['Code']."</td>";
        echo "</tr>";
    }
}
else {
    $requeteA = "SELECT * FROM Utilisateurs WHERE Username = :username";
    $reponseA = MyPDO::requeteStandard($requeteA, array(':username' => $_POST['username']));
    $requeteB = "SELECT Code, Id_Utilisateurs FROM Code WHERE Id_Utilisateurs = :id";
    $reponseB = MyPDO::requeteStandard($requeteB, array(':id' => $reponseA[0]['Id_Utilisateurs']));
    foreach ($reponseB as $ligneCode){
        echo "<tr>";
        echo "<td>".$reponseA[0]['Username']."</td>";
        echo "<td>".$ligneCode['Code']."</td>";
        echo "</tr>";
    }
}
