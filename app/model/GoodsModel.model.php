<?php

class GoodsModel extends Database
{

   public function getGoods()
   {
        try {
        $sql = "SELECT * FROM products  WHERE category_id = 'goods'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        $results_getGoods = $stmt->fetchAll();
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