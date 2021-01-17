<?php

class DBController_bro extends Database_bro {

    // the function below gets customer_id from the same customer name from customers table 
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
        
        if (empty($query || $params)) {
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
        $sql_statement = $pdo->prepare($query);
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

}