<?php
require("Config/DBConfig.php");
class MyPDO
{
    //Tiens, c'est un singleton :O : https://fr.wikipedia.org/wiki/Singleton_(patron_de_conception)
    private static $instance;

    public static function getInstance() : PDO
    {
        if (self::$instance==null) {
            $instance = new PDO ("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_LOGIN, DB_PASSWORD);
            return $instance;
        }
        else{
            return self::$instance;
        }
    }
}