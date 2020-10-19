<?php
session_start();

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' .  DIRECTORY_SEPARATOR);
define('VIEW', ROOT . 'app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
// for library
define('LIBRARY', ROOT . 'app' . DIRECTORY_SEPARATOR . 'library' . DIRECTORY_SEPARATOR);
// for content folder
define('CONTENT', ROOT . 'app' . DIRECTORY_SEPARATOR . 'content' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'app' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define('DATA', ROOT . 'app' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . 'app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
$modules = [ROOT,APP,CORE,CONTROLLER,DATA,CONTENT];



// fucnction what is checkingout url 
// now the function only checkouts methods and doesn't work with controller
 function checkout_url()
{
// the function below checkout does page exists or not 
// if page does not exists you will be located in index.php
$url = (explode( '/', $_SERVER['REQUEST_URI']));

// folder where we store our classes 
$files_name = scandir('../app/controller');

foreach($files_name as $array_key => $file_name ) {

    // the code below deletes empty arrays from array 
    if (($file_name == '.') || ($file_name == '..')){
        unset($files_name[$array_key]);
    } else {
        $file_name = explode('.', $file_name);
        // the arrays below have names of classes  
        $files_name[$array_key] = $file_name[0];
    }
}

// the function below gets methods name and create array with class methods
foreach($files_name as $key => $value) {

        $multi_dimensional_array[] = get_class_methods($value);
}


// the function below create makes one simple array and delete two methods 
foreach($multi_dimensional_array as $arrays)
        {
        //   testing code 
        // echo "<pre>";
        //    var_dump($arrays);
        //    echo "</pre>";
        //   testing code 
            foreach($arrays as $key => $value)
            {
                if (($value == 'view') || ($value == 'model')) {
                    unset($arrays[$key]);
                } else {
                    $controller_methods[] = $value; 
                       }   
            } 
    
        }


// test coding 

// create method which will check part of url if we have method in array it's OK else use header to 404.php PAGE
if (empty($url[2]) || empty($url[1])) {
        new Application();
    } 

if (in_array($url[2], $controller_methods) && !empty($url[1]))
{
    new Application();
}else {  //empty($url[1] is for avoiding redirect to 404 page
    $page_404 = new troubleController();
    $page_404->page_404();
          }
// test coding          
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
// @var_dump($_SESSION["last_customer_id"]);

// the code below show number of customer order 
// @var_dump($_SESSION["united_order_items"]);
// testing code 


// we require php script below for escaping notice undefined index "action"
require_once "../app/controller/itemController.controller.php";

// we fixed notice Undefined action with @
?>




