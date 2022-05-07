<?php

class Database
{
    // private properties signifie que la classe ne peut pas être instanciée
    // et static signifie que la méthode ne peut pas être appelée directement
    private static $dbHost = "localhost";
    private static $dbName = "burgercode_fini";
    private static $dbUser = "root";
    private static $dbUserPassword = "";
    private static $connection = null;
    // pour acceder a une propriete static utilisé le mot clef self
    public static function connect()
    {
        try {
            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbUserPassword);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return self::$connection;
    }
    // public signifie que la méthode peut être appelée directement avec un objet de la classe exemple $database = new Database();
    public static function disconnect()
    {
        self::$connection = null;
    }
}
// utilisé les 4 points pour acceder a une propriete static
Database::connect(); // acceder a la propriete static $connection de la fonction connect()
