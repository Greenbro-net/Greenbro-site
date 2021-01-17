<!-- form for leave a comment -->
<!-- testing php code below -->
<div id="main_form_comment_container<?php echo $product['id']; ?>" class="main_form_comment_container">

<!-- testing php code above -->

    <!-- element below separate html elements -->
    <p class="separating_element"></p>
  <!-- <p>Написати відгук</p> -->
  <!-- we delete id below because it was not unique id="form-contact" -->
    <form  class="styled"  method="POST">
    <!-- action="http://greenbro.com/response/call_addNewComment" -->
    <!-- testing close sign below -->
    <span id="close_sign<?php echo $product['id']; ?>" onclick="close_sign_form(<?php echo $product['id']; ?>)" class="close_sign">&#10005;</span>
       <fieldset>
           <legend>Написати відгук</legend>
           <ol>
               <li class="form-row">
                   <label>Електронна пошта:</label>
                   <input id="input-email<?php echo $product['id']; ?>" type="text" class="text-input required email default" name="email" value="" title="Введіть свою електронну пошту" />
               </li>
               <li class="form-row">
                   <label>Ваше ім'я та прізвище:</label>
                   <input id="input-name<?php echo $product['id']; ?>" type="text" class="text-input required default" name="name" value="" title="Введіть прізвище та ім'я" />
                   <!-- testing code below  -->
               </li>  

    <!-- there are we will make a rating for item -->
               <?php 
    // rating code below
    $rating = "0";
    $apperance = "star";

//  hardcode above
?>
<div class="form-row" id="rating-form-container">
    <label id="label_star">Ваша оцінка:</label>
    <!-- the element below for keeps  there a value  -->
    <input id="stars_input<?php echo $product['id']; ?>" value="" style="display: none;" class="required_stars" />
    
    <div id="stars_container<?php echo $product['id']; ?>"  class="stars_container">
    <?php
  
for ($count = 1; $count <= 5; $count ++) {
  $starRatingId = $product['id'] . '_' . $count;
  if ($count <= $rating) {
      ?>



<li value="<?php echo $count; ?>" id="<?php echo $starRatingId; ?>"
  class="star"><img src="../../../images/comment_image/<?php echo $apperance; ?>-filled.png"></li>
<?php
  } else {
      ?>
<li value="<?php $count; ?>" id="<?php echo $starRatingId; ?>"
  class="star"
  onclick="addClassStar(this,<?php echo $product['id']; ?>,<?php echo $count; ?>);"
  onMouseOver="mouseOverRating(<?php echo $product['id']; ?>,<?php echo $count; ?>,'<?php echo $apperance; ?>');"
  onMouseLeave="mouseOutRating(<?php echo $product['id']; ?>,<?php echo $rating; ?>,'<?php echo $apperance; ?>');"><img
  src="../../../images/comment_image/<?php echo $apperance; ?>-open.png"></li>
<?php
  }
}
?>

        <!-- the class should put in image tag later  -->
        <img src="../../../images/comment_image/loader.gif" class="loader-icon">
        <div class="response" id="response-<?php echo $product['id']; ?>"></div>

    </div>
</div>

        <div  class="message_place" id="message_place<?php echo $product['id']; ?>"></div>
        <!-- rating code above -->
    

               <li class="form-row">
                   <label>Коментар:</label>
                   <textarea id="input-message<?php echo $product['id']; ?>" class="text-area required" name="message" cols="40" rows="8" ></textarea>
               </li>
               <li class="button-row text-right">
                   <!-- <input id="comment_btn_submit" class="btn-submit" type="submit" value="Надіслати" name="submit_comment" /> -->
                   <!-- testing code below  -->
                   <!-- <div id="someHiddenDiv" style="display: none;">Working...</div> -->

                   <button id="submit_addComment<?php echo $product['id']; ?>" onclick="preparing_comment(<?php echo $product['id'];?>)">Відправити відгук</button>
               </li>
           </ol>
       </fieldset>
    </form>
     <!-- element below separate html elements -->
     <p class="separating_element"></p>
 </div>
  
