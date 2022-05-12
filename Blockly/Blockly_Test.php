<!--<script>-->
<!--//     import * as Blockly from 'blockly/core';-->
<!--// import 'blockly/blocks';-->
<!--// import 'blockly/php';-->
<!--// import * as Fr from 'blockly/msg/fr'; possible TODO utiliser ces imports-->
<?php
require_once ("../Testing/TestVerif.php");
?>
<!DOCTYPE html>
<script src="../node_modules/blockly/blockly_compressed.js"></script>
<script src="../node_modules/blockly/blocks_compressed.js"></script>
<script src="../node_modules/blockly/msg/fr.js"></script>
<script src="../node_modules/blockly/php_compressed.js"></script>
<script src="../node_modules/blockly/javascript_compressed.js"></script>
<!--<script src="../Testing/require.js"></script>-->
<script src="../Testing/TestVerif.js"></script>
<script src="../Blockly/LoaderBlockly.js"></script>
<!--React-->
<script src="https://unpkg.com/react@16/umd/react.development.js"></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.js"></script>
<script>
    //Récupération des tests dans la base de données

    const tests = <?php  TestVerif::getTestsNiveau(1); ?>;
    const entrees = tests.entrees;
    const sorties = tests.sorties;
    const nbTests = Object.keys(entrees).length;
    function login() {
       document.getElementById("Login").style.visibility = "visible";
    }
    function inscription() {
        document.getElementById("Inscription").style.visibility = "visible";
    }
</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Blockly</title>
</head>
<body>
<div id="barre_login">
    <button id="login_button" onclick="login()">Se connecter</button>
    <button id="register_button" onclick="inscription()">S'inscrire</button>
</div>
<div id="formulaires">
<!--    <object id="Inscription" type="text/html"  data="../Auth/Register.html"-->
<!--    width="10%"-->
<!--    height="10%">-->
<!--    <object id="Login" type="text/html"  data="../Auth/LogForm.php"-->
<!--            width="10%"-->
<!--            height="10%">-->
    <iframe src="../Auth/Register.html" id="Inscription" style="visibility: hidden"></iframe>
    <iframe src="../Auth/LogForm.php" id="Login" style="visibility: hidden"></iframe>

</div>
<div id ="root"></div>
<script  id = "niveauTexte" type="text/babel" src="TestTexte.js">
    //Permet d'avoir le texte dans un fichier différent, mais pas révolutionnaire pour le moment
</script>
<div id="blocklyDiv" style="height: 480px; width: 600px;"></div>
<script>
    var run = function() {
        var code = Blockly.PHP.workspaceToCode(workspace);
        document.getElementById('envoiCode').value = code;
        alert(code);
    };
    var workspace;
    renderBlockly('toolbox.xml');
</script>
<button type="button" onclick="verifJS(nbTests)">Vérification en JS !</button>
<form action="./Resultat.php" method="post">
    <input type="hidden" name="code" id="envoiCode" value="">
    <input type="submit" onclick="run()" value="Vérifier en PHP !">
</form>
</body>
</html>


