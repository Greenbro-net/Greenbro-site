<?php
       
// $order_customer_id the last id from table customers  // this we should get after added new customer to table customers
$_POST["payment_status"] = "FALSE";

class OrderController extends Controller
{  
    use ConfigSettingsTrait;
    use modelTrait;
    use FilterDataTrait;

    public $united_order;
    public $order_date;
    public $order_customer_id;
    public $payment_status;
    public $total_price;
    public $payment_type;
    public $delivery_type;
    public $delivery_address;
    
    public function __construct()
    {
       $this->united_order = (int)$this->call_set_united_order_items();
       $this->order_date = (string)$this->get_date();
       @$this->order_customer_id = (int)$this->filter_data($_SESSION["last_customer_id"]);
       $this->payment_status = (string)$this->filter_data($_POST["payment_status"]);
       $this->total_price = (int)$this->set_total_price();
       @$this->payment_type = (string)$this->filter_data($_POST["payment_type"]);
       @$this->delivery_type = (string)$this->filter_data($_POST["delivery_type"]);
       @$this->delivery_address = (string)$this->filter_data($_POST["delivery_address"]); 
    }

    
    // the function below return united order from session model 
    public function call_set_united_order_items()
    {
        return $this->get_object_session_model()->get_united_order_items();
    }
     // the function below gets total_price for our customer order 
     public function set_total_price()
     {   
         return $this->get_object_order_model()->gather_total_price($this->get_united_order());
     }
     protected function get_total_price()
     {
         return $this->total_price;
     }
 
     // the functions below return properties for our addNewOrder function 
     protected function get_united_order()
      {
          return $this->united_order;
      }
    // the function below returns correct date 
    protected function get_date()
    {  
      date_default_timezone_set("Europe/Kiev");
      return date("Y-m-d H:i:s"); 
    }

    protected function get_order_date()
     {
         return $this->order_date;
     }  
    protected function get_order_customer_id()
     {
         return $this->order_customer_id;
     }
    protected function get_payment_status()
     {
         return $this->payment_status;
     }
   
    protected function get_payment_type()
     {
         return $this->payment_type;
     }   
    protected function get_delivery_type()
     {
         return $this->delivery_type;
     }
    protected function get_delivery_address()
    {
         return $this->delivery_address;
    }
    // the method below checks input parameter aren't empty
    protected function check_not_empty_data()
    {   
        try {
             if (isset($_SESSION["united_order_items"])  && !empty($this->get_order_date()) && !empty($this->get_order_customer_id()) && isset($_POST["payment_status"]) &&
                 !empty($this->get_total_price()) && isset($_POST["payment_type"]) && isset($_POST["delivery_type"]) && isset($_POST["delivery_address"])) {
                        return true;
                 } else {
                     throw new Exception("Method check_not_empty_data found empty data");
                        }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }


    // the method below displays successful message about order and the method should call to funciton which sends email to greenbro.net@gmail.com
    // the method below gathers all order data then checks it and after "final submiting" add data in orders table
    public function gather_order_data()
    {
        try {  
              if ($this->check_not_empty_data()) {

                    if (empty($this->adding_order_info())) {
                        header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/finalorder/display_unsuccessful_message");
                        exit;
                        } else { // this redirect go to the successful page 
                            header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/finalorder/display_successful_message?order=" . $this->get_united_order());
                            exit;
                               }

                } else {
                    throw new Exception("Method gather_order_data wasn't executed successfully");
                       }    

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    // the method below for adds in orders table new data 
    // there are we should create a checking function which control that we can only have one order with united_order_items
    public function adding_order_info()
    {
        try {             
            $result_adding_order_info = $this->get_object_order_model()->addNewOrder($ordering_object = new orderController());
            
            // the method below sents letter after successful order to greenbro.net@gmail.com email 
            $this->get_object_mailer_model()->sent_letter($this->get_united_order());
            
              if (empty($result_adding_order_info)){
                // the exception will execute if above if isn't 1
                throw new Exception("Method adding_order_info wasn't executed succesfully");
                 } else {
                    return $result_adding_order_info;
                        }
                
            } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }


}