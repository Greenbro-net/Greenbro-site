<?php

class ResponseController extends Controller
{
    use modelTrait;
    use FilterDataTrait;
    
    public $user_id; 
    public $user_name;
    public $user_email_response;
    public $product_id;
    public $comment;
    public $rating;
    public $created_at;

    
    
    // the function below displays view page 
    public function show_response()
    {
       $this->model('ResponseModel');
       $this->view('response' . DIRECTORY_SEPARATOR . 'index');
       $this->view->page_title = 'Відгуки';
       $this->view->render();
    }

    // the method below displays success message
    protected function display_success_message()
    {
        $form_data['success'] = true;
        $form_data['posted'] = 'Method addNewRating was executed successful';
        echo json_encode($form_data);
    }
    // the method below displays unsucces message
    protected function display_unsuccess_message()
    {
        $form_data['success'] = false;
        $form_data['posted'] = 'Error is';
        echo json_encode($form_data);
    }

    // the method below checks is user log in by casual system
    private function checkUserid()
    {
        if (empty($_SESSION['user_id'])) {
            return false;
        } else {
            return true;
                }
    }

    // the method below checks is user log in by FB
    private function checkFbUserid()
    {
        if (empty($_SESSION['userData']['id'])) {
            return false;
        } else {
            return true;
               }
    }
    
    
    // the method below grabs quantity of comment by actual user  
    public function grab_quantity_comment()
    {
        // call method from model 
       if ($this->get_object_response_model()->grabQuantityComment($this->get_user_id(), $this->get_product_id())) {
        $form_data['success'] = false;
        $form_data['posted'] = "User has already added a comment for the item";
        echo json_encode($form_data);
          } else {
            $form_data['success'] = true;
            $form_data['posted'] = "User hasn't added a comment for the item yet";
            echo json_encode($form_data);
                 }
    }
    
    // the methods below gets current date 
    protected function create_date_of_comment()
    {  
        date_default_timezone_set("Europe/Kiev");
        return date("Y-m-d H:i:s"); 
    }
    protected function set_created_at()
    {
        $created_at = $this->created_at = $this->create_date_of_comment();
    }
    public function get_created_at()
    {
         $this->set_created_at();
         return $this->created_at;
    }

    // the methods below get user name
    protected function set_user_name()
    {
        $user_name = $this->user_name = $this->filter_data($_POST["user_name"]);
    }
    public function get_user_name()
    {
        $this->set_user_name();
        return $this->user_name;
    }
    // the methods below get user email response 
    protected function set_user_email_response()
    {   
        $user_email_response = $this->user_email_response = $this->filter_data($_POST["user_email_response"]);
    }
    public function get_user_email_response()
    {
        $this->set_user_email_response();
        return $this->user_email_response;
    }
    // the methods below get actual product_id
    protected function set_product_id()
    {
        $product_id = $this->product_id = $this->filter_data($_POST["product_id"]);  
    }
    public function get_product_id()
    {
        $this->set_product_id();
        return $this->product_id;
    }
    //the methods  below get comment
    protected function set_comment()
    {
        $comment = $this->comment = $this->filter_data($_POST["comment"]);
    }
    public function get_comment()
    {
        $this->set_comment();
        return $this->comment;
    }
    // the methods below get actual rating
    protected function set_rating()
    {
        $rating =  $this->rating = $this->filter_data($_POST["rating"]);        
    }
    public function get_rating()
    {
        $this->set_rating();
        return $this->rating;
    }

    // the methods below setter for user_id 
    private function set_user_id()
    {
      $user_id = $this->user_id = $this->filter_data($_SESSION["user_id"]);
    }
    // the methods below setter for FB user_id 
    private function set_user_id_fb()
    {
      $user_id = $this->user_id = $this->filter_data($_SESSION['userData']['id']);
    }



    public function get_user_id() 
    {   //set user id from casual case
        $this->set_user_id();
        if ($this->user_id) {
           return $this->user_id;
        } else {
            $this->set_user_id_fb();
            return $this->user_id;
        }

    }


    // the code below just a simple wrapper for private method findItemResponse
    public function call_findItemResponse($product_id)
    {
        return $this->get_object_response_model()->findItemResponse($product_id);
    }

    // the method below for adds new response rating in response_rating table 
    public function run_add_new_comment()
    {
        // firstly check throw what system user was logged in casual or FB
         if ($this->checkUserid() || $this->checkFbUserid()) {
                // the code below adds new comment in table response
            if ($last_response_id =  $this->get_object_response_model()->addNewComment($this->get_user_id(), $this->get_user_name(), 
                $this->get_user_email_response(), $this->get_product_id(), $this->get_comment(), $this->get_created_at()))
          
            {   
                // last_response_id receives from method above
                $this->get_object_response_model()->addNewRating($this->get_user_id(), $last_response_id, $this->get_rating());
                // the message below displays by AJax
                $this->display_success_message();
            } // the code below will work if comment won't add to table
             else {
                 $this->display_unsuccess_message();
             }  
         } 
          
    }

    

}



