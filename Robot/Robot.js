class Robot extends HTMLElement {


    constructor() {
        super();
        this.x = 0;
        this.y = 0;
    }

    connectedCallback() {
        this.style.position = "absolute";
        this.style.left = "0px";
        this.style.top = "0px";
        this.innerHTML = `<img src="Sprites/Robot_right.png" alt="loader" class="loader">`;
    }

    static get observedAttributes() {
        return ['src'];
    }

    // attributeChangedCallback(name, oldValue, newValue) (je sais pas encore si je m'en servirais)

    moveRight() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_right2.png');
        this.x += 10;
        this.style.left = this.x + 'px';
    }

    moveLeft() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_left.png');
        this.x -= 10;
        this.style.left = this.x + 'px';
    }

    moveUp() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_up.png');
        this.y -= 10;
        this.style.top = this.y + 'px';
    }

    moveDown() {
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