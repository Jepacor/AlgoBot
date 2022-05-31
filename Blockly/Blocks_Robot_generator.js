Blockly.JavaScript['check_gauche'] = function(block) {
  var dropdown_direction = block.getFieldValue('Direction');
  var value_check___gauche = Blockly.JavaScript.valueToCode(block, 'Check à gauche', Blockly.JavaScript.ORDER_ATOMIC);
  if (dropdown_direction == "L") {
        var code = 'robot.pushExecute(new Check("L"));\n';
  }
    else {
        var code = 'robot.pushExecute(new Check("R"));\n';
  }
  return [code, Blockly.JavaScript.ORDER_NONE];
};

Blockly.JavaScript['turn'] = function(block) {
  var dropdown_direction = block.getFieldValue('Direction');
  var value_tourner____ = Blockly.JavaScript.valueToCode(block, 'Tourner à :', Blockly.JavaScript.ORDER_ATOMIC);
  var code;
  if (dropdown_direction == "L") {
     code = 'robot.pushExecute(new Turn("L"));\n';
  }
    else {
     code = 'robot.pushExecute(new Turn("R"));\n';
  }
  return code;
};

Blockly.JavaScript['avancer'] = function(block) {
  var code = 'robot.pushExecute(new Move("F",30));\n';
  return code;
};