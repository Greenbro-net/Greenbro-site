<?php
// the code below gets actual environment(url, domen_part)
$wrapper_obj = new WrapperController();
$domen_part = $wrapper_obj->get_domen_part(); 
$url = $wrapper_obj->get_url();

$shoppingCart = new ShoppingCart();


$united_order_items = $_SESSION["united_order_items"]; //you can integerate your authentication module here to get logged in member
?>
  
  <!-- code below for displays cart_item -->
  <div id="cart_item_code">
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
<!-- the block of code below displays us items in our cart -->

<!-- main container for cart items  -->
 <div id="shopping-cart-container" class="box">

  <div id="shopping-cart">
     <div class="txt-heading">
       <div class="txt-heading-label">Кошик товарів</div>
       <!-- the block below for empting item cart(delete all items in cart)  -->
        <input onclick="empty_cart_item(<?php echo $united_order_items; ?>)" id="btnEmpty" 
        src="/images/images_for_cart/empty-cart.png" alt="empty-cart" title="Очистити картку" type="image"
        class="float-right" />


        <div class="cart-status">
           <div>Загальна кількість: <span id="total-quantity"><?php echo $item_quantity; ?></span></div>
           <div>Загальна ціна: <span id="total-price"><?php echo $item_price . " грн"; ?></span></div>
        </div>
     </div>

<?php 
   if (! empty($cartItem)) {
       ?>
    <div class="shopping-cart-table">
             <div class="cart-item-container header">
                 <div class="cart-info title">Назва товару</div>
                 <div class="cart-info">Кількість</div>
                 <div class="cart-info price">Ціна</div>
    </div>
<!-- the block of code above displays us items in our cart -->
<?php
// the code below helps us avoid "invalid argument supplied for foreach()"
if (is_array($cartItem) || is_object($cartItem)){
     foreach ($cartItem as $item) {
         ?>
              <div class="cart-item-container">
              <div class="cart-info title">
              <!-- the code below displays item names in title block  -->
                   <?php echo $item["name"]; ?>
              </div>


              <div class="cart-info quantity" id="cart-info quantity">
                                                <!-- the are we can send variable in jquery function using echo $item["cart_id"] -->
                    <div class="btn-increment-decrement" onClick="decrement_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">-</div><input class="input-quantity"
                        id="input-quantity-<?php echo $item["cart_id"]; ?>" value="<?php echo $item["quantity_of_item"]; ?>"><div class="btn-increment-decrement"
                        onClick="increment_quantity(<?php echo $item["cart_id"]; ?>, '<?php echo $item["price"]; ?>')">+</div>
                </div>

              
              <div class="cart-info price" id="cart-price-<?php echo $item["cart_id"]; ?>">
                      <!-- the code below shows us item price in cart  -->
                      <?php echo  ($item["price"] * $item["quantity_of_item"]) . " грн"; ?>
                    </div>

             
             <!-- this block of code for deleting item in title block  -->
             <div class="cart-info action">
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
                                                          
           <!-- the block of code below for continuing make order  -->
           <form id="to_order" name="add_items_in_cart" action="<?php echo $url; ?>://greenbro<?php echo ".$domen_part"; ?>/customer/customer_route" method="POST"
                     enctype="multipart/form-data">
           <button id="button_to_order" type="submit">Оформлення замовлення
           </button>
           </form>
      <?php
}
// there are code which will execute if our cart_item is empty(without any products there)
   else {
      ?> <button id="button_continuing_shopping">Кошик товарів порожній, продовжити покупки</button> <?php
   }
   ?>
      </div>
   </div>

</div>