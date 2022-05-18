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
        switch (this.direction) {
            case "N":
                robot.setAttribute("y",robot.y += this.distance);
                break;
            case "S":
                robot.setAttribute("y",robot.y -= this.distance);
                break;
            case "E":
                robot.setAttribute("x",robot.x += this.distance);
                break;
            case "W":
                robot.setAttribute("x",robot.x -= this.distance);
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