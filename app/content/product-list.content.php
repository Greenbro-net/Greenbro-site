<div id="product-grid">
   <div class="txt-heading">
     <div class="txt-heading-label">Товари</div>
    </div>

<?php
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

    <div class="product-title">
             <?php echo $product["name"]; ?>
           </div>
   
    <!-- the code below for write a response -->
    <div class="response_block">response</div>
    <!-- the code above for write a response -->

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
    <div class="display_description" id="show_description_<?php echo $product['id']; ?>">Our description))))
    <!-- the part of code below for image slider  -->
    <center>
       <!-- <div id="images"></div> -->
        
       <!-- we are there!!! -->
        <div  class="slider" onclick="zoomIn('bigger')">
            <div class="slider_images" id="images<?php echo $product["id"]; ?>"></div>
            <img  id="img_description_<?php echo $product['id']; ?>" src="../images/item_images/<?php echo $product['id']; ?>/0.jpg">
        
        </div>

        <br><br>
        <input type="button" onclick="changeSlide('prev')" value="Previous">
        <input type="button" onclick="changeSlide('next')" value="Next">
        <!-- <input type="button" onclick="zoomIn('smaller')" value="Make image smaller"> -->
    </center>



    <!-- the code below for description  -->
    <!-- <div class="hidden_class" id="hidden_description"> -->
             <?php echo $product["mini_description"]; ?>
             <?php echo "<br>"; ?>
             <?php echo $product["description"]; ?>
        <!-- </div> -->
    </div>
    <!-- the code above for showing description -->

    <?php
    }
 ?>
 </div>



  <!-- the code below for shows all grabing blocks of code which has to be reload  -->
  <div id="display_reload_cart_item"></div>

 