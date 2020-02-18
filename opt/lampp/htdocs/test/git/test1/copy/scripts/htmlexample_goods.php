<?php
require_once('link.php');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    
    <title>Greenbro</title>
    <link rel="stylesheet" type="text/css" media="screen" href="../cssgb.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../other_css/goods.css" />
    <meta charset="UTF-8">
    <!-- <link  src="../Other_CSS/jquery-ui.css"/> -->
    <link   href="../jquery-ui-1.12.1.custom/jquery-ui.css" rel="stylesheet"/>
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="../Other_CSS/fa-svg-with-js.css" /> -->
    
    
    <!-- Тележка над картинкой -->
    <script defer src="../fontawesome/fontawesome-all.js"></script>

    <script defer src="../fontawesome/fontawesome-all.min.js"></script>
    <script defer src="../fontawesome/fa-brends.js"></script>
    <script defer src="../fontawesome/fontawesome.js"></script>
    <script defer src="../fontawesome/fontawesome-all.js"></script>
    <script defer src="../fontawesome/fontawesome-all.js"></script>
    <script type="text/javascript" src="../jquery-ui-1.12.1.custom/external/jquery/jquery.js"></script>
    <!-- <script type="text/javascript" src="../jquery-ui-1.12.1.custom/index.html"></script>  -->
    <script defer src="../lib/jquery-3.3.1.js"></script>
    <script defer src="../js/cart-script.js"></script>
    
   

 
	<!-- <link href="jquery-ui.css" rel="stylesheet"> -->
	<style>
	body{
		font-family: "Trebuchet MS", sans-serif;
		margin: 50px;
	}
	.demoHeaders {
		margin-top: 2em;
	}
	#dialog-link {
		padding: .4em 1em .4em 20px;
		text-decoration: none;
		position: relative;
	}
	#dialog-link span.ui-icon {
		margin: 0 5px 0 0;
		position: absolute;
		left: .2em;
		top: 50%;
		margin-top: -8px;
	}
	#icons {
		margin: 0;
		padding: 0;
	}
	#icons li {
		margin: 2px;
		position: relative;
		padding: 4px 0;
		cursor: pointer;
		float: left;
		list-style: none;
	}
	#icons span.ui-icon {
		float: left;
		margin: 0 4px;
	}
	.fakewindowcontain .ui-widget-overlay {
		position: absolute;
	}
	select {
		width: 200px;
	}
	</style>
</head>

<body>

 <div id="main">
<img id="logo"  src="../images/logo1.jpg" alt="It is our logotype" title="logo">

 <p id="slogan1">All things what you need.. </p>
 <br />
 <p id="slogan2"> and other healthy, tasty things... </p>

</div>

<div id="leftcolumn"> </div>
<div id="rightcolumn">  </div>



 <body>
        
    <section class="wrapper container special" id="featured">
        <h1>Hello, Cart!</h1>        
            
       



        
       
        <?php
            $result = $link->query("SELECT * FROM products");
            if($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                do {
                    echo "
<div class=\"nav\">
    <div>
        <div class=string>
            <div class=\"grid-layout\">
                <article class=\"grid-item\">
                    <div class=\"product\" data-product-id=\"".$row["id"]."\">
                        <p class=\"product-name\">".utf8_decode($row["name"])."</p>
                        <div class=\"icon\">
                            <div class=\"icon-background\"></div>
                            <span class=\"shopping-cart\"> <i class=\"fas fa-shopping-cart fa-2x\"></i> </span> </div>
                        <div class=\"product-picture\"> <img src=\"../images/".$row["image"]."\" alt=\"Nice Cat\" /> </div>
                        <div class=\"product-menu\">
                            <div class=\"product-price\">$".$row["price"]."</div>
                            <div class=\"buy-now\"> Buy now!</div>
                            <div class=\"product-detail\"> Detail</div>
                            <div class=\"how-many\">
                                <div class=\"quantity-input\">
                                    <input class=\"minus btn\" type=\"button\" value=\"-\">
                                    <input class=\"input-text quantity text\" value=\"0\" size=\"4\" data-quantity=\"".$row["quantity"]."\">
                                    <input class=\"plus btn\" type=\"button\" value=\"+\">
                                    <div class=\"stock\">На складе ".$row["quantity"]." товаров</div>
                                </div>
                            </div>
                            <div class=\"cancel\"> Cancel</div>
                            <div class=\"add-to-cart\"> Add to Cart!</div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
                    ";
                } while( $row = $result->fetch_assoc());
            }
        ?>

   
        
<!--first was here-->

      </section>

               <!-- Finish -->

<!-- Start     second line-->

<!--second was here-->

               <!-- Finish second line -->
              
    
        <!-- Aside Area Start -->
        <aside id="cart-sidebar" class="cart">
            <a href="" class="remove"><i class="fas fa-times fa-2x"></i></a>
            
            <h2>Cart</h2>
            <!-- cart-items start-->
            <ul class="cart-items">

            </ul> 
            <!-- cart-items end -->
        
            <div class="cart-total">
                <p>Total $<span id="total"></span></p>
            </div> <!-- cart-total -->
        
            <a href="#" class="checkout-button">Checkout</a>
        </aside> <!-- cart end -->
        <!-- Aside Area end -->   
        
        



        
        <script>
    
          // document.addEventListener("DOMContentLoaded", ready);
    
          //   function ready() {
          //       document.getElementById("cart-trigger").addEventListener('click', function () {
          //           document.getElementById("cart-sidebar").classList.add('show-sidebar');
          //           }
          //       );
                
          //       document.querySelector("#cart-sidebar .remove").addEventListener('click', function () {
          //           document.getElementById("cart-sidebar").classList.remove('show-sidebar');
          //           }
          //       );
    
          //     var hamburgerToggle = document.querySelector('#menu-trigger');
        
          //     hamburgerToggle.addEventListener('click', function(e){
          //         e.preventDefault();
          //         document.querySelector('.mainmenu').classList.toggle('active');
          //     });
                
          //   }
    
          
          </script>

 
<div id ="back_home">
<a   href="../index.php">back home</a>
 </div>









	



<?php
    require "footer.php";
   
   ?> 
</body>
</html>