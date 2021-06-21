<div id="product-grid">
    <div class="txt-heading">
        <div class="txt-heading-label">Товари</div>
    </div>

<?php

foreach($products as $product)
{
    ?>

<!-- there are we chouse quantity of items in window and can add item
using post method we send variable to php script -->
    <div class="product-item" id="item_label<?php echo $product['id']; ?>" data="<?php echo $product['id']; ?>">
    <!-- the code below posts that we did adding action and code of item  -->
    
        <div class="product-image">
            <!-- the code below show us item picture  -->
            <img src="../images/item_images/<?php echo $product["id"]; ?>/0.jpg">   
        </div>

        <div id="product_title" class="product-title">
                <?php echo $product["name"]; ?>
        </div>
   
    <!-- the code below displays us quantity of comments in product list page -->
      <div class="response_block">
        
      <?php  
       $quantity_of_responses = $product["response_count"];
       App\Controller\MessageController::calldisplayCommentSentence($quantity_of_responses, $product['id']);
      ?>
            
      </div>
    <!-- the code above displays us a quantity of responses -->

    <div class="product-footer">
    <!-- the button below adds item to DB table  -->
       <div class="float-right">
         <input type="text" id="<?php echo $product['id']; ?>" name="quantity_of_item" value="1"
            size="2"  class="input-cart-quantity" />
            <!-- the code below adds button for executing function onAdd  -->
            <input onclick="onAdd(<?php echo $product['id']; ?>)" id="display" type="image"
            src="../images/images_for_cart/add-to-cart.png" class="btnAddAction" title="Додати товар у кошик"/>
        </div>

        <div class="product-price float-left" id="product-price-
            <?php echo $product["name"]; ?>">
            <?php echo $product["price"]; ?> <te id="banknote">₴</te>
        </div>
                      <!-- hidden field for pass price to item_cart_script -->
                      <input id="price_<?php echo $product["id"]; ?>" type=hidden value="<?php echo $product["price"]; ?>">
       </div>
    </div>
    <!-- the div above from product item container -->


    <!-- the code below for showing description -->
    <div class="display_description" id="show_description_<?php echo $product['id']; ?>">

         <!-- the code below displays description of item and comments  -->
        <div class="tabs">
            <ul class="tabs-list">   
               <li id="tabs-list-li<?php echo $product['id']; ?>" ><a href="#item_tab1<?php echo $product['id']; ?>">Все про товар</a></li>
               <li ><a href="#item_tab2<?php echo $product['id']; ?>"><?php App\Controller\MessageController::showCommentMessage($quantity_of_responses); ?></a></li>
            </ul>
          
            <div id="item_tab1<?php echo $product['id']; ?>" class="tab active"  data="<?php echo $product['id']; ?>">
               <h3><?php echo $product["name"]; ?></h3>
               <p>
                 <!-- the code below displays product name -->
        
                 <!--  code above displays item name -->

                   <!-- the part of code below for image slider  -->
                   <center>
                   <div  class="slider" onclick="zoomIn('bigger')">
                      <div class="slider_images" id="images<?php echo $product["id"]; ?>"></div>
                      <img  id="img_description_<?php echo $product['id']; ?>" src="../images/item_images/<?php echo $product['id']; ?>/0.jpg">
                   </div>

                       <br><br>


                   <input type="button" onclick="changeSlide('prev')" value="Previous">
                   <input type="button" onclick="changeSlide('next')" value="Next">
                   <!-- <input type="button" onclick="zoomIn('smaller')" value="Make image smaller"> -->
                   </center>
                   
                  <?php echo $product["mini_description"]; ?> 
                  <?php echo "<br>"; ?> 
                  <?php echo $product["description"]; ?>
               </p>
            </div>
              <div id="item_tab2<?php echo $product['id']; ?>" data="<?php echo $product['id']; ?>" class="tab">
              
              
               <!-- the code below requires block for displaying comments  -->
               <?php     
               require 'comment/response-list.content.php'; 
               ?>
               <!-- the code above displays us comments from DB -->
              </div>
                      
        </div>
    <!-- the div above menu-description-container  -->
    
    </div>
    <!-- the code above for showing description -->

    <?php
    }
 ?>

  </div>

  <!-- the code below for shows all grabing blocks of code which has to be reload  -->
  <div id="display_reload_cart_item"></div>

 


  