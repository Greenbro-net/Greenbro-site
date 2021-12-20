<?php


namespace App\Data;


use App\Data\DatabaseBroData;
use PDO;
use PDOException;


class DBControllerBroData extends DatabaseBroData 
{
    use \App\Traits\SqlSetterTrait;


    // the method below gets customer_id from the same customer name from customers table 
    protected function selectRegistrationTable($query, $params)
    { 
        try {
            $sql_statement = self::connect()->prepare($query);
            
            if (empty($query) || empty($params)) {
                throw new PDOException("Method selectRegistrationTable doesn't get query or params");
            }

            // this method below for updating quantity of paremeters which we should post in execute
            $result_selectUserEmail = $this->setSqlStatements($sql_statement, $params)->execute();                             

            if (empty($result_selectUserEmail)) {
                throw new PDOException("Function selectRegistrationTable doesn't return value  after execute");
            }
            
            // the parameter in the end for return only associative array data 
            $result_UserEmail = $sql_statement->fetchAll(PDO::FETCH_ASSOC);
        
            if (empty($result_UserEmail)) {
                return false;
            } else {
                return $result_UserEmail; 
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below works with registration table
    protected function updateRegistration($query, $params)
    {
        try {
            $pdo = self::connect();

            if (empty($pdo)) {
                throw new PDOException("PDO object is empty in updateRegistration");
            }
            $sql_statement = $pdo->prepare($query);
            if (empty($sql_statement)) {
                throw new PDOException("SQL statement is empty in updateRegistration");
            }
            
            // this method below for updating quantity of paremeters which we should post in execute
            $result_insert_registration = $this->setSqlStatements($sql_statement, $params)->execute();  

            if (empty($result_insert_registration)) {
                throw new PDOException("Insert query to registration table wasn't successful!");
            } else {
                return $result_insert_registration;
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }
    
    
    // the method below preparing query to grabs data from admin table  
    protected function selectAdminTable($query, $params)
    { 
        try {
            $sql_statement = self::connect()->prepare($query);
            
            if (empty($query)) {
                throw new PDOException("Method selectAdminTable doesn't get query");
            }

            // this method below for updating quantity of paremeters which we should post in execute
            $result_selectAdminTable = $this->setSqlStatements($sql_statement, $params)->execute();

            if (empty($result_selectAdminTable)) {
                throw new PDOException("Method selectAdminTable doesn't match the same manager name and was stopped");
            }
            
            // the parameter in the end for return only associative array data 
            $data_from_admin_table = $sql_statement->fetchAll(PDO::FETCH_ASSOC);
        
            if (empty($data_from_admin_table)) {
                throw new PDOException("Method selectAdminTable doesn't return value  after execute");
            } else {
                return $data_from_admin_table; 
            }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below preparing query for admin table  
    protected function updateAdminTable($query, $params)
    { 
        try {
            if (empty($query) || empty($params)) {
                throw new PDOException("Method updateAdminTable doesn't get argument");
            }
            $pdo = self::connect();
            if (empty($pdo)) {
                throw new PDOException("PDO object is empty in updateAdminTable");
            }

            $sql_statement = $pdo->prepare($query);
            if (empty($sql_statement)) {
                throw new PDOException("SQL statement is empty in updateAdminTable");
            }
            
            // this method below for updating quantity of paremeters which we should post in execute
            $result_updateAdminTable = $this->setSqlStatements($sql_statement, $params)->execute();

            if (empty($result_updateAdminTable)) {
                throw new PDOException("Method updateAdminTable doesn't return value after execution");
            } else { #in success case return result
                return $result_updateAdminTable;
            } 
            
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below testing variant for admin table  
    protected function testingAdminTable($query)
    { 
        try {
            $pdo = self::connect();

            if (empty($pdo)) {
                throw new PDOException("PDO object is empty in updateAdminTable");
            }
            $sql_statement = $pdo->prepare($query);

            if (empty($sql_statement)) {
                throw new PDOException("SQL statement is empty in updateAdminTable");
            }
            $result_updateAdminTable = $sql_statement->execute();

            if (empty($result_updateAdminTable)) {
                throw new PDOException("Method updateAdminTable doesn't return value after execution");
            } else { #in success case return result
                return $result_updateAdminTable;
            } 
            
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}
