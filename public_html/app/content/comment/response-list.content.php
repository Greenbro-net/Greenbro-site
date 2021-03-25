              <!-- the code below displays us comments from DB -->
              <div id="main_comments_container">
              <?php
              // the code below for require_once a form of leaving a comment 
                    require "comment-form.content.php";
                ?>


              <h3>Відгуки покупців</h3>
              <!-- the code below for button "create new comment" -->
              <!-- the button below opens window from comment-form.content.php   -->
              <button id="leave_comment_button<?php echo $product['id']; ?>" onclick="display_comment_form(<?php echo $product['id']; ?>)" >Залишити відгук</button>
                     
            
                  <?php
                  if ($quantity_of_responses >= 1) {
                      // $resObj = $this->load_model('ResponseModel');
                      $resObj = new ResponseController();
                      $responses = $resObj->call_findItemResponse($product["id"]);
                      foreach ($responses as $response) {
                        ?> 
                       <div id="comment_container_1"> 
                        <div class="author_date_block">
                          <!-- the code below displays user who left a comment  -->
                          <p id="author"><?php echo  $response["user_name"]; ?></p>
                          <!-- the code below displays data when user left his comment -->
                          <p id="date"><?php echo date('d:m:Y', strtotime($response["created_at"])); ?>
                        </div>
                           <!-- the code below displays stars rating of item  -->


                            <?php 
                            // for loop use require not require_once(only one cycle)
                            require "stars-list.content.php"; 
                            ?>
                          <!-- the code below displays user comments  -->
                          <p><?php echo $response["comment"]; 
                                
                              ?></p>
                       </div> 
                        <?php
                      }
                    }
                                         ?>
                  
              </div>

