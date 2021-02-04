<?php
session_start();
require_once "config.php";

echo "<h2>Login with Facebook</h2>";


        $redirectTo = 'https://greenbro.net/scripts/facebook/callback.php';
        $data = ['email'];
        $fullURL = $handler->getLoginUrl($redirectTo,  $data);



?>

<input type="button" onclick="window.location = '<?php echo $fullURL; ?>'" value="Login with Facebook">

