<?php

class eraseuserdataController extends Controller
{
    use sessionTrait;

    use modelTrait;

    private $user_id;

    private $user_id_session;


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
    // the method below sets user_id from $_SESSION
    private function set_user_id_session()
    {
        if (!empty($_SESSION["user_id"])) {
            $user_id_session = $this->user_id_session = trim($_SESSION["user_id"]);
        } 
        else if (!empty($_SESSION['userData']['id'])) {
            $user_id_session = $this->user_id_session = trim($_SESSION['userData']['id']);
        }
    }
    // the method below gets user_id from $_SESSION
    private function get_user_id_session()
    {
        $this->set_user_id_session();
        return $this->user_id_session;
    }
    // the method below for security, checks $user_id equal to actual user session
    private function control_user_id()
    {
        if ($this->get_user_id() === $this->get_user_id_session()) {
            return true;
        } else {
            return false;
               }
    }
    



    // the method below starts deletion user data
    public function erase_data()
    {   
        $user_id = $this->get_user_id_session();
        $this->get_object_response_model()->deleteResponseRatingByUserid($user_id);
        $this->get_object_response_model()->deleteResponseByUserid($user_id);
        
        // the code belew deletes user data from registration table
        $this->get_object_validation_model()->deleteUserDataByUserid($user_id);

         $this->unsetUserSession();
         $this->unsetFbUserSession();
        // if all deletion operation were success return message with success
        return "Hello There";

    }

    // the method below for displaying user status of his deletion with alphanumeric cod
    public function deletion_status($code)
    {

    }




}