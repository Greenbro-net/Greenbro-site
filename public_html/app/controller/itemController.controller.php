<?php

if(empty($_POST["quantity_of_item"])) {
    $_POST["quantity_of_item"] = "";
}

class ItemController extends Controller
{  
    use modelTrait;
    use FilterDataTrait;

    public $united_order_items;
    public $product_id;
    public $item_id;
    public $quantity_of_item;
    public $price;
    public $item_price;

    public function __construct()
    {
       $this->united_order_items = (int)$this->set_united_order_items();
       //we use @ for escape notice in our pages 
       @$this->item_id = (int)$this->filter_data($_POST["id"]);
       @$this->product_id = (int)$this->filter_data($_POST["product_id"]);
       @$this->quantity_of_item = (int)$this->filter_data($_POST["quantity_of_item"]);
       @$this->price = (int)$this->filter_data($_POST["price"]);
       @$this->item_price = $this->count_item_price($price, $quantity_of_item);

    }
        
    public function get_united_order_items() 
    {
        return $this->united_order_items;
    }

    public function get_quantity_of_item()
    {
        return  $this->quantity_of_item; 
    }

    public function get_price()
    {
        return $this->price;
    }

    public function get_id()
    {
        return $this->item_id;
    }

    public function get_product_id()
    {
        return $this->product_id;
    }

    public function count_item_price()
    {
        return $item_price = $this->get_price() * $this->get_quantity_of_item();
    }

    protected function set_united_order_items()
    {   
        try {
        
        $result_set_united_order = $this->get_object_session_model()->get_united_order_items();
        
        if (empty($result_set_united_order)) {
                            throw new Exception("Function set_united_order_items wasn't successful");
                                             } else {
                                                 return $result_set_united_order;
                                                    }
                                
            }  catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                            }

    }

    
    // the function below add item to cart
    public function add_item_to_cart()
    {
        $this->get_item_model()->add_item($this->get_id(), $this->get_quantity_of_item(), 
                                          $this->count_item_price(), $this->get_united_order_items());
    }
    // the function below delete item from cart
    public function delete_item_from_cart()
    {
        $this->get_item_model()->deleteCartItem($this->get_product_id(), $this->get_united_order_items());
    }
    // the function below delete all item from cart
    public function delete_all_items()
    {
        $this->get_item_model()->emptyCart($this->get_united_order_items());
    }
    // the function below update item quantity in cart
    public function update_item_quantity()
    {
        $this->get_item_model()->updateCartQuantity($this->get_quantity_of_item(), $this->get_product_id());
    }

}


// TO DO we can rebuild the code below without creating object just call methods from AJAX 
$object_ItemController = new ItemController();

// the function below adds item in table order_items 
// we use @ below for escape notice undefined index 
if (@$_GET["action"] == "add") {
    $object_ItemController->add_item_to_cart();
}

// the code below removes item from item_cart
// we use @ below for escape notice undefined index 
@$product_id = $_POST["product_id"]; 
if (@$_GET["action"] == "remove") {
     $object_ItemController->delete_item_from_cart();
}

// the code below empties all items from cart 
if (@$_GET["action"] == "empty") {
     $object_ItemController->delete_all_items();
   }

// the code below for updating items quantity in cart 
if (@$_GET["action"] == "update_quantity") {
     $object_ItemController->update_item_quantity();
   }
