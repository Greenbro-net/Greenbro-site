<?php

class AllProductsModel extends Database
{
    public function getAllProducts()
    {
        try {
        $sql = "SELECT * FROM products";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
    
        $results_AllProducts = $stmt->fetchAll();
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