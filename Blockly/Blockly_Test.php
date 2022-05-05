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
</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Blockly</title>
</head>
<body>
<div id ="root"></div>
<script type="text/babel" src="TestTexte.js">
    //Permet d'avoir le texte dans un fichier différent, mais pas révolutionnaire pour le moment
</script>
<!--<h1>Premiers pas</h1>-->
<!--<p>L'objectif est de réaliser une opération de multiplication basique sur x : <b>On veut que le résultat final soit x*2.</b><br></p>-->
<!--<p>x peut être n'importe quelle valeur, comme en maths ! Il s'agit de créer une suite d'instructions qui marchera quelque soit x.</p>-->
<div id="blocklyDiv" style="height: 480px; width: 600px;"></div>
<script type="text/babel" src="toolbox.js"></script>
<script>
    var run = function() {
        var code = Blockly.PHP.workspaceToCode(workspace);
        document.getElementById('envoiCode').value = code;
        alert(code);
    };
</script>
<script>
    var workspace = Blockly.inject('blocklyDiv', {toolbox: toolbox});
</script>
<button type="button" onclick="verifJS(nbTests)">Vérification en JS !</button>
<form action="./Resultat.php" method="post">
    <input type="hidden" name="code" id="envoiCode" value="">
    <input type="submit" onclick="run()" value="Vérifier en PHP !">
</form>
</body>
</html>