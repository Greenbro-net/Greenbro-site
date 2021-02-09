<?php
// TO DO create two form one for registration and another for sing in to system
// make a query to DB through a model 
// create option which will allow display user nickname after sing in
// create function for sing out(which unsets user SESSION) 

// DB for validation 
// 1. id;
// 2.user_name;
// 3.user_email;
// 4.user_password;
// 5.date_of_create;

class ValidationController extends Controller
{
    use urlTrait;

    public $user_id;

    // the method below filter input data 
    public function filter_data($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    // the method below checks is user log in or not
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




    // the method below for jquery return response by AJAX
    protected function response_not_login() 
    {
        $form_data['success'] = false;
        $form_data['posted'] = "User did not log in";
        echo json_encode($form_data);
    }   
    // the method below for jquery return response by AJAX
    protected function response_login()
    {
        $form_data['success'] = true;
        $form_data['posted'] = "User was log in";
        echo json_encode($form_data);
    }

    // the method below for ajax call from comment-script.js
    public function check_log_in()
    {
        if (!$this->checkUserid()) {
             return $this->response_not_login();
            } else {
             return $this->response_login();
                   }
    }


    // the method below set user in
    protected function set_user_id()
    {   
        if (!empty($_SESSION["user_id"])) {
            $user_id = $this->user_id  = $this->filter_data($_SESSION["user_id"]);
             }
    }
    // the method below get user_id
    public function  get_user_id()
    {
        $this->set_user_id();
        return $this->user_id;
    }

    
    public function register() {
        // $data = [
        //     'username' => '',
        //     'email' => '',
        //     'password' => '',
        //     'confirmPassword' => '',
        //     'usernameError' => '',
        //     'emailError' => '',
        //     'passwordError' => '',
        //     'confirmPasswordError' => ''
        // ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Santize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'contact' => trim($_POST['contact']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => ''
            ];
            
            $nameValidation = "/^[a-zA-Z0-9]*$/";
            //Validation for password
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";

            //Validate username on letters/numbers
            if (empty($_POST['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $_POST['username'])) {
                $data['usernameError'] = 'Name can only contain letters 
                     and numbers.';
            } else {
                //Check if username exists
                
                //create object model below
                if ($this->get_object_validation_model()->findUserByUsername($data['username'])) {
                    $data['usernameError'] = 'Username is already taken.';
                } else {
                    echo "We do not have that username";
                }
            }

            //Validate email
            if (empty($_POST['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                 $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists

                // create object model below
                if ($this->get_object_validation_model()->findUserByEmail($data['email'])) {
                    $data['emailError'] = 'Email is already taken.';
                    // testing code below
                    var_dump($this->get_object_validation_model()->findUserByEmail($data['email']));
                } else {
                    echo "We do not have that email";
                    // testing code below 
                    var_dump($this->get_object_validation_model()->findUserByEmail($data['email']));
                }
            }
                //Validate password on length and numeric values
                if (empty($data['password'])) {
                    $data['passwordError'] = 'Please enter password.';
                } elseif (strlen($data['password'] < 6)) {
                    $data['passwordError'] = 'Password must be at least 8 characters.';
                } elseif (!preg_match($passwordValidation, $data['password'])) {
                    $data['passwordError'] = 'Password must have at least one numeric value.';
                }

                //Validate confirm password
                if (empty($data['confirmPassword'])) {
                    $data['confirmPasswordError'] = 'Please enter password.';
                } else {
                    if ($data['password'] != $data['confirmPassword']) {
                    $data['confirmPasswordError'] = 'Password do not match, please try again.';
                    }
                }

                // Make sure that errors are empty
                if (empty($data['usernameError']) && empty($data['emailError']) &&
                    empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                    //Hash password
                    $data['password'] = password_hash($data['password'],
                          PASSWORD_DEFAULT);

                    $hashedPassword = password_hash($data['password'],
                          PASSWORD_DEFAULT);
                    
                    //Register user from model function
                    if ($this->get_object_validation_model()->addNewUser($data["username"], $data["email"], $data["password"])) {
                        //Redirect to the login page
                        header("Location:" . $this->get_url() . "://greenbro." . $this->get_domen_part() . "/validation/login");
                    } else {
                        die('Something went wrong.');
                    }

                }
        }
        // $this->view('validation' . DIRECTORY_SEPARATOR . $data);
        // echo "<hr>";
        // var_dump($data);
    }


    public function login() {
        $data = [
            'title' => 'Login page',
            'username' => '',
            'password' => '',
            'usernameError' => '',
            'passwordError' => ''
        ];

        //Check for post
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'username' => trim($_POST['username']),
                'password' => trim($_POST['password']),
                'usernameError' => '',
                'passwordError' => ''
            ];

            //Validate username
            if (empty($data['username'])) {
                 $data['usernameError'] = 'Please enter a username.';
            }

            //Validate password
            if (empty($data['password'])) {
                 $data['passwordError'] = 'Please enter a password.';
            }
            

            //Check if all errors are empty
            if (empty($data['usernameError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->get_object_validation_model()->loginUser($data['username'], $data['password']);
                // var_dump($_POST['password']);
                // var_dump($data['password']);
                // var_dump($hashedPassword);
                // var_dump($loggedInUser);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or username is incorrect. Please try again.';
                }
            } else {
                $data = [
                    'username' => '',
                    'password' => '',
                    'usernameError' => '',
                    'passwordError' => ''
                ];
            }

        }
        
    }
    
    // the method below is public wrapper for private method unsetUserSession
    public function logout() {
       $this->unsetUserSession();
       $this->unsetFbUserSession();
    }

    // the method below creates session 
    private function createUserSession($loggedInUser) 
    {
        $_SESSION['user_id'] = $loggedInUser[0]['user_id'];
        // change key to user_name for using both cases casual and FB 
        $_SESSION['user_name'] = $loggedInUser[0]['username'];
        $_SESSION['email'] = $loggedInUser[0]['email'];
    }

    // TO DO expand this method for unseting session from FB API
    // the method below for logout casual user, unset Session 
    private function unsetUserSession() 
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['email']);
    }

