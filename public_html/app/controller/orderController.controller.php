<?php
// 1.united_order                                      gets it from SESSION
// 2.order_date                                        this is OK(function)
// 3.order_customer_id
// payment status will change to "OK" after fondy returns that customer pays 
// 4.payment_status                                   this will change after successfully payment
// 5.total_price                                      this we should get from order_items table by model
// 6.payment_type      $_POST["payment_type"];        this we should get just by POST method
// 7.delivery_type     $_POST["delivery_type"];       this we should get just by POST method
// 8.delivery_address  $_POST["delivery_address"];    this we should get just by POST method
       
// $order_customer_id the last id from table customers  // this we should get after added new customer to table customers
$_POST["payment_status"] = "FALSE";

class OrderController extends Controller
{  
    use urlTrait;
    
    protected $united_order;
    protected $order_date;
    protected $order_customer_id;
    protected $payment_status;
    protected $total_price;
    protected $payment_type;
    protected $delivery_type;
    protected $delivery_address;
    
    public function __construct()
    {
       $this->united_order = (int)$this->call_set_united_order_items();
       $this->order_date = (string)$this->get_date();
       @$this->order_customer_id = (int)trim($_SESSION["last_customer_id"]);
       $this->payment_status = (string)trim($_POST["payment_status"]);
       $this->total_price = (int)$this->set_total_price();
       @$this->payment_type = (string)trim($_POST["payment_type"]);
       @$this->delivery_type = (string)trim($_POST["delivery_type"]);
       @$this->delivery_address = (string)trim($_POST["delivery_address"]); 
    }

    

    // the function below return united order from session model 
    public function call_set_united_order_items()
    {
        return $this->get_object_session_model()->get_united_order_items();
    }
     // the function below gets total_price for our customer order 
     public function set_total_price()
     {   
         return $this->get_object_order_model()->gather_total_price($this->get_united_order()); //47320200927
     }
     public function get_total_price()
     {
         return $this->total_price;
     }
 
     // the functions below return properties for our addNewOrder function 
     public function get_united_order()
      {
          return $this->united_order;
      }
    // the function below returns correct date 
    public function get_date()
    {  
      date_default_timezone_set("Europe/Kiev");
      return date("Y-m-d H:i:s"); 
    }

    public function get_order_date()
     {
         return $this->order_date;
     }  
    public function get_order_customer_id()
     {
         return $this->order_customer_id;
     }
    public function get_payment_status()
     {
         return $this->payment_status;
     }
   
    public function get_payment_type()
     {
         return $this->payment_type;
     }   
    public function get_delivery_type()
     {
         return $this->delivery_type;
     }
    public function get_delivery_address()
     {
         return $this->delivery_address;
     }

    // this functions below in Controller makes URL name for calling page
    // the function below displays successful message about order and the method should call to funciton which sends email to greenbro.net@gmail.com


    // the function below gathers all order data then checks it and after "final submiting" add data in orders table
    public function gather_order_data()
    {
        try {    //header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/customer/get_customer_data");
              
              if (isset($_SESSION["united_order_items"])  && !empty($this->get_order_date()) && !empty($this->get_order_customer_id()) && isset($_POST["payment_status"]) &&
                 !empty($this->get_total_price()) && isset($_POST["payment_type"]) && isset($_POST["delivery_type"]) && isset($_POST["delivery_address"]))
                {
                    $result_adding_order = $this->adding_order_info();

                    if (empty($result_adding_order)) {
                        header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/finalorder/display_unsuccessful_message");
                        exit;
                                      } else {
                                         // this redirect should go to the successful page 
                                         // after displays successful message for customer we unset successful $_SESSION["united_order_items"] and ($_SESSION["last_customer_id"])
                                         header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/finalorder/display_successful_message");
                                         exit;
                                             }
                        
                    // TO DO the code above doesn't work properly it should be rafactoring  as soon as possible

                } else {
                    throw new Exception("Function gather_order_data wasn't executed successfully");
                       }    

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    // the function below for adds in orders table new data 
    // there are we should create a checking function which control that we can only have one order with united_order_items
    public function adding_order_info()
    {
        try {          
                    if ($this->get_united_order() && $this->get_order_date() && $this->get_order_customer_id() && $this->get_payment_status() &&
                        $this->get_total_price() && $this->get_payment_type() && $this->get_delivery_type() && $this->get_delivery_address()) 
                        {  
                            $result_adding_order_info =  $this->get_object_order_model()->addNewOrder($this->get_united_order(), $this->get_order_date(), $this->get_order_customer_id(), $this->get_payment_status(),
                            $this->get_total_price(), $this->get_payment_type(), $this->get_delivery_type(), $this->get_delivery_address());
                            
                            // the method below sents letter after successful order to greenbro.net@gmail.com email 
                            $this->get_object_mailer_model()->sent_letter($this->get_united_order());
                            return $result_adding_order_info;
                            
                        } else {
                                // the exception will execute if above if isn't 1
                                throw new Exception("Function adding_order_info wasn't executed succesfully");
                               }
                
            } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    public function get_object_order_model()
    {
       $this->model('OrderModel');
       $object_order_model = new OrderModel();
       return $object_order_model;
    }

    public function get_object_session_model()
    {
       $this->model('SessionModel');
       $object_session_model = new SessionModel();
       return $object_session_model;
    }
    
    public function get_object_mailer_model()
    {
        $this->model('PHPMailerModel');
        $object_mailer_model = new PHPMailerModel();
        return $object_mailer_model;
    }

}