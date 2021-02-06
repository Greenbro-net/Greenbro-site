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
	 <?php if (isset($_SESSION['user_id'])) : ?>
	    <li  class="validation_button"><a class="validation_button" onclick="logout_user()" id="log_out_button">
	      <img src="<?php echo $url; ?>://greenbro.<?php echo $domen_part; ?>/images/image_for_validation/user_image_arrow.png" id="log_inout_img" alt="Вийти з системи">Вийти:)
	    </a></li>
		
     <?php else : ?>
	 <li  class="validation_button"><a class="validation_button" onclick="show_log_in()" id="log_in_button">
	  <img src="<?php echo $url; ?>://greenbro.<?php echo $domen_part; ?>/images/image_for_validation/user_image_arrow.png" id="log_inout_img" alt="Увійти в систему">Привіт)Увійти
	 </a></li>
	 <?php endif; ?>
	 </div>
	 <!-- code above for changing view for login and logout -->
     

	 	
	
	
	