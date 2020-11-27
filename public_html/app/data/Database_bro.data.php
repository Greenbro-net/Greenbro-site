<?php


// define("DATABASE_HOST", "hosting26.ukrnames.com");
// define("DATABASE_USERNAME", "green64_one");
// define("DATABASE_PASSWORD", "123456");
// define("DATABASE_NAME", "green64_bro");


class Database_bro {
    private static $host   = "greenbro.net";
    private static $dbName = "green64_bro";
    private static $username = "green64_one";
    private static $password = "123456";

    protected static function connect() {
        $pdo = new PDO("mysql:host=".self::$host.";dbname=".self::$dbName.";charset=utf8", self::$username, self::$password);
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC);


        return $pdo;
    }
    protected static function query($query, $params = array()) {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetchAll();
            return $data;
        }
    }
    
}