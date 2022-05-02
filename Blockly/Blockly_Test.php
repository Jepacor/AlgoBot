<!--<script>-->
<!--//     import * as Blockly from 'blockly/core';-->
<!--// import 'blockly/blocks';-->
<!--// import 'blockly/php';-->
<!--// import * as Fr from 'blockly/msg/fr';-->
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
<!--<script src="../Testing/TestVerif.js"></script>-->
<script>
    //     function sleep(milliseconds) {
    //     const date = Date.now();
    //     let currentDate = null;
    //     do {
    //     currentDate = Date.now();
    // } while (currentDate - date < milliseconds);
    // }
    //     sleep(50);
    // Pas forcément nécéssaire ? C'était pour éviter que Blockly se charge avant
</script>
<script>
    //Récupération des tests dans la base de données
    const tests = <?php  TestVerif::getTestsNiveau(1); ?>;
    const entrees = tests.entrees;
    const sorties = tests.sorties;
</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Blockly</title>
</head>
<body>
<h1>Premiers pas</h1>
<p>L'objectif est de réaliser une opération de multiplication basique sur x : <b>On veut que le résultat final soit x*2.</b><br></p>
<p>x peut être n'importe quelle valeur, comme en maths ! Il s'agit de créer une suite d'instructions qui marchera quelque soit x.</p>
<div id="blocklyDiv" style="height: 480px; width: 600px;"></div>
<xml xmlns="https://developers.google.com/blockly/xml" id="toolbox" style="display: none">
    <block type="variables_get">
        <field name="VAR" id="-AK(qZPO0-8:eJY`u2df">x</field>
    </block>
    <block type="variables_set">
        <field name="VAR" id="-AK(qZPO0-8:eJY`u2df">x</field>
    </block>
    <block type="math_arithmetic">
        <field name="OP">MULTIPLY</field>
        <value name="A">
            <shadow type="math_number">
                <field name="NUM">1</field>
            </shadow>
        </value>
        <value name="B">
            <shadow type="math_number">
                <field name="NUM">1</field>
            </shadow>
        </value>
    </block>
</xml>
<script>
    var run = function() {
        var code = Blockly.PHP.workspaceToCode(workspace);
        document.getElementById('envoiCode').value = code;
        alert(code);
    };
    var verifJS = function() {
        var code = Blockly.JavaScript.workspaceToCode(workspace);
        document.getElementById('envoiCode').value = code;
        function algoUser(x) {
            eval(code);
            return x;
        }
        let i = 0;
        let max = 2; // TODO : Trouver comment définir dynamiquement max
        console.log(max);
        for(i; i < max; i++) {
            let x = entrees[i];
            let y = algoUser(x);
            if(y != sorties[i]) {
                alert("Erreur : " + y + " ne correspond pas au résultat attendu : " + sorties[i]);
            }
            else {
                alert("Bravo, vous avez réussi le test n°" + i+1);
            }
        }
        // entrees.forEach((entree) => {
        //     let resultat = algoUser(entree[i]);
        //     if (resultat == sorties[i]) {
        //         alert("Bravo, vous avez réussi le test n°" + i);
        //     } else {
        //         alert("Désolé, vous n'avez pas réussi le test n°" + i);
        //     }
        //     i++;
        // });
        // let x = 2;
        // let resultat = algoUser(x);
        // let result1 = verif(1,resultat)
        // x = 8;
        // resultat = algoUser(x);
        // let result2 = verif(2,resultat)
        // if (result1 && result2) {
        //     alert("Bravo, vous avez réussi !");
        // } else {
        //     alert("Désolé, vous n'avez pas réussi !");
        // }
        alert(code);
    };
</script>
<script>
    var workspace = Blockly.inject('blocklyDiv', {toolbox: document.getElementById('toolbox')});
</script>
<button type="button" onclick="verifJS()">Vérification en JS !</button>
<form action="./Resultat.php" method="post">
    <input type="hidden" name="code" id="envoiCode" value="">
    <input type="submit" onclick="run()" value="Vérifier en PHP !">
</form>
</body>
</html>