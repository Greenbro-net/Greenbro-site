<?php
require_once('Routes.php');

function __autoload($class_name) {
    if(file_exists('./classes/'.$class_name.'.php')) {
        require_once './classes/'.$class_name.'.php';
    } else if (file_exists('./Controllers/'.$class_name.'.php')) {
        require_once './Controllers/'.$class_name.'.php';
    }
}
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Greenbro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" type="text/css" ng-href="other_css/normalize.css">
    <link rel="stylesheet" type="text/css" ng-href="other_css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" ng-href="other_css/goodsNew.css">
    <link rel="stylesheet" type="text/css" ng-href="lib/simplebar.css">

    <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <link rel="mask-icon" href="images/safari-pinned-tab.svg" color="#5bbad5">
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
require_once "scripts/header.php";
?>


        </div>
    </div>
</section>

<div class="basket checkout-button">
    <img src="images/shopping-basket.svg" alt="shopping-basket">
</div>

<!--For testing future registration-->
<!--<br />-->
<!-- <div id ="back_home">-->
<!--<a   href="../index.php">back home</a>-->
<!--<br>-->
<!--<a href = "http://greenbro.net/registration/registration.php">registration</a>-->
<!-- </div>           -->


<!--<div id="size"></div>-->

<?php
require "scripts/footer_index.php";
?>


<script defer src="lib/jquery-3.3.1.js"></script>
<script defer src="js/cart-script.js"></script>
<script defer src="lib/simplebar.min.js"></script>

</body>
</html>


