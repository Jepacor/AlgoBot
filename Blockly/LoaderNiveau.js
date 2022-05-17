class LoaderNiveau extends HTMLElement {
    constructor() {
        super();
    }

    connectedCallback() {
        // browser calls this method when the element is added to the document
        // (can be called many times if an element is repeatedly added/removed)
        var elem = this;
        var src = this.getAttribute('src');
        var envoi = new XMLHttpRequest();
        envoi.onreadystatechange = function() {
            if(envoi.readyState == 4 && envoi.status == 200) {
                console.log(envoi.responseText);
                elem.innerHTML = envoi.responseText;
            }
            else {
                console.log("Load échoué");
            }
        }
        envoi.open("GET", src);
        envoi.send();
    }


    static get observedAttributes() {
        return ['src'];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        this.connectedCallback();
    }

}
customElements.define("loader-niveau", LoaderNiveau);