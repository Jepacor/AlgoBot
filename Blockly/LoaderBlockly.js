function renderBlockly (toolboxPath, nbBlocks) {
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
                workspace = Blockly.inject('blocklyDiv', {maxBlocks: nbBlocks, trashcan: true, toolbox : xhr.responseXML.activeElement});
                function onchange(event) {
                    document.getElementById('capacity').textContent =
                        workspace.remainingCapacity();
                }
                workspace.addChangeListener(onchange);
                onchange();
            }
        }
    };
    xhr.send();
    // return xhr.onreadystatechange;
}