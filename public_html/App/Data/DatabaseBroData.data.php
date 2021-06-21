<?php

namespace App\Data;

use PDO;

 require_once 'CoreData.data.php';

class DatabaseBroData {
    private static $host   = DATABASE_HOST;
    private static $dbName = DATABASE_NAME;
    private static $username = DATABASE_USERNAME;
    private static $password = DATABASE_PASSWORD;
   

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
