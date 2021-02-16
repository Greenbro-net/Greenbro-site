<!-- the code below can pass variable in href -->
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/food/show_food">Продукти</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/clothes/show_clothes">Одяг</a></li>    
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/goods/show_goods">Речі</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/book/show_books">Література</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/home/allThings">Все разом</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/home/paymentShipping">Оплата і доставка</a></li>
	 <li><a href="//greenbro.<?php echo $domen_part; ?>/home/contactUs">Контакти</a></li>

      
	 <!-- code below is anchor for pop up messages -->
		  <div class="login_message_place" id="login_message_place"></div>
		  <div class="registration_message_place" id="registration_message_place"></div>
	 
	 <!-- code below for changing view for login and logout -->
	 <div id="reload_window_1" class="reload_container">


    <!-- code below calls method from controller -->
	<?php 
		$view_val_obj  = new ViewValidationController();
		$view_val_obj->call_manager();
	?>
	 
	 <!-- the code below menu for user who was logged in  -->
	 <div class="user_loggedin_menu" id="user_loggedin_menu">
	    <li class="user_loggedin_menu_li" onclick="logout_user()">Вийти:)</li>
	    <li class="user_loggedin_menu_li" >Допомога</li>
	    <li class="user_erase_button_li" onclick="delete_user_data()">Видалити дані з сайту</li>
	 </div>

	</div>
	 <!-- code above for changing view for login and logout -->
     

	 	
	
	
	