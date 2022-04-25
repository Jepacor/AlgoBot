<?php
require("Config/DBConfig.php");
class MyPDO
{
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