<?php

class messageController extends Controller
{
    use modelTrait;
    
    // the method below  which shows messages about quantity of products
    // method below hasn't used yet  
    public static function showmessage($products) 
    {    
        $message = "Є в наявності";
        if($products["quantity"] < 6) {
            $message = "Товар закінчується";
        } 
        if ($products["quantity"] == 0) {
            $message = "Товар закінчився";
        }
        return $message;
    }
    

    // the method below displays necessary message in comment block
    public static function showCommentMessage($quantity_of_responses)
    {
        if ($quantity_of_responses >= 1) { 
            // the function below returns  correct word for quantity of responses
            echo $quantity_of_responses . " " . self::get_message_model()->choose_right_case($quantity_of_responses);
        } else {
            echo "Залишити відгук";
               }
    }

    // the method below for calling displayCommentSentence
    public static function calldisplayCommentSentence($quantity_of_responses, $product_id)
    {
        self::get_message_model()->displayCommentSentence($quantity_of_responses, $product_id);
    }
    
}