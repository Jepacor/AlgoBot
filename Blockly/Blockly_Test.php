<?php
require_once ("../Testing/TestVerif.php");
?>
<!DOCTYPE html>
<!-- Blockly: https://developers.google.com/blockly/ -->
<script src="../node_modules/blockly/blockly_compressed.js"></script>
<script src="../node_modules/blockly/blocks_compressed.js"></script>
<script src="../node_modules/blockly/msg/fr.js"></script>
<script src="../node_modules/blockly/php_compressed.js"></script>
<script src="../node_modules/blockly/javascript_compressed.js"></script>
<!--Blocks custom pour le déplacement du robot-->
<script src="Blocks_Robot_generator.js"></script>
<script src="Blocks_Robot.json"></script>

<!-- Mes scripts -->
<script src="../Testing/TestVerif.js"></script>
<script src="LoaderBlockly.js"></script>
<script src="LoaderNiveau.js"></script>

<link rel="stylesheet" href="PageNiveau.css">

<!--Robot-->
<link rel="stylesheet" href="../Robot/bubble.css">
<script src="../Robot/Robot.js"></script>
<script src="../Robot/CodeToRobot.js"></script>
<script src="../Robot/Actions.js"></script>

<script>
    //Récupération des tests dans la base de données

    const tests = <?php  TestVerif::getTestsNiveau(1); ?>;
    const entrees = tests.entrees;
    const sorties = tests.sorties;
    const nbTests = Object.keys(entrees).length;
    function login() {
       document.getElementById("Login").style.visibility = "visible";
        document.getElementById("Login").style.height = "250px";
    }
    function inscription() {
        document.getElementById("Inscription").style.visibility = "visible";
        document.getElementById("Inscription").style.height = "300px";
    }
</script>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test Blockly</title>
</head>
<body>
<div id="barre_login">
    <?php
    session_start();
    if(isset($_SESSION['username'])){
        echo "Connecté en tant que ".$_SESSION['username'];
    }
    else{
        echo "<button id='login_button' onclick='login()'>Se connecter</button>
    <button id='register_button' onclick='inscription()'>S'inscrire</button>";
    }
    ?>
</div>
<div id="formulaires">
    <iframe src="../Auth/Register.html" id="Inscription" style="visibility: hidden" height="0px"></iframe>
    <iframe src="../Auth/LogForm.php" id="Login" style="visibility: hidden" height="0px"></iframe>
</div>
<div class ="NiveauStruct">
    <div class = "TextEtLimite">
        <loader-niveau src="TestTexte.html" id="Texte"></loader-niveau>
        <p>Vous pouvez encore placer <b><span id="capacity" style="color: red"></span> blocs.</b></p>
    </div>
    <div class = "Robot">
        <sprite-robot id="robot" x="0" y="50" direction="E" text="Hello"></sprite-robot>
    </div>
    <div id="blocklyDiv" style="height: 480px; width: 600px;"></div>
</div>
<script>
    const robot = document.querySelector('#robot');
    var run = function() {
        var code = Blockly.PHP.workspaceToCode(workspace);
        document.getElementById('envoiCode').value = code;
        alert(code);
    };
    var workspace;
    renderBlockly('toolbox.xml',6);
</script>
<button type="button" onclick="CodeToRobot(nbTests)">Vérification en JS !</button>
<form action="./Resultat.php" method="post">
    <input type="hidden" name="code" id="envoiCode" value="">
    <input type="submit" onclick="run()" value="Vérifier en PHP !">
</form>
<button onclick="robot.execute()">Faire action</button>
<button onclick="robot.undo()">Annuler action</button>
<button onclick="robot.resetPosition()">Reset la position</button>
<button onclick="robot.resetRobot()">Reset complet</button>
<button onclick="robot.playAll()">Faire toute les actions</button>
</body>
</html>


