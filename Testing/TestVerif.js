var verifJS = function(nbTests) {
    var code = Blockly.JavaScript.workspaceToCode(workspace);
    document.getElementById('envoiCode').value = code;
    function algoUser(x) {
        eval(code);
        return x;
    }
    let i = 0;
    console.log(nbTests);
    for(i; i < nbTests; i++) {
        let x = entrees[i];
        let y = algoUser(x);
        if(y != sorties[i]) {
            alert("Erreur : " + y + " ne correspond pas au résultat attendu : " + sorties[i]);
        }
        else {
            alert("Bravo, vous avez réussi le test n°" + (i+1));
        }
    }
    //alert(code);
};