    // the method below for logout user from FB, unset Session 
    private function unsetFbUserSession()
    {
        unset($_SESSION['userData']['id']);
        unset($_SESSION['userData']['first_name']);
        unset($_SESSION['userData']['last_name']);
        unset($_SESSION['userData']['email']);
        unset($_SESSION['userData']['picture']['url']);
    }

    // the method below for gets validation model 
    private function get_object_validation_model()
    {
        $this->model('ValidationModel');
        $object_validation_model = new ValidationModel();
        return $object_validation_model;
    }
    // the method below fills in email field
    protected function fill_in_email()
    {
        $form_data['success'] = true;
        $form_data['posted'] = $result[0]["email"];
        echo json_encode($form_data);
    }

    // the method below for gets user email for autocomplete
    public function get_user_email()
    {
       if ($this->checkUserid()) {
        // call method from model
         if ($result = $this->get_object_validation_model()->findEmailByUserid($this->get_user_id())) {         
               $form_data['success'] = true;
               $form_data['posted'] = $result[0]["email"];
               echo json_encode($form_data);
           }
        }
        // the code below grabs email from FB 
        elseif($this->checkFbUserid()) {
            if (!empty($_SESSION['userData']['email'])) {
                 $form_data['success'] = true;
                 $form_data['posted'] = $_SESSION['userData']['email'];
                 echo json_encode($form_data);
            }
        }
    }



}
    // the block of code below for ajax manages of validation 
    $object_ValidationController = new ValidationController();

    // the function below log out user 
    // we use @ below for escape notice undefined index
    if (@$_GET["action"] == "logout") {
        $object_ValidationController->logout();
    }

    // the function below log in user 
    if (@$_GET["action"] == "login") {
        $object_ValidationController->login();
    }


    






















   


//     protected function required($field, $value, $satisifer)
//     {
//         return !empty(trim($value));
//     }

//     protected function minlength($field, $value, $satisifer)
//     {
//         return mb_strlen($value) >= $satisifer;
//     }

//     protected function maxlength($field, $value, $satisifer)
//     {
//         return mb_strlen($value) <= $satisifer;
//     }

//     protected function email($field, $value, $satisifer)
//     { 
//         return filter_var($value, FILTER_VALIDATE_EMAIL);
//     }

//     // the function below gets variables from validation form
//     public function get_validation_data()
//     {
//         var_dump($_POST['user_name'],$_POST['user_password'], $_POST['user_email']);
//         // $_SESSION['user'] = ;
//     }

//     public function display_validation_page()
//     {
//         $this->view('validation' . DIRECTORY_SEPARATOR . 'validation_page');
//         // the code below is testing because it will be only small window
//         $this->view->page_title = 'Валідація';
//         $this->view->render();
//     }
// }












