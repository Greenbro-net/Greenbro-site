<?php

namespace App\Controller;

use App\Core\Controller;

use Exception;

class AddItemController extends Controller
{

    use \App\Trait\ConfigSettingsTrait;
    use \App\Trait\FilterDataTrait;
    use \App\Trait\EmptyObjectCheckingTrait;
    
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
    
    // the method below displays successful page
    public function display_successful_page()
    {
        $this->view('add_item' . DIRECTORY_SEPARATOR . 'successful_adding');
        $this->view->page_title = 'Товар був доданий успішно';
        $this->view->render();
    }
    // the method below displays unsuccessful page
    public function display_unsuccessful_page()
    {
        $this->view('add_item' . DIRECTORY_SEPARATOR . 'unsuccessful_adding');
        $this->view->page_title = 'Товар не був доданий, виникла помилка';
        $this->view->render();
    }

    // the method below returns correct date 
    protected function get_date()
    {  
      date_default_timezone_set("Europe/Kiev");
      return date("Y-m-d H:i:s"); 
    }    
    public function call_add_new_product()
    {    
        try { 
            $this->load_model_obj('ItemMode')->organize_image_download();
            
            if ($this->object_has_properties($add_item_obj = new AddItemController())) {
                $result = $this->load_model_obj('AddItemModel')->add_new_product($add_item_obj);
                
                header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/addItem/display_successful_page");
                exit;

            } else {
                throw new Exception("Method object_has_properties found empty property in object");
                   
                header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/addItem/display_unsuccessful_page");
                exit;
                   }
    
           
            }  catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }

        
    }
    
}






