<?php
trait modelTrait 
{
   use  controllerTrait;

   // the method below for gets response model
    private function get_object_response_model()
    {
        $this->model('ResponseModel');
        $object_response_model = new ResponseModel();
        return $object_response_model;
    }
    // the method below for gets validation model
    private function get_object_validation_model()
    {
        $this->model('ValidationModel');
        $object_validation_model = new ValidationModel();
        return $object_validation_model;
    }
    // the method below returns CustomerModel for calling methods
    private function get_object_customer_model()
    {
        $this->model('CustomerModel');
        $object_customer_model = new CustomerModel();
        return $object_customer_model;
    }
    // the method below returns OrderModel for calling methods
    private function get_object_order_model()
    {
       $this->model('OrderModel');
       $object_order_model = new OrderModel();
       return $object_order_model;
    }
    // the method below returns SessionModel for calling methods
    private function get_object_session_model()
    {
       $this->model('SessionModel');
       $object_session_model = new SessionModel();
       return $object_session_model;
    }
    // the method below returns  PHPMailerModel
    private function get_object_mailer_model()
    {
        $this->model('PHPMailerModel');
        $object_mailer_model = new PHPMailerModel();
        return $object_mailer_model;
    }
    // the method below returns ItemModel for calling methods 
    private function get_item_model()
    {
        $this->model('ItemModel');
        $item_model = new ItemModel();
        return $item_model;
    }
    // the method below returns ConfigSettingsModel for calling methods
    private function get_setting()
    {
        parent::model('ConfigSettingsModel');
        $url_model = new  ConfigSettingsModel;
        return $object = $url_model->get_json();
    }

    private function get_setting_without_parent()
    {
        $this->model('ConfigSettingsModel');
        $url_model = new  ConfigSettingsModel;
        return $object = $url_model->get_json();
    }
    
}