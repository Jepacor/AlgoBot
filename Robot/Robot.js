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
    }

    connectedCallback() {
        this.style.position = "absolute";
        this.x = this.getAttribute("x");
        this.y = this.getAttribute("y");
        this.xorigin = this.x;
        this.yorigin = this.y;
        this.style.left = this.x + "px";
        this.style.top = this.y + "px";
        this.style.transition = "left 1s ease-in-out, top 1s ease-in-out";
        this.innerHTML = `<div class="bubble bubble-bottom-left">Hello ! </div>
                    <img src="Sprites/Robot_right.png" alt="loader" class="loader">`;
        this.img = this.querySelector("img");
        this.textbox = this.querySelector(".Textbox");
        this.textbox.style.backgroundColor = "rgba(65,65,65,0.47)";
        this.text = this.getAttribute("text");
    }

    static get observedAttributes() {
        return ['x', 'y', 'direction','text'];
    }
    update() {
        switch (this.direction){
            case "N":
                this.img.setAttribute('src', 'Sprites/Robot_up.png');
                break;
            case "E":
                this.img.setAttribute('src', 'Sprites/Robot_right2.png');
                break;
            case "S":
                this.img.setAttribute('src', 'Sprites/Robot_down.png');
                break;
            case "W":
                this.img.setAttribute('src', 'Sprites/Robot_left.png');
                break;
        }
        this.style.left = this.x + "px";
        this.style.top = this.y + "px";
        this.textbox.innerHTML = this.text;
    }

    attributeChangedCallback(name, oldValue, newValue) {
        this.direction = this.getAttribute("direction");
        this.x = this.getAttribute('x');
        this.y = this.getAttribute('y');
        this.update();
    }
    resetRobot() {
        this.resetPosition();
        this.commands = [];
    }
    resetPosition() {
        this.img.setAttribute('src', 'Sprites/Robot_right.png');
        this.x = this.xorigin;
        this.y = this.yorigin;
        this.style.left = this.x + 'px';
        this.style.top = this.y + 'px';
        this.currentCommand = 0;
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
    undo () {
        if (this.currentCommand > 1 && this.currentCommand <= this.commands.length) {
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
        }, 1000);
    }

}
customElements.define("sprite-robot", Robot);