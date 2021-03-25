    // the code below gets right url setting for app  
    var json = $.getJSON({'url': "/config_settings.json", 'async': false});
    json = JSON.parse(json.responseText);
    domen_part = json.domen_part;
    url = json.url;
    
    
      // the code below can reload a page 
      // $("#display_reload_cart_item").load("http://greenbro.com/food/show_food/" + ' #cart_item_code');        



// the function below displays us cart item 
$(document).ready(function () {

$('#basket_checkout_button, #shopping-cart-container').click(function(ee) {    // Added .box to the click-function

    if ($(this).attr("class") == "box") { // check if the clicked element is .box(box what was opened does not closes after click on it)
      return false;                       // do nothing like return false
    }   
   // the code below reload shopping-cart-container and displays correct info of item after updating 
   $("#display_reload_cart_item").load(url+"://greenbro."+domen_part+"/cart/show_cart_item/" + ' #cart_item_code', show_pager);

    // stop spreading method below
    ee.stopPropagation();
    // Toggle between adding and removing the "some" class name for all "some" elements in this example for cart basket
    $(this).toggleClass('active');
    // $(".box").slideToggle();
  });
    // the code below hides cart item when clicked was outside of cart item block 
  $('body').click(function(ee) {
    if ($(ee.target).hasClass('box') || $(ee.target).hasClass("remove_button") || 
       $(ee.target).hasClass("btn-increment-decrement") || $(ee.target).hasClass("float-right"))
    {
      return false;
    }
    $(".box").hide();
    // hide active color for element(icon item cart)
    $("#basket_checkout_button").removeClass('active');
    // checkoutButton.off().click(function(){});
  });
});
  
// the function below for displays description of item 
$(document).ready(function () {
  $(".product-item, .display_description").click(function (e) {
      if ($(this).attr("class") == "display_description") {
          return false;
      }
      // the code below helps us escape trouble if we onclick add item icon 
      // it's stop execution of description function 
      if ($(e.target).hasClass('btnAddAction') || $(e.target).hasClass('input-cart-quantity') || $(e.target).hasClass('product-price float-left'))
      {
        return false;
      }

      e.stopPropagation();
      // the code below displays message after click on item 
      // alert($(this).attr("data"));
      id = $(this).attr("data");

      
      
      // the ajax method below loads images with necessary folder for slider
      $.ajax({
        type: "POST",
        url: url+"://greenbro."+domen_part+"/slider/get_slider_images",
        data: {id: id},
        dataType: "json",
        success: function(data) {
          // The each() method specifies a function to run for each matched element.
            $.each(data, function(i, filename) {
              //append method insert content at the end of all <#images> elements:
              // thd code below adds img fields in #images
                $("#images"+ id).append("<img src='" + filename + "'>");

                // the code below adds activ_slider for first img element
                $('#images' + id).children().first().addClass('active_slider');
            });
         }
      });    

      // $('#images' + id).children().first().addClass('active_slider');
      // previous variant $('#img_description_' + id).addClass('active_slider');



          $(".tab").hide();      
          // code tab-comment-block below 
          $('#item_tab1' + id).addClass('active');
          // the code below add active class to tab in item description 
          $('#tabs-list-li' + id).addClass('active');
          // the code below removes class from second li element "comment section" 
          $('#tabs-list-li' + id).next().removeClass('active');

      // the code below displays part of page after document ready and 0.1 sec
      $(document).ready(function () {
         setTimeout(function() {
          // the method below shows and hides us station info block 
          $("#show_description_" + id).slideToggle();
          }, 100);
      });

   });
});
 

// the code below hides description block 
$(document).ready(function () {
$('body').click(function() {
  //  make code for fixing error with undefined variable id 

  // $("#show_description_"+ $id).hide();
  // the new version of code can escape of error with undefined $id 
     $(".display_description").hide();

  // the code below remove class active from desk_box
  $(".product-item").removeClass('active');

  // delete all elements from some id 
    //  the code above older variant which has undefined error  with $id
     $(".slider_images").empty();
    });
});
 

// the functions below calls in product-list.content.php and add items in order_items table
  // we throw item variable id to tb products_cart by the function onAdd
  function onAdd(id, price) {
    // code below grabs value from input element with correct id of item 
      var quantity_of_item = document.getElementById(id).value;
      // the code below passes price from hidden field to item_cart_script
      var price = $('#price_' + id).val();
    
    $.ajax({                            
        type: "POST",
        url: url+"://greenbro."+domen_part+"/item/add_item_to_cart",
        data: {id: id , quantity_of_item: quantity_of_item, price: price},
        success: function(data, textStatus, jqXHR) {
          // the code below reload shopping-cart-container and displays correct info of item after updating 
          $("#display_reload_cart_item").load(url+"://greenbro."+domen_part+"/cart/show_cart_item/" + ' #cart_item_code');
            // alert(id);
            // alert(data);
            // alert(quantity_of_item);
        }
    });
    
}



  // the function below calls in product-list.content.php and remove item from order_items table
function removeItem(product_id) {
  // code below grabs value from input element with correct id of item 
  $.ajax({                            
      type: "POST",
      url: url+"://greenbro."+domen_part+"/item/delete_item_from_cart",
      data: {product_id: product_id},
      success: function(data, textStatus) {
          // the code below reload shopping-cart-container and displays correct info of item after updating, before ordering
          $("#display_reload_cart_item").load(url+"://greenbro."+domen_part+"/cart/show_cart_item/" + ' #cart_item_code', show_pager);
      },
      error: function(data) {
        // alert("Error in removeItem function");
      }
  });
   
}

