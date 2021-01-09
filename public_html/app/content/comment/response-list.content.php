<?php

            //   edit the if else block later 
              if (empty($_SESSION['user_id'])) {
                 echo "You should log in for leave a comment";
              } else {
                // TO DO option here or delete it in the future 
                //  echo "Залишити відгук";
              }

              ?>
              <!-- the code below displays us comments from DB -->
              <div id="main_comments_container">
              <?php
              // the code below for require_once a form of leaving a comment 
                    require_once "comment-form.content.php";
                ?>


              <h3>Відгуки покупців</h3>
              <!-- the code below for button "create new comment" -->
              <button id="leave_comment_button">Залишити відгук</button>
                     
            
                  <?php
                  if ($quantity_of_responses >= 1) {
                      $resObj = $this->load_model('ResponseModel');
                      $responses = $resObj->public_findItemResponse($product["id"]);
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
                           <!-- there are a problem -->
                           <!-- TO DO put our stars-list in foreach loop and create form for adding comment  -->


                            <?php 
                            // for loop use require not require_once(only one cycle)
                            require "stars-list.content.php"; 
                            ?>
                          <!-- the code below displays user comments  -->
                          <p><?php echo $response["comment"]; 
                                   var_dump($response);
                              ?></p>
                       </div> 
                        <?php
                      }
                    }
                                         ?>
                     
                     

              </div>


