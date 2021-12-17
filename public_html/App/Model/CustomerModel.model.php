<?php 


namespace App\Model;


use App\Data\CustomerData;
use Exception;
use PDO;


class CustomerModel extends CustomerData
{
    public  function get_customer_data()
    { 
        try {
    // will check does we have the same customer data(last name, mobile number, email) in customers table
    $sql = "SELECT  `user_email`, `recipient_mobile_number` FROM customers";
    $stmt = $this->connect()->prepare($sql);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
             if (empty($results)) {
                 throw new Exception("get_customer_data returns empty results");
                                  }
            } catch (Exception $exception) {
                    file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                      'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }


    // the method below grabs customer name and last_name from customer table 
    public  function get_customer_name()
    {
        try {
            $sql = "SELECT  `recipient_name`, `recipient_last_name` FROM customers";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
                if (empty($results)) {
                    throw new Exception("get_customer_name returns empty results");
                }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }


    // the method below for checking customer name before insert it to table `customers`
    public function  checking_customer_name($recipient_name, $recipient_last_name)
    {   
        // the function below return all customers which we have in table customers 
        try {
            //    checking incoming data below
            if (empty($recipient_name || $recipient_last_name)) {
                throw new Exception("Parameter for method in checking_customer_name is empty");
            }

            $recipient_names = $this->get_customer_name();
       
            if (empty($recipient_names)) {
                throw new Exception("Result of get_customer_name is empty");
            }
            // the code below for checking do we have the same recipient_name and recipient_last_name in DB
            foreach ($recipient_names as $one_recipient_name) {
                if ($recipient_name == $one_recipient_name["recipient_name"] && $recipient_last_name == $one_recipient_name["recipient_last_name"]) { 
                //return true if we have the same user data
                return true;
                } 
            } //return false if we don't have the same user data
                return false;
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }     


    // the function below for checking customer data before insert it to table `customers`
    public function checking_customer_data($user_email, $recipient_mobile_number)
    {   
        // the function below return all customers which we have in table customers
        try {
            // checking incoming data below
            if (empty($user_email || $recipient_mobile_number)) {
                throw new Exception("Method checking_customer_data doesn't get all parameter");
            }
            $recipients_data = $this->get_customer_data();
        
            if (empty($recipients_data)) {
                throw new Exception("Result of get_customer_data is empty");
            }

            // the code below for checking do we have the same user_email and recipient_mobile_number in DB
            foreach ($recipients_data as $recipient_data) {
                if ($user_email == $recipient_data["user_email"] && $recipient_mobile_number == $recipient_data["recipient_mobile_number"]) {  //return true if we have the same user data 
                    return true;
                }
            } //return false if we don't have the same user data
            return false;
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }  
    

    public function adding_customer_info($customer_info)
    {      
        try {                       
    
            if ($result_of_function = $this->addNewCustomer($customer_info->recipient_name, $customer_info->recipient_last_name, 
                                                            $customer_info->user_email, $customer_info->recipient_mobile_number)) {  
                // $result_of_function returns last_customer_id
                $_SESSION["last_customer_id"] = $result_of_function;
            } else {
                // the exception will execute if above if isn't 1
                throw new Exception("Function adding_customer_info doesn't have all parameters");
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

    
    // the function below returns customer_id if we have the same data from customer 
    public function get_customer_id($recipient_name, $recipient_last_name, $user_email,$recipient_mobile_number)
    {
        try { 
            if (empty($recipient_name ||$recipient_last_name || $user_email || $recipient_mobile_number)) {
                throw new Exception("Our arguments were empted in get_customer_id method");
            }
            $query = "SELECT `customer_id` FROM `customers` WHERE recipient_name = ? AND recipient_last_name = ? 
                                                 AND user_email = ? AND recipient_mobile_number = ?";
            $params = array(
            array(
                "param_type" => "s",
                "param_value" => $recipient_name
            ),
            array(
                "param_type" => "s",
                "param_value" => $recipient_last_name
            ),
            array(
                "param_type" => "s",
                "param_value" => $user_email
            ),
            array(
                "param_type" => "s",
                "param_value" => $recipient_mobile_number
            ));
           
            // if function was executed successfully it returns string with number
            $result_get_customer_id = $this->selectCustomerId($query, $params);
     
            if (empty($result_get_customer_id)) {
                throw new Exception("Function get_last_id wasn't successful");
            } else {
                return $result_get_customer_id[0]["customer_id"];
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}