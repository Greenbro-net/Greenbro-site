<!-- the code below allows us change .com(for developer) or .net(for production) -->
<?php
$domain = "com"; //for developer 
// $domain = "net"; //for production


// the code below can pass variable in href
	 echo   
	 "<ul id=\"menu\">

	 <li><a href=\"//greenbro.$domain/food/show_food\">Продукти</a></li>
	 <li><a href=\"//greenbro.$domain/home/clothesPage\">Одяг</a></li>    
	 <li><a href=\"//greenbro.$domain/home/goodsPage\">Речі</a></li>
	 <li><a href=\"//greenbro.$domain/home/booksPage\">Література</a></li>
	 <li><a href=\"//greenbro.$domain/home/allThings\">Все разом</a></li>
	 <li><a href=\"//greenbro.$domain/home/paymentShipping\">Оплата і доставка</a></li>
	 <li><a href=\"//greenbro.$domain/home/contactUs\">Контакти</a></li>	

    </ul>";

?>	
	