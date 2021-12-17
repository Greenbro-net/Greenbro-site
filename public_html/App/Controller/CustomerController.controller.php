<?php

namespace App\Controller;

use App\Core\Controller;
use Exception;

// create system for validation data which we will get from user 
class CustomerController extends Controller
{  
    use \App\Traits\ConfigSettingsTrait;
    use \App\Traits\SessionTrait;
    use \App\Traits\FilterDataTrait;
    use \App\Traits\JsonReplyTrait;
    use \App\Traits\ValidationTrait;

    public $recipient_name;
    public $recipient_last_name;
    public $user_email;
    public $recipient_mobile_number;
    // this properties above for customer 

    public function __construct()
    {  
    // TO DO use ? true : false block instead of @ 
       @$this->recipient_name = (string)$this->filter_data($_POST["recipient_name"]);
       @$this->recipient_last_name = (string)$this->filter_data($_POST["recipient_last_name"]);
       @$this->user_email = (string)$this->filter_data($_POST["user_email"]);
       @$this->recipient_mobile_number = (string)$this->filter_data($_POST["recipient_mobile_number"]);
    }

    // the method below checking does $_SESSION["last_customer_id"] have value if not grab it from CustomerModel
    public function grab_last_customer_id()
    {   
      try {
            if (empty($_SESSION["last_customer_id"])) {
                 $result = $this->load_model_obj('CustomerModel')->get_customer_id($this->get_recipient_name(),$this->get_recipient_last_name(), 
                       $this->get_user_email(), $this->get_recipient_mobile_number());
                 if (empty($result)) {
                     throw new Exception("Method get_customer_id return empty result");
                    }
                       return $_SESSION["last_customer_id"] = $result;
            } else {
                return $_SESSION["last_customer_id"];
                   }
          } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
              'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
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
        return  $this->load_model_obj('SessionModel')->grab_united_order_items();  
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
       return $this->load_model_obj('CustomerModel')->checking_customer_data($this->get_user_email(), $this->get_recipient_mobile_number());
    }
    // the method below organises checking the same user name
    protected function repeated_customer_name()
    {
       return $this->load_model_obj('CustomerModel')->checking_customer_name($this->get_recipient_name(), $this->get_recipient_last_name());
    }

    public function choses_next_step()
    {
        // the method below checks that data not empty
        if ($this->check_not_empty_data()) {
            //there is #1 variant 
            // we do not have that user before, new one
            if ((!$this->repeated_customer_data()) && (!$this->repeated_customer_name())) {
              // the code below adds user data to DB and do next step
              $this->load_model_obj('CustomerModel')->adding_customer_info($customer_info = new CustomerController());
              $this->delivery_payment_type();
            }
            //there is #2 variant
            elseif ((!$this->repeated_customer_data()) || (!$this->repeated_customer_name())) {
              // the code below adds user data to DB and do next step
              $this->load_model_obj('CustomerModel')->adding_customer_info($customer_info = new CustomerController());
              $this->delivery_payment_type();
            }
            // there is #3 variant
            // there we should take customer_id if the information of customer is the same 
             else { 
            // the function below returns customer_id for customer that we have already had in table       
            $this->grab_last_customer_id();
            $this->delivery_payment_type();
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


    // the method below does autocompliting for logged in user, such us email and phone number
    public function fill_in_customer_data()
    {
        try {
              if ($this->checkUserid()) {
                  // the block of code below grabs user email
                  $result_user_email = $this->load_model_obj('ValidationModel')->findEmailByUserid($this->get_user_id());         
                  // the block of code below grabs user phone number
                  $result_user_phone_number = $this->load_model_obj('ValidationModel')->findPhoneNumberByUserid($this->get_user_id());
                  
                  if (empty($result_user_phone_number)) {
                      throw new Exception("Parameter result_user_phone_number in fill_in_customer_data is empty");
                    }
                  if (empty($result_user_email)) {
                    throw new Exception("Parameter result_user_email in fill_in_customer_data is empty");
                    }
                  $this->display_casual_user_data($result_user_email, $result_user_phone_number);
              }
              // the code below grabs email from FB
              elseif($this->checkFbUserid()) {
                    //  $this->createUserSession();
                     $this->display_fb_user_email();
              }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                  'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

}       


   
   


