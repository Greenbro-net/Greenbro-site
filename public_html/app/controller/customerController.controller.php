<?php
// TO DO the code below should be refactoring

// create system for validation data which we will get from user 
// if we have the same data(last name, mobile number, email) in DB we don't create new insert to DB
// if it's new user we will insert new data to table customers
class CustomerController extends Controller
{  
    use ConfigSettingsTrait;
    use modelTrait;
    use sessionTrait;
    use FilterDataTrait;

    public $recipient_name;
    public $recipient_last_name;
    public $user_email;
    public $recipient_mobile_number;
    // this properties above for customer 

    public function __construct()
    {  
       @$this->recipient_name = (string)$this->filter_data($_POST["recipient_name"]);
       @$this->recipient_last_name = (string)$this->filter_data($_POST["recipient_last_name"]);
       @$this->user_email = (string)$this->filter_data($_POST["user_email"]);
       @$this->recipient_mobile_number = (string)$this->filter_data($_POST["recipient_mobile_number"]);
    }

    // the method below checking does $_SESSION["last_customer_id"] have value if not grab it from CustomerModel
    public function grab_last_customer_id()
    {
        if (empty($_SESSION["last_customer_id"])) {
            return $_SESSION["last_customer_id"] = $this->get_object_customer_model()->get_customer_id($this->get_recipient_name(),$this->get_recipient_last_name(), 
                   $this->get_user_email(), $this->get_recipient_mobile_number());
        } else {
            return $_SESSION["last_customer_id"];
               }
    }

    // the method below checks data from from not empty
    protected function check_not_empty_data()
    {   
        try {
             if (isset($_POST["recipient_name"]) && isset($_POST["recipient_last_name"]) && 
             isset($_POST["user_email"]) &&  isset($_POST["recipient_mobile_number"])) {
                return true;
               } else {
                   throw new Exception("Method check_not_empty_data gets empty parameter");
                      }

        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }
         
    }
    

    protected function get_recipient_name()
    {
        return $this->recipient_name;
    }

    protected function get_recipient_last_name()
    {
        return $this->recipient_last_name;
    }

    protected function get_user_email()
    {
        return $this->user_email;
    }

    protected function get_recipient_mobile_number()
    {
        return $this->recipient_mobile_number;
    }
    
    protected function set_united_order_items()
    {
        return  $this->get_object_session_model()->get_united_order_items();  
    }

    // the function below makes routing for customer 
    public function customer_route()
    {
        if (empty($_SESSION["last_customer_id"])) {
            header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/customer/get_customer_data");
            exit();

        } else {
            header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/customer/delivery_payment_type");
            exit();
               }
    }
    // the method below organises checking the same user email and number
    protected function repeated_customer_data()
    {
       return $this->get_object_customer_model()->checking_customer_data($this->get_user_email(), $this->get_recipient_mobile_number());
    }
    // the method below organises checking the same user name
    protected function repeated_customer_name()
    {
       return $this->get_object_customer_model()->checking_customer_name($this->get_recipient_name(), $this->get_recipient_last_name());
    }

    public function choses_next_step()
    {
        // the method below checks that data not empty
        if ($this->check_not_empty_data()) {
            //there is #1 variant 
            // we do not have that user before, new one
            if ((!$this->repeated_customer_data()) && (!$this->repeated_customer_name())) {
           
            // the code below adds user data to DB and do next step
           $this->get_object_customer_model()->adding_customer_info($customer_info = new customerController());
           header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/customer/delivery_payment_type");
           exit;
            }
                    //there is #2 variant
        // there we should take customer_id if the information of customer is the same 
        elseif (($this->repeated_customer_data()) && ($this->repeated_customer_name())) { 

            // the function below returns customer_id for customer that we have already had in table 
            $this->grab_last_customer_id();
            header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/customer/delivery_payment_type");
            exit;
          } 

        }
    }

    

    // this functions below in Controller makes URL name for calling page
    public function get_customer_data()
    {
        $this->model('CustomerModel');
        $this->view('order' . DIRECTORY_SEPARATOR . 'index');
        $this->view->page_title = 'Оформлення замовлення';
        $this->view->render();
    }

    // this function below in Controller is for  URL name for gets delivery information
    public function delivery_payment_type()
    {   
        $this->model('OrderModel');
        $this->view('order' . DIRECTORY_SEPARATOR . 'delivery_payment');
        $this->view->page_title = 'Доставка та оплата';
        $this->view->render();
    }

     

    
    
}       


   
   


