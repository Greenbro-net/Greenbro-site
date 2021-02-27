<?php
// we don't create try catch block for function getCartItembyProduct which select from tables because 
// it causes exception when table is empty
class ShoppingCart extends DBController
{
    // $united_order_items is on the DB table 'order_items'
    // the result of function will displays in our Shopping Cart section
    public function getMemberCartItem($united_order_items)
    {   
        try {
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
            return $cartResult;
               throw new Exception("Function getMemberCartItem return empty result, but it's cause because order_items was empty");
                                } else {
                                    return $cartResult;
                                       }
        
             } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                            }
    }


    // the function below  returns item_id from order_items 
    public function getCartItembyProduct($product_id, $united_order_items)
    {   
        try {
        $query = "SELECT * FROM order_items WHERE product_id = ? AND united_order_items = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $united_order_items
            ));
        // there is we don't throw exception if we have empty cartResult because when customer add item for first time it returns false
        $cartResult = $this->getDBgetCartItembyProduct($query, $params);
        if (!empty($cartResult)) {
                            return $cartResult;
                                 }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }
    
    // the function below add item in order_items table
    // orders_items_id is last order_items_id from table(order_items) plus one 
    public function addToCart($product_id, $quantity_of_item, $item_price, $united_order_items)
    { 
       try {
    $query = "INSERT INTO `order_items`(`product_id`, `quantity_of_item`, `item_price`, `united_order_items`) VALUES (?, ?, ?, ?)";
        
    $params = array(
        array(
            "param_type" => "i",
            "param_value" => $product_id
        ),
        array(
            "param_type" => "i",
            "param_value" => $quantity_of_item
        ),
        array(
            "param_type" => "i",
            "param_value" => $item_price
        ),
        array(
            "param_type" => "i",
            "param_value" => $united_order_items
        ));

    $result_addToCart = $this->updateDB($query, $params);

    if (empty($result_addToCart)) {
           throw new Exception("Function addToCart wasn't success");
                                  } else {
                                    //   maybe this will cause problem in the future, be careful
                                   return $result_addToCart;
                                         }
           } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                          }
    }

    // the funciton below is for updating data in tbl_cart table which is callest in update_cart_quantity.php 
    public function updateCartQuantity($quantity_of_item, $product_id)
    {
        try {
        $query = "UPDATE order_items SET quantity_of_item = ? WHERE product_id = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $quantity_of_item
            ),
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ));

        $result_updateCartQuantity = $this->updateDB($query, $params);
        
        if (empty($result_updateCartQuantity)) {
               throw new Exception("Method updateCartQuantity wasn't successful");
                  }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    // the function below for deleting item from cart in title block  
    public function deleteCartItem($product_id, $united_order_items)
    { 
        try {
         if ((empty($product_id)) || (empty($united_order_items))) {
            throw new Exception("Method deleteCartItem doesn't get parameter");
          }
        $query = "DELETE FROM  order_items WHERE product_id = ? AND united_order_items = ?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $product_id
            ),
            array(
                "param_type" => "i",
                "param_value" => $united_order_items
            ));

        $resultdeleteCartItem = $this->updateDB($query, $params);
        
        if (empty($resultdeleteCartItem)) {
            throw new Exception("Method deleteCartItem wasn't successful");
                                          }
            } catch (Exception $exception)   {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                             }
    }

    // the function below for clears all items from cart 
    public function emptyCart($united_order_items)
    {
        try {
        $query = "DELETE FROM order_items WHERE united_order_items =?";

        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $united_order_items
            ));

        $resultemptyCart = $this->updateDB($query, $params);

        if (empty($resultemptyCart)) {
             throw new Exception("Function emptyCart wasn't successful");
                                     }
           } catch (Exception $exception)   {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                            }
    }

    // the function below for gets description information about item from products table
    public function getProductDescription($id)
    {
        try {
        $query = "SELECT * FROM products WHERE id = ?";
        
        $params = array(
            array(
                "param_type" => "i",
                "param_value" => $id
            ));
        
        $result_getProductDescription = $this->getDBResult($query, $params);
        
        if (empty($result_getProductDescription)) {
              throw new Exception("Function return getProductDescription wasn't success");
               } else {
                   return $result_getProductDescription;
                      }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

}



