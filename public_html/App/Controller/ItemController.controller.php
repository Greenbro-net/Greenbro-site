<?php


namespace App\Controller;


use App\Core\Controller;
use Exception;


class ItemController extends Controller
{  
    use \App\Traits\FilterDataTrait;


    public $united_order_items;
    public $product_id;
    public $item_id;
    public $quantity_of_item;
    public $price;
    public $item_price;


    public function __construct()
    {   
        $this->united_order_items = !empty($this->set_united_order_items()) ? (int)$this->set_united_order_items() : false;
        $this->item_id = !empty($_POST['id']) ? (int)$this->filter_data($_POST['id']) : false;
        $this->product_id = !empty($_POST['product_id']) ? (int)$this->filter_data($_POST['product_id']) : false;
        $this->quantity_of_item = !empty($_POST['quantity_of_item']) ? (int)$this->filter_data($_POST['quantity_of_item']) : false;
        $this->price = !empty($_POST['price']) ? (int)$this->filter_data($_POST['price']) : false;
        $this->item_price = !empty($this->count_item_price($price, $quantity_of_item)) ? (int)$this->count_item_price($price, $quantity_of_item) : false;
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


    // the method below sets united_order_items
    protected function set_united_order_items()
    {   
        try {
        
            $result_set_united_order = $this->load_model_obj('SessionModel')->grab_united_order_items();
            
            if (empty($result_set_united_order)) {
                throw new Exception("Method set_united_order_items wasn't successful");
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
        $this->load_model_obj('ItemModel')->add_item($this->get_id(), $this->get_quantity_of_item(), 
        $this->count_item_price(), $this->get_united_order_items());
    }


    // the function below delete item from cart
    public function delete_item_from_cart()
    {
        $this->load_model_obj('ItemModel')->deleteCartItem($this->get_product_id(), $this->get_united_order_items());
    }


    // the function below delete all item from cart
    public function delete_all_items()
    {
        $this->load_model_obj('ItemModel')->emptyCart($this->get_united_order_items());
    }

    
    // the function below update item quantity in cart
    public function update_item_quantity()
    {
        $this->load_model_obj('ItemModel')->updateCartQuantity($this->get_quantity_of_item(), $this->get_product_id());
    }

}

