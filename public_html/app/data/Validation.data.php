<?php

class Validation extends DBController_bro
{
    // the function below adds user data in 'registration' table 
    public function addNewUser($username, $email, $password) 
    {
        try {
        $query = "INSERT INTO `registration`(`username`, `email`, `password`) VALUES(?, ?, ?)";

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
                "param_value" => $password
            ));

        // if function was executed successfully in returns 1
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