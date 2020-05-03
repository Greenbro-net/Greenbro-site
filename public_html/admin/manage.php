
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Page_for_managing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=cyrillic" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../other_css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../other_css/bootstrap-grid.min.css">
    <link rel="stylesheet" type="text/css" href="../other_css/goodsNew.css">
    <link rel="stylesheet" type="text/css" href="../lib/simplebar.css">
    <!-- This is for registration page -->
    <link rel="stylesheet" type="text/css" media="screen" href="../other_css/registration_css.css" />

    <link rel="apple-touch-icon" sizes="180x180" href="../images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="../images/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="GreenBro">
    <meta name="application-name" content="GreenBro">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">
</head>

<body>
<!-- Checkout popup window -->
<div id="checkoutPopup" class="popup">
    <div class="container popup-content" data-simplebar>
        <div class="row">
            <div class="col-lg-12">
                <span class="close">&times;</span>
                <h2>Ваш заказ:</h2>
            </div>
            <div class="container">
                <div class="row">
                    <div class=" checkout-cart col-lg-10 offset-lg-1 col-md-12"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="checkout__end col-lg-10 offset-lg-1 col-md-12">
                <p>Итого $<span id="total"></span></p>
                <button class="btn checkout__end-btn">Оформить заказ</button>     
            </div>
        </div>
    </div>
</div>
<!-- End of checkout popup -->

<!-- Description popup window -->
<div id="descriptionPopup" class="popup">
    <div class="container popup-content" data-simplebar>
        <div class="row">
            <div class="col-lg-12 ">
                <span id="closeDescription" class="close">&times;</span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="description col-lg-8 offset-lg-2 col-md-12">
                        <div class="description_block">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of checkout popup -->

<?php
require_once "../scripts/header.php";
?>

<!-- <h3>  calm down and go to work))</h3> -->

<!-- This part of page below for adding new goods -->
<form id= "manage_goods" name="manage_goods" action="add_to_db.php " method="POST"
                     enctype="multipart/form-data">
    </span><br>
       <!-- For name -->
       <label for="products_name">Products_name</label>
       <input id="products_name"  type="text" name="products_name" class="menu" pattern="^[А-Яа-яЁё\s]+$ 0-9]{3,110}" placeholder="Введіть найменування товару" required><span></span><br>
       <!-- For brand_name -->
       <label for="brand_name">Name of brand</label>
       <input id="brand_name"  type="text"  name="brand_name" class="menu" pattern="^[А-Яа-яЁё\s]+$ 0-9]{5,110}" required placeholder="Введіть ім'я бренду"><span></span><br>
       <!-- For brand_id -->
       <hr>
       <label class="pic" for="category_of_products">Enter category of goods</label>
       <input type="checkbox" name="category_of_products[]" value="products"> Products category
       <input type="checkbox" name="category_of_products[]" value="clothes"> Clothes category
       <input type="checkbox" name="category_of_products[]" value="goods"> Goods category
       <input type="checkbox" name="category_of_products[]" value="books"> Books category <br>
       <hr>
       <!-- For mini_description -->
       <label for="mini_description">Mini description</label>               
       <input id="mini_description"  type="text" name="mini_description" class="menu" pattern="^[А-Яа-яЁё\s]+$  0-9]{5,200}" placeholder="Введіть коротке описання товару" required><span></span><br>
             <!-- For mini_description -->
             
             <!-- For description -->
             <hr>
        <p id="description_name" for="description">Description of goods</p>
          <textarea id="description" name="description" class="menu" pattern="^[А-Яа-яЁё\s]+$   0-9]{5,600}" placeholder="Введіть описання товару" required></textarea>  <br>
            <hr>
            <!-- For description -->
            




        <!-- Upload images -->
        <!-- You add this only image name, after that you have to upload image into folder image of host -->
       
       <!-- <input id="upload_image"  type="text" name="upload_image" class="menu" pattern="^[А-Яа-яЁё\s]+$  0-9]{5,25}"  placeholder="Ім'я файла зображення" required><span></span><br> -->
       
       <!-- new version  below -->
       <div class="for_images">
                                  <!-- the code below for uploading main image -->
       <label id="main_image">Main image download</label>
           <div>
           
        <p><input type="file"  name="main_image"  accept=".jpg, .jpeg, .png" onchange="loadFile(event)"></p>
        <img id="output"/>
           </div><br>
        <!-- the code below for uploading images -->
         <p id="multi_image">Multiple download additional images:</p>
        <!-- the code below makes limitation for file size -->
        <div>
        <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
        <p><input type="file" id="fileMulti" name="fileMulti[]" accept=".jpg, .jpeg, .png"  multiple/></p>
        <span id="outputMulti"></span>
          </div>
            </div>

           <script>
           function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
                   // Loop through the FileList and render image files as thumbnails.
          for (var i = 0, f; f = files[i]; i++) {
          // Only process image files.
        if (!f.type.match('image.*')) {
            alert("Image only please....");
        }
        var reader = new FileReader();
        // Closure to capture the file information.
        reader.onload = (function (theFile) {
            return function (e) {
                // Render thumbnail.
                var span = document.createElement('span');
                span.innerHTML = ['<img class="thumb" title="', escape(theFile.name), '" src="', e.target.result, '" />'].join('');
                document.getElementById('outputMulti').insertBefore(span, null);
            };
        })(f);
        // Read in the image file as a data URL.
        reader.readAsDataURL(f);
              }
            }
         document.getElementById('fileMulti').addEventListener('change', handleFileSelect, false);


       //function for main_image
          var loadFile = function(event) {
          var output = document.getElementById('output');
          output.src = URL.createObjectURL(event.target.files[0]);
          output.onload = function() {
          URL.revokeObjectURL(output.src) // free memory
                }
            };
    </script><br>
         <hr>
      <!-- new version above -->


       <!-- Set a price -->
       <label for="set_price">Set price</label>
       <input id="set_price"  type="text" name="set_price" class="menu" pattern="[0-9]{2-10}"  placeholder="Встановіть ціну" required><span></span><br>
        <!-- Set it if you have discount for this product -->
       <label for="sale">Bargain sale </label>
       <input id="sale"  type="text" name="sale" class="menu" pattern="[0-9]{1,30}" placeholder="Розпродаж товарів" required><span></span><br>
        <!-- Quantity of products -->
        <label for="quantity">Quantity of products</label>
       <input id="quantity"  type="text" name="quantity" class="menu" pattern="[0-9]{1-5}" placeholder="Кількість товарів" required><span></span><br>
          <!-- Datetime -->
          <hr>
        <label id="datetime" for="datetime">Date and time</label>
        <input type="checkbox" name="set_time" value="set_time" checked> Встановити поточний час та дату
        <input type="checkbox" name="unset_time" value="unset_time"> Не встановлювати час та дату  <br>
          <hr>   
        <!-- Visible or invisible -->
        <label  id="visible" for="visible">Visible of products</label>
        <input type="checkbox" name="visible" value="visible" checked> Відображувати товар
        <input type="checkbox" name="invisible" value="invisible"> Не відображувати товар  <br>


 <div class="button">
<input type="submit" value="Enter" /> 
 </div>
</form>
<!-- end of adding part of page -->


<?php
require_once "../scripts/footer.php";
?>


<script defer src="../lib/jquery-3.3.1.js"></script>
<script defer src="../js/cart-script.js"></script>
<script defer src="../lib/simplebar.min.js"></script>
<!-- this script below has some function for adding and deleting windows of images -->
<script src="../js/adding_image.js"></script>

</body>
</html>
<?php



?>