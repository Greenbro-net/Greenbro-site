<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Greenbro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
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


    
<form name="feedback" action="new_user.php " method="POST"
                     enctype="multipart/form-data">
    </span><br>
       <!-- <label for="sheet"> Enter here</label>
        <input type="text" name="sheet"> -->
       <label for="name">Ім'я</label>
       <input id="city" type="text" name="name" class="menu" placeholder="Ім'я" required><span></span><br>
       <label for="mail">Ел.пошта</label>
       <input id="mail" type="email" name="mail" class="menu" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" placeholder="Введіть електронну адресу" required><span></span><br>
       <label for="password">Пароль</label>
       <input id="password"  type="password"  name="password" class="menu" pattern="[a-zA-Z0-9]{6,20}" required placeholder="Введіть пароль"><span></span><br>
       <label for="two">Повторіть</label> 
       <input id="two" type="password"   name="two" class="menu" placeholder="Повторіть пароль" required pattern="[a-zA-Z0-9]{6,20}"><span></span><br>
       <label class="pic" for="number">Введіть число з картинки</label>
       <input id="number" type="text" class="picinput" pattern="[0-9]{5}"  placeholder="Введіть 5 цифр" required><span></span>


<div class="button">
<input type="submit" value="Зареєструватися" />
<!-- <label class="qwe" for="button"><input id="button" form="form" type="submit">Зарегистрироваться</label> -->
</div>
</form>
</div>



<div id="size"></div>

<?php
require "../scripts/footer.php";
?>


<script defer src="../lib/jquery-3.3.1.js"></script>
<script defer src="../js/cart-script.js"></script>
<script defer src="../lib/simplebar.min.js"></script>

</body>







