class Robot extends HTMLElement {


    constructor() {
        super();
        this.x = 0;
        this.y = 0;
        this.direction = "E";
    }

    connectedCallback() {
        this.style.position = "absolute";
        this.style.left = "0px";
        this.style.top = "0px";
        this.innerHTML = `<img src="Sprites/Robot_right.png" alt="loader" class="loader">`;
    }

    static get observedAttributes() {
        return ['x', 'y', 'direction'];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        switch (this.direction){
            case "N":
                this.firstChild.setAttribute('src', 'Sprites/Robot_up.png');
                break;
            case "E":
                this.firstChild.setAttribute('src', 'Sprites/Robot_right2.png');
                break;
            case "S":
                this.firstChild.setAttribute('src', 'Sprites/Robot_down.png');
                break;
            case "W":
                this.firstChild.setAttribute('src', 'Sprites/Robot_left.png');
                break;
        }
        this.x = this.getAttribute('x');
        this.y = this.getAttribute('y');

    }

    moveRight() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_right2.png');
        this.x += 10;
        this.style.left = this.x + 'px';
    }

    moveLeft(undo = false) {
        this.firstChild.setAttribute('src', 'Sprites/Robot_left.png');
        this.x -= 10;
        this.style.left = this.x + 'px';
    }

    moveUp(undo = false) {
        this.firstChild.setAttribute('src', 'Sprites/Robot_up.png');
        this.y -= 10;
        this.style.top = this.y + 'px';
    }

    moveDown(undo = false) {

        this.firstChild.setAttribute('src', 'Sprites/Robot_down.png');
        this.y += 10;
        this.style.top = this.y + 'px';
    }
    resetRobot() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_right.png');
        this.x = 0;
        this.y = 0;
        this.style.left = this.x + 'px';
        this.style.top = this.y + 'px';
    }
}
customElements.define("sprite-robot", Robot);