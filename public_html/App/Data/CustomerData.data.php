<?php


namespace App\Data;


use App\Data\DBControllerData;
use Exception;


class CustomerData extends DBControllerData
{
    // the function below adds new customer in customer table
    public function addNewCustomer($recipient_name, $recipient_last_name, $user_email,$recipient_mobile_number)
    {
        try {
            $query = "INSERT INTO `customers`(`recipient_name`, `recipient_last_name`, `user_email`, `recipient_mobile_number`) VALUES (?, ?, ?, ?)";
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
                "param_type" => "i",
                "param_value" => $recipient_mobile_number));
           
            // if function was executed successfully it returns 1
            $result_addNewCustomer = $this->updateCustomer($query, $params);
            if (empty($result_addNewCustomer)) {
                throw new Exception("Function addNewCustomer wasn't successfully");
            } else {
                return $result_addNewCustomer;
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}