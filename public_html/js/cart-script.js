;$(document).ready(function () {

   let cart = [];
   let totalPrice = 0.0;
   let checkoutPopup = $("#checkoutPopup");
   let descriptionPopup = $("#descriptionPopup")
   $("#total")[0].innerHTML = `${totalPrice}`;

   $(".add-to-cart").on("click", addToCart);
   $(".checkout-cancel").on("click", cancel);
   $(".minus").on("click", minusQuantity);
   $(".plus").on("click", plusQuantity);
   $(".quantity").on("input", inputQuantity);
   $(".checkout-button").on("click", showPopup);
   checkoutPopup.on("click", closePopup, event);
   $(".checkout__end-btn").on("click", updateDB);
   $(window).on("click", ifDelete, event);
   $(".product__img, .product-name").on("click", showDescription);
   descriptionPopup.on("click",closeDescription, event);

   function showDescription() {
      let id = $(this).parents(".product").attr('data-product-id');

      drawDescription();
//  the function below posts id from description.php 
      $.ajax({
         url: '../scripts/description.php',
         type: 'POST',
         dataType: 'json',
         data: {id: id},
         success: function(data){
            data = data[0];

            let brand = data["brand"];
            let brandId = data["brand_id"];
            let datetime = data["datetime"];
            let description = data["description"];
            let image = data["image"];
            let miniDescription = data["mini_description"];
            let name = data["name"];
            let price = data["price"];
            let quantity = data["quantity"];
            let sale = data["sale"];

          
            // console.log("brand - " + brand);
            // console.log("brandId - " + brandId);
            // console.log("datetime - " + datetime);
            // console.log("description - " + description);
            // console.log("image - " + image);
            // console.log("miniDescription - " + miniDescription);
            // console.log("name - " + name);
            // console.log("price - " + price);
            // console.log("quantity - " + quantity);
            // console.log("sale - " + sale);
            
             let srcImg = "../images/picture/" + image;
           
           $(".description_block").append("<div class ='descr_img'><img src ='"+ srcImg +"'/></div>"); 
            $(".description_block").append("<div class ='descr_name'><h4>Наименование товара </h4><p>" + name + "</p></div>");
            $(".description_block").append("<div class ='descr_brand'><h5>Производитель </h5><p>" + brand + "</p></div>");
            $(".description_block").append("<div class ='descr_main'><p>Описание </p>" + description + "</div>");
            
            if(sale > 0){
              $(".description_block").append("<div class ='descr_sale'><p>Осталось товаров по акции </p>" + sale + "</div>");
            }
            
            $(".description_block").append("<div class ='descr_price'><p>Цена </p>" +price +  "грн"+ "</div>");
         }
      });
   }

   // the function below change visibility of description block
   function drawDescription() {
      descriptionPopup.css({"display": "block"});
      $("body").css("overflow", "hidden");
   }

   function closeDescription(event) {
      let closePopup = $("#closeDescription")[0];

      if ( (event.target === descriptionPopup[0]) || (event.target === closePopup) ) {
         descriptionPopup.css({"display": "none"});
         $("body").css("overflow", "auto");
          $(".description_block").empty();
      }
   }


   $("#burger-menu-button").click(function(){
      $(this).toggleClass("active");
      $("#line-1").toggleClass("active");
      $("#line-2").toggleClass("active");
      $("#line-3").toggleClass("active");
      $("#burger-menu").slideToggle("slow");
   });

   function ifDelete() {
       let cancelClass = event.target.outerHTML.substr(15,15);
       if(cancelClass === "checkout-cancel") customDelete(event.target.parentNode);
   }

   function customDelete(item) {
       let TOTAL;
       let id = $(item).attr('data-for');
       let price = parseFloat($(item).children(".checkout-total")[0].innerHTML.substr(8));

       if(totalPrice !== 0) {
           if(save[id] !== undefined) totalPrice -= price;
           TOTAL = Math.ceil(totalPrice * 10) / 10;
           if(TOTAL <= 0.1) TOTAL = 0;
           $("#total")[0].innerHTML = `${TOTAL}`;
       }
       if(save[id] !== undefined) {
           delete(save[id]);
           $(`[data-for|=${id}]`)[0].remove();
       }
   }

   function addToCart() {
      let TOTAL;
      let id = $(this).parents(".product").attr('data-product-id');
      let quantity = parseInt($(this).siblings(".how-many").children(".quantity-input").children(".quantity").val());
      let price = parseFloat($(`[data-product-id=${id}]`).children(".product-menu").children(".product-price")[0].innerText.substr(1));

      if(quantity > 0) {
         if (cart[id] === undefined) cart[id] = quantity;
         else cart[id] += quantity;
         totalPrice += price * quantity;
         TOTAL = Math.ceil(totalPrice * 10) / 10;
         $("#total")[0].innerHTML = `${TOTAL}`;
      }
   }

   function cancel() {
      let TOTAL;
      let id = $(this).parents(".product").attr('data-product-id');
      let price = parseFloat($(`[data-product-id=${id}]`).children(".product-menu").children(".product-price")[0].innerText.substr(1));
      if(totalPrice !== 0) {
         if(save[id] !== undefined) totalPrice -= price * save[id];
         TOTAL = Math.ceil(totalPrice * 10) / 10;
         if(TOTAL <= 0.1) TOTAL = 0;
         $("#total")[0].innerHTML = `${TOTAL}`;
      }
      if(save[id] !== undefined) {
         delete(save[id]);

         $(`[data-for|=${id}]`)[0].remove();
      }
   }

   function minusQuantity() {
      console.log("minus");
      let quantity = $(this).siblings(".quantity");
      let val = quantity.val();

      $(this).siblings(".stock").css("color", "#808080");
      if(val > 0) {
         val--;
         quantity.val(val);
      }
   }

   function plusQuantity() {
      let quantity = $(this).siblings(".quantity");
      let maxQuantity = quantity.attr("data-quantity");
      let val = quantity.val();

      if (val === maxQuantity) {
         $(this).siblings(".stock").css("color", "red");
      }
      else val++;
      quantity.val(val);
   }

   function inputQuantity() {
      let maxQuantity = $(this).attr("data-quantity");
      let val = parseInt($(this).val());

      if(isNaN(val)) $(this).val("");
      else if(val > maxQuantity) $(this).val(maxQuantity);
      else $(this).val(val);
   }

   let sale = [];//обнуляет массив для предотвращения повторного добавления в корзину
   let save = [];//конечный массив в коротом хранится информация о товарах корзины

   // the function below displays us cart item 
   function showPopup() {
      // the code below checks if item cart has more then one item inside it will display or nor 
      // if(cart.length > 0) {
         checkoutPopup.css({"display": "block"});
         $("body").css("overflow", "hidden");
         for(let i = 0; i < cart.length; i++) {
            if(cart[i] !== undefined) {
               let product = $(`[data-product-id=${i}]`);
               let productId = product.attr("data-product-id");
               let productImage = product.children(".product__img")[0];
               let productName = product.children(".product-name")[0];
               let productQuantity = save[i];
               let productMaxQuantity = product.children(".product-menu").children(".how-many").children(".quantity-input").children(".quantity").attr("data-quantity");

               if(save[i] !== undefined ){
                  productQuantity += cart[i];
               } else {
                  productQuantity = cart[i];
               }
               // let productQuantity = cart[i];
               let productPrice = parseFloat( product.children(".product-menu").children(".product-price")[0].innerHTML.substr(1) );
               let string = "<div class=\"checkout-item\" data-for='"+ productId + "'>" +
                   productName.outerHTML +
                   productImage.outerHTML +



                  "<div class=\"quantity-input\" style=\"margin: auto 0; text-align: center;\">" +
               "<input class=\"minus btn\" type=\"button\" value=\"-\">" +
               "<input class=\"input-text quantity text\" value=\""+ productQuantity +"\" size=\"4\" data-quantity=\""+productMaxQuantity+"\">" +
               "<input class=\"plus btn\" type=\"button\" value=\"+\">" +
               "<div class=\"stock\">На складе " + productMaxQuantity + " товаров</div>" +
               "</div>"+
               "<p class=\"checkout-price\">Ціна: " + productPrice + " грн</p>" +
               "<button class=\"checkout-cancel\">Удалить</button>" +
               "<h3 class=\"checkout-total\">Сумма: $" + ( Math.ceil( productPrice * productQuantity * 10 ) / 10 ) + "</h3>" +
               "</div>";

               if(save[i] !== undefined ){
                  $(`[data-for|=${i}]`)[0].remove();
                  save[i] += cart[i];
                  cart[i] = sale[i]; // обнуляем рабочий массив
                  $(".checkout-cart").append(string);
               } else {
                  $(".checkout-cart").append(string);
                  save[i] = cart[i]; //добавляем елемент к конечный массив
                  cart[i] = sale[i]; // обнуляем рабочий массив
               }
            }
         }
      // }
   }

   function closePopup(event) {
      let closePopup = $(".close")[0];

      if ( (event.target === checkoutPopup[0]) || (event.target === closePopup) ) {
         checkoutPopup.css({"display": "none"});
         $("body").css("overflow", "auto");
      }
   }

   function updateDB() {
      if(save.length !== 0) {
         save.forEach(function (quantity, id) {
            let maxQuantity = $(`[data-product-id=${id}]`).children(".product-menu").children(".how-many").children(".quantity-input").children(".quantity").attr("data-quantity");
            let diff = maxQuantity - quantity;

            $.ajax({
               url: '../scripts/dbhandler.php',
               type: 'POST',
               dataType: 'json',
               data: {id:id, quantity:diff}
            });
         });
      }
   }
}());