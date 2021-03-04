<?php

class ValidationModel extends Validation
{   
   
    // the method below check was user login or not
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
    public function findUserByUsername($username) 
    {
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


    // The method below gets user email uses for it user_id 
    public function findEmailByUserid($user_id) 
    {
        try {
         $query = "SELECT email FROM `registration` WHERE `user_id` = ?";

         $params = array(
             array(
                 "param_type" => "i",
                 "param_value"=> $user_id
             ));

          if (empty($user_id)) {
              throw new Exception("Function findEmailByUserid doesn't get user_id parameter");
                               }
          $resultfindEmailByUserid = $this->selectRegistrationTable($query, $params);

          if (empty($resultfindEmailByUserid)) {
              throw new Exception("Function findEmailByUserid doesn't return result");
                                               }
    
          if (empty($resultfindEmailByUserid)) {
               return false;
            } else { // return user email
                return $resultfindEmailByUserid;
                   }  

        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                         }
    }

    // The method below gets user phone number uses for it user_id 
    public function findPhoneNumberByUserid($user_id) 
    {
        try {
         $query = "SELECT phone_number FROM `registration` WHERE `user_id` = ?";

         $params = array(
             array(
                 "param_type" => "i",
                 "param_value"=> $user_id
             ));

          if (empty($user_id)) {
              throw new Exception("Function findPhoneNumberByUserid doesn't get user_id parameter");
                               }
          $resultfindPhoneNumberByUserid = $this->selectRegistrationTable($query, $params);

          if (empty($resultfindPhoneNumberByUserid)) {
              throw new Exception("Function findPhoneNumberByUserid doesn't return result");
                                               }
    
          if (empty($resultfindPhoneNumberByUserid)) {
               return false;
            } else { // return user phone number
                return $resultfindPhoneNumberByUserid;
                   }  

        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                         }
    }


    // the method below deletes user data from registration by of user_id
    public function deleteUserDataByUserid($user_id)
    {
         try {
              $query = "DELETE FROM `registration` WHERE `user_id` = ?";

              $params = array(
                  array(
                      "param_type" => "i",
                      "param_value" => $user_id
                  ));
              $result_deleteUserDataByUserid = $this->updateRegistration($query, $params);

              if (empty($user_id)) {
                  throw new Exception("Method deleteUserDataByUserid doesn't get argument of user_id");
                }
              if (empty($result_deleteUserDataByUserid)) {
                  throw new Exception("Method deleteUserDataByUserid wasn't executed successful");
                 } else {
                    return $result_deleteUserDataByUserid;
                        }
             } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                    'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

}
















