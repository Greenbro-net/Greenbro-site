<?php
session_start();


if (!isset($_SESSION['access_token'])) {
    header('Location  https://greenbro.net/scripts/facebook/login.php ');
    exit(); 
}


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

// the code below for displays user picture 
?>
<img src=<?php echo $_SESSION['userData']['picture']; ?> />



