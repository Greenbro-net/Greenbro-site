<?php

class ClothesModel extends Database
{
    public function getClothes()
    {
        try {
        $sql = "SELECT * FROM products  WHERE category_id = 'clothes'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results_getClothes = $stmt->fetchAll();
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