<?php
require_once('../scripts/link.php');
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
require_once "header.php";
?>

<section class="catalog" id="catalog">
    <h2>Наши товары</h2>
    <div class="container">
        <div class="row">
            <?php
            $result = $link->query("SELECT * FROM products");
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                do {
                    echo "
                    <div class=\"product col-lg-3 col-md-4 col-sm-6\" data-product-id=\"".$row["id"]."\">               
                        <div class=\"product__img\"> <img src=\"../images/".$row["image"]."\" alt=\"Nice Cat\" /> </div>
                        <p class=\"product-name\">".utf8_decode($row["name"])."</p>
                        <div class=\"product-menu\">";

                    if($row["sale"]) {
                        $price = $row["price"] - ($row["price"] * ($row["sale"] / 100));
                        $price = (ceil($price*100) / 100);
                        echo "<div class=\"product-price sale\">$" . $price;
                    }
                    else echo "<div class=\"product-price\">$".$row["price"];

                    echo "</div>
                            <div class=\"how-many\">
                                <div class=\"quantity-input\">
                                    <input class=\"minus btn\" type=\"button\" value=\"-\">
                                    <input class=\"input-text quantity text\" value=\"1\" size=\"4\" data-quantity=\"".$row["quantity"]."\">
                                    <input class=\"plus btn\" type=\"button\" value=\"+\">
                                    <div class=\"stock\">На складе ".$row["quantity"]." товаров</div>
                                </div>
                            </div>
                            <button class=\"btn add-to-cart\">Добавить в корзину</button>
                        </div>
                    </div>
                            ";
                } while( $row = $result->fetch_assoc());
            }
            ?>
        </div>
    </div>
</section>

<div class="basket checkout-button">
    <img src="../images/shopping-basket.svg" alt="shopping-basket">
</div>

<?php
require_once "footer.php";
?>


<script defer src="../lib/jquery-3.3.1.js"></script>
<script defer src="../js/cart-script.js"></script>
<script defer src="../lib/simplebar.min.js"></script>

</body>
</html>