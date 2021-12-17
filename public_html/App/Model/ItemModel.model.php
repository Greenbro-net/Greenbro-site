<?php


namespace App\Model;


use App\Data\ShoppingCartData;
use Exception;


class ItemModel extends ShoppingCartData
{
    // we should create functions which call to different models like:add, delete.etc 
    public function add_item($product_id, $quantity_of_item, $item_price, $united_order_items)
    {   
        try {
            if (!empty($product_id) && !empty($quantity_of_item) && !empty($item_price) && !empty($united_order_items)) {
                // the code below checks, have we  already had item in table order_items
                $cartResult = $this->getCartItemByProduct($product_id, $united_order_items);

                if (!empty($cartResult)) {
                    // Update cart item quantity in database
                    // $quantity_of_item how many items we add type in window below item image 
                    $new_quantity_of_item = $cartResult[0]["quantity_of_item"] + $quantity_of_item;
                    $this->updateCartQuantity($new_quantity_of_item, $product_id);
                } else {
                    // Add to cart table
                    $result_addToCart = $this->addToCart($product_id, $quantity_of_item, $item_price, $united_order_items);
                    if (empty($result_addToCart)) {
                        throw new Exception("Function addToCart wasn't successful");
                    }
                    echo "Code inside adding block was executed";
                }
            } else {
                throw new Exception("Method add_item has got at least one empty parameter");
            }
      } catch (Exception $exception) {
          file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
          'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
      }
    }

}