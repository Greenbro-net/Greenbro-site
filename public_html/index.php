<?php
session_start();
// if (!isset($_SESSION['access_token'])) {
//     header('Location  https://greenbro.net/facebook/login');
//     exit(); 
// }
// create method which will display description and item_cart in current place of screen 

require_once "vendor/autoload.php";
require_once "../config.php";
 



// the function below checkout does methods and controllers exist or not
function checkout_url()
{ 
    $url = Application::clearupParameter();
    // folder where we store our classes 
    $file_controller_names = array_slice(scandir('app/controller/'), 2);

    // the code below gets controller name and store it in array  
    foreach($file_controller_names as $controller_key => $file_controller_name ) {
    // the code below deletes empty arrays from array 
        
        // the code below for gets name with Controller part 
        $file_controller_array = explode('.', $file_controller_name);
        // the arrays below have names of controllers  
        $controller_names[$controller_key] = $file_controller_array[0];

        // the code below for gets name without Controller part 
        $file_controller_array = explode('Controller', $file_controller_name);
        $short_controller_names[$controller_key] = $file_controller_array[0];
    }

    // the function below gets methods name and create array with class methods
    foreach($controller_names as $controller_name) {
         
        $arrays_method_names[] = get_class_methods($controller_name);
    }
    // the function below create makes one simple array and delete three methods 
    foreach($arrays_method_names as $method_names) {
        
            foreach($method_names as $key_method_name => $method_name) {
                
                if (($method_name == 'view') || ($method_name == 'model') || ($method_name == '__construct')) {
                    unset($method_names[$key_method_name]);
                } else {
                    $controller_methods[] = $method_name; 
                       }   
                } 
            }

    // the code below for case of pure domain name greenbro.net
    if (empty($url[0]) && empty($url[1])) {
    Application::call_by_url();
     return $variable = TRUE;
    }
    // the code below for case only one of two url parameters
    elseif(empty($url[0]) || empty($url[1])) {
     $variable = FALSE;
    }

    elseif (!empty($url[0]) && !empty($url[1])) {
      foreach ($short_controller_names as $controller_name_check) {
        if ($controller_name_check == $url[0]) {
            foreach ($controller_methods as $controller_method_check)
            {
               if ($controller_method_check == $url[1]) {
                //    the code below calls method of actual controller 
                   Application::call_by_url();
                   return $variable = TRUE;
               } 
            }
        }  else { // the else block escapes undefined variable notice beloц
            $variable = FALSE;
                }
            } 
        }
    // if page does not exists you will be located in 404.php
    if ($variable !== TRUE) {
        $page_404 = new troubleController();
        $page_404->page_404();
    }

}



// The code below autoload functions for each classes 
function autoload($className)
{
    $modules = [ROOT,APP,CORE,CONTROLLER,DATA];

    foreach ($modules as $current_dir)
    {
        $path = $current_dir . $className . ".controller.php";
        if (file_exists($path))
        {
            require_once $path;
            return;
        } else {
            $path = $current_dir . $className . ".data.php";
            if(file_exists($path)) {
                require_once $path;
                return;
            }
        }
    }
}
spl_autoload_register('autoload', false);

// Application is call in checkout_url function above
checkout_url();




// testing code 
// var_dump($_POST['user_name'],$_POST['user_password'], $_POST['user_email'], $_POST['validation_submit'] );
// var_dump($_POST);
// @var_dump($_SESSION["last_customer_id"]);


// the code below show number of customer order 
// @var_dump($_SESSION["united_order_items"]);
// testing code 


// we require php script below for escaping notice undefined index "action"
// the code below require file for manages items by AJAX
require_once "app/controller/itemController.controller.php";
// the code below require file for manages user login and logout 
require_once "app/controller/validationController.controller.php";

// we fixed notice Undefined action with @




// testing code below

// $_SESSION['user_id'] = 5;
// unset ($_SESSION['user_id']);
// var_dump($_SESSION['user_id']);

// var_dump($_POST);
?>




