<?php

class eraseuserdataController extends Controller
{
    private $user_id;

    // the method below sets user_id
    private function set_user_id()
    {
       $user_id = $this->user_id = trim($_GET['user_id']);
    }
    // the method below gets user_id
    private function get_user_id()
    {
        $this->set_user_id();
        return $this->user_id;
    }

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



    // the method below starts deletion user data
    public function erase_data()
    {   
        // if all deletion operation were success return message with success

    }
}