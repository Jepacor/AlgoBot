class Robot extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        this.innerHTML = `<img src="Sprites/Robot_right.png" alt="loader" class="loader" style="position : absolute; left: 0px;top:0px">`;
    }

    static get observedAttributes() {
        return ['src'];
    }

    // attributeChangedCallback(name, oldValue, newValue) (je sais pas encore si je m'en servirais)

    moveRight() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_right2.png');
        this.firstChild.style.left = this.firstChild.style.left + 10 + 'px';
    }

    moveLeft() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_left.png');
        this.firstChild.style.left = this.firstChild.style.left - 10 + 'px';
    }

    moveUp() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_up.png');
        this.firstChild.style.top = this.firstChild.style.top - 10 + 'px';
    }

    moveDown() {
        this.firstChild.setAttribute('src', 'Sprites/Robot_up.png');
        this.firstChild.style.top = this.firstChild.style.top + 10 + 'px';
    }
}
customElements.define("sprite-robot", Robot);