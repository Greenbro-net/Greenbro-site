<?php

class addItemController extends Controller
{
    use ConfigSettingsTrait;
    use modelTrait;
    use FilterDataTrait;
    use EmptyObjectCheckingTrait;


    public $products_name;
    public $brand_name;
    public $category_of_products;
    public $mini_description;
    public $description;
    public $upload_image;
    public $set_price;
    public $sale;
    public $quantity;
    public $datetime;
    public $visible;

    public function __construct()
    {
       $this->products_name = !empty($_POST['products_name']) ? $this->filter_data($_POST['products_name']) : false;
       $this->brand_name = !empty($_POST['brand_name']) ? $this->filter_data($_POST['brand_name']) : false;
       $this->category_of_products = !empty($_POST['category_of_products']) ? $this->filter_data(reset($_POST['category_of_products'])) : false;
       $this->mini_description = !empty($_POST['mini_description']) ? $this->filter_data($_POST['mini_description']) : false;
       $this->description = !empty($_POST['description']) ? $this->filter_data($_POST['description']) :false;
       $this->upload_image = !empty($_FILES['main_image']['name']) ? $this->filter_data($_FILES['main_image']['name']) : false; // property doesn't set
       $this->set_price = !empty($_POST['set_price']) ? $this->filter_data($_POST['set_price']) : false;
       $this->sale = !empty($_POST['sale']) ? $this->filter_data($_POST['sale']) : false;
       $this->quantity = !empty($_POST['quantity']) ? $this->filter_data($_POST['quantity']) : false;
       $this->datetime = !empty($_POST['set_time']) ? $this->filter_data($this->get_date()) : false;
       $this->visible = !empty($_POST['visible']) ? $this->filter_data($_POST['visible']) : false;

    }

    // the function below returns correct date 
    protected function get_date()
    {  
      date_default_timezone_set("Europe/Kiev");
      return date("Y-m-d H:i:s"); 
    }    
    public function call_add_new_product()
    {    
        try { 
            // echo "<pre>";
            // var_dump($_POST);
            // echo "<hr>";
            // var_dump($_FILES);
            // echo "</pre>";
            $this->get_add_item_model()->organize_image_download();
            // testing code above 
            
            if ($this->object_has_properties($add_item_obj = new addItemController())) {
                $result = $this->get_add_item_model()->add_new_product($add_item_obj);
                // var_dump($result);
            } else {
                throw new Exception("Method object_has_properties found empty property in object");
                   }
    
           
            }  catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }

        
    }
    
    
    
    

}






