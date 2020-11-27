<?php
// TO DO the pure page like greenbro.net has bags with jquery fix it

// create method which will display description and item_cart in current place of screen 
session_start();

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'public_html/app' .  DIRECTORY_SEPARATOR);
define('VIEW', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
// for library folder
define('LIBRARY', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR);
// for content folder
define('CONTENT', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define('DATA', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . 'public_html/app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
$modules = [ROOT,APP,CORE,CONTROLLER,DATA,CONTENT];



// fucnction what is checkingout url 
// now the function only checkouts methods and doesn't work with controller
 function checkout_url()
{
// the function below checkout does page exists or not 
// if page does not exists you will be located in index.php
$url = (explode( '/', $_SERVER['REQUEST_URI']));

// folder where we store our classes 
$file_controller_names = array_slice(scandir('app/controller/'), 2);

// var_dump($file_controller_names);
// echo "<hr>";

foreach($file_controller_names as $controller_key => $file_controller_name ) {
    //  var_dump($file_controller_names);
    // the code below deletes empty arrays from array 
    // if (($file_controller_names == '.') || ($file_controller_names == '..')){
    //     unset($file_controller_name[$controller_key]);
    // } else {
        $file_controller_array = explode('.', $file_controller_name);
        // the arrays below have names of controllers  
        $controller_names[$controller_key] = $file_controller_array[0];
    // }
    // var_dump($controller_names);
}

// testing code for gets names on views in our app 
$directory_view_names = scandir('app/view');
foreach($directory_view_names as $view_key => $directory_view_name ) {

    // var_dump($directory_view_name);
    // the code below deletes empty arrays from array 
    if (($directory_view_name == '.') || ($directory_view_name == '..')){
        unset($directory_view_name);
    } else {
        // $file_view_names = explode('.', $directory_view_name);
        // the arrays below have names of view folders 
        $view_names[] = $directory_view_name;
    }
    // echo "<hr>";
    // var_dump($view_names);
}


// the function below gets methods name and create array with class methods
foreach($controller_names as $key => $controller_name) {
         
        $multi_dimensional_array[] = get_class_methods($controller_name);
}
// echo "<pre>";
// var_dump($multi_dimensional_array);
// echo "</pre>";
// the function below create makes one simple array and delete two methods 
foreach($multi_dimensional_array as $arrays)
        {
        //   testing code 
        //   echo "<pre>";
        //   var_dump($arrays);
        //   echo "</pre>";
        //   testing code 
            foreach($arrays as $key => $value)
            {
                if (($value == 'view') || ($value == 'model') || ($value == '__construct')) {
                    unset($arrays[$key]);
                } else {
                    $controller_methods[] = $value; 
                       }   
            } 
    
        }
        // echo "<pre>";
        // var_dump($controller_methods);
        // echo "</pre>";
// testing foreach below
 if (empty($url[1]) || empty($url[2])) {
    new Application();
    return $variable = TRUE;

} 
    foreach ($view_names as $view_name) {
        if ($view_name == $url[1]) {
            foreach ($controller_methods as $controller_method)
            {
               if ($controller_method == $url[2]) {
                  new Application();
                //   echo "We have the same method";
                  return $variable = TRUE;
               } 
            }
        }  
                       
      // testing code below
    //   echo"<pre>";
    //   var_dump($_SERVER['REQUEST_URI']);
    //   var_dump($url[1], $url[2]);
    //     echo"</pre>";
        
  } 
    // echo "The loop is ending";

    if ($variable !== TRUE) {
        $page_404 = new troubleController();
        $page_404->page_404();
    }
//     else {
//       $page_404 = new troubleController();
//       $page_404->page_404();
    
// }


// else {
//     $page_404 = new troubleController();
//     $page_404->page_404();
//     die;

// }
// should organize it in good function, now it has some problems
// create method which will check part of url if we have method in array it's OK else use header to 404.php PAGE
// if (@in_array($url[2], $controller_methods) && !empty($url[1]))
// {
//     new Application();
// } 
// else if (empty($url[2]) || empty($url[1])) {
//     new Application();
//     } 

// // the method below doesn't work properly
// else {  //empty($url[1] is for avoiding redirect to 404 page
//     $page_404 = new troubleController();
//     $page_404->page_404();
//           }

        //   testing code below
        // echo"<pre>";
        // var_dump($view_names);
        // var_dump($controller_methods);
        // echo"</pre>";
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
// new Application();
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
var_dump($_SESSION['user_id']);
















// testing foreach below
// if (empty($url[1]) || empty($url[2])) {
//     new Application();

// } elseif (!empty($url[1]) && !empty($url[2])) {
//     foreach ($view_names as $view_name) {
//         if ($view_name == $url[1]) {
//             foreach ($controller_methods as $controller_method)
//             {
//                if ($controller_method == $url[2]) {
//                   new Application();
//                   echo "We have the same method";
//                } 
//             }
//         } 
//         echo"<pre>";
                                        
//       // testing code below
//       var_dump($_SERVER['REQUEST_URI']);
//       var_dump($url[1], $url[2]);
//         echo"</pre>";
        
//   } 
//     echo "The loop is ending";

//    } else {
//       $page_404 = new troubleController();
//       $page_404->page_404();
    
// }






























    
?>




