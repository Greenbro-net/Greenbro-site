<?php


namespace App\Data;


use App\Data\DBControllerData;
use Exception;


class OrderData extends DBControllerData
{
   // the method below adds new order in `orders` table
   public function addNewOrder($ordering_object)
   {    
       try {
            // we should insert only values for "foreingh keys" which we have in parent tables 
            $query = "INSERT INTO `orders`(`united_order`, `order_date`, `order_customer_id`, `payment_status`, `total_price`, `payment_type`, `delivery_type`, `delivery_address`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $ordering_object->united_order
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $ordering_object->order_date
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $ordering_object->order_customer_id
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $ordering_object->payment_status
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $ordering_object->total_price
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $ordering_object->payment_type
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $ordering_object->delivery_type
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $ordering_object->delivery_address
                ));

                // if function was executed successfully it returns 1
                $result_addNewOrder = $this->updateOrder($query, $params);

                if (empty($result_addNewOrder)) {
                    throw new Exception("Function add NewOrder wasn't successfully");
                } else {
                    return $result_addNewOrder;
                }
                
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}