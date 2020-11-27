<?php

class ValidationModel extends Validation
{   

    public function loginUser($username, $password) 
    {
       try {
        $query = "SELECT * FROM `registration` WHERE username = ?";

        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $username
            ));

        $result_loginUser = $this->selectRegistrationTable($query, $params);

        if (empty($username) || empty($password)) {
            throw new Exception("Function loginUser doesn't get username or password parameter");
                              }
        // check password 
        if (password_verify($password, $result_loginUser[0]['password'])) {
            return $result_loginUser;
        } else {
            return false;
               } 

            }  catch (Exception $exception) {
             file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                 'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }

    }


    //TO DO create method below
    //Find user by email. Email is passed in by the Controller.
    public function findUserByEmail($email) {
      try {
        $query = "SELECT * FROM `registration` WHERE email = ?";
         
        $params = array(
            array(
                "param_type" => "s",
                "param_value" => $email
        ));

        if (empty($email)) {
            throw new Exception("Function findUserByEmail doesn't get email parameter");
                           }
        //Check if email is already registered
        // if function was executed successful it returns string with number
        $result_get_user_email = $this->selectRegistrationTable($query, $params);
        if (empty($result_get_user_email)) {
                return false;
                } else { // if email is already registered
                    return true;
                       }
        
         } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                        }
    }

    //Find user by username. Username is passed in by the Controller.
    public function findUserByUsername($username) {
        try {
          $query = "SELECT * FROM `registration` WHERE username = ?";

          $params = array(
               array(
                   "param_type" => "s",
                   "param_value" => $username
               ));

            if (empty($username)) {
                throw new Exception("Function findUserByUsername doesn't get username parameter");
                                  }
        //Check if username is already registered
        //if function was executed successful it returns string with number
        $result_get_user_name = $this->selectRegistrationTable($query, $params);
            if (empty($result_get_user_name)) {
                        return false;
                    } else { // if username is already registered
                                              return true;
                                                 }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                    'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                             }
    }




}