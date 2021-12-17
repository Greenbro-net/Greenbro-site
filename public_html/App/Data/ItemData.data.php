<?php


namespace App\Data;


use App\Data\DBControllerData;
use PDO;
use PDOException;


class ItemData extends DBControllerData
{
    // the method below update item in products table 
    public function updateProductsTable($query, $params)
    { 
        try {
            $sql_statement = self::connect()->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_insert = $this->setSqlStatements($sql_statement, $params)->execute();
            
            if (empty($result_insert)) {
                throw new PDOException("Method updateProductsTable was not success!");
            } else {
                return $result_insert;
            }
        }  catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }   
    }

}