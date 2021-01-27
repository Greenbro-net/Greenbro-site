<?php
session_start();


// if (!isset($_SESSION['access_token'])) {
//     header('Location  https://greenbro.net/facebook/login');
//     exit(); 
// }
// create method which will display description and item_cart in current place of screen 

echo "ID";
echo $_SESSION['userData']['id'];
echo "<hr>";

echo "First Name";
echo $_SESSION['userData']['first_name'];
echo "<hr>";

echo "Last Name";
echo $_SESSION['userData']['last_name'];
echo "<hr>";

echo "Email";
echo $_SESSION['userData']['email'];
echo "<hr>";

?>
<img src="<?php echo $_SESSION['userData']['url']; ?>">

<?php 



require_once "vendor/autoload.php";
require_once "../config.php";


// $facebook_output = "";


// testing code below for autoloading 
$facebook = new \Facebook\Facebook([
    'app_id' => '884265225709842',
    'app_secret' => '88a78eda35cbb12323f383fdd7eac19e',
    'default_graph_version' => 'v9.0'

]);



        $handler = $facebook->getRedirectLoginHelper();

        $redirectTo = 'https://greenbro.net/facebook/login';
        $data = ['email'];
        $fullURL = $handler->getLoginUrl($redirectTo,  $data);



?>

<input type="button" onclick="window.location = '<?php echo $fullURL; ?>'" value="Login with Facebook">
<?php


// $data['email'] = "string";
// echo $data['email'];




// the code below from other lesson 
// if (isset($_GET['code'])) 
// {
//     if (isset($_GET['access_token']))
//     {
//         $access_token = $_SESSION['access_token'];
//     }
//     else
//     {
//         $access_token = $facebook_helper->getAccessToken();

//         $_SESSION['access_token'] = $access_token;

//         $facebook->setDefaultAccessToken($_SESSION['access_token']);
//     }

//     $graph_response = $facebook->get("/me?fields=name, email", $access_token);

//     // the code below grabs user data from facebook 
//     $facebook_user_info = $graph_response->getGraphUser();

//     // the block of code below sets session 
//     if (!empty($facebook_user_info['id']))
//     {
//         $_SESSION['user_image'] = 'http://graph.facebook.com/'
//         .$facebook_user_info['id'].'/picture';
//     }

//     if (!empty($facebook_user_info['name'])) 
//     {
//        $_SESSION['user_name'] = $facebook_user_info['name'];
//     }

//     if (!empty($facebook_user_info['email']))
//     {
//         $_SESSION['user_email_address'] = $facebook_user_info['email'];
//     }
//     // the block of code above sets session 
// }
//   else 
//   {
//       $facebook_permissions = ['email'];

//       $facebook_login_url = $facebook_helper->getLoginUrl('https://greenbro.net/facebook/login',
//               $facebook_permissions);
      
//       $facebook_login_url = '<div align="center"><a href="'.$facebook_login_url
//       .'"><img src="php-login-with-facebook.gif" /></a></div>';
//   }


// //   other block for login with facebook 
// if (isset($facebook_login_url))
// {
//     echo $facebook_login_url;
// }
// else
// {
//     echo '<div class="panel-heading">Welcome User</div><div class="
//     panel-body">';
//     echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive
//     img-circle img-thumbnail" />';
//     echo '<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';

//     echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';

//     echo '<h3><a href="logout.php">Logout</h3></div>';
// }

// testing code above for implementation of FB












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