// the function below calls in product-list.content.php and remove item from order_items table
function removeItemEditor(product_id) {
    // code below reloads part of page and displays actual data     
    $.ajax({                            
        type: "POST",
        url: url+"://greenbro."+domen_part+"/item/delete_item_from_cart",
        data: {product_id: product_id},
        success: function(data, textStatus) {
            // the code below executes in success case 
            $("#cart_item_editor").load(url+"://greenbro."+domen_part+"/customer/delivery_payment_type/" + ' #cart_item_editor');
        },
        error: function(data) {
          // alert("Error in removeItemEditor function");
        }
    });
    
}


// the function below  delete all items from cart
function empty_cart_item(united_order_items) {
  // the method below working well 
    // the code below passes price from hidden field to item_cart_script
  $.ajax({                            
      type: "POST",
      url: url+"://greenbro."+domen_part+"/item/delete_all_items",
      data: {united_order_items: united_order_items},
      success: function(data, textStatus) {
        // the code below reload shopping-cart-container and displays correct info of item after updating 
        $("#display_reload_cart_item").load(url+"://greenbro."+domen_part+"/cart/show_cart_item/" + ' #cart_item_code', show_pager);
          // alert(united_order_items);
          // alert(data);
      }
  });
}


// DELETE IN the future????????
// this function below helps us avoid problems with asynchronous we put it as a  callback 
function show_pager() {
  $(".box").slideToggle();
}


// function for add item to cart
    // cart_id it's id in table order_items
    function increment_quantity(cart_id, price) {
      var inputQuantityElement = $("#input-quantity-"+cart_id);
      // below create new variable which is bigger on one 
      var newQuantity = parseInt($(inputQuantityElement).val())+1;
      var newPrice = newQuantity * price;
      save_to_db(cart_id, newQuantity, newPrice);
  }
  
       // function for minus item from cart 
  function decrement_quantity(cart_id, price) {
      var inputQuantityElement = $("#input-quantity-"+cart_id);
      if($(inputQuantityElement).val() > 1) 
      {
      var newQuantity = parseInt($(inputQuantityElement).val()) - 1;
      var newPrice = newQuantity * price;
      save_to_db(cart_id, newQuantity, newPrice);
      }
  }
  
      // cart_id and price are array keys 
      // the function below save to DB new quantity of goods using ajax
      function save_to_db(cart_id, new_quantity, newPrice) { 
          // the variable below shows actual quantity of item
          var inputQuantityElement = $("#input-quantity-"+cart_id);
          // the variable below shows actual price sum of item 
          var priceElement = $("#cart-price-"+cart_id);
          $.ajax({
              url: url+"://greenbro."+domen_part+"/item/update_item_quantity",
              data : "product_id="+cart_id+"&quantity_of_item="+new_quantity,
              type : 'POST',
              success : function(response) {
                  // the val() method returns or sets the attribute of the selected elements(for form elements)
                  $(inputQuantityElement).val(new_quantity);
                  // the text() sets or returns the text content of selected elements
              $(priceElement) .text(newPrice+" грн");
              var totalQuantity = 0;
              // each() method specifies a function to run for each matched element
              $("input[id*='input-quantity-']").each(function() {
                  var cart_quantity = $(this).val();
  
              // the parseInt() function parses a string and returns an integer.
              // only the first number in the string is returned
                  totalQuantity = parseInt(totalQuantity) + parseInt(cart_quantity);
              });
              $("#total-quantity").text(totalQuantity);
              var totalItemPrice = 0;
              $("div[id*='cart-price-']").each(function() {
              // replace() method searches a string for specified value, or a regular expression
              //  and returns a new string where the specified values are replaced
  
                  var cart_price = $(this).text().replace("грн", "");
                  totalItemPrice = parseInt(totalItemPrice) + parseInt(cart_price);
              });
              $("#total-price").text(totalItemPrice+" грн");
              }
          });
      }


// the function below display burger_menu in small scrin 
$(document).ready(function () {
  $("#burger-menu-button, #burger-menu").click(function (e) {
      $('.burger-menu').show();
   });
});
// the code below hides burger-menu block 
$(document).ready(function () {
  $('body').click(function(e) {

    if ($(e.target).attr("class") == "burger-menu-button") {
          return false;
      }
    if ($(e.target).hasClass('burger-menu-button') || $(e.target).hasClass('burger-menu')) {
          return false;
      } 
       $(".burger-menu").hide();
      });
  });




// for show and hide burger-menu depends on screen size 
$(window).resize(function() {

  if ($(this).width() < 750) {
    $('.burger-menu-button').show();
    // the code below hides main menu in small screen 
    $('.main_menu').hide();
  } else {
    $('.burger-menu-button').hide();
    // the code below hide burger-menu 
    $('.burger-menu').hide();
    $('.main_menu').show();
         }
  });


// the code below switchs between different tab in description section
$(document).ready(function(){
  $(".tabs-list li a").click(function(es){
    // The event.preventDefault() method stops the default action of an element from happening.
     es.preventDefault();
  });

  
  $(".tabs-list li").click(function(){

    // alert("Our id" +$id);
     var tabid = $(this).find("a").attr("href");  
    // alert("Our tabid" + tabid);

    //  second part after comma for removing active class   ::.tabs div.tab
     $(".tabs-list li,.tabs div.tab").removeClass("active");   // removing active class from tab

     $(".tab").hide();   // hiding open tab
     $(tabid).show();    // show tab
    //  the code below for tab 
     $(this).addClass("active"); //  adding active class to clicked tab

    });

});

