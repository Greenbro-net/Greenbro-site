<?php

class DBController extends Database {

    
    // function which prepare and execute connection to DB
    public function getDBResult($query, $params)
    {
        try {
        $sql_statement = self::connect()->prepare($query);
        
        $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_INT);
                                               }
        
        $result_getDBResult = $sql_statement->execute();

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



    // the function below update items in cart 
    public function updateDB($query, $params)
    { 
        try {
        $sql_statement = self::connect()->prepare($query);
        // this block of code for updating quantity of paremeters which we should post in execute
        $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_INT);
        }
        
        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_INT);
        }

        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_INT);
        }

        if (!empty($params[4]["param_value"])) {
            $sql_statement->bindParam(5, $params[4]["param_value"], PDO::PARAM_INT);
        }

        $result_insert = $sql_statement->execute();
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
        // this block of code for updating quantity of paremeters which we should post in execute
        $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_STR);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
        }
        
        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_STR);
        }

        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_INT);
        }
         
        $result_insert = $sql_statement->execute(array($params[0]["param_value"],$params[1]["param_value"],$params[2]["param_value"],$params[3]["param_value"]));
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
        // this block of code for updating quantity of paremeters which we should post in execute
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
                                               }
        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_INT);
                                               }
        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_STR);
                                               }
        if (!empty($params[4]["param_value"])) {
            $sql_statement->bindParam(5, $params[4]["param_value"], PDO::PARAM_INT); 
                                               }
        if (!empty($params[5]["param_value"])) {
            $sql_statement->bindParam(6, $params[5]["param_value"], PDO::PARAM_STR);
                                               }                              
        if (!empty($params[6]["param_value"])) {
            $sql_statement->bindParam(7, $params[6]["param_value"], PDO::PARAM_STR);
                                               }
        if (!empty($params[7]["param_value"])) {
            $sql_statement->bindParam(8, $params[7]["param_value"], PDO::PARAM_STR);
                                               }

        $result_insert_order = $sql_statement->execute();
        
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


        $result_selectCustomerId = $sql_statement->execute();

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
    
            // this block of code for updating quantity of paremeters which we should post in execute
                $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);
            
            // code below can interact with with both parameters as int and str 
            if (!empty($params[1]["param_value"])) {
                // the code below create PDO PARAM for integer 
                if (is_numeric($params[1]["param_value"])) {
                    $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_INT);
                } else {
                    $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
                       }
            }    
    
            if (empty($query || $params)) {
                throw new PDOException("Function receiveResponseTable doesn't get query or params");
                                          }
            $result_ResponseTable = $sql_statement->execute();
            
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

        // this block of code for updating quantity of paremeters which we should post in execute
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
        }
        
        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_STR);
        }

        if (!empty($params[3]["param_value"])) {
            $sql_statement->bindParam(4, $params[3]["param_value"], PDO::PARAM_INT);
        }

        if (!empty($params[4]["param_value"])) {
            $sql_statement->bindParam(5, $params[4]["param_value"], PDO::PARAM_STR);
        }

        if (!empty($params[5]["param_value"])) {
            $sql_statement->bindParam(6, $params[5]["param_value"], PDO::PARAM_STR);
        }

        if (empty($query || $params)) {
            throw new PDOException("Function updateResponseTable doesn't get query or params");
                                      }
        
         $result_ResponseTable = $sql_statement->execute();
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

        // this block of code for updating quantity of paremeters which we should post in execute
            $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);

        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_STR);
        }
         
        if (empty($query) || empty($params)) {
            throw new PDOException("Function deleteFromResponseTable doesn't get argument");
        }
         $result_deleteFromResponseTable = $sql_statement->execute();
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

        // this block of code for updating quantity of parameters which we should post in execute
        $sql_statement->bindParam(1, $params[0]["param_value"], PDO::PARAM_INT);
        
        if (!empty($params[1]["param_value"])) {
            $sql_statement->bindParam(2, $params[1]["param_value"], PDO::PARAM_INT);
        }

        if (!empty($params[2]["param_value"])) {
            $sql_statement->bindParam(3, $params[2]["param_value"], PDO::PARAM_INT);
        }

        if (empty($query || $params)) {
            throw new PDOException("Function updateResponseRatingTable doesn't get query or params");
                                      }
        $result_ResponseRatingTable = $sql_statement->execute();

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

