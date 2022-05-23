function cleanCode(code) {
    var codeSplit = code.split("\n");
    //remove 4 first lines qui déclare la variable + retours à la ligne
    codeSplit.splice(0, 3);
    //recréer la chaîne de caractère
    code = codeSplit.join("\n");
    return code;
}


var CodeToRobot = function (nbTests) {
    var code = Blockly.JavaScript.workspaceToCode(workspace);
    code = cleanCode(code);
    var codeSplit = code.split("\n");
    codeSplit.forEach(element => {
        robot.push(new Text(element));
    });
    verifJS(nbTests);
}