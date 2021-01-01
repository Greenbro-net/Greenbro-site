<div id="product-grid">
   <div class="txt-heading">
     <div class="txt-heading-label">Товари</div>
    </div>

<?php
// the below function returns correct word for quantity of responses
 function choose_right_case($quantity_of_responses) 
{
    $last_digit = (substr($quantity_of_responses, -1));
   // 21,31, 41
   if ($last_digit == 1 ) {
       return "відгук";
   }
   // 22, 23, 24, 32, 33, 34, 42, 43, 44,   
   if ($last_digit == 2 || $last_digit == 3 || $last_digit == 4) {
       return "відгуки";
   }
   // 25,26,27, 28, 29, 30, 45, 46, 47,
   if ($last_digit >= 5 && $last_digit <=9 || $last_digit == 0) {
       return "відгуків";
   }

}

// function which shows messages about quantity of products
function showmessage($products) 
{    
    $message = "Є в наявності";
    if($products["quantity"] < 6) {
        $message = "Товар закінчується";
    } 
    if ($products["quantity"] == 0) {
        $message = "Товар закінчився";
    }
    return $message;
}


// the function below displays necessary message in comment block
function showCommentMessage($quantity_of_responses)
{
    if ($quantity_of_responses >= 1) {
    // there should be a function which displays us all comments for current id 
    // the function below returns  correct word for quantity of responses
    echo $quantity_of_responses . " " .choose_right_case($quantity_of_responses);
      } 
      // there are should be a function which posts a response to DB after onclick event
      else {
          echo "Залишити відгук";
           }
}


foreach($products as $product)
{
    ?>


<!-- we post item code other php scripts  -->
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
      <div class="response_block"><a href=""><?php 
         $quantity_of_responses = $product["response_count"];
         showCommentMessage($quantity_of_responses); ?>
        </a>
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
    <?php echo $product["price"]; ?> <te id="banknote">₴</te></div>
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
               <li ><a href="#item_tab2<?php echo $product['id']; ?>"><?php showCommentMessage($quantity_of_responses); ?></a></li>
            </ul>
          
            <div id="item_tab1<?php echo $product['id']; ?>" class="tab active"  data="<?php echo $product['id']; ?>">
               <h3><?php echo $product["name"]; ?></h3>
               <p>
                 <!-- the code below displays product name -->
            <div>
    </div>
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
              
               <!-- response-list.content.php later after fix all trouble -->
               <!-- the code below requires block for displaying comments  -->
               <?php     require_once 'comment/response-list.content.php'; ?>
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

 





  <!-- testing code below displays comments block  -->
  <div class="phppot-container">
      <div class="container">
          <h2>Start Rating Script in PHP</h2>
          <div id="course_list">
          
          </div>
      </div>
  </div>


  