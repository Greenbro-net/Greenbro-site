<?php
session_start();


use App\Core\Application;
use App\Controller\TroubleController;


require_once "vendor/autoload.php";
require_once "../config.php";



// "autoload": {
//     "psr-4": {
//         "Core\\": "App/Core/"
//        }
// }

// the function below checkout does methods and controllers exist or not
function checkout_url()
{ 
    $url = Application::clearupParameter();

    // var_dump($url);
    // folder where we store our classes 
    $file_controller_names = array_slice(scandir('App/Controller/'), 2);

    // the code below gets controller name and store it in array  
    foreach($file_controller_names as $controller_key => $file_controller_name ) {
    // the code below deletes empty arrays from array 
        
        // the code below for gets name with Controller part 
        $file_controller_array = explode('.', $file_controller_name);
        // the arrays below have names of controllers  
        $controller_names[$controller_key] = $file_controller_array[0];
        
        // var_dump($controller_names);

        // the code below for gets name without Controller part 
        $file_controller_array = explode('Controller', $file_controller_name);
        $short_controller_names[$controller_key] = $file_controller_array[0];
    }

    // the function below gets methods name and create array with class methods
    foreach($controller_names as $controller_name) {
        
        // echo "<pre>";
        // var_dump($controller_name);

        $arrays_method_names[] = get_class_methods("App\Controller\\".$controller_name);
    }
    // the function below  makes one simple array and delete three methods 
    foreach($arrays_method_names as $method_names) {
        
            foreach($method_names as $key_method_name => $method_name) {
                
                if (($method_name == 'view') || ($method_name == 'model') || ($method_name == '__construct')) {
                    unset($method_names[$key_method_name]);
                } else {
                    $controller_methods[] = $method_name; 
                       }   
                } 
            }

            // var_dump($url[0], $url[1]);

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

        if ((strcasecmp($controller_name_check, $url[0]) == 0)) {
        // if ($controller_name_check == $url[0]) {


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
// function autoload($className)
// {
//     $modules = [ROOT,APP,CORE,CONTROLLER,DATA,TRAITS];

//     foreach ($modules as $current_dir)
//     {
//         $path = $current_dir . $className . ".controller.php";
//         if (file_exists($path))
//         {
//             require_once $path;
//             return;
//         }
//         // the code below for trait
//         $path = $current_dir . $className . ".trait.php";
//         if (file_exists($path))
//         {
//             require_once $path;
//             return;
//         } else {
//             $path = $current_dir . $className . ".data.php";
//             if(file_exists($path)) {
//                 require_once $path;
//                 return;
//             }
//         }
//     }
// }
// spl_autoload_register('autoload', true);

// Application is call in checkout_url function above
checkout_url();


// we fixed notice Undefined action with @

// testing code below 

// $app = new Application();
// $page_404 = new troubleController();
//         $page_404->page_404();
// var_dump($_SESSION['access_manager']);
// var_dump($_SERVER['REQUEST_URI']);

// var_dump($_SESSION['randomnr2']);
// var_dump(md5($_POST['admin_captcha_numbers']));


?>




