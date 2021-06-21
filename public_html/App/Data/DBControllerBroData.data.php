<?php

namespace App\Data;

use DatabaseBroData;

use PDO;
use PDOException;

class DBControllerBroData extends DatabaseBroData 
{

    // the method below gets customer_id from the same customer name from customers table 
    protected function selectRegistrationTable($query, $params)
    { 
        try {
        $sql_statement = self::connect()->prepare($query);

        // this block of code for updating quantity of paremeters which we should post in execute
        // code below can interact with with both parameters as int and str
        if (is_numeric($params[0]["param_value"])) {
            // the code below create PDO PARAM for integer
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);
        } else {
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_STR);
               }


        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
        }
        
        if (empty($query) || empty($params)) {
            throw new PDOException("Function selectRegistrationTable doesn't get query or params");
                                      }
        $result_selectUserEmail = $sql_statement->execute();

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

    // the function below works with registration table
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
   
        // the code below checks param and set STR or INT
        if (is_numeric($params[0]["param_value"])) {
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);
        } else {
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_STR);
               }
        // this block of code for updating quantity of paremeters which we should post in execute
        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
                                               }
        if (!empty($params[2]["param_value"])) {
                $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_STR);
                                               }
        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_STR);
                                               } 

        $result_insert_registration = $sql_statement->execute();

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
    

    
    // the function below preparing query to grabs data from admin table  
    protected function selectAdminTable($query, $params)
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
        
        if (empty($query)) {
            throw new PDOException("Function selectAdminTable doesn't get query");
            }
        $result_selectAdminTable = $sql_statement->execute();

        if (empty($result_selectAdminTable)) {
            throw new PDOException("Function selectAdminTable doesn't match the same manager name and was stopped");
            }
        
        // the parameter in the end for return only associative array data 
        $data_from_admin_table = $sql_statement->fetchAll(PDO::FETCH_ASSOC);
    

        if (empty($data_from_admin_table)) {
                       throw new PDOException("Function selectAdminTable doesn't return value  after execute");
                            } else {
                                return $data_from_admin_table; 
                                   }
        } catch (PDOException $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                          }
    }


    // the function below preparing query for admin table  
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

        // this block of code for updating quantity of paremeters which we should post in execute
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_STR);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
            }
        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_INT);
            }
        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_STR);
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




    // the function below testing variant for admin table  
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
