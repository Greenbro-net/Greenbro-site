<?php

class ResponseController extends Controller
{
    public $user_id; 
    public $response_id = 5;
    public $rating = 3;
    // the code below just for testing method 

    // the function below displays view page 
    public function show_response()
    {
       $this->model('ResponseModel');
       $this->view('response' . DIRECTORY_SEPARATOR . 'index');
       $this->view->page_title = 'Відгуки';
       $this->view->render();
    }
    // the method below for gets response model 
    private function get_object_response_model()
    {
        $this->model('ResponseModel');
        $object_response_model = new ResponseModel();
        return $object_response_model;
    }

    // the method below for checks is user log in or not 
    private function checkUserid()
    {
        if (empty($_SESSION['user_id'])) {
            // testing code below for that method
            return false;
        } else {
            return true;
                }
    }
    // the method below for jquery function which checking user_id 
    public function isLoggedIn() {
        if (!$this->checkUserid()) {
            $form_data['success'] = false;
            $form_data['posted'] = 'User did not log in';
            echo json_encode($form_data);
        } else {
            return true;
               }
        
    }

    // the code below has to be edit for our app
    public function grab_from_db()
    {
        var_dump($this->get_object_response_model()->public_findItemResponse(97));
    }

    // the method below setter for user_id 
    private function set_user_id()
    {
      $user_id = $this->user_id = $_SESSION["user_id"];
    }

    public function get_user_id() 
    {
        $this->set_user_id();
        return $this->user_id;
    }
    public function get_response_id()
    {
        return $this->response_id;
    }
    public function get_rating()
    {
        return $this->rating;
    }

    // TO DO a method which checks if user has already left a comment

    // the method below for adds new response rating in response_rating table 
    public function call_addNewComment()
    {
        // the code below will work if user doesn't log in 
        if (!$this->isLoggedIn()) {
            $form_data['success'] = false;
            $form_data['posted'] = 'User did not log in';
            echo json_encode($form_data);
        }
        // firstly check if user log in or not 
         elseif ($this->checkUserid()) {
            if (@$this->get_object_response_model()->addNewRating($this->get_user_id(), $this->get_response_id(), $this->get_rating())) {
                //  the message below displays by AJax
                // $back_message = "Коментар був успішно доданий";
                // echo "Коментар був успішно доданий";
                $form_data['success'] = true;
                $form_data['posted'] = 'Method addNewRating was executed successful';
                echo json_encode($form_data);
            } // the code below will work if comment won't add to table
             else {
                $form_data['success'] = false;
                $form_data['posted'] = 'Error is';
                echo json_encode($form_data);
             }  
         } 
          
    }

    

}

    // Here the user id is hardcoded
    // You can integrate your authentication code here to get the logged in user_id 

    $user_id = 5;

    if (isset($_POST["index"], $_POST["course_id"])) {

        $courseId = $_POST["course_id"];
        $ratingIndex = $_POST["index"];

        $rowCount = $this->get_object_response_model()->isUserRatingExist($user_id, $courseId);

        if ($rowCount == 0) {
            $insertId = $this->get_object_response_model()->addNewRating($userId, $courseId, $ratingIndex);
            if (empty($insertId)) {
                echo "Problem in adding ratings.";
            }
        } else {
                // the message displays when we have already had rating
                // we should use this type of messages in our app 
                echo "You have added rating already.";
               }
    }






//     <!-- DATABASE
// 1. See what tables and columns we need
// 2. Add response DATABASE
// Database fields:
// 1. id        INT
// 2. user_id   INT
// 3. product_id INT (for display response of some item)
// 4. body_of_response TEXT
// 5. created_at DATETIME

// Create
// 1. User has to be logged in
// 2. Check if data is text
// 3. Check for empty fields
// 4. If checks are met, do a request and create post

// Read
// 1. Read data from the database
// 2. Displays responses on the list of items 
// 3. On list of items, user can click on response and opens all response for current item for reading

// Update
// 1. Create function for answer on user response 

// Delete 
// 1. Delete button for admin if response is incorrect  -->

?>


























