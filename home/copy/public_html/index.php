<?php
require_once('scripts/link.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    
    <title>Greenbro</title>
    <link rel="stylesheet" type="text/css" media="screen" href="cssgb.css" />
    <meta charset="UTF-8">
</head>


<body>
<div class="content">
 <div id="main">
<img id="logo"  src="logo1.jpg" alt="It is our logotype" title="logo">

 <p id="slogan1">You make this world better and </p>
 <br />
 <p id="slogan2"> we help you do it... </p>

</div>




<div id="leftcolumn"> </div>
<div id="rightcolumn">  </div>



    
<ul id="menu">
    <li><a href="scripts/foods.php">Продукти</a></li>
    <li><a href="scripts/clothes.php">Одяг</a></li>
    
    <li><a href="scripts/goods.php">Речі</a></li>
    <li><a href="scripts/books.php">Література</a></li>
    <li><a href="scripts/recipe.php">Рецепти</a></li>
    <li><a href="scripts/other.php"> Інше</a></li>
</ul>
<!-- <ul>
     <li><a href="scripts/recipe.php">Рецепти</a></li>
    <li><a href="scripts/other.php"> Інше</a></li>
</ul> -->
 
<a   href="scripts/callback_second.php">call_back</a> <br />
<a href="../registration/registration.php">registration here</a> <br />
 <?php
    require "scripts/footer.php";
   
   ?> 
<!-- <div id="footer_index">
      &copy; 2019, Greenbro
<p>
      All trademarks and registered trademarks appearing on 
      this site are the property of their respective owners.
</p>
    </div> -->

  </div>
</body>
</html>
