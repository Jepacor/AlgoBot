
function connectDBMySQL(){
    var mysql = require('mysql2');
    var connection = mysql.createConnection({
        host: 'localhost',
        user: 'root',
        password: 'root',
        database: 'Tests_Algo'
    });
    connection.connect();
    return connection;
}


function verif(id_result, result_donne)
{
    var connection = connectDBMySQL();
    var requete = "SELECT Sortie FROM Sorties WHERE Id_Resultats = " + id_result;
    var rep = connection.execute(requete);
    var sortie = result[0];
    console.log("résultat donné : " + result_donne);
    console.log("résultat attendu : " + sortie);
    if(sortie == result_donne)
        {
            console.log("Sortie correcte");
            return true;
        }
    else
        {
            console.log("Sortie incorrecte");
            return false;
        }
}