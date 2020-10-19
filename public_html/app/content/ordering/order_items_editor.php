
<?php
$shoppingCart = new ShoppingCart();

$united_order_items = $_SESSION["united_order_items"]; //you can integerate your authentication module here to get logged in member
?>

<!-- the code below are title of delivery_payment_type page  -->
<div id="user_ordering_form">
<h3>Оформлення замовлення </h3>
<br>
<h4>2. Деталі замовлення </h4>
</div>


<!-- code below for displays cart_item -->
  <div id="cart_item_editor">
<?php
$cartItem = $shoppingCart->getMemberCartItem($united_order_items);

if (! empty($cartItem)) {
   // the code below helps us avoid notice "undefined variable"
   $item_quantity = 0;
    $item_price = 0;

    // the code below helps us avoid "invalid argument supplied for foreach()"
    if (is_array($cartItem) || is_object($cartItem)){
    if (! empty($cartItem)) {
        foreach ($cartItem as $item) {
            $item_quantity = $item_quantity + $item["quantity_of_item"];
            // the code below counts sum of items in cart 
            $item_price = $item_price + ($item["price"] * $item["quantity_of_item"]);
                                     }
                            }
                                                    }
   } else {
   // the code below helps us avoid notice "undefined variable"
   $item_price = 0;
   $item_quantity = 0;
          }
?>

<!-- main container for cart items  -->
 <div id="shopping-cart-editor" class="box-editor">     
 
<!-- there are we should display all items which customer puts inside item_cart with small images and total price  -->
<!-- and customer should have opportunity to edit his order, create button for it  -->

<?php 
   if (! empty($cartItem)) {
       ?>
    <div class="shopping-cart-table-editor">
             <div class="cart-item-container header-editor">
                 <div class="cart-title-editor">Назва товару</div>
                 <div class="cart-info-editor">Кількість</div>
                 <div class="cart-price-editor">Ціна</div>
                 <div class="cart-total-price-editor">Сума</div>
    </div>
<!-- the block of code above displays us items in our cart -->
<?php
// the code below helps us avoid "invalid argument supplied for foreach()"
if (is_array($cartItem) || is_object($cartItem)){
     foreach ($cartItem as $item) {
         ?>
              <div class="cart-item-container-editor">
              <div class="cart-info title-editor">
              <!-- the code below displays item names in title block  -->
                   <?php echo $item["name"]; ?>
              </div>
              <!-- the code below displays us small item image  -->
              <div id="block-editor-image"><img id="items-editor-image" src="../images/item_images/<?php echo $item["cart_id"]; ?>/0.jpg"></div>
              
              <div class="cart-info quantity" id="cart-info-quantity-editor">
                                                <!-- the are we can send variable in jquery function using echo $item["cart_id"] -->
                    <div class="btn-increment-decrement-editor" title="Зменшити кількість" onClick="decrement_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">-</div><input class="input-quantity"
                     id="input-quantity-<?php echo $item["cart_id"]; ?>" value="<?php echo $item["quantity_of_item"]; ?>"><div class="btn-increment-decrement-editor" title="Збільшити кількість"
                        onClick="increment_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">+</div>
                </div>


               <!-- the code below displays us  item price  -->
               <div class="cart-info-total-price-editor" id="cart-total-price-<?php echo $item["cart_id"]; ?>">
                      <!-- the code below shows us item price in cart  -->
                      <?php echo  $item["price"]  . " грн"; ?>
              </div>
              <!-- the code below displays us items price for quantity -->
              <div class="cart-info-price-editor" id="cart-price-<?php echo $item["cart_id"]; ?>">
                      <!-- the code below shows us items price for their quantity   -->
                      <?php echo  $item["price"] * $item["quantity_of_item"] . " грн"; ?>
              </div>
             

             <!-- this block of code for deleting item in title block  -->
             <div class="cart-info action-editor">
              <div id="<?php echo $item['id']; ?>"
                 
                 class="btnRemoveAction"><img class="remove_button" onclick="removeItem(<?php echo $item['id']; ?>)"
                 src="/images/images_for_cart/icon-delete.png" alt="icon-delete"
                 title="Видалити позицію" /></div>
             </div>
           </div>
             <?php
     }
  }
     ?>
   </div>
   

      <?php
}
   
   ?>
   <div id="txt-heading-editor" class="txt-heading-editor">

        <div class="cart-status-editor">
           <div>Загальна кількість: <span id="total-quantity"><?php echo $item_quantity; ?></span></div></br>
           <div>Загальна сума: <span id="total-price"><?php echo $item_price . " грн"; ?></span></div>
        </div>
     </div>
      </div>
   
<!-- main div below which is reload -->
</div>
