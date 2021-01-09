<?php
require_once 'DBinfo.data.php';

class Database {
    private static $host   = DATABASE_HOST;
    private static $dbName = DATABASE_NAME1;
    private static $username = DATABASE_USERNAME;
    private static $password = DATABASE_PASSWORD;
    // the property below for load_model method 
    protected $model;

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

    // the method bellow allows load model in other model and create object of the model class 
    protected function load_model($loadModelName, $data=[])
    {
         if (file_exists(MODEL . $loadModelName . '.model.php')) {
              require_once MODEL . $loadModelName . '.model.php';
              return $this->model = new $loadModelName;
          }
    }
    
}

