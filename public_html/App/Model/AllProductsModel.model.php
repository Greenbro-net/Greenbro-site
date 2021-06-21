<?php

namespace App\Model;

use App\Data\DBControllerData;
use Exception;
use PDO;

class AllProductsModel extends DBControllerData
{
    private function getAllProducts()
    {
        try {

            $sql = "SELECT P.*, COUNT(R.product_id) AS response_count
            FROM `products` P
            LEFT JOIN `response` R ON `R`.`product_id` = `P`.`id`
            group by P.id"; 
             
                  
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        
        // the parameter in the end for grabs only associative array data 
        $results_AllProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (empty($results_AllProducts)) {
                    throw new Exception("Function getAllProducts wasn't successful");
                        } else {
                             return $results_AllProducts;
                               }
            
            } catch (Exception $exception) {
                    file_put_contents("my-errors.log", 'Message:' . $exception->getMessage() . '<br />'.   'File: ' . $exception->getFile() . '<br />' .
                    'Line: ' . $exception->getLine() . '<br />' .'Trace: ' . $exception->getTraceAsString());
                                           }
    }

    public function showAllProducts()
    {   
        $products = $this->getAllProducts();
        include CONTENT . 'product-list.content.php';
    }

    
}
