<!-- form for leave a comment -->

<div id="main_form_comment_container">
    <!-- element below separate html elements -->
    <p class="separating_element"></p>
  <!-- <p>Написати відгук</p> -->
    <form id="form-contact" class="styled" action="some/method" method="post">
    <!-- testing close sign below -->
    <span id="close_sign">&#10005;</span>
       <fieldset>
           <legend>Написати відгук</legend>
           <ol>
               <li class="form-row">
                   <label>Електронна пошта:</label>
                   <input id="input-email" type="text" class="text-input required email default" name="email" value="" title="Введіть свою електронну пошту" />
               </li>
               <li class="form-row">
                   <label>Ваше ім'я та прізвище:</label>
                   <input id="input-name" type="text" class="text-input required default" name="name" value="" title="Введіть прізвище та ім'я" />
                   <!-- testing code below  -->
                   <!-- <span class="error">Required field</span> -->
                </li>  

    <!-- there are we will make a rating for item -->
               <?php 
    //  require_once "star-rating.content.php"; 
    // rating code below
    $rating = "0";
    $row['id'] = $product["id"];;
    $apperance = "star";

//  hardcode above
?>
<div class="form-row" id="rating-form-container">
    <label id="label_star">Ваша оцінка:</label>
    <!-- the element below for keeps  there a value  -->
    <input id="stars_input" value="" style="display: none;" class="required" />

    <div id="stars_container" >
    <?php
  
for ($count = 1; $count <= 5; $count ++) {
  $starRatingId = $row['id'] . '_' . $count;
  if ($count <= $rating) {
      ?>



<li value="<?php echo $count; ?>" id="<?php echo $starRatingId; ?>"
  class="star"><img src="../../../images/comment_image/<?php echo $apperance; ?>-filled.png"></li>
<?php
  } else {
      ?>
<li value="<?php $count; ?>" id="<?php echo $starRatingId; ?>"
  class="star"
  onclick="addClassStar(this,<?php echo $row['id']; ?>,<?php echo $count; ?>);"
  onMouseOver="mouseOverRating(<?php echo $row['id']; ?>,<?php echo $count; ?>,'<?php echo $apperance; ?>');"
  onMouseLeave="mouseOutRating(<?php echo $row['id']; ?>,<?php echo $rating; ?>,'<?php echo $apperance; ?>');"><img
  src="../../../images/comment_image/<?php echo $apperance; ?>-open.png"></li>
<?php
  }
}
?>

        <!-- the class should put in image tag later  -->
        <img src="../../../images/comment_image/loader.gif" class="loader-icon">
        <div class="response" id="response-<?php echo $row['id']; ?>"></div>

    </div>
</div>

        <div  class="message_place" id="message_place<?php echo $row['id']; ?>"></div>
        <!-- rating code above -->
    




               <li class="form-row">
                   <label>Коментар:</label>
                   <textarea id="input-message" class="text-area" name="message" cols="40" rows="8"></textarea>
               </li>
               <li class="button-row text-right">
                   <input id="comment_btn_submit" class="btn-submit" type="submit" value="Надіслати" name="submit_comment" />
               </li>
           </ol>
       </fieldset>
    </form>
     <!-- element below separate html elements -->
     <p class="separating_element"></p>
 </div>
  
