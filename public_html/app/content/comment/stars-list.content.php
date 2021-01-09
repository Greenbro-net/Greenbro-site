<?php 

// $responseObj = new ResponseModel();
// $responseObj->showResponse();

// $courseResult = $responseObj->public_findItemResponse(97);
// if (! empty($courseResult)) {
//     foreach ($courseResult as $row) {
//     $userRating = $rating->getUserRating($userId, $row['id']);
//     $totalRating = $rating->getTotalRating($row['id']);
//     $date = date_create($row["last_date_to_register"]);

    ?>

  <div class="row-item">

      <div class="row-title">
    
      </div>

      <ul class="list-inline" id="list-<?php echo $row['id']; ?>">
     <?php 
    //  require_once "star-rating.content.php"; 
    // testing code below
    $rating = $response['rating'];
    $row['id'] = $response['response_id'];
    $apperance = "star";

// testing hardcode above
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

        <!-- <div  class="message_place" id="message_place<?php 
        // echo $row['id']; 
        ?>"></div> -->

        <!-- testing code above -->
    
    <p class="text-address">
           <!-- the code below should be delete  -->
          </label>
          
          
     </p> 
    </div>
   
  



