<?php


namespace App\Data;


use App\Data\DatabaseData;
use PDO;
use PDOException;


class DBControllerData extends DatabaseData 
{
    use \App\Traits\SqlSetterTrait;


    // function which prepare and execute connection to DB
    public function getDBResult($query, $params)
    {
        try {
            $sql_statement = self::connect()->prepare($query);                            
            // this method below for updating quantity of paremeters which we should post in execute
            $result_getDBResult = $this->setSqlStatements($sql_statement, $params)->execute();                                      
            $resultset = $sql_statement->fetchAll();

            if (empty($result_getDBResult)) {
                throw new PDOException("Function getDBResult was not success");
            } else {
                return $resultset;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // testing function for   connection to DB for getProductByCode
    public function getDBforgetProductByCode($query, $params)
    {
        try {
            $sql_statement = self::connect()->prepare($query);
            
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_STR);
            $result_getDBforgetProductByCode = $sql_statement->execute();
            $resultset = $sql_statement->fetchAll();

            if (empty($result_getDBforgetProductByCode)) {
                throw new PDOException("getDBforgetProductByCode was not success!");
            } else {
                return $resultset;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    //function for  connection to DB for getCartItembyProduct
    public function getDBgetCartItembyProduct($query, $params)
    {  
        try {
            $sql_statement = self::connect()->prepare($query);
            
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_INT);
            
            $result_getDBgetCartItembyProduct = $sql_statement->execute();

            $result_cart_item = $sql_statement->fetchAll();

            if (empty($result_getDBgetCartItembyProduct)) {
                throw new PDOException("Function getDBgetCartItembyProduct wasn't success");
            } else {
                return $result_cart_item;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below update items in cart 
    public function updateDB($query, $params)
    { 
        try {
            $sql_statement = self::connect()->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_insert = $this->setSqlStatements($sql_statement, $params)->execute();
            
            if (empty($result_insert)) {
                throw new PDOException("Function updateDB was not success!");
            } else {
                return $result_insert;
            }
        }  catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }
    

    // the function below works with customers table 
    protected function updateCustomer($query, $params)
    { 
        try {
            // we separate connect() and prepare to get pdo object for method lastInsertId()
            $pdo = self::connect();
            $sql_statement = $pdo->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_insert = $this->setSqlStatements($sql_statement, $params)->execute();
            
            // the code below gets last_id from customers table after inserted new customer
            $last_customer_id = $pdo->lastInsertId();

            if (empty($result_insert)) {
                throw new PDOException("Insert query to customer table was not success!");
            } else {
                return $last_customer_id; 
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

    
    // the function below works with order table 
    protected function updateOrder($query, $params)
    {
        try {
            $pdo = self::connect();
            $sql_statement = $pdo->prepare($query);

            // this method below for updating quantity of paremeters which we should post in execute
            $result_insert_order = $this->setSqlStatements($sql_statement, $params)->execute();

            if (empty($result_insert_order)) {
                throw new PDOException("Insert query to order table was not successful!");
            } else {
                return $result_insert_order;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

    
    // the function below gets customer_id from the same customer name from customers table 
    protected function selectCustomerId($query, $params)
    { 
        try {
            $sql_statement = self::connect()->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_selectCustomerId = $this->setSqlStatements($sql_statement, $params)->execute();
            $result_customer_id = $sql_statement->fetchAll();
        
            if (empty($result_customer_id)) {
                throw new PDOException("Function selectCustomerId wasn't successful!");
            } else {
                return $result_customer_id; 
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below for select data from response table like associative array 
    protected function receiveResponseTable($query,  $params) 
    {
        try {
            $sql_statement = self::connect()->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_ResponseTable = $this->setSqlStatements($sql_statement, $params)->execute();
            
            // the parameter in the end for return only associative array data 
            $result_of_method = $sql_statement->fetchAll(PDO::FETCH_ASSOC);
    
            if (empty($result_of_method)) {
                return false; 
            } else {
                return $result_of_method;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below for insert data to response table 
    protected function updateResponseTable($query, $params)
    {
        try {
            // we separate connect() and prepare to get pdo object for method lastInsertId()
            $pdo = self::connect();
            $sql_statement = $pdo->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_ResponseTable = $this->setSqlStatements($sql_statement, $params)->execute();

            if (empty($result_ResponseTable)) {
                throw new PDOException("Method updateResponseTable doesn't return result of execution");
            }
            
            // the code below gets last_id from customers table after inserted new customer
            $last_response_id = $pdo->lastInsertId();
            
            if (empty($last_response_id)) {
                throw new PDOException("Last response id is empty");
            }
            
            if (empty($result_ResponseTable)) {
                return false; 
            } else {
                return $last_response_id;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    } 
    

    // the method below for deletion data from response table 
    protected function deleteFromResponseTable($query, $params)
    {
        try {      
            $sql_statement = self::connect()->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_deleteFromResponseTable = $this->setSqlStatements($sql_statement, $params)->execute();

            if (empty($result_deleteFromResponseTable)) {
                throw new PDOException("Method deleteFromResponseTable doesn't return result of execution");
            } else {
                return $result_deleteFromResponseTable;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    } 


    // the method below for interaction between model and table response_rating
    protected function updateResponseRatingTable($query, $params) 
    {
        try {
            $sql_statement = self::connect()->prepare($query);
            // this method below for updating quantity of paremeters which we should post in execute
            $result_ResponseRatingTable = $this->setSqlStatements($sql_statement, $params)->execute();
            // the parameter in the end for return only associative array data
            $result_of_method_ResponseRatingTable = $sql_statement->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($result_of_method_ResponseRatingTable)) {
                return $result_of_method_ResponseRatingTable;
            }
            
            if (empty($result_of_method_ResponseRatingTable) && empty($result_ResponseRatingTable)) {
                return false;   
            } else {
                return $result_ResponseRatingTable;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }
    
}

