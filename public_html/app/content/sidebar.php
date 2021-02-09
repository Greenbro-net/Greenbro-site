<!-- the code below can pass variable in href -->
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/food/show_food">Продукти</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/clothes/show_clothes">Одяг</a></li>    
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/goods/show_goods">Речі</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/book/show_books">Література</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/home/allThings">Все разом</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/home/paymentShipping">Оплата і доставка</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/home/contactUs">Контакти</a></li>

	 
	 <!-- code below for changing view for login and logout -->
	 <div id="reload_window_1" class="reload_container">


    <!-- testing code below -->
	<?php 
		$view_val_obj  = new ViewValidationController();
		$view_val_obj->call_manager();

	?>
	 <!-- function for log  out below -->
	 <!-- onclick="logout_user()" id="log_out_button" --> 
	 
	 <!-- the sign below for log out -->
	 
	 <!-- the code below menu for user who was logged in  -->
	 <div class="user_loggedin_menu" id="user_loggedin_menu">
	   <li class="user_loggedin_menu_li" onclick="logout_user()">Вийти:)</li>
	   <li class="user_loggedin_menu_li" >Допомога</li>
	   <li class="user_loggedin_menu_li" >Видалити дані з сайту</li>
	 </div>
	 
	 
			<!-- the code below displays casual image and name of user   -->
	<!-- <li  class="validation_button"><a class="validation_button" onclick="logout_user()" id="log_out_button">
	<img src="<?php echo $url; ?>://greenbro.<?php echo $domen_part; ?>/images/image_for_validation/user_image_arrow.png" id="log_inout_img" alt="Вийти з системи">Вийти:)
	</a></li> -->
		
    

	 </div>
	 <!-- code above for changing view for login and logout -->
     

	 	
	
	
	