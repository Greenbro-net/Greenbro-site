<?php

namespace App\Model;

use App\Data\DBControllerBroData;
use Exception;

class AdminModel extends DBControllerBroData
{
    // the method below sets access session after success validation
    private function set_access_session()
    {
        $_SESSION['access_manager'] = "allow";
    }
    // the method below unsets access session after exit
    public function unset_access_session()
    {
        unset($_SESSION['access_manager']);
    }

    // the method below checks in table admin manager name
    public function check_manager_name($admin_object)
    {
        try {
            if (empty($admin_object->manager_name)) {
                throw new Exception("Method check_manager_name doesn't get parameter");
               }

             $query = "SELECT `manager_name` FROM `admin` WHERE `manager_name` = ?";

             $params = array(
                 array(
                     "param_type" => "s",
                     "param_value" => $admin_object->manager_name
                 ));
                
             
             $result_check_manager_name = $this->selectAdminTable($query, $params);

             if (empty($result_check_manager_name)) {
                    return false;
                } else { // return manager name in success case
                    return $result_check_manager_name[0]["manager_name"];
                       }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    // the method below returns manager password, admin_group from admin table
    public function get_manager_data($manager_name) 
    {
        try {
            $query = "SELECT `manager_password`, `manager_access` FROM `admin` WHERE `manager_name` = ?";

            $params = array(
                array(
                    "param_type" => "s",
                    "param_value" => $manager_name
                ));

            $result_get_manager_data = $this->selectAdminTable($query, $params);
            
            if (empty($result_get_manager_data)) {
                throw new Exception("Method get_manager_data returns empty result");
                } else { // return manager data in success case
                    return $result_get_manager_data;
                       }

            } catch (Exception $exception) {
                    file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                    'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    // the method below return crypted value of admin_captcha_numbers
    private function get_crypt_catpcha($admin_object)
    {
        return (string)md5($admin_object->admin_captcha_numbers);
    }
    // the method below checking captcha
    private function checking_captcha($admin_object)
    {
        try {
               if (empty($_SESSION['randomnr2']) || empty($admin_object->admin_captcha_numbers)) {
                  throw new Exception("Method checking_captcha doesn't get parameter");
                   }
              
               return $_SESSION['randomnr2'] === $this->get_crypt_catpcha($admin_object) ? true : false;

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    // the method below checking password
    protected function match_manager_password($admin_object, $result_get_manager_data)
    {
        try {
            if (empty($result_get_manager_data[0]["manager_password"])) {
                throw new Exception("Method match_managers_password doesn't get parameter");
                }

            if (password_verify($admin_object->manager_password, $result_get_manager_data['0']['manager_password'])) {
                 return true; // password equal each other return true 
                } else {
                 return false;
                       }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

    // the method below organises validation of manager data
    public function organise_manager_validation_data($admin_object)
    {
       $result_manager_name = $this->check_manager_name($admin_object);
       $result_get_manager_data = $this->get_manager_data($result_manager_name);

       // checking manager password below
     if ($this->match_manager_password($admin_object, $result_get_manager_data) && 
         $this->checking_captcha($admin_object)) {
         $this->set_access_session(); // this is success case
         return true;
       }  else {
            echo "Password or captcha doesn't match each other";
               }

    }
    // the method below crypt password
    protected function get_crypted_password($admin_object)
    {
        return  password_hash($admin_object->manager_password, PASSWORD_BCRYPT );
    }
    
    // the method below adds new manager to admin table
    public function add_new_manager($admin_object)
    {
        try {
            if (empty($admin_object->manager_name) || empty($admin_object->manager_password ||
                empty($admin_object->manager_access))) {
                    throw new Exception("Method add_new_manager doesn't get parameter");
                }

             $query = "INSERT INTO `admin`(`manager_name`, `manager_password`, `manager_access`) VALUES(?, ?, ?)";
           
             $params = array(
                array(
                    "param_type" => "s",
                    "param_value" => $admin_object->manager_name
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $this->get_crypted_password($admin_object)
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $admin_object->manager_access
                ));

            // in success case of execution method returns 1 or false
            $result_add_new_manager = $this->updateAdminTable($query, $params);

            if (empty($result_add_new_manager)) {
                  throw new Exception("Method add_new_manager wasn't successful");
                            } else {
                               return $result_add_new_manager;
                                   }
            } catch (Exception $exception) {
                  file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    
}