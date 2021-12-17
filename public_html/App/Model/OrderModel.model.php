<?php


namespace App\Model;


use App\Data\OrderData;
use Exception;


class OrderModel extends OrderData
{   
    public function get_united_order_items()
    {
        return $this->united_order_items;
    }

    public function gather_total_price($united_order_items)
    {
        try {
            if (empty($united_order_items)) {
                throw new Exception("There was empty argument for function");
            }
            // get total price from order_items table 
            $query = "SELECT  SUM(`quantity_of_item` * `item_price`) as `total_price`
            FROM  `order_items` WHERE `united_order_items` = ?"; 
            $params = array(array("param_type" => "i",
            "param_value" => $united_order_items));
            $result_total_price = $this->getDBResult($query, $params);
    
            if (empty($result_total_price)) {
                throw new Exception("Function get_total_price doesn't return result");
            } else {
                // there are we return total_price and lead to type integer 
                return (int)$result_total_price[0]["total_price"];
            }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
        }
    }

}