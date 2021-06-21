<?php

namespace App\Data;

use DBControllerBroData;

use Exception;

class ValidationData extends DBControllerBroData
{
    // the function below adds user data in 'registration' table 
    public function addNewUser($username, $email, $phone_number, $password) 
    {
        try {
        // the code below checks not empty parameters
        if (empty($username) || empty($email) || empty($phone_number) || empty($password)) {
            throw new Exception("Empty parameter in addNewUser method");
           }
        $query = "INSERT INTO `registration`(`username`, `email`, `phone_number`, `password`) VALUES(?, ?, ?, ?)";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $username
            ),
            array(
                "param_type" => "s",
                "param_value" => $email
            ),
            array(
                "param_type" => "s",
                "param_value" => $phone_number
            ),
            array(
                "param_type" => "s",
                "param_value" => $password
            ));

        
        // if function was executed successfully it returns 1
        $result_addNewUser = $this->updateRegistration($query, $params);
        if (empty($result_addNewUser)) {
                            throw new Exception("Function addNewUser wasn't successfully");
                                       } else {
                                          return $result_addNewUser;
                                              }

        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                         }

    }
    
}