var verifOneRobot = function(idTest, algoUser) {
    robot.push(new Text("Entrée : " + entrees[idTest]));
    let x = entrees[idTest];
    let y = algoUser(x);
    robot.push(new Text("Comparaison : résultat donné : " + y + "; résultat attendu : " + sorties[idTest]));
    if(y != sorties[idTest]) {
        alert("Erreur : " + y + " ne correspond pas au résultat attendu : " + sorties[idTest]);
        robot.push(new Text("Résultat : " + "Faux"));
        return false;
    }
    else {
        alert("Bravo, vous avez réussi le test n°" + (parseInt(idTest)+1));
        robot.push(new Text("Résultat : " + "Vrai"));
        return true;
    }
}



var verifJS = function(nbTests) {
    var code = Blockly.JavaScript.workspaceToCode(workspace);
    document.getElementById('envoiCode').value = code;
    function algoUser(x) {
        eval(code);
        return x;
    }
    let i = 0;
    console.log(nbTests);
    let result = true;
    for(i; i < nbTests; i++) {
        // let x = entrees[i];
        // let y = algoUser(x);
        // if(y != sorties[i]) {
        //     alert("Erreur : " + y + " ne correspond pas au résultat attendu : " + sorties[i]);
        //     result = false;
        // }
        // else {
        //     alert("Bravo, vous avez réussi le test n°" + (i+1));
        // }
        let resultOne = verifOneRobot(i, algoUser);
        if(!resultOne) {
            result = false;
        }

    }
    if(result == false) {

    }

    else {
        //envoi du code au serveur via AJAX
        var envoi = new XMLHttpRequest();
        envoi.onreadystatechange = function() {
            if(envoi.readyState == 4 && envoi.status == 200) {
                console.log("Envoi réussi");
            }
            else {
                console.log("Erreur d'envoi");
                console.log(envoi.responseText);
            }
        }
        var donnees = new FormData();
        donnees.append("code", code);
        donnees.append("niveau",1);
        envoi.open("POST", "writeCode.php");
        envoi.send(donnees);
        //Niveau suivant !
        console.log("Niveau suivant");
        let texteIntro = document.getElementById("test");
        texteIntro.setAttribute("src","TexteFizzbuzz.html")
        renderBlockly('../Blockly/toolboxFizzbuzz.xml');
    }
    //alert(code);
};