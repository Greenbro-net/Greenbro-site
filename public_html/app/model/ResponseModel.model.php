<?php

class ResponseModel extends DBController 
{
   //the method below grabs from `response` table 
   private function findItemResponse($product_id)
   {
       try {
       $query = "SELECT response.*, response_rating.response_id, response_rating.rating 
       FROM response,response_rating WHERE response.response_id = response_rating.response_id AND response.user_id = response_rating.user_id
       AND response.product_id = 106";

       $params = array(
           array(
               "param_type" => "i",
               "param_value" => $product_id
           ));

        $result_findItemResponse = $this->updateResponseTable($query, $params);
        
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

    // the code below just a simple wrapper for private method findItemResponse
    public function public_findItemResponse($product_id)
    {
        return $this->findItemResponse($product_id);
    }

    // the method below adds new response in `response` table 
    public function addNewResponse($user_id, $user_name, $product_id, $body, $created_at)
    {
        try {
            $query = "INSERT INTO `response`(`user_id`, `user_name`, `product_id`, `body`, `created_at`) VALUES(?, ?, ?, ?, ?)";

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
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "s",
                    "param_value" => $body
                ),
                array(
                    "param_type" => "i",
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


    // the function below adds new rating to response_rating table 
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

    // the method below gets total rating from response_rating table 
    public function getTotalRating($response_id) 
    {
       try {
         $query = "SELECT * FROM `response_table` WHERE response_id = ?";

         $params = array(
             array(
                 "param_type" => "i",
                 "param_value" => $response_id
             ));

        $result_getTotalRating = $this->updateResponseRatingTable($query, $params);

        if (empty($response_id)) {
            throw new Exception("Method getTotalRating doesn't get variable of response_id");
                }
        if (empty($result_getTotalRating)) {
                return false;
                } else {
                    return $result_getTotalRating;
                       }
       } catch (Exception $exception) {
        file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
            'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                      }
    }

    
}

// query which can grab data from two tables response and response_rating
$query = "SELECT response.*, response_rating.response_id, response_rating.rating 
          FROM response,response_rating WHERE response.response_id = response_rating.response_id 
          AND response.product_id = 106";