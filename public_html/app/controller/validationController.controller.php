<?php

class ValidationController extends Controller
{
    use ConfigSettingsTrait;
    use sessionTrait;
    use modelTrait;
    use cryptographerTrait;
    use jsonreplyTrait;

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

    // the method below for ajax call from comment-script.js
    public function check_log_in()
    {
        if ($this->checkUserid() || $this->checkFbUserid()) {
             return $this->response_login();            
            } else {
                return $this->response_not_login();
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
    
    // the method below keeps values of an array
    protected function data_array_keeper()
    {
         // Sanitize post data
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        return $data = [
            'username' => trim($_POST['username']),
            'email' => trim($_POST['email']),
            'phone_number' => trim($_POST['phone_number']),
            'password' => trim($_POST['password']),
            'confirmPassword' => trim($_POST['confirm_password']),
            'usernameError' => '',
            'emailError' => '',
            'phone_numberError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];
    }
    // the method below checks user name
    protected function check_user_name()
    {
        $nameValidation = "/^[a-zA-Z0-9]*$/";

        $data = $this->data_array_keeper();
        //Validate username on letters/numbers
        if (empty($data['username'])) {
             $data['usernameError'] = 'Введіть ім\'я користувача';
        } elseif (!preg_match($nameValidation, $data['username'])) {
             $data['usernameError'] = 'Ім\'я може складатися тільки з літер та цифр';
        // the code below checks table for the same username
        } elseif ($this->get_object_validation_model()->findUserByUsername($data['username'])) {
             $data['usernameError'] = 'Це ім\'я вже використовується, спробуйте інше';
        }
        return $data;
    }
    // the method below checks user email
    protected function check_user_email()
    {   //Validate email
        // the method below return data with corrections
        $data = $this->check_user_name();
        if (empty($data['email'])) {
            $data['emailError'] = 'Введіть електронну адресу';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Введена вами електронна адреса не є коректною';
            //Check if email has already taken or not
        } elseif(($this->get_object_validation_model()->findUserByEmail($data['email']))) {
            $data['emailError'] = 'Введена електронна адреса вже використовується, спробуйте іншу';
        }
        return $data;
    }
    //the method below checks user phone number
    protected function check_user_phone_number()
    {   //Validate phone_number
        $data = $this->check_user_email(); // checks user email
        if (empty($data['phone_number'])) {
            $data['phone_numberError'] = 'Введіть контактний номер телефону';
        }
        return $data;
    }
    // the method below checks user password
    protected function check_user_password()
    { //Validate password on length and numeric values
            //Validation for password
            $passwordValidation = "/^(.{0,7}|[^a-z]*|[^\d]*)$/i";
            $data = $this->check_user_phone_number();

            if (empty($data['password'])) {
                $data['passwordError'] = 'Введіть пароль';
            } elseif (strlen($data['password'])  < 8) {
                $data['passwordError'] = 'Пароль має містити не менше 8 символів';
            } elseif (!preg_match($passwordValidation, $data['password'])) {
                $data['passwordError'] = 'Пароль має містити одну цифру';
            }

            //Validate confirm password
            if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Введіть пароль в поле для підтвердження паролю';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Паролі не співпадають, спробуйте знову';
                }
            }
            return $data;
    }
    // the method below checks data array for errors
    protected function look_for_error_in_data()
    {   $data = $this->check_user_password();
        if(empty($data['usernameError']) && empty($data['emailError']) && empty($data['phone_numberError']) &&
                empty($data['passwordError']) && empty($data['confirmPasswordError'])) {
                    return true;
                } else {
                    return false;
                       }
    }
    public function register() 
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        $data = $this->check_user_password();

        // Make sure that errors are empty
        if ($this->look_for_error_in_data()) {
            //Hash password
            $hashedPassword = password_hash($data['password'],
                    PASSWORD_DEFAULT);

        // the code below adds new user to tb registration
        if ($this->get_object_validation_model()->addNewUser($data["username"], $data["email"], $data["phone_number"], $hashedPassword)) {
            // after successful registration sets session for user  
            $loggedInUser = $this->get_object_validation_model()->loginUser($data['username'], $data['password']);
                
            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
                // display message by json 
                $this->registration_success_message();
            }

            // the code below if addNewUser method finished with error
            } else {
            $this->registration_unsuccess_message();
                   }
        // the code below displays message with error for user in unsuccess case
        } else {
            //return error by json
            $form_data['success'] = false;
            $form_data['posted'] = $this->check_errors($data);
            echo json_encode($form_data);
                }
        }
    }


    // the method below look for error in data array and return error value
    public function check_errors($data) 
    {
        if  (!empty($data['usernameError'])) {
            $error = $data['usernameError'];
        }  
        else if (!empty($data['emailError'])) {
            $error = $data['emailError'];
        }
        else if(!empty($data['phone_numberError'])) {
            $error = $data['phone_numberError'];
        }
        else if(!empty($data['passwordError'])) {
            $error = $data['passwordError'];
        }
        else if (!empty($data['confirmPasswordError'])) {
            $error = $data['confirmPasswordError'];
        }

        return $error;
    }
    

    
    // the method below is public wrapper for protected method unsetUserSession
    public function logout() {
       $this->unsetUserSession();
       $this->unsetFbUserSession();
    }

    public function login() {
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
            
            if ($loggedInUser) {
                $this->createUserSession($loggedInUser);
                // the code below returns success message
                $this->response_login();
                

            } else { //  block below if mistake was happened in code
                $this->response_not_login();
                // $data['passwordError'] = 'Password or username is incorrect. Please try again.';
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


    













   


