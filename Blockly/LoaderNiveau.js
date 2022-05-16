class LoaderNiveau extends HTMLElement {
    constructor() {
        super();
        // element created
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

    disconnectedCallback() {
        // browser calls this method when the element is removed from the document
        // (can be called many times if an element is repeatedly added/removed)
    }

    static get observedAttributes() {
        return ['src'];
    }

    attributeChangedCallback(name, oldValue, newValue) {
        this.connectedCallback();
    }

    adoptedCallback() {
        // called when the element is moved to a new document
        // (happens in document.adoptNode, very rarely used)
    }

    // there can be other element methods and properties
}
customElements.define("loader-niveau", LoaderNiveau);