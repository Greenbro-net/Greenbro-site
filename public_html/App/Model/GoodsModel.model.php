<?php

namespace App\Model;

use App\Data\DBControllerData;

use Exception;
use PDO;

class GoodsModel extends DBControllerData
{

   private function getGoods()
   {
        try {
        $sql = "SELECT P.*,  COUNT(R.product_id) as response_count 
            FROM `products` P
            LEFT JOIN `response` R ON `R`.`product_id` = `P`.`id`
            WHERE category_id = 'goods'
            group by P.id";


        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
         
        // the parameter in the end for grabs only associative array data 
        $results_getGoods = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results_getGoods)) {
                throw new Exception("Function getGoods wasn't successful");
                    } else {
                         return $results_getGoods;
                           }
        
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    public function showGoods()
    {
        $products = $this->getGoods();
        include CONTENT . 'product-list.content.php';
    }



}