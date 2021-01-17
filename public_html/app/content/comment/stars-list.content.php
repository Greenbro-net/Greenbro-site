  <div class="row-item">

      <div class="row-title">
    
      </div>

      <ul class="list-inline" id="list-<?php echo $response['response_id']; ?>">
     <?php 
    // testing code below
    $rating = $response['rating'];
    $apperance = "star";

// testing hardcode above
for ($count = 1; $count <= 5; $count ++) {
  $starRatingId = $response['response_id'] . '_' . $count;
  if ($count <= $rating) {
      ?>
<li value="<?php echo $count; ?>" id="<?php echo $starRatingId; ?>"
  class="star"><img src="../../../images/comment_image/<?php echo $apperance; ?>-filled.png"></li>
<?php
  } else {
      ?>
<li value="<?php $count; ?>" id="<?php echo $starRatingId; ?>"
  class="star"
  
  onMouseOver="mouseOverRating(<?php echo $response['response_id']; ?>,<?php echo $count; ?>,'<?php echo $apperance; ?>');"
  onMouseLeave="mouseOutRating(<?php echo $response['response_id']; ?>,<?php echo $rating; ?>,'<?php echo $apperance; ?>');"><img
  src="../../../images/comment_image/<?php echo $apperance; ?>-open.png"></li>
<?php
  }
}
?>
        <!-- the class should put in image tag later  -->
        <img src="../../../images/comment_image/loader.gif" class="loader-icon">
        <div class="response" id="response-<?php echo $response['response_id']; ?>"></div>
    
    <p class="text-address">
           <!-- the code below should be delete  -->
          </label>
          
          
     </p> 
    </div>
   
  



