<?php
// TO DO the code below should be refactoring

class Order extends DBController
{
   // the function below adds new order in `orders` table
   public function addNewOrder($united_order, $order_date, $order_customer_id, $payment_status, $total_price,
                               $payment_type, $delivery_type, $delivery_address)
   {    
       try {
        //    we should insert only values for "foreingh keys" which we have in parent tables 
    $query = "INSERT INTO `orders`(`united_order`, `order_date`, `order_customer_id`, `payment_status`, `total_price`, `payment_type`, `delivery_type`, `delivery_address`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $params = array(
        array(
            "param_type" => "i",
            "param_value" => $united_order
        ),
        array(
            "param_type" => "s",
            "param_value" => $order_date
        ),
        array(
            "param_type" => "i",
            "param_value" => $order_customer_id
        ),
        array(
            "param_type" => "s",
            "param_value" => $payment_status
        ),
        array(
            "param_type" => "i",
            "param_value" => $total_price
        ),
        array(
            "param_type" => "s",
            "param_value" => $payment_type
        ),
        array(
            "param_type" => "s",
            "param_value" => $delivery_type
        ),
        array(
            "param_type" => "s",
            "param_value" => $delivery_address
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