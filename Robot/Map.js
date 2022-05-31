class Map {
    constructor (mapEncode, robotStartX, robotStartY) {
        this.map = [[]];
        this.map = mapEncode;
        this.robotX = robotStartX;
        this.robotY = robotStartY;
    }
    checkCase(x, y) {
        //On inverse vu que y c'est ordonnée et x c'est abscisse
        return this.map[y][x] === "1" || this.map[y][x] === "2"; //2 étant l'arrivée
    }
    render () {
        //render a 2D table of the map (1 = chemin, 0 = nope)
        let table = document.createElement("table");
        table.setAttribute("id", "map");
        for (let y = 0; y < this.map.length; y++) {
            let line = document.createElement("tr");
            for (let x = 0; x < this.map[y].length; x++) {
                let cell = document.createElement("td");
                if (this.map[y][x] == 2) {
                    cell.setAttribute("class", "case goal");
                }
                else if (this.map[y][x] == 1) {
                    cell.setAttribute("class", "case chemin");
                } else {
                    cell.setAttribute("class", "case mur");
                }
                line.appendChild(cell);
            }
            table.appendChild(line);
        }
        let toAppend = document.getElementById("mapContainer");
        toAppend.appendChild(table);
    }
    checkGoal(x, y) {
        return this.map[y][x] === "2";
    }
}