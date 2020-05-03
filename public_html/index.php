<?php

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'app' .  DIRECTORY_SEPARATOR);
define('VIEW', ROOT . 'app' . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODEL', ROOT . 'app' . DIRECTORY_SEPARATOR . 'model' . DIRECTORY_SEPARATOR);
define('DATA', ROOT . 'app' . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR);
define('CORE', ROOT . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR);
define('CONTROLLER', ROOT . 'app' . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR);
$modules = [ROOT,APP,CORE,CONTROLLER,DATA];



// The code below autoload functions for each classes 
function autoload($className)
{
    $modules = [ROOT,APP,CORE,CONTROLLER,DATA];

    foreach ($modules as $current_dir)
    {
        $path = $current_dir . $className . ".php";
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

new Application();


?>




