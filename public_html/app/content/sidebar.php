<!-- the code below allows us change .com(for developer) or .net(for production) -->

<!-- the code below can pass variable in href -->
	 
	 <li><a href="//greenbro.<?php echo $domain; ?>/food/show_food">Продукти</a></li>
	 <li><a href="//greenbro.<?php echo $domain; ?>/clothes/show_clothes">Одяг</a></li>    
	 <li><a href="//greenbro.<?php echo $domain; ?>/goods/show_goods">Речі</a></li>
	 <li><a href="//greenbro.<?php echo $domain; ?>/book/show_books">Література</a></li>
	 <li><a href="//greenbro.<?php echo $domain; ?>/home/allThings">Все разом</a></li>
	 <li><a href="//greenbro.<?php echo $domain; ?>/home/paymentShipping">Оплата і доставка</a></li>

     <!-- TO DO create method when user log in system, button logout in sidebar unset session after onclick  -->
	 <!-- code below for changing view for login and logout -->
	 <?php if (isset($_SESSION['user_id'])) : ?>
	    <!-- <li id="validation_button" class="validation_button"><a class="validation_button">
	      <img src="http://greenbro.<?php echo $domain; ?>/images/image_for_validation/user_image_arrow.png" id="test" alt="Увійти в систему">Привіт)Вийти
	    </a></li> -->
		<li><a href="//greenbro.<?php echo $domain; ?>/validation/logout">Logout</li>
     <?php else : ?>
	 <li id="validation_button" class="validation_button"><a class="validation_button">
	  <img src="http://greenbro.<?php echo $domain; ?>/images/image_for_validation/user_image_arrow.png" id="test" alt="Увійти в систему">Привіт)Увійти
	 </a></li>
	 <?php endif; ?>
	 <!-- code below for changing view for login and logout -->


	 <li><a href="//greenbro.<?php echo $domain; ?>/home/contactUs">Контакти</a></li>	
	
	
	