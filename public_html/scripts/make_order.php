<!-- <!DOCTYPE html>
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

<body> -->
<!-- Checkout popup window -->
<!-- <div id="checkoutPopup" class="popup">
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
</div> -->
<!-- End of checkout popup -->

<!-- Description popup window -->
<!-- <div id="descriptionPopup" class="popup">
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
</div> -->
<!-- End of checkout popup -->

<?php
// require_once "header.php";
?>
<form id= "make_order " name="make_order" action="order_controller.php " method="POST"
                     enctype="multipart/form-data">
<!-- making_order -->
<div>
<h3>Оформлення замовлення </h3>
<br>

<h4>1. Ваші контактні дані </h4>
<!-- Personal contact information  -->

 <p> Ім'я</p>
 <p>Прізвище <p>
 <p>Місто</p>
 <p>Мобільний телефон </p>
 
 <h4>2. Замовлення</h4>
 <!-- List of products -->
 <br>

<h4>3. Доставка</h4>
<!-- Method of delivery  -->
<br>
<p><input type="radio" id="radioButton" name="delivery" value="post_office" >&nbsp;&nbsp;Самовивіз з Нової Пошти</p>
<textarea name="post_office" placeholder="Введіть адресу та номер відділення "> </textarea>
<p><input type="radio" id="radioButton" name="delivery" value="courier">&nbsp;&nbsp;Доставка кур'єром</p>


<h4>4. Оплата</h4>
<!-- Way of payment  -->
<br>
<p><input type="radio" id="radioButton" name="payment" value="cash" >&nbsp;&nbsp;Оплата при отриманні товару</p>
<p><input type="radio" id="radioButton" name="payment" value="without_cash">&nbsp;&nbsp;Карткою чи за допомогою онлайн банкінгу</p>

<!-- Contact information about person who will get goods  -->
<h4>5. Контактні дані отримувача замовлення </h4>
<br>
       <!-- Enter name -->
       <label for="recipient_information">Ім'я</label>
       <input id="contact_information"  type="text" name="recipient_name" class="menu" pattern="^[А-Яа-яЁё\s]+$  0-9]{5,25}"  placeholder="Введіть ім'я" required><span></span><br>
       <!-- enter fathers name -->
       <label for="recipient_information">По батькові</label>
       <input id="contact_information"  type="text" name="recipient_father_name" class="menu" pattern="^[А-Яа-яЁё\s]+$  0-9]{5,25}"  placeholder="Введіть ім'я по батькові" required><span></span><br>
        <!-- enter last name -->
       <label for="recipient_information">Прізвище </label>
       <input id="contact_information"  type="text" name="recipient_last_name" class="menu" pattern="^[А-Яа-яЁё\s]+$  0-9]{5,25}" placeholder="Введіть прізвище" required><span></span><br>
        <!-- enter mobile number -->
        <label for="recipient_information">Мобільний телефон</label>
       <input id="contact_information"  type="text" name="recipient_mobile_number" class="menu" pattern="([0]{1}[0-9]{9}" placeholder="Введіть мобільний телефон" required><span></span><br>
        
        <input type="submit" value="Замовлення підтверджую" >
 </div>
 </form>



<?php
// require_once "footer.php";
?>


<!-- <script defer src="../lib/jquery-3.3.1.js"></script>
<script defer src="../js/cart-script.js"></script>
<script defer src="../lib/simplebar.min.js"></script>

</body>
</html> -->