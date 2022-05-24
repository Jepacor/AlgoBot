class Robot extends HTMLElement {


    constructor() {
        super();
        this.x = 0;
        this.y = 0;
        this.xorigin = 0;
        this.yorigin = 0;
        this.direction = "E";
        this.commands = [];
        this.currentCommand = 0;
        this.text = "";
        this.textorigin = "";
        this.checkpoints = [];
        this.anim = "left 0.5s linear, top 0.5s linear";
    }

    connectedCallback() {
        this.style.position = "absolute";
        this.x = this.getAttribute("x");
        this.y = this.getAttribute("y");
        this.text = this.getAttribute("text");
        this.textorigin = this.text;
        this.xorigin = this.x;
        this.yorigin = this.y;
        this.style.left = this.x + "px";
        this.style.top = this.y + "px";
        this.style.transition = this.anim;
        this.innerHTML = `<div class="bubble bubble-bottom-left">${this.text}</div>
                    <img src="../Robot/Sprites/Robot_right.png" alt="loader" class="loader">`;
        this.img = this.querySelector("img");
        this.textbox = this.querySelector(".bubble");
    }

    static get observedAttributes() {
        return ['x', 'y', 'direction','text'];
    }
    update() {
        switch (this.direction){
            case "N":
                this.img.setAttribute('src', '../Robot/Sprites/Robot_up.png');
                break;
            case "E":
                this.img.setAttribute('src', '../Robot/Sprites/Robot_right2.png');
                break;
            case "S":
                this.img.setAttribute('src', '../Robot/Sprites/Robot_down.png');
                break;
            case "W":
                this.img.setAttribute('src', '../Robot/Sprites/Robot_left.png');
                break;
        }
        this.style.left = this.x + "px";
        this.style.top = this.y + "px";
        this.textbox.innerHTML = this.text;
    }

    attributeChangedCallback(name, oldValue, newValue) {
        //Attention à rajouter l'appel quand on rajoute un attribut
        this.direction = this.getAttribute("direction");
        this.x = this.getAttribute('x');
        this.y = this.getAttribute('y');
        this.text = this.getAttribute('text');
        this.update();
    }
    resetRobot() {
        this.resetPosition();
        this.commands = [];
    }
    resetPosition() {
        this.setAttribute("x",this.xorigin);
        this.setAttribute("y",this.yorigin);
        this.setAttribute("direction","E");
        this.setAttribute("text",this.textorigin);
        this.img.setAttribute('src', '../Robot/Sprites/Robot_right.png');
        this.currentCommand = 0;
        this.update();
    }
    push (command) {
        this.commands.push(command);
    }
    execute () {
        if (this.commands.length > 0 && this.currentCommand < this.commands.length) {
            let command = this.commands[this.currentCommand];
            command.execute(this);
            this.currentCommand++;
        }
    }
    pushExecute (command) {
        this.push(command);
        this.execute();
    }

    undo () {
        if (this.currentCommand > 0 && this.currentCommand <= this.commands.length) {
            this.commands[this.currentCommand - 1].undo(this);
            this.currentCommand--;
        }
    }
    playAll () {
        let interval = setInterval(() => {
            this.execute();
            if (this.currentCommand >= this.commands.length) {
                clearInterval(interval);
            }
        }, 500);
    }
    addCheckpoint () {
        this.checkpoints.push(this.currentCommand);
    }

    goToCheckpoint (numCheckpoint) {
        if (this.checkpoints.length == 0 || this.checkpoints.length < numCheckpoint){
            return;
        } else {
            this.style.transition = "";
            this.resetPosition();
            while (this.currentCommand < this.checkpoints[numCheckpoint]) {
                this.execute();
            }
            this.style.transition = this.anim;
        }
    }

    removeCheckpoint (numCheckpoint) {
        this.checkpoints.splice(numCheckpoint, 1);
    }

    associateMap(map) {
        this.map = map;
    }


}
customElements.define("sprite-robot", Robot);