<?php

namespace App\Model;

use Exception;

class MessageModel
{

    // the method below returns correct word for quantity of responses
    public static function choose_right_case($quantity_of_responses) 
    {
        try {
              if (empty($quantity_of_responses)) {
                  throw new Exception("Method choose_right_case doesn't get parameter");
              }
                $last_digit = (substr($quantity_of_responses, -1));
                // 21,31, 41
                if ($last_digit == 1 ) {
                    return "відгук";
                }
                // 22, 23, 24, 32, 33, 34, 42, 43, 44,   
                if ($last_digit == 2 || $last_digit == 3 || $last_digit == 4) {
                    return "відгуки";
                }
                // 25,26,27, 28, 29, 30, 45, 46, 47,
                if ($last_digit >= 5 && $last_digit <=9 || $last_digit == 0) {
                    return "відгуків";
                }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    
    }

    // the method below displays message for items list under item image
    public static function displayCommentSentence($quantity_of_responses, $product_id)
    {
        try {
              if (empty($product_id)) {
                  throw new Exception("Method displayCommentSentence doesn't get parameter");
                  }
                if ($quantity_of_responses >= 1) {
                // there should be a function which displays us all comments for current id 
                // the function below returns  correct word for quantity of responses
                ?>
                <a href="#" id="item_comment_block" onclick="display_response_tab(<?php echo $product_id; ?>)" > 
                <?php echo $quantity_of_responses . " " .self::choose_right_case($quantity_of_responses);
                ?> </a> <?php
                        } 
                    // there are should be a function which posts a response to DB after onclick event
                    else {
                    ?> 
                    <a href="#" id="item_comment_block" onclick="display_response_tab(<?php echo $product_id; ?>)" >Залишити відгук</a>
                        <?php  
                        }
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }
 
}