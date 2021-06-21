<?php

namespace App\Model;

use App\Data\DBControllerData;

use Exception;


class CartModel extends DBControllerData
{
    public function ShowCartItem()
    {
        // include file from content which displays us our items in cart 
        include CONTENT . 'cart_item.content.php';
    }

    // $united_order_items is on the DB table 'order_items'
    // the result of function will displays in our Shopping Cart section
    public function getMemberCartItem($united_order_items)
    {   
        try {
        if (empty($united_order_items)) {
            throw new Exception("Method getMemberCartItem has got empty parameter");
         }
        // * it is meaning select all rows from table 
           // AS command is used to rename a column or table with an alias
   
           //    the code below gets from products some rows 
           // and in order_items.id will be cart_id and gets quantity
           $query = "SELECT products.*, order_items.product_id as cart_id,order_items.quantity_of_item 
                      FROM products, order_items
        --    the code below means that id value has to be the same in both tables
                      WHERE products.id = order_items.product_id 
                   --    AND is like a && operator in PHP
                      AND order_items.united_order_items = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $united_order_items
            ));
            // exception execute when our customer make first step because order_items table 
            // is empty but not all the time keep in mind if everything is fine delete  this comment
        $cartResult = $this->getDBResult($query, $params);
        if (empty($cartResult)) {
             return false;
                                } else {
                                    return $cartResult;
                                       }
        
             } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                            }
    }
    
}

?>