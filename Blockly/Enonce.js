// import {Component} from "react";
import {Niveau1} from "./TestTexte";
import {Niveau2} from "./TexteFizzbuzz";
// import reactDOM from "react-dom";

class Enonce extends React.Component {
    render() {
        switch (this.props.niveau) {
            case "1":
                return <Niveau1/>;
            case "2":
                return <Niveau2/>;
        }
    }
}
ReactDOM.render(<Enonce niveau="1"/>, document.getElementById("root"));