<?php
session_start();

if(empty($_SESSION['contact']))
{   
    $_SESSION['contact'] = 1;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <!-- <meta charset="utf-8"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
    <title>Greenbro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../other_css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../other_css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../other_css/goodsNew.css">
    <link rel="stylesheet" type="text/css" href="../lib/simplebar.css">
    <!-- css_for_contact.php -->
    <link rel="stylesheet" type="text/css" href="../other_css/contact_css.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="../images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="GreenBro">
    <meta name="application-name" content="GreenBro">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
    
    <!--js-script captcha by google-->
   <script src='https://www.google.com/recaptcha/api.js?hl=uk' async defer'></script>
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
// require_once "header.php";
?>

<div id="list_payment_delivery">
    <h2 id="title">Контакти</h2>
       <h4>Адреса:</h4>
       <p>м. Ірпінь, вул.Єсеніна 30</p>
       <p>Понеділок - П'ятниця з 9:00 до 18:00</p>
</div>

<div id="list_payment_delivery">
    <h4>Телефон:</h4>
    <p>(093) 770-72-71</p>
</div>

<div id="list_payment_delivery">
    <h4>Електронна адреса:</h4>
    <p>greenbro.net@gmail.com</p>
</div>

<!-- callback_form -->
    
<div class="contact_container">
    <!--#feedback -->
    <div id="contact_feedback">
    <!-- .head -->
    <div class="contact_head">
     <h4 id="contact_h4">Контактна форма</h4>
    </div>
<form action="contact_manage.php" id="form" method="POST" name="form">
   <input name="contact_name" pattern="^[А-Яа-яЁё\s]+$ 0-9]{3,25}" placeholder="Ім’я:" type="text" value="">
   <input name="contact_email" type="text" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Введіть свою електронну адресу" value="">
   <textarea id="contact_textarea" name="contact_textarea" pattern="^[А-Яа-яЁё\s]+$  0-9]{5,200}" placeholder="Текст листа"></textarea>
   
   <!-- this is for captcha -->
   <div class="g-recaptcha" data-sitekey="6LeKAbIUAAAAABOVTP-FERWRoVC_EU28uHUzcpYU"></div> 
   <!--element which enter the mistakes-->
   <div class="text-danger" id="recaptchaError"></div>
   
   <!--code top is for captcha-->
     <input id="send" name="submit" type="submit" value="Надіслати">  
   
</form>

    </div>
</div>




<?php
//this code whow error message if user doing something wrong
    if($_SESSION['contact'] == 65 && $_SESSION['contact_num'] >=2) {
      echo "<script> alert('Підтвердіть що ви не робот, заповніть всі поля форми та  натисніть `Надіслати`.'); </script>";
       unset($_SESSION['contact_num']);
       unset($_SESSION['contact']);
    }
    
//this code whow error message if user doing something wrong in textarea
    if($_SESSION['contact'] == 66 && $_SESSION['contact_num'] >=2) {
      echo "<script> alert('Були введені недопустимі символи, заповніть всі поля форми та  натисніть `Надіслати`.'); </script>";
       unset($_SESSION['contact_num']);
       unset($_SESSION['contact']);
    }
?>


<!-- callback_form -->

<?php
require_once "footer.php";
?>


<script defer src="../lib/jquery-3.3.1.js"></script>
<script defer src="../js/cart-script.js"></script>
<script defer src="../lib/simplebar.min.js"></script>

</body>
</html>