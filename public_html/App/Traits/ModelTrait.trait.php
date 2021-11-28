<?php
// TO DO delete it in future 
namespace App\Traits;

trait ModelTrait 
{
   use  ControllerTrait;

   // the method below for gets response load_model
    private function get_object_response_model()
    {
        $this->load_model('ResponseModel');
        $object_response_model = new ResponseModel();
        return $object_response_model;
    }
    // the method below for gets validation load_model
    private function get_object_validation_model()
    {
        $this->load_model('ValidationModel');
        $object_validation_model = new ValidationModel();
        return $object_validation_model;
    }
    // the method below returns CustomerModel for calling methods
    private function get_object_customer_model()
    {
        $this->load_model('CustomerModel');
        $object_customer_model = new CustomerModel();
        return $object_customer_model;
    }
    // the method below returns OrderModel for calling methods
    private function get_object_order_model()
    {
       $this->load_model('OrderModel');
       $object_order_model = new OrderModel();
       return $object_order_model;
    }
    // the method below returns SessionModel for calling methods
    private function get_object_session_model()
    {
       $this->load_model('SessionModel');
       $object_session_model = new SessionModel();
       return $object_session_model;
    }
    // the method below returns  PHPMailerModel
    private function get_object_mailer_model()
    {
        $this->load_model('PHPMailerModel');
        $object_mailer_model = new PHPMailerModel();
        return $object_mailer_model;
    }
    // the method below returns ItemModel for calling methods 
    private function get_item_model()
    {
        $this->load_model('ItemModel');
        $item_model = new ItemModel();
        return $item_model;
    }
    // the method below returns AdminModel for calling methods
    private function get_admin_model()
    {
        $this->load_model('AdminModel');
        $admin_model = new AdminModel();
        return $admin_model;
    }
    // the method below returns AddItemModel for calling methods
    private function get_add_item_model()
    {
        $this->load_model('AddItemModel');
        $add_item_model = new AddItemModel();
        return $add_item_model;
    }
    // the method below returns SliderModel for calling methods
    private function get_slider_model()
    {
        $this->load_model('SliderModel');
        $slider_model = new SliderModel();
        return $slider_model;
    }
    // the method below returns MessageModel for calling methods, static case
    private static function get_message_model()
    {
        self::static_load_model('MessageModel');
        $message_model = new MessageModel();
        return $message_model;
    }
    
    
}