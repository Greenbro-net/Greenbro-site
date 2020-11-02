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
    public $user_name;
    public $user_email;
    public $user_password;

    public $errorHandler;

    protected $rules = ['required', 'minlength', 'maxlength', 'email'];

    public $messages = [
        'required' => 'The :field field is required',
        'minlength' => 'The :field field must be a minumum of :satisifer length',
        'maxlength' => 'The :field field must be a maximum of :satisifer length',
        'email'     => 'That is not valid email address'
    ];

    // testing code below
    public $validation =  [
        'username' => [
            'check' => true,
            'maxlength' => 20,
            'minlength' => 3
        ],
        'email' => [
            'required' => true,
            'maxlength' => 255,
            'email'     => true
        ],
        'password' => [
            'required' => true,
            'minlength' =>  6
        ]
     ];
    
    // testing code above

   
    public function __construct()
    {
        // $this->errorHandler = $errorHandler;  
    }

    public function check($items, $rules)
    {
        foreach($items as $item => $value)
        {
            if (in_array($item, array_keys($rules)))
            {
                $this->validate([
                    'field' => $item,
                    'value' => $value,
                    'rules' => $rules[$item]
                ]);
            }
        }

        return $this;
    }

    public function fails()
    {
        return $this->errorHandler->hasErrors();
    }

    protected function validate($item)
    {
       $field = $item['field'];

       foreach($item['rules'] as $rule => $satisifer)
       {
           if (in_array($rule, $this->rules))
           {
               if (!call_user_func_array([$this, $rule], [$field, $item['value'], $satisifer]))
               {
                   $this->errorHandler->addError(
                       str_replace([':field', ':satisifer'], [$field, $satisifer],  $this->messages[$rule])
    
                   );
               }
           }
       }
    }

    protected function required($field, $value, $satisifer)
    {
        return !empty(trim($value));
    }

    protected function minlength($field, $value, $satisifer)
    {
        return mb_strlen($value) >= $satisifer;
    }

    protected function maxlength($field, $value, $satisifer)
    {
        return mb_strlen($value) <= $satisifer;
    }

    protected function email($field, $value, $satisifer)
    { 
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

    // the function below gets variables from validation form
    public function get_validation_data()
    {
        var_dump($_POST['user_name'],$_POST['user_password'], $_POST['user_email']);
        // $_SESSION['user'] = ;
    }

    public function display_validation_page()
    {
        $this->view('validation' . DIRECTORY_SEPARATOR . 'validation_page');
        // the code below is testing because it will be only small window
        $this->view->page_title = 'Валідація';
        $this->view->render();
    }
}


// testing code below
// die;
// $errorHandler1 = new ErrorHandlerController;
    
// var_dump($errorHandler1);
// die;
    // $validator = new ValidatorController($errorHandler1);

    // var_dump($validator->fails());
// var_dump($validation->errors());
// die;






