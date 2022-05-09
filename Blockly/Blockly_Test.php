<?php
require_once ("../Testing/TestVerif.php");
?>
<!DOCTYPE html>
<script src="../node_modules/blockly/blockly_compressed.js"></script>
<script src="../node_modules/blockly/blocks_compressed.js"></script>
<script src="../node_modules/blockly/msg/fr.js"></script>
<script src="../node_modules/blockly/php_compressed.js"></script>
<script src="../node_modules/blockly/javascript_compressed.js"></script>
<script src="../require.js"></script>
<script src="../Testing/TestVerif.js"></script>
<!--React-->
<script src="https://unpkg.com/react@16/umd/react.development.js"></script>
<script src="https://unpkg.com/react-dom@16/umd/react-dom.development.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/babel-standalone/6.26.0/babel.js"></script>
<script>
    //Récupération dnpmes tests dans la base de données
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
<script  id = "niveauTexte" type="text/babel" src="Enonce.js">
    //Permet d'avoir le texte dans un fichier différent, mais pas révolutionnaire pour le moment
</script>
<div id="blocklyDiv" style="height: 480px; width: 600px;"></div>
<script>
    function renderBlockly (toolboxPath) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', toolboxPath);
        xhr.setRequestHeader('Content-Type', 'text/xml');
        xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseXML);
            if (workspace != null){
                //Update de la toolbox pour passer au niveau suivant
                workspace.updateToolbox(xhr.responseXML.activeElement);
                workspace.clear();
            }
            else {
                //Premier lancement de Blockly
                workspace = Blockly.inject('blocklyDiv', {toolbox : xhr.responseXML.activeElement});
            }
        }
    };
        xhr.send();
        // return xhr.onreadystatechange;
    }
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


