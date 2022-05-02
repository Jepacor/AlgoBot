//import * as mysql from '../node_modules/mysql2/index.js';

function connectDBMySQL(){
    const mysql = require(['../node_modules/mysql/index'], function (mysql2) {
        console.log("mysql chargé");
    });
    //const mysql = require('mysql2');
    const connection = mysql.createConnection({
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
    let connection = connectDBMySQL();
    let requete = "SELECT Sortie FROM Sorties WHERE Id_Resultats = ?";
    connection.execute(requete,id_result,function(err,results,fields){
        console.log(results);
        console.log(fields);
    });
    let sortie = results[0];
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