<?php

class ResponseModel extends DBController 
{
   //the method below grabs from `response` table 
   public function findItemResponse($product_id)
   {
       try {
       $query = "SELECT response.*, response_rating.response_id, response_rating.rating 
       FROM response,response_rating WHERE response.response_id = response_rating.response_id AND response.user_id = response_rating.user_id
       AND response.product_id = ?";

       $params = array(
           array(
               "param_type" => "i",
               "param_value" => $product_id
           ));

        $result_findItemResponse = $this->receiveResponseTable($query, $params);
        
        if (empty($product_id)) {
            throw new Exception("Method findItemResponse doesn't get variable of product_id");
              }
        if (empty($result_findItemResponse)) {
                return false;
                } else {
                    return $result_findItemResponse;
                       }
           } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                          }
    }



    // the method below adds new response in `response` table 
    public function addNewComment($user_id, $user_name, $user_email_response, $product_id, $comment, $created_at)
    {
        try {
            $query = "INSERT INTO `response`(`user_id`, `user_name`, `user_email_response`, `product_id`, `comment`, `created_at`) VALUES(?, ?, ?, ?, ?, ?)";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $user_name
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $user_email_response
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $comment
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $created_at
                ));

        // if method was executed successfully it returns 1 or false
        $result_addNewResponse = $this->updateResponseTable($query, $params);
        if (empty($result_addNewResponse)) {
            throw new Exception("Method addNewResponse wasn't successfully");
                         } else {
                             return $result_addNewResponse;
                         }
        } catch (Exception $exception) {
            file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                       }
    }


    // the method below adds new rating to response_rating table 
    public function addNewRating($user_id, $response_id, $rating)
    {
        try {
            $query = "INSERT INTO `response_rating`(`user_id`, `response_id`, `rating`) VALUES(?, ?, ?)";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $response_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $rating
                ));
            // if method was executed succesffully it returns 1 or false
            $result_addNewRating = $this->updateResponseRatingTable($query, $params);
            if (empty($result_addNewRating)) {
                throw new Exception("Method addNewRating wasn't successfully");
                             } else {
                                return $result_addNewRating;
                                    }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                    'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
        
    }

    // the method below checks quantity of comment for item by user from `response` table
    public function grabQuantityComment($user_id, $product_id)
    {
        try {
            $query = "SELECT `response_id` FROM `response` WHERE `user_id` = ? AND `product_id` = ?";
            
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $user_id
                ),
                array(
                    "param_type" => "i",
                    "param_value"  => $product_id
                ));
            $result_grabQuantityComment = $this->receiveResponseTable($query, $params);

            if (empty($user_id) || empty($product_id)) {
                throw new  Exception("Method grabQuantityComment doesn't get variable user_id or product_id");
            }

            if (empty($result_grabQuantityComment)) {
                return false;
                } else {
                    return true;
                       }

            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                    'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }


    // the method below deletes user response by of user id
    public function deleteResponseByUserid()
    {

    }

    // the method below deletes user response rating by of user id
    public function deleteResponseRatingByUserid()
    {
        
    }
    
}

