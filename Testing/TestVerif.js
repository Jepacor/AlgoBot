var tests, entrees, sorties, nbTests;
function loadTests(niveau) {
    var envoi;
    envoi = new XMLHttpRequest();
    envoi.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            tests = this.responseText;
            entrees = tests.entrees;
            sorties = tests.sorties;
            nbTests = Object.keys(entrees).length;
        }
    };
    var donnees = new FormData();
    donnees.append("niveau",niveau);
    envoi.open("POST", "getNiveau.php", true);
    envoi.send();
}

function verifJS(nbTests) {
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
        let x = entrees[i];
        let y = algoUser(x);
        if(y != sorties[i]) {
            alert("Erreur : " + y + " ne correspond pas au résultat attendu : " + sorties[i]);
            result = false;
        }
        else {
            alert("Bravo, vous avez réussi le test n°" + (i+1));
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
        let texteIntro = document.getElementById("niveauTexte");
        texteIntro.src = "TexteFizzbuzz.js";
        ReactDOM.render(intro, document.getElementById('root'));
        renderBlockly('../Blockly/toolboxFizzbuzz.xml');
    }
    //alert(code);
}

