<?php


namespace App\Data;


use PDO;
use Config\Configuration;


class DatabaseBroData 
{
    protected static function connect() 
    {
        $pdo = new PDO("mysql:host=".Configuration::get_host().";dbname=".Configuration::get_db_name_bro().";charset=utf8", 
            Configuration::get_username(), Configuration::get_password());
        $pdo->setAttribute(PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC);
        return $pdo;
    }
    
    
    protected static function query($query, $params = array()) 
    {
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        if (explode(' ', $query)[0] == 'SELECT') {
            $data = $statement->fetchAll();
            return $data;
        }
    }

} 
