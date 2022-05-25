Blockly.JavaScript['check_gauche'] = function(block) {
  var dropdown_direction = block.getFieldValue('Direction');
  var value_check___gauche = Blockly.JavaScript.valueToCode(block, 'Check à gauche', Blockly.JavaScript.ORDER_ATOMIC);
  // TODO: Assemble JavaScript into code variable.
  var code = '...';
  // TODO: Change ORDER_NONE to the correct strength.
  return [code, Blockly.JavaScript.ORDER_NONE];
};

Blockly.JavaScript['turn'] = function(block) {
  var dropdown_direction = block.getFieldValue('Direction');
  var value_tourner____ = Blockly.JavaScript.valueToCode(block, 'Tourner à :', Blockly.JavaScript.ORDER_ATOMIC);
  // TODO: Assemble JavaScript into code variable.
  var code = '...;\n';
  return code;
};

Blockly.JavaScript['avancer'] = function(block) {
  // TODO: Assemble JavaScript into code variable.
  var code = '...;\n';
  return code;
};