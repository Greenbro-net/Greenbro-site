<?php

class ClothesModel extends DBController
{
    private function getClothes()
    {
        try {
        $sql = "SELECT P.*,  COUNT(R.product_id) as response_count 
            FROM `products` P
            LEFT JOIN `response` R ON `R`.`product_id` = `P`.`id`
            WHERE category_id = 'clothes'
            group by P.id";
        
        
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
          // the parameter in the end for grabs only associative array data
        $results_getClothes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results_getClothes)) {
                throw new Exception("Function getClothes wasn't successful");
                    } else {
                         return $results_getClothes;
                           }
        
            } catch (Exception $exception) {
                file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    public function showClothes()
    {
        $products = $this->getClothes();
        include CONTENT . 'product-list.content.php';
    }
}