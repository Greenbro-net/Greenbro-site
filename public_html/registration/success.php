<?php
require_once '../database_connection/database_connection.php';
require_once '../messages/array_messages.php';

if (!isset($_REQUEST)){
    echo "Something go wrong";
    die;
    } 
    // var_dump($_REQUEST);
    $number=$_REQUEST['user_id'];
    
    // SELECT  `name`, `mail`, `password` FROM `registration` WHERE `user_id`=1
    
    
    // Function for pulling value from datebase
    
    $select_v = "SELECT `name`, `mail` FROM `registration` WHERE `user_id` = $number  "; 
    
        $select_result = mysqli_query($link, $select_v)
        or die(mysqli_error($link));  
        // var_dump($select_result);
    
    
    
    $yourArray = array();
    $index = 0;
    while($row = mysqli_fetch_assoc($select_result)){
        $yourArray[$index] = $row;
        $index++;
    }
    $array = array();
        
        while($row1 = mysqli_fetch_assoc($select_result)) {
           $array[] = $row1;
        }
    // var_dump($yourArray);
    
    // var_dump ($array);
    foreach($yourArray as  $value){
       
    }
    // var_dump($value);
    foreach($value as $key =>$value1){
    }
    $name=$value['name'];
    $mail=$value['mail'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Greenbro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../other_css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../other_css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../other_css/goodsNew.css">
    <link rel="stylesheet" type="text/css" href="../lib/simplebar.css">
    <!-- This is for registration page -->
    <link rel="stylesheet" type="text/css" media="screen" href="../other_css/registration_css.css" />

    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="../images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="GreenBro">
    <meta name="application-name" content="GreenBro">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
    <!-- Checkout popup window -->
<div id="checkoutPopup" class="popup">
    <div class="container popup-content" data-simplebar>
        <div class="row">
            <div class="col-lg-12">
                <span class="close">&times;</span>
                <h2>Ваш заказ:</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class=" checkout-cart col-lg-10 offset-lg-1 col-md-12"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="checkout__end col-lg-10 offset-lg-1 col-md-12">
                <p>Итого $<span id="total"></span></p>
                <button class="btn checkout__end-btn">Оформить заказ</button>     
            </div>
        </div>
    </div>
</div>
<!-- End of checkout popup -->

<!-- Description popup window -->
<div id="descriptionPopup" class="popup">
    <div class="container popup-content" data-simplebar>
        <div class="row">
            <div class="col-lg-12 ">
                <span id="closeDescription" class="close">&times;</span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="description col-lg-8 offset-lg-2 col-md-12">
                        <div class="description_block">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of checkout popup -->

<?php
require_once "../scripts/header.php";
?>

<!-- If user does not find, show a mistake -->
<div id="success_messages">
    <div class="success">
        <p id="success_words"><?php echo $_MESSAGES['success']; ?></p>
    </div>
</div>


 
         <div class="user_profile">
         <h1><?php echo "Ім'я користувача: $name" ?></h1>
         <h1 class="contact_info">  <?php echo "Електронна пошта зареєстрована на сайті: $mail"; ?></h1>
         <h1><?php echo " Перейдіть за вказаною електронною поштою для підтвердження реєстрації: $mail"; ?></h1>         
</div>

    <!-- If user does not find, show a mistake -->
<div id="success_messages">
    <div class="success_messages">
        <p><?php echo $_SESSION['message_password'], $_SESSION['message_name'], $_SESSION['message_mail']?></p>
    </div>
</div>


<div id="size"></div>

<?php
require "../scripts/footer.php";
?>

<script defer src="../lib/jquery-3.3.1.js"></script>
<script defer src="../js/cart-script.js"></script>
<script defer src="../lib/simplebar.min.js"></script>

</body>
</html>






