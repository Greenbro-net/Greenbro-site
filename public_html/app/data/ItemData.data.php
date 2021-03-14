<?php

// TO DO a function which can substitute long if block below!!!!
class ItemData extends DBController
{
    // the method below update item in product table TO DO!!!
    public function updateProductsTable($query, $params)
    { 
        try {
        $sql_statement = self::connect()->prepare($query);
        // this block of code for updating quantity of paremeters which we should post in execute
        $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_STR);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
        }
        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_STR);
        }
        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_STR);
        }
        if (!empty($params[4]["param_value"])) {
            $sql_statement->bindParam(5, $params[4]["param_value"], PDO::PARAM_STR);
        }
        if (!empty($params[5]["param_value"])) {
            $sql_statement->bindParam(6, $params[5]["param_value"], PDO::PARAM_STR);
        }
        if (!empty($params[6]["param_value"])) {
            $sql_statement->bindParam(7, $params[6]["param_value"], PDO::PARAM_INT);
        }
        if (!empty($params[7]["param_value"])) {
            $sql_statement->bindParam(8, $params[7]["param_value"], PDO::PARAM_INT);
        }
        if (!empty($params[8]["param_value"])) {
            $sql_statement->bindParam(9, $params[8]["param_value"], PDO::PARAM_INT);
        }
        if (!empty($params[9]["param_value"])) {
            $sql_statement->bindParam(10, $params[9]["param_value"], PDO::PARAM_STR);
        }
        if (!empty($params[10]["param_value"])) {
            $sql_statement->bindParam(11, $params[10]["param_value"], PDO::PARAM_INT);
        }

        

        $result_insert = $sql_statement->execute();
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