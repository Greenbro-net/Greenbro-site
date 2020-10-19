<?php
// TO DO the code below should be refactoring

// create system for validation data which we will get from user 
// if we have the same data(last name, mobile number, email) in DB we don't create new insert to DB
// if it's new user we will insert new data to table customers

class CustomerController extends Controller
{  
    protected $recipient_name;
    protected $recipient_last_name;
    protected $user_email;
    protected $recipient_mobile_number;
    // this properties above for customer 

    public function __construct()
    {  
       @$this->recipient_name = (string)trim($_POST["recipient_name"]);
       @$this->recipient_last_name = (string)trim($_POST["recipient_last_name"]);
       @$this->user_email = (string)trim($_POST["user_email"]);
       @$this->recipient_mobile_number = (string)trim($_POST["recipient_mobile_number"]);
    }

    // the function below checking does $_SESSION["last_customer_id"] have value if not grab it from CustomerModel
    public function grab_last_customer_id()
    {
        if (empty($_SESSION["last_customer_id"])) {
            return $_SESSION["last_customer_id"] = $this->get_object_customer_model()->get_customer_id($this->get_recipient_name(),$this->get_recipient_last_name(), 
                   $this->get_user_email(), $this->get_recipient_mobile_number());
        } else {
            return $_SESSION["last_customer_id"];
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
        $this->model('SessionModel');
        $session_model = new SessionModel();
        return  $session_model->get_united_order_items();  
    }

    // the function below makes routing for customer 
    public function customer_route()
    {
        if (empty($_SESSION["last_customer_id"])) {
            header('Location: http://greenbro.com/customer/get_customer_data');
        } else {
            header('Location: http://greenbro.com/customer/delivery_payment_type');
               }
    }
    
    public function choses_next_step()
    {
        // a few variants for our customers:
        if (!empty($this->get_recipient_name()) && !empty($this->get_recipient_last_name()) && 
            !empty($this->get_user_email()) &&  !empty($this->get_recipient_mobile_number())) {
                    //there is #1 variant
       if (!$this->get_object_customer_model()->checking_customer_data($this->get_user_email(), $this->get_recipient_mobile_number()) 
        && !$this->get_object_customer_model()->checking_customer_name($this->get_recipient_name(), $this->get_recipient_last_name())) {

       $this->get_object_customer_model()->adding_customer_info($this->get_recipient_name(), $this->get_recipient_last_name(), 
       $this->get_user_email(), $this->get_recipient_mobile_number());
       header('Location: http://greenbro.com/customer/delivery_payment_type');
       exit;
        }
                    //there is #2 variant
       // there we should take customer_id if the information of customer is the same 
       elseif ($this->get_object_customer_model()->checking_customer_data($this->get_user_email(), $this->get_recipient_mobile_number()) 
           && $this->get_object_customer_model()->checking_customer_name($this->get_recipient_name(), $this->get_recipient_last_name())) { 

        // the function below returns customer_id for customer that we have already had in table 
        $this->grab_last_customer_id();

        header('Location: http://greenbro.com/customer/delivery_payment_type');
        exit;
          } 
                    //there is #3 variant
        // maybe in the future we should expand behaviour of adding customer to DB
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

    // the function below returns CustomerModel for calling methods
    public function get_object_customer_model()
    {
        $this->model('CustomerModel');
        $object_customer_model = new CustomerModel();
        return $object_customer_model;
    }
    
}       


   
   


