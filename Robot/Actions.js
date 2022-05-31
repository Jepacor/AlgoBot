/* JS a pas vraiment de classe abstraite et un tableau de JS peut stocker des objets de plusieurs types donc techniquement
il n'y a pas besoin de la classe Action de base mais je trouve que ça rend le code plus clair i.e conforme au pattern
communément utilisé pour résoudre le problème de undo/redo : https://gameprogrammingpatterns.com/command.html
 */
class Action {
    constructor(){};
    execute(robot) {};
    undo(robot) {};
}

// On simplifie en faisant une classe pour toutes les directions
class Move extends Action {
    constructor(distance, direction) {
        super();
        this.distance = distance;
        this.direction = direction;
    }
    execute(robot) {
        console.log("move");
        this.xprev = robot.x;
        this.yprev = robot.y;
        this.directionprev = robot.direction;
        if (this.direction == "F") { // Rajout de la possibilité d'avancer dans la même direction
            this.direction = robot.direction;
        }
        let newX, newY;
        switch (this.direction) {
            case "N":
                newY = parseInt(robot.y) - parseInt(this.distance);
                robot.setAttribute("y",newY);
                robot.map.robotY = parseInt(robot.map.robotY) + parseInt(1);
                break;
            case "S":
                newY = parseInt(robot.y) + parseInt(this.distance);
                robot.setAttribute("y",newY);
                robot.map.robotY = parseInt(robot.map.robotY) - parseInt(1);
                break;
            case "E":
                newX = parseInt(robot.x) + parseInt(this.distance);
                robot.setAttribute("x",newX);
                robot.map.robotX = parseInt(robot.map.robotX) - parseInt(1);
                break;
            case "W":
                newX = parseInt(robot.x) - parseInt(this.distance);
                robot.setAttribute("x",newX);
                robot.map.robotX = parseInt(robot.map.robotX) + parseInt(1);
                break;
        }
        robot.setAttribute("direction",this.direction);
    }
    undo(robot) {
        robot.setAttribute("x",this.xprev);
        robot.setAttribute("y",this.yprev);
        robot.setAttribute("direction",this.directionprev);
    }
}

class Text extends Action{
    constructor(text) {
        super();
        this.text = text;
    }
    execute(robot) {
        console.log("text");
        this.textprev = robot.text;
        robot.setAttribute("text",this.text);
    }
    undo(robot) {
        robot.setAttribute("text",this.textprev);
    }
}

class Check extends Action {
    constructor(direction) {
        super();
        this.direction = direction;
    }
    execute(robot) {
        this.textprev = robot.text;
        let resultat;
        switch (robot.direction) {
            case "N":
                if (this.direction == "L") {
                    resultat = robot.map.checkCase(robot.map.robotX - 1, robot.map.robotY);
                } else {
                    resultat = robot.map.checkCase(robot.map.robotX + 1, robot.map.robotY);
                }
                break;
            case "S":
                if (this.direction == "L") {
                    resultat = robot.map.checkCase(robot.map.robotX + 1, robot.map.robotY);
                } else {
                    resultat = robot.map.checkCase(robot.map.robotX - 1, robot.map.robotY);
                }
                break;
            case "E":
                if (this.direction == "L") {
                    resultat = robot.map.checkCase(robot.map.robotX, robot.map.robotY + 1);
                } else {
                    resultat = robot.map.checkCase(robot.map.robotX, robot.map.robotY - 1);
                }
                break;
            case "W":
                if (this.direction == "L") {
                    resultat = robot.map.checkCase(robot.map.robotX, robot.map.robotY - 1);
                } else {
                    resultat = robot.map.checkCase(robot.map.robotX, robot.map.robotY + 1);
                }
                break;
        }
        if (resultat) {
            if (this.direction == "L") {
                robot.setAttribute("text","Case valide à gauche du robot !");
            }
            else {
                robot.setAttribute("text","Case valide à droite du robot !");
            }
            return true;
        }
        else {
            if (this.direction == "L") {
                robot.setAttribute("text","Case invalide à gauche du robot !");
            }
            else {
                robot.setAttribute("text","Case invalide à droite du robot !");
            }
            return false;
        }
    }
    undo(robot) {
        robot.setAttribute("text",this.textprev);
    }
}

class Turn extends Action {
    constructor(direction) {
        super();
        this.direction = direction;
    }
    execute(robot) {
        this.directionprev = robot.direction;
        switch (robot.direction) {
            case "N":
                if (this.direction == "L") {
                    robot.setAttribute("direction","W");
                }
                else {
                    robot.setAttribute("direction","E");
                }
                break;
            case "S":
                if (this.direction == "L") {
                    robot.setAttribute("direction","E");
                }
                else {
                    robot.setAttribute("direction","W");
                }
                break;
            case "E":
                if (this.direction == "L") {
                    robot.setAttribute("direction","N");
                }
                else {
                    robot.setAttribute("direction","S");
                }
                break;
            case "W":
                if (this.direction == "L") {
                    robot.setAttribute("direction","S");
                }
                else {
                    robot.setAttribute("direction","N");
                }

        }

    }
    undo(robot) {
        robot.setAttribute("direction",this.directionprev);
    }
}